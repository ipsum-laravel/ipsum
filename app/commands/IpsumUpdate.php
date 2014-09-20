<?php

use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;

class IpsumUpdate extends Command {

	/**
	 * The console command name.
	 *
	 * @var string
	 */
	protected $name = 'ipsum:update';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'Update Ipsum Packages.';

	/**
	 * Create a new command instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		parent::__construct();
	}

	/**
	 * Execute the console command.
	 *
	 * @return mixed
	 */
    public function fire() {
        $this->call(
            'migrate',
            array('--package' => 'ipsum/core')
        );
        $this->call(
            'asset:publish',
            array('package' => 'ipsum/admin')
        );
        $this->call(
            'migrate',
            array('--package' => 'ipsum/admin')
        );
    }

}
