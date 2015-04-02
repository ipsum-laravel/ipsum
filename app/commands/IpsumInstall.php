<?php

use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;
use Illuminate\Support\Facades\Config;

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
        if (Config::get('app.key') == 'YourSecretKey!!!') {
            $this->call(
                'key:generate'
            );
        }
        if (Schema::hasTable(Config::get('database.migrations'))) {
            $this->error('Stop install, migration déja installé.');
            return false;
        }
        $this->call(
            'ipsum:update'
        );
        $this->call(
            'db:seed'
        );
    }

}
