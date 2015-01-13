<?php

class DomainRepository
{
    /**
     * Add master zone
     *
     * @param  array      $data
     * @return array|bool
     */
    public function addMaster(array $data)
    {
        $recordValidator = Validator::make($data, Domain::getCreateMasterRules());

        if ($recordValidator->passes()) {
            $domain = new Domain();
            $domain->name = array_get($data, 'name');
            $domain->type = strtoupper(array_get($data, 'type'));
            $domain->account = array_get($data, 'account');
            if ($domain->account == 'admin') {
                $domain->account = null;
            }
            $domain->save();

            // attach an zone template
            if (is_numeric($data['template'])) {
                /** @var ZoneTemplateRepository $templateRepo */
                $templateRepo = App::make('ZoneTemplateRepository');

                $template = $templateRepo->getTemplate($data['template']);

                if ($template instanceof ZoneTemplate) {
                    foreach ($template->records as $templateRecord) {
                        $domainRecord = new Record();
                        $domainRecord->domain_id = $domain->id;
                        $domainRecord->name = ZoneTemplateRepository::proceedPlaceholder($templateRecord->name, $domain->name);
                        $domainRecord->type = $templateRecord->type;
                        $domainRecord->content = ZoneTemplateRepository::proceedPlaceholder($templateRecord->content, $domain->name);
                        $domainRecord->ttl = $templateRecord->ttl;
                        $domainRecord->prio = $templateRecord->priority == 0 ? null : $templateRecord->priority;
                        $domainRecord->save();
                    }
                }
            }

            return true;
        }

        return $recordValidator->errors()->all();
    }

    /**
     * Delete domain and it records
     *
     * @param  int       $id
     * @return bool
     * @throws Exception
     */
    public function deleteDomain($id)
    {
        /** @var Domain $domain */
        $domain = Domain::findOrFail($id);

        if (Entrust::hasRole('Administrator') || $domain->account == Auth::user()->username) {
            $domain->records()->delete();
            $domain->delete();

            return true;
        }

        return false;
    }
}
