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
                    </div>
                </div>

                &nbsp;

                <div class="card">
                    <div class="card-header">Выбрать контрольную работу</div>

                    <div class="card-body">
                        @foreach($test_list as $test)
                            <div class="card-row col-md-12">
                                <div class="col-md-4 card-row-title"></div>
                                <div class="col-md-7 card-row-value">
                                    <a href="{{ route('home-test-index', $test['id']) }}" title="Выбрать контрольную работу">
                                        <div class="btn btn-secondary col-md-5">{{ $test['name'] }}</div>
                                    </a>
                                </div>
                                <div class="col-md-1 card-row-button"></div>
                            </div>
                        @endforeach
                        <div class="card-row col-md-12">
                            <div class="col-md-4 card-row-title"></div>
                            <div class="col-md-7 card-row-value">
                                <a href="#">
                                    <div class="btn btn-primary col-md-5">Добавить контрольную работу</div>
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
