<?php

class BaseController extends Controller {

    public $layout = 'layouts.website';

	/**
	 * Setup the layout used by the controller.
	 *
	 * @return void
	 */
	protected function setupLayout()
	{
		if ( ! is_null($this->layout))
		{
			$this->layout = View::make($this->layout);
		}
        if (isset($this->title)) {
            $this->layout->title = $this->title;
        }
        if (isset($this->rubrique)) {
            $this->layout->rubrique = $this->rubrique;
        }
	}

    public function __construct()
    {
        $this->beforeFilter('csrf', array('on' => array('post')));

    }

}