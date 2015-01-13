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
                        $domainRecord->ttl = intval($templateRecord->ttl);
                        $domainRecord->prio = intval($templateRecord->priority);
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

    public function getDomain($id)
    {
        /** @var Domain $domain */
        $domain = Domain::findOrFail($id);

        if (Entrust::hasRole('Administrator') || $domain->account == Auth::user()->username) {
            return $domain;

            return true;
        }

        return false;
    }

    public function editDomain($id, $data)
    {
        /** @var Domain $domain */
        $domain = Domain::findOrFail($id);

        if (Entrust::hasRole('Administrator') || $domain->account == Auth::user()->username) {
            $domainRecordsList = $domain->records()->lists('id');

            // modified and deleted records
            if (isset($data['record_names'])) {
                // deleted records
                $deletedRecordsIds = array_diff($domainRecordsList, array_keys($data['record_names']));
                if (!empty($deletedRecordsIds)) {
                    Record::destroy($deletedRecordsIds);
                }

                // changed recordss
                foreach ($data['record_names'] as $key => $record) {
                    $record = Record::findOrFail($key);
                    $record->name = $data['record_names'][$key];
                    $record->type = $data['record_types'][$key];
                    $record->content = $data['record_contents'][$key];
                    $record->ttl = $data['record_ttls'][$key];
                    $record->prio = $data['record_priorities'][$key];
                    $record->save();
                }
            }

            // new records
            if (isset($data['record_names_new'])) {
                $domainRecords = [];
                foreach ($data['record_names_new'] as $key => $record) {
                    $domainRecordArray = [
                        'domain_id' => $domain->id,
                        'name' => $data['record_names_new'][$key],
                        'type' => $data['record_types_new'][$key],
                        'content' => $data['record_contents_new'][$key],
                        'ttl' => intval($data['record_ttls_new'][$key]),
                        'prio' => intval($data['record_priorities_new'][$key]),
                    ];
                    $recordValidator = Validator::make($domainRecordArray, Record::getCreateRules());

                    if ($recordValidator->passes()) {
                        $domainRecords[] = new Record($domainRecordArray);
                    }
                }

                if (!empty($domainRecords)) {
                    $domain->records()->saveMany($domainRecords);
                }
            }

            return true;
        }

        return false;
    }
}
