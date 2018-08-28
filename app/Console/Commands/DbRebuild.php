<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class DbRebuild extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'db:fresh';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Drops all tables, then executes all migrations. If nWidart/laravel-modules is enabled,
     executes all migrations and seed from Modules.';

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
    public function handle()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        foreach (DB::select('SHOW TABLES') as $table) {
            $table_array = get_object_vars($table);
            DB::statement('Drop table ' . $table_array[key($table_array)]);
            /*Schema::drop($table_array[key($table_array)]);*/
        }
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
        $this->call('migrate');
        if (env('APP_HAS_MODULES', false)) {
            $this->call('module:migrate');
            $this->call('module:seed');
        }

    }
}
