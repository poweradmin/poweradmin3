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
        $zoneTemplates = ZoneTemplate::findOrFail($id);

        if (Entrust::hasRole('Administrator') || $zoneTemplates->user_id == Auth::user()->id) {
            return $zoneTemplates;
        }

        return false;
    }

    /**
     * Edit zone template with their records
     *
     * @param  integer $id
     * @param  array   $data
     * @return bool
     */
    public function editTemplate($id, $data)
    {
        $zoneTemplate = ZoneTemplate::findOrFail($id);

        if (Entrust::hasRole('Administrator') || $zoneTemplate->user_id == Auth::user()->id) {
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

        return false;
    }
}
