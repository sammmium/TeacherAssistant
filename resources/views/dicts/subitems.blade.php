@extends('layouts.app')

@section('scripts')
    $(document).ready(function() {
        /* подсветка кнопки меню */
        $('a.button-dicts').parent().addClass('selected-button');
    });
@endsection

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Справочник</div>

                    <div class="card-body">
                        <div class="card-row col-md-12">
                            <div class="col-md-3 card-row-title">Наименование справочника</div>
                            <div class="col-md-7 card-row-head">{{ $selected['value'] }}</div>
                            <div class="col-md-1 card-row-button text-md-right">
                                <a class="btn btn-primary" href="{{ route('dicts') }}" title="На уровень выше">
                                    <i class="fa fa-solid fa-arrow-up"></i>
                                </a>
                            </div>
                            <div class="col-md-1 card-row-button">
                                <form method="POST" action="{{ route('dict-add') }}">
                                    @csrf
                                    <input type="hidden" name="selected_dict" value="{{ $selected['id'] }}">
                                    <button class="btn btn-success" type="submit" title="Добавить запись">
                                        <i class="fa fa-solid fa-plus"></i>
                                    </button>
                                </form>
                            </div>
                        </div>

                        <hr>

                        <div class="card-row col-md-12">
                            <div class="col-md-1 card-row-head text-md-center">№ п/п</div>
                            <div class="col-md-2 card-row-head text-md-left">Код</div>
                            <div class="col-md-3 card-row-head text-md-left">Значение</div>
                            <div class="col-md-4 card-row-head text-md-left">Описание</div>
                            <div class="col-md-2 card-row-head text-md-center">Действия</div>
                        </div>

                        <hr>

                        @foreach($items as $item)
                            <div class="card-row col-md-12">
                                <div class="col-md-1 card-row-value text-md-center">{{ $loop->iteration }}</div>
                                <div class="col-md-2 card-row-value text-md-left">{{ $item['code'] }}</div>
                                <div class="col-md-3 card-row-value text-md-left">{{ $item['value'] }}</div>
                                <div class="col-md-4 card-row-value text-md-left">{{ $item['description'] }}</div>
                                <div class="col-md-1 card-row-button text-md-right">
                                    <a class="btn btn-primary" href="{{ route('dict-edit', $item['id']) }}" title="Редактировать">
                                        <i class="fa fa-solid fa-pencil"></i>
                                    </a>
                                </div>
                                <div class="col-md-1 card-row-button">
                                    <form method="POST" action="{{ route('dict-delete', $item['id']) }}">
                                        @csrf
                                        <input type="hidden" name="id" value="{{ $item['id'] }}">
                                        <input type="hidden" name="parent_id" value="{{ $item['parent_id'] }}">
                                        <button class="btn btn-danger" type="submit" title="Удалить">
                                            <i class="fa fa-solid fa-trash"></i>
                                        </button>
                                    </form>
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
