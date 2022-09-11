<?php

namespace Msimonoska\Translation\Controllers;

class TranslationController
{
    private $translationModel;

    public function __construct()
    {
        $this->translationModel = config('translation.model');
    }


    public function index()
    {
        // paginate translations
        $translations = $this->translationModel::paginate(10);

        // return view
        return view('translation::index', compact('translations'));
    }

    public function show($id)
    {
        // find translation
        $translation = $this->translationModel::find($id);

        return view('translation::show', compact('translation'));
    }

    public function create()
    {
        return view('translation::create');
    }

    public function store()
    {
        // validate request
        $data = request()->validate([
            'key' => 'required|string|unique:translations',
        ]);

        // create translation
        $translation = new $this->translationModel();
        $translation->key = $data['key'];
        // If we have value_en, value_de, value_fr, etc. in the request
        // we will save them in the database
        foreach (config('translation.languages') as $language) {
            if (request()->has('value_' . $language)) {
                $translation->{'value_' . $language} = request()->input('value_' . $language);
            }
        }

        // save translation
        $translation->save();

        return redirect()
            ->route('translations.index')
            ->with('success', __('Translation created successfully'));
    }

    public function edit($id)
    {
        // find translation
        $translation = $this->translationModel::find($id);

        return view('translation::edit', compact('translation'));
    }

    public function update($id)
    {
        // find translation
        $translation = $this->translationModel::find($id);

        // validate request
        $data = request()->validate([
            'key' => 'required|string|unique:translations,key,' . $id,
        ]);

        // update translation
        $translation->key = $data['key'];
        // If we have value_en, value_de, value_fr, etc. in the request
        // we will save them in the database
        foreach (config('translation.languages') as $language) {
            if (request()->has('value_' . $language)) {
                $translation->{'value_' . $language} = request()->input('value_' . $language);
            }
        }

        return redirect()
            ->route('translations.edit', $id)
            ->with('success', __('Translation updated successfully'));
    }

    public function destroy($id)
    {
        // find translation
        $translation = $this->translationModel::find($id);

        // delete translation
        $translation->delete();

        return redirect()
            ->route('translations.index')
            ->with('success', __('Translation deleted successfully'));
    }

}
