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
                    <div class="card-header">
                        Создание формы сбора данных по контрольной работе
                    </div>

                    <div class="card-body">

                        <form method="POST" name="test-form" action="{{ route('test-form-store') }}">
                            @csrf

                            <input type="hidden" name="sub" value="{{ $sub }}">
                            <input type="hidden" name="group" value="{{ $group }}">
                            <input type="hidden" name="type" value="{{ $type }}">

                            <div class="card-row col-md-12">
                                <div class="col-md-1 card-row-title text-md-center">№ п/п</div>
                                <div class="col-md-1 card-row-title text-md-center">Выбор</div>
                                <div class="col-md-2 card-row-title text-md-center">Порядковый номер</div>
                                <div class="col-md-2 card-row-title text-md-center">Тип поля</div>
                                <div class="col-md-6 card-row-title text-md-center">Наименование задачи и/или ошибки по ней</div>
                            </div>

                            <hr>

                            @foreach($slots as $slot)
                                <div class="card-row col-md-12">
                                    <div class="col-md-1 card-row-value text-md-center">
                                        {{ $loop->iteration }}
                                    </div>
                                    <div class="col-md-1 card-row-value text-md-center">
                                        <input type="checkbox"
                                               name="checkbox_{{ $slot['name'] }}">
                                    </div>
                                    <div class="col-md-2 card-row-value text-md-center">
                                        <input type="text"
                                               name="tabindex_{{ $slot['name'] }}"
                                               value="{{ $slot['tabindex'] }}"
                                               class="col-md-6 text-md-center">
                                    </div>
                                    <div class="col-md-2 card-row-value text-md-center">
                                        {{ $slot['type'] }}
                                    </div>
                                    @if($slot['is_main'])
                                        <div class="col-md-6 card-row-value">
                                            <input type="text"
                                                   name="name_{{ $slot['name'] }}"
                                                   value="{{ $slot['value'] }}"
                                                   placeholder="{{ $slot['placeholder'] }}"
                                                   class="col-md-12">
                                        </div>
                                    @else
                                        <div class="col-md-1 card-row-value text-md-right">
                                            <i class="fa-solid fa-arrow-turn-up fa-rotate-90"></i>
                                        </div>
                                        <div class="col-md-5 card-row-value">
                                            <input type="text"
                                                   name="name_{{ $slot['name'] }}"
                                                   value="{{ $slot['value'] }}"
                                                   placeholder="{{ $slot['placeholder'] }}"
                                                   class="col-md-12">
                                        </div>
                                    @endif
                                    <div class="col-md-1 card-row-button"></div>
                                </div>
                            @endforeach

                            <hr>

                            <div class="card-row col-md-12">
                                <div class="col-md-4 card-row-title"></div>
                                <div class="col-md-7 card-row-value">
                                    <input class="btn btn-primary col-md-5" type="submit" value="Сохранить" tabindex="37">
                                </div>
                                <div class="col-md-1 card-row-button"></div>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
