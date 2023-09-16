<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;

class RunMigrationCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:migrate';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Migrate project databases all tables';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->comment('Running migrate:fresh');
//        Artisan::call('migrate');
        Artisan::call('migrate:fresh', [
            '--force' => true,
        ]);
        $this->info('Migration has been completed.');
    }
}
