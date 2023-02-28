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
                    <div class="card-header">Выбор и добавление группы (класса)</div>

                    <div class="card-body">

                        <form method="POST" name="group" action="{{ route('home-group-selected') }}">
                            @csrf

                            <input type="hidden" name="unit_id" value="{{ $unit_id }}">
                            <input type="hidden" name="unit_group_id" value="{{ $unit_group_id }}">

                            <div class="card-row col-md-12">

                                <div class="col-md-3 card-row-title">Выбор группы (класса)</div>
                                <div class="col-md-7 card-row-value">
                                    <select name="group_id" class="form-control">
                                        @foreach($group_list as $group)
                                            <option value="{{ $group['id'] }}">{{ $group['value'] }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-1 card-row-button text-md-right">
                                    <button type="submit" class="btn btn-primary" title="Выбрать">
                                        <i class="fa fa-solid fa-check"></i>
                                    </button>
                                </div>
                                <div class="col-md-1 card-row-button">
                                    <a href="{{ route('dict-group-create') }}" class="btn btn-success" title="Создать новую запись">
                                        <i class="fa fa-solid fa-plus"></i>
                                    </a>
                                </div>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
