@extends('layouts.app')

@push('individual_styles')
    {{--    <link rel="stylesheet" href="{{ asset('css/choices.base.min.css') }}">--}}
    <link rel="stylesheet" href="{{ asset('css/choices.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/custom/realty_characteristics.css') }}">
@endpush

@section('content')
    <div class="container mb-2">
        <form class="w-100">
            <div class="row">
                <div class="col-3">
                    <div class="row justify-content-center">
                        <div class="select_wr">
                            <label for="category_select">Категорія</label>
                            <select name="realty_type_parent_id" id="category_select">
                                <option value=""></option>
                                {{--@foreach($categories as $category)
                                    <option value="{{ $category->ext_id }}" @if(request()->get('realty_type_parent_id') == $category->ext_id) selected @endif>{{ $category->name }}</option>
                                @endforeach--}}
                            </select>
                        </div>
                    </div>
                </div>
                <div class="col-3">
                    <div class="row justify-content-center">
                        <div class="select_wr">
                            <label for="realty_type_select">Тип</label>
                            <select name="realty_type_id" id="realty_type_select">
                                <option value=""></option>
                                {{--@foreach($realty_types as $realty_type)
                                    <option value="{{ $realty_type->ext_id }}" @if(request()->get('realty_type_id') == $realty_type->ext_id) selected @endif>{{ $realty_type->name }}</option>
                                @endforeach--}}
                            </select>
                        </div>
                    </div>
                </div>
                <div class="col-3">
                    <div class="row justify-content-center">
                        <div class="select_wr">
                            <label for="operation_type_select">Операція</label>
                            <select id="operation_type_select" name="advert_type_id">
                                <option value=""></option>
                                {{--@foreach($operation_types as $operation_type)
                                    <option value="{{ $operation_type->ext_id }}" @if(request()->get('advert_type_id') == $operation_type->ext_id) selected @endif>{{ $operation_type->name }}</option>
                                @endforeach--}}
                            </select>
                        </div>
                    </div>
                </div>
                <div class="col-3">
                    <div class="row justify-content-center">
                        <div class="select_wr">
                            <button class="btn btn-success w-100" style="margin-top: 32px;">Поиск</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-3">
                    <div class="row justify-content-center">
                        <div class="select_wr">
                            <label for="sort_select">Сортировка</label>
                            <select id="sort" name="sort">
                                <option value="1" >По дате</option>
                                <option value="2" >Цена по возростанию</option>
                                <option value="3" >Цена по убиванию</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <button class="btn btn-info" id="subscribe">Підписатись</button>
                </div>
            </div>
        </form>
    </div>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                @foreach($orders as $order)

                    <div class="card mb-3">
                        <div class="row no-gutters">

                                <div class="col-md-4">
                                    <a href="{{ config('common.dom_ria_base_url') . $order->beautiful_url }}" target="_blank">
                                        <img src="{{ config('common.ria_images_base_url') . $order->main_photo }}" class="card-img" alt="...">
                                    </a>
                                </div>
                                <div class="col-md-8">
                                    <div class="card-body">
                                        <h4 class="card-title">
                                            <a href="{{ config('common.dom_ria_base_url') . $order->beautiful_url }}" target="_blank">
                                                {{ $order->district_type }}
                                                {{ $order->district_name }}
                                                {{ $order->street_name }}
                                                {{ $order->building_number_str }}
                                                {{ $order->flat_number }}
                                            </a>

                                            ( {{ $order->ext_id }} )

                                        </h4>
                                        <h5 style="color: green;"><b>{{ $order->price }} {{ $order->currency_type }}</b></h5>
                                        <p>{{ $order->operation_type_name }} {{ $order->realty_type_name }}</p>
                                        <div class="d-flex justify-content-between">
                                            @if($order->rooms_count) <p>Комнат: {{ $order->rooms_count }}</p> @endif
                                            @if($order->floors_count) <p>Этаж: {{ $order->floor }} / {{ $order->floors_count }}</p> @endif
                                            @if($order->total_square_meters) <p>Площадь: {{ $order->total_square_meters }} м<sup>2</sup></p> @endif
                                        </div>
                                        <p class="card-text">{{ $order->description }}</p>
                                        <p class="card-text"><small class="text-muted">{{ $order->publishing_date }}</small></p>
                                    </div>
                                </div>

                        </div>
                    </div>

                @endforeach
            </div>
        </div>
    </div>
@endsection

@push('individual_scripts')
    <script src="{{ asset('js/choices.min.js') }}"></script>
@endpush

@push('page_script')
    <script>
        $(function () {

            $('#subscribe').on('click', subscribe);

            var categories = {};
            var realty_types = {};
            var operation_types = {};

            var select_config = {
                shouldSort: false,
                itemSelectText: '',
                noChoicesText: '',
            };

            var categories_select = new Choices($('#category_select').get(0), select_config);
            var realty_types_select = new Choices($('#realty_type_select').get(0), select_config);
            var operation_types_select = new Choices($('#operation_type_select').get(0), select_config);
            var sort_select = new Choices($('#sort').get(0), Object.assign({searchEnabled: false}, select_config));

            getCategories();
            getRealtyTypes();
            getOperationTypes();

            function getCategories() {
                $.ajax({
                    url: '{{ route('getCategories') }}'
                })
                .done(function (response) {
                    categories = response.data;
                    fillCategorySelect();
                })
            }

            function getRealtyTypes() {
                $.ajax({
                    url: '{{ route('getRealtyTypes') }}'
                })
                .done(function (response) {
                    realty_types = response.data;

                    fillRealtyTypeSelect();
                });
            }

            function getOperationTypes() {
                $.ajax({
                    url: '{{ route('getOperationTypes') }}'
                })
                .done(function (response) {
                    operation_types = response.data;
                    fillOperationTypes();
                })
            }

            function fillCategorySelect() {
                let categories_local = [];

                $.each(categories, function (index, element) {
                    categories_local.push({
                        value: element.ext_id,
                        label: element.name,
                        selected: element.ext_id == '{{ request()->get('realty_type_parent_id') }}'
                    });
                });

                categories_select.setChoices(categories_local);
            }

            function fillRealtyTypeSelect() {
                let realty_types_local = [];

                $.each(realty_types, function (index, element) {
                    if(element.category_ext_id != categories_select.passedElement.value)
                        return;

                    realty_types_local.push({
                        value: element.ext_id,
                        label: element.name,
                        selected: element.ext_id == '{{ request()->get('realty_type_id') }}'
                    });
                });

                realty_types_select.setChoices(realty_types_local, 'value', 'label', true);
            }

            function fillOperationTypes() {
                let operation_types_local = [];

                $.each(operation_types, function (index, element) {
                    operation_types_local.push({
                        value: element.ext_id,
                        label: element.name,
                        selected: element.ext_id == '{{ request()->get('advert_type_id') }}'
                    });
                });

                operation_types_select.setChoices(operation_types_local);
            }

            function subscribe(event) {

            }

            $('#category_select').on('change', function (event) {
                fillRealtyTypeSelect();
            });
        });



    </script>
@endpush
