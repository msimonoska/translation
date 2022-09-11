@extends(View::exists(config('translation.layout'))?
config('translation.layout'):'translation::layout.minimal')


@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">{{__('Translations')}}</h3>
            <a href="{{route('translations.create')}}" class="btn btn-primary btn-sm float-right">{{__('Add')}}</a>
        </div>
        <div class="card-body">
            <table class="table table-striped table-responsive-sm" id="translations">
                <thead>
                <tr>
                    <th scope="col">{{__('Key')}}</th>
                    @foreach(config('translation.languages') as $language)
                        <th scope="col">{{strtoupper($language)}}</th>
                    @endforeach

                    <th scope="col" class="text-right">{{__('Action')}}</th>
                </tr>
                </thead>
                <tbody>
                @foreach($translations as $translation)
                    <tr>
                        <td>
                            {{$translation->key}}
                        </td>
                        @foreach(config('translation.languages') as $language)
                            <td>
                                {{$translation->{"value_$language"} ?? ''}}
                            </td>
                        @endforeach

                        <td class="text-right">
                            <a href="{{route('translations.edit', $translation->id)}}"
                               class="btn btn-primary btn-sm">{{__('Edit')}}</a>

                            <button type="submit"
                                    data-link="{{route('translations.destroy', $translation->id)}}"
                                    class="btn btn-danger btn-sm delete">{{__('Delete')}}</button>
                        </td>
                    </tr>
                @endforeach
                </tbody>
                <div>
                    {{$translations->links()}}
                </div>

                <form action="" id="deleteForm" method="POST">
                    @csrf
                    @method('DELETE')
                </form>
            </table>
        </div>
    </div>

@endsection

@push('scripts')

    <script>
        // init datatable
        $(document).ready(function () {
            $('#translations').DataTable({
                "paging": false,
                "searching": false,
                "ordering": false,
                "info": false,
                "autoWidth": true,
                "responsive": true,
            });
        });

        $('.delete').on('click', function (e) {
            // get link from button's data attribute
            let link = $(this).data('link');


            let form = $('#deleteForm');
            // set action attribute
            form.attr('action', link);

            Swal.fire({
                title: '{{__("Are you sure?")}}',
                text: '{{__("You will not be able to revert this!")}}',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: '{{__("Yes")}}',
                cancelButtonText: '{{__("No")}}',
                reverseButtons: true
            }).then(function (result) {
                if (result.value) {
                    form.submit();
                }
            });
        });
    </script>
@endpush
