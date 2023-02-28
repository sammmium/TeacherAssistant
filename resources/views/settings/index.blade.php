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
                    <div class="card-header">Настройки</div>

                    <div class="card-body">
                        <div class="card-row col-md-12">
                            <div class="col-md-4 card-row-title"></div>
                            <div class="col-md-7 card-row-value">
                                <a href="{{ route('teacher') }}">
                                    <div class="btn btn-secondary col-md-5">Учитель</div>
                                </a>
                            </div>
                            <div class="col-md-1 card-row-button"></div>
                        </div>

                        <div class="card-row col-md-12">
                            <div class="col-md-4 card-row-title"></div>
                            <div class="col-md-7 card-row-value">
                                <a href="{{ route('educational-institution') }}">
                                    <div class="btn btn-secondary col-md-5">Учебное заведение</div>
                                </a>
                            </div>
                            <div class="col-md-1 card-row-button"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
