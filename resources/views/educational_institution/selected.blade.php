@extends('layouts.app')

@section('scripts')
    $(document).ready(function() {
        /* подсветка кнопки меню */
        $('a.button-settings').parent().addClass('selected-button');
    });
@endsection

@section('content')
    <div class="container">
        <div class="row justify-content-center">

            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Настройки: Учебное заведение</div>

                    <div class="card-body">

                        <div class="card-row col-md-12">
                            <div class="col-md-3 card-row-title">Полное наименование</div>
                            <div class="col-md-7 card-row-value">{{ $educational_institution['fullname'] }}</div>
                            <div class="col-md-1 card-row-button text-md-right"></div>
                            <div class="col-md-1 card-row-button"></div>
                        </div>

                        <div class="card-row col-md-12">
                            <div class="col-md-3 card-row-title">Краткое наименование</div>
                            <div class="col-md-7 card-row-value">{{ $educational_institution['shortname'] }}</div>
                            <div class="col-md-1 card-row-button text-md-right"></div>
                            <div class="col-md-1 card-row-button"></div>
                        </div>

                        <div class="card-row col-md-12">
                            <div class="col-md-3 card-row-title">Адрес</div>
                            <div class="col-md-7 card-row-value">{{ $educational_institution['address'] }}</div>
                            <div class="col-md-1 card-row-button text-md-right"></div>
                            <div class="col-md-1 card-row-button"></div>
                        </div>

                        <hr>

                        <div class="card-row col-md-12">
                            <div class="col-md-3 card-row-title"></div>
                            <div class="col-md-7 card-row-value"></div>
                            <div class="col-md-1 card-row-button text-md-right">
                                <a href="{{ route('educational-institution-edit', $educational_institution['id']) }}" class="btn btn-primary" title="Редактировать">
                                    <i class="fa fa-solid fa-pencil"></i>
                                </a>
                            </div>
                            <div class="col-md-1 card-row-button">
                                <a href="{{ route('educational-institution-reset', $educational_institution['id']) }}" class="btn btn-danger" title="Отменить привязку">
                                    <i class="fa fa-solid fa-cancel"></i>
                                </a>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
