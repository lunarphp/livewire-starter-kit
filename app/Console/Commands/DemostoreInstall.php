<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class DemostoreInstall extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'demostore:install';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command to install the files required by the demo store.';

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
     * @return int
     */
    public function handle()
    {
        $this->info('Copying across config files');

        $files = File::files(
            base_path('installer/config')
        );

        foreach ($files as $file) {
            File::put(
                config_path('getcandy/'.$file->getFilename()),
                $file->getContents()
            );
        }

        return 0;
    }
}
