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
                                {{ $teacher['lastname'] }} {{ $teacher['firstname'] }} {{ $teacher['patronymic'] }}
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

                        <div class="card-row col-md-12">
                            <div class="col-md-3 card-row-title">
                                Предмет
                            </div>
                            <div class="col-md-7 card-row-value">
                                {{ $subject['value'] }}
                            </div>
                            <div class="col-md-1 card-row-button">
                                <form method="POST" action="{{ route('home-subject-list') }}">
                                    @csrf
                                    <button class="btn btn-info" type="submit" title="К списку предметов">
                                        <i class="fa-solid fa-arrow-up"></i>
                                    </button>
                                </form>
                            </div>
                            <div class="col-md-1 card-row-button"></div>
                        </div>

                        <div class="card-row col-md-12">
                            <div class="col-md-3 card-row-title">
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
                            <div class="col-md-1 card-row-button"></div>
                        </div>
                    </div>
                </div>

                &nbsp;

                <div class="card">

                    <div class="card-header">Скачать результаты анализа</div>

                    <div class="card-body">
                        <div class="card-row col-md-12">
                            <div class="col-md-3 card-row-title"></div>
                            <div class="col-md-7 card-row-value">
                                <form method="POST" action="{{ route('home-test-download') }}">
                                    @csrf
                                    <input type="hidden" name="group_id" value="{{ $group['id'] }}">
                                    <input type="hidden" name="subject_id" value="{{ $subject['id'] }}">
                                    <input type="hidden" name="test_id" value="{{ $test['id'] }}">
                                    <input type="hidden" name="member_id_list" value="{{ $member_id_list }}">
                                    <button class="btn btn-success col-md-5" type="submit">
                                        Скачать
                                    </button>
                                </form>
                            </div>
                            <div class="col-md-1 card-row-button"></div>
                            <div class="col-md-1 card-row-button"></div>
                        </div>
                    </div>
                </div>

                &nbsp;

                <div class="card">
                    <div class="card-header">Список учеников / участников</div>

                    <div class="card-body">
                        <div class="card-row col-md-12">
                            <div class="col-md-1 card-row-head">№ п/п</div>
                            <div class="col-md-4 card-row-head">Ученик</div>
                            <div class="col-md-1 card-row-button"></div>
                            <div class="col-md-4 card-row-head">Участник</div>
                            <div class="col-md-1 card-row-button"></div>
                            <div class="col-md-1 card-row-button"></div>
                        </div>

                        <hr>

                        @foreach($member_list as $member)
                            <div class="card-row col-md-12">
                                <div class="col-md-1 card-row-title"></div>
                                <div class="col-md-4 card-row-value">{{ $member['pupil'] }}</div>
                                <div class="col-md-1 card-row-button">
                                    @if(!empty($member['card_id']))
                                        <form method="POST" action="{{ route('reset_member') }}">
                                            @csrf
                                            <input type="hidden" name="card_id" value="{{ $member['card_id'] }}">
                                            <button class="btn btn-danger" type="submit" title="Исключить из участников">
                                                <i class="fa-solid fa-arrow-left"></i>
                                            </button>
                                        </form>
                                    @else
                                        <form method="POST" action="{{ route('add_member') }}">
                                            @csrf
                                            <input type="hidden" name="unit_group_pupil_id" value="{{ $member['unit_group_pupil_id'] }}">
                                            <input type="hidden" name="test_id" value="{{ $test['id'] }}">
                                            <button class="btn btn-info" type="submit" title="Добавить к участникам">
                                                <i class="fa-solid fa-arrow-right"></i>
                                            </button>
                                        </form>
                                    @endif
                                </div>
                                <div class="col-md-4 card-row-value">
                                    @if(!empty($member['member']['fio']))
                                        <a href="{{ route('card-index', $member['member']['id']) }}">
                                            <div class="btn btn-{{ $member['member']['filled'] }} col-md-12">{{ $member['member']['fio'] }}</div>
                                        </a>
                                    @endif
                                </div>
                                <div class="col-md-1 card-row-button"></div>
                                <div class="col-md-1 card-row-button"></div>
                            </div>
                        @endforeach

                        <hr>

                        <div class="card-row col-md-12">
                            <div class="col-md-1 card-row-title"></div>
                            <div class="col-md-4 card-row-value">
                                <a href="{{ route('group-pupil-add', $group['id']) }}">
                                    <div class="btn btn-primary col-md-12">Добавить ученика</div>
                                </a>
                            </div>
                            <div class="col-md-1 card-row-button"></div>
                            <div class="col-md-4 card-row-value"></div>
                            <div class="col-md-1 card-row-button"></div>
                            <div class="col-md-1 card-row-button"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
