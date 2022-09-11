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

        // config
        if (! $this->configExists('translation.php')) {
            $this->publishConfiguration();
            $this->info('Published configuration');
        } else {
            if ($this->shouldOverwriteConfig()) {
                $this->info('Overwriting configuration file...');
                $this->publishConfiguration($force = true);
            } else {
                $this->info('Existing configuration was not overwritten');
            }
        }

        // migrations
        if (! $this->migrationExists('create_translations_table.php')) {
            $this->publishMigrations();
            $this->info('Published migrations');
        } else {
            if ($this->shouldOverwriteMigrations()) {
                $this->info('Overwriting migrations...');
                $this->publishMigrations($force = true);
            } else {
                $this->info('Existing migrations were not overwritten');
            }
        }

        // views
        if (! $this->viewExists('translation::index')) {
            $this->publishViews();
            $this->info('Published views');
        } else {
            if ($this->shouldOverwriteViews()) {
                $this->info('Overwriting views...');
                $this->publishViews($force = true);
            } else {
                $this->info('Existing views were not overwritten');
            }
        }

        $this->info('Installed Translation Package');
    }

    private function configExists($fileName)
    {
        return File::exists(config_path($fileName));
    }

    private function migrationExists($fileName)
    {
        return File::exists(database_path('migrations/' . $fileName));
    }

    private function viewExists($fileName)
    {
        return File::exists(resource_path('views/' . $fileName));
    }

    private function shouldOverwriteConfig()
    {
        return $this->confirm(
            'Config file already exists. Do you want to overwrite it?',
            false
        );
    }

    private function shouldOverwriteMigrations()
    {
        return $this->confirm(
            'Migrations already exist. Do you want to overwrite them?',
            false
        );
    }

    private function shouldOverwriteViews()
    {
        return $this->confirm(
            'Views already exist. Do you want to overwrite them?',
            false
        );
    }

    private function publishConfiguration($forcePublish = false)
    {
        $params = [
            '--provider' => "Msimonoska\Translation\TranslationServiceProvider",
            '--tag' => "config"
        ];

        if ($forcePublish === true) {
            $params['--force'] = true;
        }

        $this->call('vendor:publish', $params);
    }

    private function publishMigrations($forcePublish = false)
    {
        $params = [
            '--provider' => "Msimonoska\Translation\TranslationServiceProvider",
            '--tag' => "migrations"
        ];

        if ($forcePublish === true) {
            $params['--force'] = true;
        }

        $this->call('vendor:publish', $params);
    }

    private function publishViews($forcePublish = false)
    {
        $params = [
            '--provider' => "Msimonoska\Translation\TranslationServiceProvider",
            '--tag' => "views"
        ];

        if ($forcePublish === true) {
            $params['--force'] = true;
        }

        $this->call('vendor:publish', $params);
    }
}
