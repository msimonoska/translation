<?php

namespace Msimonoska\Translation;

class Translation
{
    // Create from file
    public static function createFromFile(string $file): self
    {
        // read json file
        $json = file_get_contents($file);

        // decode json to array
        $array = json_decode($json, true);

        // read filename
        $filename = pathinfo($file, PATHINFO_FILENAME);

        // the filename is the language for example en.json
        $language = $filename;

        // for each key in the array create a translation in the database
        foreach ($array as $key => $value) {

            // check if key exists
            $translation = self::where('key', $key)->first();

// if key exists update the value
            if ($translation) {
                $translation->update([
                    $language => $value,
                ]);
            } else {
                // if key does not exist create a new translation
                self::create([
                    'key' => $key,
                    $language => $value,
                ]);
            }
            // create translation
            $translation = new self();
            $translation->language = $language;
            $translation->key = $key;
            $translation->value = $value;
            $translation->save();
        }

        return new self();
    }
}
