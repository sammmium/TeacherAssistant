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
                    <div class="card-header">{{ __('app.pages.educational_institution.title.edit') }}</div>

                    <div class="card-body">

                        <form method="POST" name="educational-institution" action="{{ route('educational-institution-store') }}">
                            @csrf

                            <div class="card-row col-md-12">
                                <div class="col-md-3 card-row-title">Полное наименование</div>
                                <div class="col-md-7 card-row-value">
                                    <input type="text" class="form-control" name="fullname" value="{{ $educational_institution['fullname'] }}" required autocomplete="fullname" autofocus>
                                </div>
                                <div class="col-md-1 card-row-button text-md-right"></div>
                                <div class="col-md-1 card-row-button"></div>
                            </div>

                            <div class="card-row col-md-12">
                                <div class="col-md-3 card-row-title">Краткое наименование</div>
                                <div class="col-md-7 card-row-value">
                                    <input type="text" class="form-control" name="shortname" value="{{ $educational_institution['shortname'] }}" required autocomplete="shortname" autofocus>
                                </div>
                                <div class="col-md-1 card-row-button text-md-right"></div>
                                <div class="col-md-1 card-row-button"></div>
                            </div>

                            <div class="card-row col-md-12">
                                <div class="col-md-3 card-row-title">Адрес</div>
                                <div class="col-md-7 card-row-value">
                                    <input type="text" class="form-control" name="address" value="{{ $educational_institution['address'] }}" required autocomplete="address" autofocus>
                                </div>
                                <div class="col-md-1 card-row-button text-md-right"></div>
                                <div class="col-md-1 card-row-button"></div>
                            </div>

                            <hr>

                            <div class="card-row col-md-12">
                                <div class="col-md-3 card-row-title"></div>
                                <div class="col-md-7 card-row-value">
                                    <input type="hidden" name="educational_institution_id" value="{{ $educational_institution['id'] }}">
                                </div>
                                <div class="col-md-1 card-row-button text-md-right">
                                    <button type="submit" class="btn btn-success">
                                        <i class="fa fa-solid fa-save"></i>
                                    </button>
                                </div>
                                <div class="col-md-1 card-row-button">
                                    <a class="btn btn-info" href="{{ route('educational-institution') }}">
                                        <i class="fa fa-solid fa-arrow-up"></i>
                                    </a>
                                </div>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
