<?php

use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;
use Illuminate\Support\Facades\Config;
use Illuminate\Console\ConfirmableTrait;

class IpsumReloadDb extends Command {

    use ConfirmableTrait;

    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'ipsum:reloadDb';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Recrer la bdd.';

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
        if ( ! $this->confirmToProceed()) return;

        $tables = DB::select('SHOW TABLES');
        DB::statement('SET FOREIGN_KEY_CHECKS=0');
        foreach($tables as $table) {
            foreach ($table as $key => $value) {
                Schema::drop($value);
            }
        }
        DB::statement('SET FOREIGN_KEY_CHECKS=1');

        $this->call(
            'ipsum:update'
        );
        $this->call(
            'db:seed'
        );
        $this->call(
            'cache:clear'
        );
    }

}
