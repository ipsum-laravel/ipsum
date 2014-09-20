<?php

use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;

class IpsumInstall extends Command {

    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'ipsum:install';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Install Ipsum Packages.';

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
            'key:generate'
        );
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
        $this->call(
            'config:publish',
            array('package' => 'ipsum/admin')
        );
        $this->call(
            'db:seed'
        );
    }

}
