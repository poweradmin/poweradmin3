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
        if(Entrust::hasRole('Administrator')) {
            $zoneTemplates = ZoneTemplate::all();
        } else {
            $zoneTemplates = ZoneTemplate::where('user_id', '=', Auth::user()->id)->get();
        }

        return $zoneTemplates;
    }

    /**
     * Deleting zone template
     *
     * @param integer $id
     * @return bool
     */
    public function deleteTemplate($id)
    {
        $zoneTemplates = ZoneTemplate::findOrFail($id);

        if(Entrust::hasRole('Administrator') || $zoneTemplates->user_id==Auth::user()->id) {
            $zoneTemplates->delete();

            return true;
        }

        return false;
    }
}
