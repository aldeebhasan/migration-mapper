<?php

namespace Aldeebhasan\MigrationMapper\Commands;

use Aldeebhasan\MigrationMapper\Facades\MigrationMapper;
use Illuminate\Console\Command;

class GenerateMigrationsCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'mapper:generate';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This command will handle the changes in your models and generate the related migration files';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $this->output->info('Generating migrations:');
        $logs = MigrationMapper::generateMigration();
        $count = count($logs);
        $this->output->table(['Table', 'Migration'], $logs);
        $this->output->success("($count) Migration files generated successfully");
    }
}
