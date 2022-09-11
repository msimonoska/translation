<?php

class Translation
{
    // Create from file
    public static function createFromFile(string $file): bool
    {
        try{
            // read json file
            $json = file_get_contents($file);

            // decode json to array
            $array = json_decode($json, true);

            // read filename
            $filename = pathinfo($file, PATHINFO_FILENAME);

            // the filename is the language for example en.json
            $language = $filename;

            // use the translation model
            $translationModel = config('translations.model');

            // for each key in the array create a translation in the database
            foreach ($array as $key => $value) {

                // check if key exists
                $translation = $translationModel::where('key', $key)->first();

                // if key exists update the value
                if ($translation) {
                    $translation->update([
                        "value_$language" => $value,
                    ]);
                } else {
                    // if key does not exist create a new translation
                    $translationModel::create([
                        'key' => $key,
                        "value_$language" => $value,
                    ]);
                }

            }

            return true;
        }
        catch (\Exception $e){
            return false;
        }

    }

    // Truncate translations
    public static function truncateTranslations(): bool
    {
        try{
            // use the translation model
            $translationModel = config('translations.model');

            // truncate translations
            $translationModel::truncate();

            return true;
        }
        catch (\Exception $e){
            return false;
        }
    }


}
