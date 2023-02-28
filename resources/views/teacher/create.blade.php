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
                    <div class="card-header">{{ __('app.pages.teacher.title.create') }}</div>

                    <div class="card-body">

                        <form method="POST" name="people" action="{{ route('teacher-add') }}">
                            @csrf

                            <div class="form-group row">
                                <label for="lastname" class="col-md-4 col-form-label text-md-right">Фамилия</label>

                                <div class="col-md-6">
                                    <input id="lastname" type="text" class="form-control" name="lastname" value="{{ old('lastname') }}" required autocomplete="lastname" autofocus>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="firstname" class="col-md-4 col-form-label text-md-right">Имя</label>

                                <div class="col-md-6">
                                    <input id="firstname" type="text" class="form-control" name="firstname" value="{{ old('firstname') }}" required autocomplete="firstname" autofocus>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="patronymic" class="col-md-4 col-form-label text-md-right">Отчество</label>

                                <div class="col-md-6">
                                    <input id="patronymic" type="text" class="form-control" name="patronymic" value="{{ old('patronymic') }}" required autocomplete="patronymic" autofocus>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="birthdate" class="col-md-4 col-form-label text-md-right">Дата рождения</label>

                                <div class="col-md-6">
                                    <input id="birthdate" type="text" class="form-control" name="birthdate" value="{{ old('birthdate') }}" required autocomplete="birthdate" autofocus>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="role_id" class="col-md-4 col-form-label text-md-right">Роль (должность)</label>

                                <div class="col-md-6">
                                    <select id="role_id" name="role_id" class="form-control">
                                        @foreach($dicts as $dict)
                                            <option value="{{ $dict['id'] }}">{{ $dict['value'] }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-8 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('app.pages.teacher.submit') }}
                                    </button>
                                </div>
                            </div>

                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

