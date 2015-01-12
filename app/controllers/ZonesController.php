<?php

class ZonesController extends BaseController
{
    public function getAddSlave()
    {
        $domain = new Domain();
        $usersList = User::all()->lists('username', 'username');

        return View::make('zones.edit')
            ->withDomain($domain)
            ->with('usersList', $usersList);
    }

    public function postAddSlave()
    {
        $post = Input::all();

        $validator = Validator::make($post, Domain::$createSlaveRules);

        if ($validator->passes()) {
            $domain = new Domain();
            $domain->name = $post['name'];
            if (!empty($post['master'])) {
                $domain->master = $post['master'];
            }
            $domain->type = 'SLAVE';
            $domain->account = $post['account'];
            $saved = $domain->save();

            if ($saved === true) {
                return Redirect::to('/dashboard')
                    ->withSuccess('Slave zone added');
            } elseif ($saved instanceof Domain) {
                return Redirect::back()
                    ->withInput()
                    ->withErrors('The slave zone (ip and hostname) exists');
            } else {
                return Redirect::back()
                    ->withInput()
                    ->withErrors('Cant save the slave zone :/');
            }
        } else {
            return Redirect::back()
                ->withInput()
                ->withErrors($validator->errors()->all());
        }
    }

    public function getTemplates()
    {
        /** @var ZoneTemplateRepository $templateRepo */
        $templateRepo = App::make('ZoneTemplateRepository');

        $templates = $templateRepo->getAll();

        return View::make('zones.templates')
            ->withTemplates($templates);
    }

    public function getAddTemplate()
    {
        $template = new ZoneTemplate();

        return View::make('zones.edit-templates')
            ->withTemplate($template);
    }

    public function postAddTemplate()
    {
        /** @var ZoneTemplateRepository $templateRepo */
        $templateRepo = App::make('ZoneTemplateRepository');

        $addTemplate = $templateRepo->addTemplate(Input::all());

        if ($addTemplate) {
            return Redirect::to('/zones/templates')
                ->withSuccess('Template added');
        } else {
            return Redirect::back()
                ->withErrors('You cant add the template');
        }
    }

    public function getDeleteTemplate($id)
    {
        /** @var ZoneTemplateRepository $templateRepo */
        $templateRepo = App::make('ZoneTemplateRepository');

        $deletedTemplate = $templateRepo->deleteTemplate($id);

        if ($deletedTemplate) {
            return Redirect::back()
                ->withSuccess('Template deleted');
        } else {
            return Redirect::back()
                ->withErrors('You cant delete the template');
        }
    }

    public function getEditTemplate($id)
    {
        /** @var ZoneTemplateRepository $templateRepo */
        $templateRepo = App::make('ZoneTemplateRepository');

        $template = $templateRepo->getTemplate($id);

        if ($template === false) {
            return $this->redirectUnprivileges();
        }

        return View::make('zones.edit-templates')
            ->withTemplate($template);
    }

    public function postEditTemplate($id)
    {
        /** @var ZoneTemplateRepository $templateRepo */
        $templateRepo = App::make('ZoneTemplateRepository');

        $editedTemplate = $templateRepo->editTemplate($id, Input::all());

        if ($editedTemplate) {
            return Redirect::to('/zones/templates')
                ->withSuccess('Template edited');
        } else {
            return Redirect::back()
                ->withErrors('You cant edit the template');
        }
    }

    public function getAddMaster()
    {
        $domain = new Domain();
        $usersList = User::all()->lists('username', 'username');

        /** @var ZoneTemplateRepository $templateRepo */
        $templateRepo = App::make('ZoneTemplateRepository');

        $templates = $templateRepo->getAll()->lists('name', 'id');

        return View::make('zones.master')
            ->withDomain($domain)
            ->withTemplates($templates)
            ->with('usersList', $usersList);
    }

    public function postAddMaster()
    {
        $post = Input::all();

        /** @var DomainRepository $domainRepo */
        $domainRepo = App::make('DomainRepository');

        $added = $domainRepo->addMaster($post);

        if ($added === true) {
            return Redirect::to('/dashboard')
                ->withSuccess('Zone added');
        } else {
            return Redirect::back()
                ->withInput()
                ->withErrors($added);
        }
    }
}
