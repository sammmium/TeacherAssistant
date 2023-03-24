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
                    <div class="card-header">Добавление ученика группы (класса): {{ $group['value'] }}</div>

                    <div class="card-body">
                        <div class="card-row col-md-12">
                            <div class="col-md-3 card-row-title"></div>
                            <div class="col-md-7 card-row-head"></div>
                            <div class="col-md-2 card-row-button">
                                <a class="btn btn-primary" href="{{ route('home') }}" title="На уровень выше">
                                    <i class="fa fa-solid fa-arrow-up"></i>
                                </a>
                            </div>
                        </div>

                        <hr>

                        <form method="POST" action="{{ route('group-pupil-store') }}">
                            @csrf
                            <input type="hidden" name="group_id" value="{{ $group['id'] }}">

                            <div class="card-row col-md-12">
                                <div class="col-md-3 card-row-title">Фамилия *</div>
                                <div class="col-md-7 card-row-value">
                                    <input type="text" name="lastname" class="col-md-7" value="{{ old('lastname') }}">
                                </div>
                                <div class="col-md-1 card-row-button"></div>
                                <div class="col-md-1 card-row-button"></div>
                            </div>

                            <div class="card-row col-md-12">
                                <div class="col-md-3 card-row-title">Имя *</div>
                                <div class="col-md-7 card-row-value">
                                    <input type="text" name="firstname" class="col-md-7" value="{{ old('firstname') }}">
                                </div>
                                <div class="col-md-1 card-row-button"></div>
                                <div class="col-md-1 card-row-button"></div>
                            </div>

                            <div class="card-row col-md-12">
                                <div class="col-md-3 card-row-title">Отчество</div>
                                <div class="col-md-7 card-row-value">
                                    <input type="text" name="patronymic" class="col-md-7" value="{{ old('patronymic') }}">
                                </div>
                                <div class="col-md-1 card-row-button"></div>
                                <div class="col-md-1 card-row-button"></div>
                            </div>

                            <div class="card-row col-md-12">
                                <div class="col-md-3 card-row-title">Дата рождения *</div>
                                <div class="col-md-7 card-row-value">
                                    <input type="text" name="birthdate" class="col-md-7" value="{{ old('birthdate') }}">
                                </div>
                                <div class="col-md-1 card-row-button"></div>
                                <div class="col-md-1 card-row-button"></div>
                            </div>

                            <div class="card-row col-md-12">
                                <div class="col-md-3 card-row-title">Описание</div>
                                <div class="col-md-7 card-row-value">
                                    <input type="text" name="description" class="col-md-7" value="{{ old('description') }}">
                                </div>
                                <div class="col-md-1 card-row-button"></div>
                                <div class="col-md-1 card-row-button"></div>
                            </div>

                            <hr>

                            <div class="card-row col-md-12">
                                <div class="col-md-3 card-row-title"></div>
                                <div class="col-md-7 card-row-value"></div>
                                <div class="col-md-1 card-row-button">
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
