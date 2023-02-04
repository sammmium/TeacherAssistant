@extends('layouts.app')

@section('scripts')
    $(document).ready(function() {
        /* подсветка кнопки меню */
        $('a.button-test').parent().addClass('selected-button');
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
                                {{ $test['theme'] }}
                            </div>
                            <div class="col-md-1 card-row-button">
                                <div class="button-up" title="К списку контрольных работ"><i class="fa-solid fa-arrow-up"></i></div>
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
                            <div class="col-md-7 card-row-value"></div>
                            <div class="col-md-1 card-row-button">
                                <a href="{{ route('test-download') }}" title="Скачать">
                                    <div class="button-download"><i class="fa-solid fa-download"></i></div></a>
                            </div>
                        </div>
                    </div>
                </div>

                &nbsp;

                <div class="card">
                    <div class="card-header">Список учеников</div>

                    <div class="card-body">
                        @foreach($pupil_list as $pupil)
                            <div class="card-row col-md-12">
                                <div class="col-md-4 card-row-title">
                                    {{ $loop->iteration }}
                                </div>
                                <div class="col-md-7 card-row-value">
                                    {{ $pupil['first_name'] }} {{ $pupil['last_name'] }}
                                </div>
                                <div class="col-md-1 card-row-button">
                                    <a href="{{ route('test-card', $pupil['id']) }}" title="Открыть карточку">
                                        <div class="button-down"><i class="fa-solid fa-arrow-down"></i></div></a>
                                </div>
                            </div>

                        @if (!$loop->last)
                            <hr>
                        @endif

                        @endforeach
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
