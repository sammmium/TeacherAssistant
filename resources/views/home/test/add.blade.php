@extends('layouts.app')

@section('scripts')
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

                            <div class="card-row col-md-12">
                                <div class="col-md-3 card-row-title">Тип работы</div>
                                <div class="col-md-7 card-row-value">
                                    <select name="type" class="form-control">
                                        @foreach($test_types as $key => $value)
                                            <option value="{{ $key }}">{{ $value }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-1 card-row-button text-md-right">
                                    <button type="submit" class="btn btn-success" title="Далее">
                                        <i class="fa fa-solid fa-arrow-down"></i>
                                    </button></div>
                                <div class="col-md-1 card-row-button"></div>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
