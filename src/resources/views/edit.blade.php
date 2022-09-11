@extends(View::exists(config('translation.layout'))?
config('translation.layout'):'translation::layout.minimal')


@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">{{__(' Edit Translations')}}</h3>
        </div>
        <div class="card-body">
            <form action="{{route('translations.update', $translation->id)}}" method="POST">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="key">{{__('Key')}}</label>
                    <input type="text" name="key"  value="{{old('key', $translation->key)}}" id="key" class="form-control" required>
                    @error('key')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                @foreach(config('translation.languages') as $language)
                    <div class="form-group">
                        <label for="value_{{$language}}">{{strtoupper($language)}}</label>
                        <input type="text" name="value_{{$language}}" id="value_{{$language}}"
                               value="{{old('value_'.$language, $translation->{'value_'.$language})}}"
                               class="form-control">
                    </div>
                @endforeach
                <button type="submit" class="btn btn-primary">{{__('Update')}}</button>
            </form>
        </div>
    </div>

@endsection

