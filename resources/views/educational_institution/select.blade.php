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

                        <form method="POST" name="educational-institution" action="{{ route('educational-institution-selected') }}">
                            @csrf

                            <input type="hidden" name="teacher_id" value="{{ $teacher['id'] }}">

                            <div class="card-row col-md-12">
                                <div class="col-md-3 card-row-title">Выбор</div>
                                <div class="col-md-7 card-row-value">
                                    <select name="educational_institution_id" class="form-control">
                                        @foreach($educational_institutions as $educational_institution)
                                            <option value="{{ $educational_institution['id'] }}">{{ $educational_institution['fullname'] }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-1 card-row-button text-md-right">
                                    <button type="submit" class="btn btn-primary" title="Выбрать">
                                        <i class="fa fa-solid fa-check"></i>
                                    </button>
                                </div>
                                <div class="col-md-1 card-row-button">
                                    <a href="{{ route('educational-institution-create') }}" class="btn btn-success" title="Создать новую запись">
                                        <i class="fa fa-solid fa-plus"></i>
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
