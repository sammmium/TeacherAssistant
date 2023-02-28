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
                    <div class="card-header">{{ __('app.pages.teacher.title.index') }}</div>

                    <div class="card-body">

                        <div class="card-row col-md-12">
                            <div class="col-md-3 card-row-title">Фамилия</div>
                            <div class="col-md-7 card-row-value">{{ $teacher['lastname'] }}</div>
                            <div class="col-md-1 card-row-button text-md-right"></div>
                            <div class="col-md-1 card-row-button"></div>
                        </div>

                        <div class="card-row col-md-12">
                            <div class="col-md-3 card-row-title">Имя</div>
                            <div class="col-md-7 card-row-value">{{ $teacher['firstname'] }}</div>
                            <div class="col-md-1 card-row-button text-md-right"></div>
                            <div class="col-md-1 card-row-button"></div>
                        </div>

                        <div class="card-row col-md-12">
                            <div class="col-md-3 card-row-title">Отчество</div>
                            <div class="col-md-7 card-row-value">{{ $teacher['patronymic'] }}</div>
                            <div class="col-md-1 card-row-button text-md-right"></div>
                            <div class="col-md-1 card-row-button"></div>
                        </div>

                        <div class="card-row col-md-12">
                            <div class="col-md-3 card-row-title">Дата рождения</div>
                            <div class="col-md-7 card-row-value">{{ $teacher['birthdate'] }}</div>
                            <div class="col-md-1 card-row-button text-md-right"></div>
                            <div class="col-md-1 card-row-button"></div>
                        </div>

                        <div class="card-row col-md-12">
                            <div class="col-md-3 card-row-title">Роль (должность)</div>
                            <div class="col-md-7 card-row-value">{{ $role['value'] }}</div>
                            <div class="col-md-1 card-row-button text-md-right"></div>
                            <div class="col-md-1 card-row-button"></div>
                        </div>

                        <div class="card-row col-md-12">
                            <div class="col-md-3 card-row-title"></div>
                            <div class="col-md-7 card-row-value"></div>
                            <div class="col-md-1 card-row-button text-md-right">
                                <form method="POST" name="teacher" action="{{ route('teacher-edit') }}">
                                    @csrf
                                    <input type="hidden" name="teacher_id" value="{{ $teacher['id'] }}">
                                    <button type="submit" class="btn btn-primary" title="Редактировать">
                                        <i class="fa fa-solid fa-pencil"></i>
                                    </button>
                                </form>
                            </div>
                            <div class="col-md-1 card-row-button"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

