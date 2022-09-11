<?php
namespace Msimonoska\Translation\Console;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
class InstallTranslationPackage extends Command
{
    protected $signature = 'translation:install';

    protected $description = 'Install the Translation Package';

    public function handle()
    {
        $this->info('Installing Translation Package...');

        $this->info('Publishing configuration...');

        // run the vendor:publish command

        $this->call('vendor:publish', [
            '--provider' => "Msimonoska\Translation\Providers\TranslationServiceProvider"
        ], [
            '--force' => true
        ]);


        $this->info('Installed Translation Package');
    }

}
