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
                                {{ $role }}
                            </div>
                            <div class="col-md-7 card-row-value">
                                {{ $teacher['lastname'] }} {{ $teacher['firstname'] }} {{ $teacher['patronymic'] }}
                            </div>
                            <div class="col-md-1 card-row-button"></div>
                            <div class="col-md-1 card-row-button"></div>
                        </div>
                    </div>
                </div>

                &nbsp;

                <div class="card">
                    <div class="card-header">Список классов</div>

                    <div class="card-body">
                        @foreach($group_list as $group)
                            <div class="card-row col-md-12">
                                <div class="col-md-3 card-row-title"></div>
                                <div class="col-md-7 card-row-value">
                                    <a href="{{ route('home-group-select', $group['id']) }}" title="Выбрать группу">
                                        <div class="btn btn-secondary col-md-5">{{ $group['name'] }}</div>
                                    </a>
                                </div>

                                <div class="col-md-1 card-row-button"></div>
                                <div class="col-md-1 card-row-button text-md-right">
                                    <a href="{{ route('home-group-reset', $group['id']) }}" class="btn btn-danger" title="Открепить группу">
                                        <i class="fa fa-solid fa-cancel"></i>
                                    </a>
                                </div>
                            </div>
                        @endforeach

                        <div class="card-row col-md-12">
                            <div class="col-md-3 card-row-title"></div>
                            <div class="col-md-7 card-row-value">
                                <a href="{{ route('home-group-add') }}">
                                    <div class="btn btn-primary col-md-5">Добавить группу</div>
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
