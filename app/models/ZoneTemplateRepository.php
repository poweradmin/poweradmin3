<?php

class ZoneTemplateRepository
{
    /**
     * Get list of zone template
     *
     * @return ZoneTemplate[]
     */
    public function getAll()
    {
        if (Entrust::hasRole('Administrator')) {
            $zoneTemplates = ZoneTemplate::all();
        } else {
            $zoneTemplates = ZoneTemplate::where('user_id', '=', Auth::user()->id)->get();
        }

        return $zoneTemplates;
    }

    /**
     * Deleting zone template
     *
     * @param  integer $id
     * @return bool
     */
    public function deleteTemplate($id)
    {
        /** @var ZoneTemplate $zoneTemplates */
        $zoneTemplates = ZoneTemplate::findOrFail($id);

        if (Entrust::hasRole('Administrator') || $zoneTemplates->user_id == Auth::user()->id) {
            $zoneTemplates->delete();

            return true;
        }

        return false;
    }

    /**
     * Get one template
     *
     * @param  integer           $id
     * @return bool|ZoneTemplate
     */
    public function getTemplate($id)
    {
        /** @var ZoneTemplate $zoneTemplate */
        $zoneTemplate = ZoneTemplate::findOrFail($id);

        if (Entrust::hasRole('Administrator') || $zoneTemplate->user_id == Auth::user()->id) {
            return $zoneTemplate;
        }

        return false;
    }

    /**
     * Add new zone template
     *
     * @param  array       $data
     * @return bool|string
     */
    public function addTemplate($data)
    {
        $validator = Validator::make($data, ZoneTemplate::$createRules);

        if ($validator->passes()) {
            DB::beginTransaction();
            try {
                $zoneTemplate = new ZoneTemplate();
                $zoneTemplate->user_id = Auth::user()->id;

                $this->processAddEditTemplate($zoneTemplate, $data);

                DB::commit();
            } catch (\Exception $ex) {
                DB::rollback();

                return $ex->getMessage();
            }

            return true;
        }

        return false;
    }

    /**
     * Edit zone template with their records
     *
     * @param  integer     $id
     * @param  array       $data
     * @return bool|string
     */
    public function editTemplate($id, $data)
    {
        /** @var ZoneTemplate $zoneTemplate */
        $zoneTemplate = ZoneTemplate::findOrFail($id);

        if (Entrust::hasRole('Administrator') || $zoneTemplate->user_id == Auth::user()->id) {
            DB::beginTransaction();
            try {
                $this->processAddEditTemplate($zoneTemplate, $data);
                DB::commit();
            } catch (\Exception $ex) {
                DB::rollback();

                return $ex->getMessage();
            }

            return true;
        }

        return false;
    }

    /**
     * Process of add or update zone template
     *
     * @param  ZoneTemplate $zoneTemplate
     * @param  array        $data
     * @return bool
     */
    private function processAddEditTemplate(ZoneTemplate $zoneTemplate, $data)
    {
        $zoneTemplate->name = array_get($data, 'name');
        $zoneTemplate->description = array_get($data, 'description');
        $zoneTemplate->save();

        $zoneTemplateRecords = [];

        foreach ($data['record_names'] as $key => $record) {
            $templateRecordArray = [
                'template_id' => $zoneTemplate->id,
                'name'  => $data['record_names'][$key],
                'type' => $data['record_types'][$key],
                'content' => $data['record_contents'][$key],
                'ttl' => intval($data['record_ttls'][$key]),
                'priority' => intval($data['record_priorities'][$key]),
            ];
            $recordValidator = Validator::make($templateRecordArray, ZoneTemplateRecord::getCreateRules());

            if ($recordValidator->passes()) {
                $zoneTemplateRecords[] = new ZoneTemplateRecord($templateRecordArray);
            }
        }

        $zoneTemplate->records()->delete();
        $zoneTemplate->records()->saveMany($zoneTemplateRecords);

        return true;
    }

    public static function proceedPlaceholder($element, $domainName, $currDate = null)
    {
        if (is_null($currDate)) {
            $currDate = date('Ymd');
        }

        $currDate .= '00';

        return str_replace(['[ZONE]', '[SERIAL]'], [$domainName, $currDate], $element);
    }
}
