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
                    <div class="card-header">{{ __('app.pages.teacher.title.edit') }}</div>

                    <div class="card-body">

                        <form method="POST" name="teacher" action="{{ route('teacher-store') }}">
                            @csrf

                            <div class="card-row col-md-12">
                                <div class="col-md-3 card-row-title">Фамилия</div>
                                <div class="col-md-7 card-row-value">
                                    <input type="text" class="form-control" name="lastname" value="{{ $teacher['lastname'] }}" required autocomplete="lastname" autofocus>
                                </div>
                                <div class="col-md-1 card-row-button text-md-right"></div>
                                <div class="col-md-1 card-row-button"></div>
                            </div>

                            <div class="card-row col-md-12">
                                <div class="col-md-3 card-row-title">Имя</div>
                                <div class="col-md-7 card-row-value">
                                    <input type="text" class="form-control" name="firstname" value="{{ $teacher['firstname'] }}" required autocomplete="firstname" autofocus>
                                </div>
                                <div class="col-md-1 card-row-button text-md-right"></div>
                                <div class="col-md-1 card-row-button"></div>
                            </div>

                            <div class="card-row col-md-12">
                                <div class="col-md-3 card-row-title">Отчество</div>
                                <div class="col-md-7 card-row-value">
                                    <input type="text" class="form-control" name="patronymic" value="{{ $teacher['patronymic'] }}" required autocomplete="patronymic" autofocus>
                                </div>
                                <div class="col-md-1 card-row-button text-md-right"></div>
                                <div class="col-md-1 card-row-button"></div>
                            </div>

                            <div class="card-row col-md-12">
                                <div class="col-md-3 card-row-title">Дата рождения</div>
                                <div class="col-md-7 card-row-value">
                                    <input type="text" class="form-control" name="birthdate" value="{{ $teacher['birthdate'] }}" required autocomplete="birthdate" autofocus>
                                </div>
                                <div class="col-md-1 card-row-button text-md-right"></div>
                                <div class="col-md-1 card-row-button"></div>
                            </div>

                            <div class="card-row col-md-12">
                                <div class="col-md-3 card-row-title">Роль (должность)</div>
                                <div class="col-md-7 card-row-value">
                                    <select name="role_id" class="form-control">
                                        @foreach($roles as $role)
                                            <option value="{{ $role['id'] }}" @if($role['id'] == $teacher['role_id']) selected @endif>{{ $role['value'] }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-1 card-row-button text-md-right"></div>
                                <div class="col-md-1 card-row-button"></div>
                            </div>

                            <div class="card-row col-md-12">
                                <div class="col-md-3 card-row-title">
                                    <input type="hidden" name="teacher_id" value="{{ $teacher['id'] }}">
                                </div>
                                <div class="col-md-7 card-row-value"></div>
                                <div class="col-md-1 card-row-button text-md-right">
                                    <button type="submit" class="btn btn-primary">
                                        <i class="fa fa-solid fa-save"></i>
                                    </button>
                                </div>
                                <div class="col-md-1 card-row-button">
                                    <a class="btn btn-secondary" href="{{ route('teacher') }}">
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
