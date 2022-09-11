<?php
namespace Msimonoska\Translation\Console;

use Illuminate\Console\Command;
use Msimonoska\Translation\Models\Translation;

class ExportTranslations extends Command
{
    protected $signature = 'translation:export';

    protected $description = 'Create backup json files from the database';

    public function handle()
    {
        $this->info('Exporting translations...');

        $path = 'backup/'.date('Y-m-d_H-i-s');

        // check if there exists a directory backup in the resource/lang directory
        if (!file_exists(lang_path('backup'))){
            // if not, create it
            mkdir(lang_path('backup'), 0777, true);
        }

        // inside backup create a directory with current datetime
        mkdir(lang_path($path), 0777, true);

        // for each language
        foreach (config('translation.languages') as $language){
            $this->info('Exporting translations for language: ' . $language);

            // get all translations
            $translations = Translation::all();

            // create an array with key-value pairs
            $array = [];
            foreach ($translations as $translation){
                $array[$translation->key] = $translation->{"value_".$language};
            }

            // encode the array to json
            $json = json_encode($array, JSON_PRETTY_PRINT);

            // save the json file inside backup directory with todays datetime as prefix
            file_put_contents(
                lang_path($path . '/' . $language . '.json'),
                stripslashes($json));
        }

        $this->info('Translations exported successfully!');
    }

}
