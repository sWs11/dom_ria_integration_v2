@extends('layouts.app')

@push('individual_styles')
{{--    <link rel="stylesheet" href="{{ asset('css/choices.base.min.css') }}">--}}
    <link rel="stylesheet" href="{{ asset('css/choices.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/custom/realty_characteristics.css') }}">
@endpush

@section('content')

    <div class="container">

        <form action="{{ route('getRealtyCharacteristicsFromApi') }}">
            <div class="row justify-content-center">
                <div class="select_wr">
                    <select id="category_select" name="category">
                        @foreach($categories as $category)
                            <option value="{{ $category->ext_id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>

            </div>

            <div class="row justify-content-center">
                <div class="select_wr">
                    <select id="realty_type_select" name="realty_type">
                        @foreach($realty_types as $category_name => $options)
                            <optgroup label="{{ $category_name }}">
                                @foreach($options as $realty_type)
                                    <option value="{{ $realty_type->ext_id }}">{{ $realty_type->name }}</option>
                                @endforeach
                            </optgroup>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="row justify-content-center">
                <div class="select_wr">
                    <select id="operation_type_select" name="operation_type">
                        @foreach($operation_types as $operation_type)
                            <option value="{{ $operation_type->ext_id }}">{{ $operation_type->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="row justify-content-center">
                <button type="submit" class="btn btn-success">Отримати характеристики</button>
            </div>
        </form>

    </div>

@endsection


@push('individual_scripts')
    <script src="{{ asset('js/choices.min.js') }}"></script>
@endpush

@push('page_script')
    <script>
        $(function () {
            var select_config = {
                shouldSort: false
            };

            var categories_select = new Choices($('#category_select').get(0), select_config);
            var operation_types = new Choices($('#operation_type_select').get(0), select_config);
            var realty_types = new Choices($('#realty_type_select').get(0), select_config);
        });

        $('#category_select').on('change', function (event) {
            console.log('category_select changes');
        });

    </script>
@endpush
