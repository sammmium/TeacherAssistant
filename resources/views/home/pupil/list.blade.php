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
                            <div class="col-md-4 card-row-title">
                                Наименование учреждения
                            </div>
                            <div class="col-md-7 card-row-value">
                                {{ $educational_institution['full_name'] }}
                            </div>
                            <div class="col-md-1 card-row-button"></div>
                        </div>

                        <div class="card-row col-md-12">
                            <div class="col-md-4 card-row-title">
                                {{ $teacher['job_title'] }}
                            </div>
                            <div class="col-md-7 card-row-value">
                                {{ $teacher['first_name'] }} {{ $teacher['last_name'] }}
                            </div>
                            <div class="col-md-1 card-row-button"></div>
                        </div>

                        <div class="card-row col-md-12">
                            <div class="col-md-4 card-row-title">
                                Класс
                            </div>
                            <div class="col-md-7 card-row-value">
                                {{ $group['name'] }}
                            </div>
                            <div class="col-md-1 card-row-button">
                                <form method="POST" action="{{ route('group-list-return') }}">
                                    @csrf
                                    <button class="btn btn-info" type="submit" title="К списку классов">
                                        <i class="fa-solid fa-arrow-up"></i>
                                    </button>
                                </form>
                            </div>
                        </div>

                        <div class="card-row col-md-12">
                            <div class="col-md-4 card-row-title">
                                Предмет
                            </div>
                            <div class="col-md-7 card-row-value">
                                {{ $subject['name'] }}
                            </div>
                            <div class="col-md-1 card-row-button">
                                <form method="POST" action="{{ route('home-subject-list') }}">
                                    @csrf
                                    <button class="btn btn-info" type="submit" title="К списку предметов">
                                        <i class="fa-solid fa-arrow-up"></i>
                                    </button>
                                </form>
                            </div>
                        </div>

                        <div class="card-row col-md-12">
                            <div class="col-md-4 card-row-title">
                                Контрольная работа
                            </div>
                            <div class="col-md-7 card-row-value">
                                {{ $test['name'] }}
                            </div>
                            <div class="col-md-1 card-row-button">
                                <form method="POST" action="{{ route('home-test-list') }}">
                                    @csrf
                                    <button class="btn btn-info" type="submit" title="К списку контрольных работ">
                                        <i class="fa-solid fa-arrow-up"></i>
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                &nbsp;

                <div class="card">

                    <div class="card-header">Скачать результаты анализов</div>

                    <div class="card-body">
                        <div class="card-row col-md-12">
                            <div class="col-md-4 card-row-title"></div>
                            <div class="col-md-7 card-row-value">
                                <form method="POST" action="{{ route('home-test-download') }}">
                                    @csrf
                                    <input type="hidden" name="group_id" value="{{ $group['id'] }}">
                                    <input type="hidden" name="subject_id" value="{{ $subject['id'] }}">
                                    <input type="hidden" name="test_id" value="{{ $test['id'] }}">
                                    <button class="btn btn-success col-md-5" type="submit">
                                        Скачать
                                    </button>
                                </form>
                            </div>
                            <div class="col-md-1 card-row-button"></div>
                        </div>
                    </div>
                </div>

                &nbsp;

                <div class="card">
                    <div class="card-header">Выбрать ученика</div>

                    <div class="card-body">
                        @foreach($pupil_list as $pupil)
                            <div class="card-row col-md-12">
                                <div class="col-md-4 card-row-title"></div>
                                <div class="col-md-7 card-row-value">
                                    <a href="{{ route('home-card-index', $pupil['id']) }}" title="Выбрать ученика">
                                        <div class="btn btn-secondary col-md-5">{{ $pupil['last_name'] }} {{ $pupil['first_name'] }}</div>
                                    </a>
                                </div>
                                <div class="col-md-1 card-row-button"></div>
                            </div>
                        @endforeach
                        <div class="card-row col-md-12">
                            <div class="col-md-4 card-row-title"></div>
                            <div class="col-md-7 card-row-value">
                                <a href="#">
                                    <div class="btn btn-primary col-md-5">Добавить ученика</div>
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
