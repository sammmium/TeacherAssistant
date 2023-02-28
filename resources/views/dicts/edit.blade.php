@extends('layouts.app')

@section('scripts')
    $(document).ready(function() {
        /* подсветка кнопки меню */
        $('a.button-dicts').parent().addClass('selected-button');
    });
@endsection

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Справочник</div>

                    <div class="card-body">
                        <div class="card-row col-md-12">
                            <div class="col-md-3 card-row-title">Наименование справочника</div>
                            <div class="col-md-7 card-row-head">{{ $selected['value'] }}</div>
                            <div class="col-md-2 card-row-button">
                                <a class="btn btn-primary" href="{{ route('dicts-select', $selected['id']) }}" title="На уровень выше">
                                    <i class="fa fa-solid fa-arrow-up"></i>
                                </a>
                            </div>
                        </div>

                        <hr>

                        <form method="POST" action="{{ route('dict-update') }}">
                            @csrf
                            <input type="hidden" name="parent_id" value="{{ $selected['id'] }}">
                            <input type="hidden" name="id" value="{{ $item['id'] }}">

                            <div class="card-row col-md-12">
                                <div class="col-md-4 card-row-title">Код</div>
                                <div class="col-md-7 card-row-value">
                                    <input type="text" name="code" class="col-md-7" placeholder="Интуитивно-понятный код" value="{{ $item['code'] }}">
                                </div>
                                <div class="col-md-1 card-row-button"></div>
                            </div>

                            <div class="card-row col-md-12">
                                <div class="col-md-4 card-row-title">Значение</div>
                                <div class="col-md-7 card-row-value">
                                    <input type="text" name="value" class="col-md-7" placeholder="Наименование элемента справочника" value="{{ $item['value'] }}">
                                </div>
                                <div class="col-md-1 card-row-button"></div>
                            </div>

                            <div class="card-row col-md-12">
                                <div class="col-md-4 card-row-title">Описание</div>
                                <div class="col-md-7 card-row-value">
                                    <input type="text" name="description" class="col-md-7" placeholder="Дополнительная информация" value="{{ $item['description'] }}">
                                </div>
                                <div class="col-md-1 card-row-button"></div>
                            </div>

                            <hr>

                            <div class="card-row col-md-12">
                                <div class="col-md-3 card-row-title"></div>
                                <div class="col-md-7 card-row-value"></div>
                                <div class="col-md-2 card-row-button">
                                    <button type="submit" class="btn btn-success">Сохранить</button>
                                </div>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
