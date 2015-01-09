<?php

class BaseController extends Controller
{
    /**
     * Setup the layout used by the controller.
     *
     * @return void
     */
    protected function setupLayout()
    {
        if (! is_null($this->layout)) {
            $this->layout = View::make($this->layout);
        }
    }

    public function redirectUnprivileges()
    {
        return Redirect::back()
            ->withError('Sorry, you dont have permission to see previous page');
    }
}
