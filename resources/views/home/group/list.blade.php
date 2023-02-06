@extends('layouts.app')

@section('scripts')
{{--    <script>--}}
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
                    </div>
                </div>

                &nbsp;

                <div class="card">
                    <div class="card-header">Список классов</div>

                    <div class="card-body">
                        @foreach($group_list as $group)
                            <div class="card-row col-md-12">
                                <div class="col-md-4 card-row-title"></div>
                                <div class="col-md-7 card-row-value">
                                    <a href="{{ route('home-group-index', $group['id']) }}" title="Выбрать группу">
                                        <div class="btn btn-secondary col-md-5">{{ $group['name'] }}</div>
                                    </a>
                                </div>
                                <div class="col-md-1 card-row-button"></div>
                            </div>
                        @endforeach

                        <div class="card-row col-md-12">
                            <div class="col-md-4 card-row-title"></div>
                            <div class="col-md-7 card-row-value">
{{--                                <form method="POST" action="{{ route('home-group-list-add') }}">--}}
{{--                                    @csrf--}}
{{--                                    <button class="btn btn-primary col-md-5">Добавить группу</button>--}}
{{--                                </form>--}}
                                <a href="{{ route('home-group-list-add') }}">
                                    <div class="btn btn-primary col-md-5">Добавить группу</div>
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
