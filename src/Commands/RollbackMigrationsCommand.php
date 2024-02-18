<?php

namespace Aldeebhasan\MigrationMapper\Commands;

use Aldeebhasan\MigrationMapper\Facades\MigrationMapper;
use Illuminate\Console\Command;

class RollbackMigrationsCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'mapper:rollback';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This command will reverse the last generation of migration files';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $this->output->info('Generating migrations:');
        MigrationMapper::rollbackMigration();
        $this->output->success('Rollback done successfully');
    }
}
