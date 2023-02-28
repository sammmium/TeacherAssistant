@extends('layouts.app')

@section('scripts')
{{--        <script>--}}
    $(document).ready(function() {
        /* подсветка кнопки меню */
        $('a.button-home').parent().addClass('selected-button');
    });
@endsection

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Добавление контрольной работы</div>

                    <div class="card-body">

                        <form method="POST" name="subject" action="{{ route('home-test-create') }}">
                            @csrf

                            <input type="hidden" name="unit_subject_id" value="{{ $unit_subject_id }}">

                            <div class="card-row col-md-12">
                                <div class="col-md-3 card-row-title">Дата</div>
                                <div class="col-md-7 card-row-value">
                                    <input type="text" name="date" value="{{ old('date') }}" class="form-control" data-mask="date">
                                </div>
                                <div class="col-md-1 card-row-button text-md-right"></div>
                                <div class="col-md-1 card-row-button"></div>
                            </div>

                            <div class="card-row col-md-12">
                                <div class="col-md-3 card-row-title">Наименование</div>
                                <div class="col-md-7 card-row-value">
                                    <input type="text" name="name" value="{{ old('name') }}" class="form-control">
                                </div>
                                <div class="col-md-1 card-row-button text-md-right"></div>
                                <div class="col-md-1 card-row-button"></div>
                            </div>

                            <div class="card-row col-md-12">
                                <div class="col-md-3 card-row-title"></div>
                                <div class="col-md-7 card-row-value"></div>
                                <div class="col-md-1 card-row-button text-md-right">
                                    <button type="submit" class="btn btn-success" title="Сохранить">
                                        <i class="fa fa-solid fa-save"></i>
                                    </button>
                                </div>
                                <div class="col-md-1 card-row-button"></div>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
