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
                                <div class="button-up" title="К списку классов"><i class="fa-solid fa-arrow-up"></i></div>
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
                                <div class="button-up" title="К списку предметов"><i class="fa-solid fa-arrow-up"></i></div>
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
                                <div class="button-up" title="К списку контрольных работ"><i class="fa-solid fa-arrow-up"></i></div>
                            </div>
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
                                        <div class="button-down">{{ $pupil['last_name'] }} {{ $pupil['first_name'] }}</div>
                                    </a>
                                </div>
                                <div class="col-md-1 card-row-button"></div>
                            </div>
                        @endforeach
                    </div>

                    button ++++++++++
                </div>
            </div>
        </div>
    </div>
@endsection
