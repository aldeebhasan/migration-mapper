<?php

namespace Aldeebhasan\MigrationMapper\Commands;

use Aldeebhasan\MigrationMapper\Facades\MigrationMapper;
use Illuminate\Console\Command;

class RegenerateMigrationsCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'mapper:regenerate';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This command will remove all the generated migrations and regenerate them from scratch';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $this->output->info('Regenerating migrations:');
        $this->output->confirm('Are you sure you want to regenerate migrations?');
        $logs = MigrationMapper::regenerateMigration();
        $count = count($logs);
        $this->output->table(['Table', 'Migration'], $logs);
        $this->output->success("($count) Migration files generated successfully");
    }
}
