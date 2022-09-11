<?php
namespace Msimonoska\Translation\Console;

use Illuminate\Console\Command;
use Msimonoska\Translation\Models\Translation;

class ImportTranslations extends Command
{
    protected $signature = 'translation:import';

    protected $description = 'Import key-value pairs from a json file to the database';

    public function handle()
    {
        $this->info('Importing translations...');

        // for each language
        foreach (config('translation.languages') as $language){
            $this->info('Importing translations for language: ' . $language);

            $path = lang_path($language . '.json');

            // check if file exists

            if(file_exists($path)){
                // get the json file
                $json = file_get_contents(lang_path($language . '.json'));

                // decode the json file
                $translations = json_decode($json, true);

                // for each key-value pair
                foreach ($translations as $key => $value){

                    // check if the key already exists in the database
                    $translation = Translation::where('key', $key)->first();

                    // if the key does not exist in the database
                    if (!$translation){
                        // create a new translation
                        $translation = new Translation();
                        $translation->key = $key;
                    }
                    $translation->{"value_".$language} = $value;
                    $translation->save();
                }
            }
        }

        $this->info('Translations imported successfully!');
    }

}
