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
                    <div class="card-header">{{ __('app.pages.test.title.index') }}</div>

                    <div class="card-body">
                        <div class="card-row col-md-12">
                            <div class="col-md-3 card-row-title">
                                Учебный год
                            </div>
                            <div class="col-md-7 card-row-value">
                                {{ $year }}
                            </div>
                            <div class="col-md-1 card-row-button"></div>
                            <div class="col-md-1 card-row-button"></div>
                        </div>

                        <div class="card-row col-md-12">
                            <div class="col-md-3 card-row-title">
                                Наименование учреждения
                            </div>
                            <div class="col-md-7 card-row-value">
                                {{ $educational_institution['fullname'] }}
                            </div>
                            <div class="col-md-1 card-row-button"></div>
                            <div class="col-md-1 card-row-button"></div>
                        </div>

                        <div class="card-row col-md-12">
                            <div class="col-md-3 card-row-title">
                                {{ $role['value'] }}
                            </div>
                            <div class="col-md-7 card-row-value">
                                {{ $teacher['firstname'] }} {{ $teacher['lastname'] }}
                            </div>
                            <div class="col-md-1 card-row-button"></div>
                            <div class="col-md-1 card-row-button"></div>
                        </div>

                        <div class="card-row col-md-12">
                            <div class="col-md-3 card-row-title">
                                Класс
                            </div>
                            <div class="col-md-7 card-row-value">
                                {{ $group['value'] }}
                            </div>
                            <div class="col-md-1 card-row-button">
                                <form method="POST" action="{{ route('group-list-return') }}">
                                    @csrf
                                    <button class="btn btn-info" type="submit" title="К списку классов">
                                        <i class="fa-solid fa-arrow-up"></i>
                                    </button>
                                </form>
                            </div>
                            <div class="col-md-1 card-row-button"></div>
                        </div>
                    </div>
                </div>

                &nbsp;

                <div class="card">
                    <div class="card-header">Выбрать предмет</div>

                    <div class="card-body">
                        @foreach($subject_list as $subject)
                            <div class="card-row col-md-12">
                                <div class="col-md-3 card-row-title"></div>
                                <div class="col-md-7 card-row-value">
                                    <a href="{{ route('home-subject-index', $subject['id']) }}" title="Выбрать предмет">
                                        <div class="btn btn-secondary col-md-5">{{ $subject['name'] }}</div>
                                    </a>
                                </div>
                                <div class="col-md-1 card-row-button"></div>
                                <div class="col-md-1 card-row-button">
                                    <form method="POST" name="group" action="{{ route('home-subject-reset') }}">
                                        @csrf
                                        <input type="hidden" name="group_id" value="{{ $group['id'] }}">
                                        <input type="hidden" name="subject_id" value="{{ $subject['id'] }}">
                                        <button class="btn btn-danger" title="Открепить предмет">
                                            <i class="fa fa-solid fa-cancel"></i>
                                        </button>
                                    </form>
                                </div>
                            </div>
                        @endforeach
                        <div class="card-row col-md-12">
                            <div class="col-md-3 card-row-title"></div>
                            <div class="col-md-7 card-row-value">
                                <a href="{{ route('home-subject-add') }}">
                                    <div class="btn btn-primary col-md-5">Добавить предмет</div>
                                </a>
                            </div>
                            <div class="col-md-1 card-row-button"></div>
                            <div class="col-md-1 card-row-button"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
