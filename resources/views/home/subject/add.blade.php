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
                    <div class="card-header">Выбор и добавление предмета</div>

                    <div class="card-body">

                        <form method="POST" name="subject" action="{{ route('home-subject-selected') }}">
                            @csrf

                            <input type="hidden" name="unit_group_id" value="{{ $unit_group_id }}">

                            <div class="card-row col-md-12">

                                <div class="col-md-3 card-row-title">Выбор предмета</div>
                                <div class="col-md-7 card-row-value">
                                    <select name="subject_id" class="form-control">
                                        @foreach($subject_list as $subject)
                                            <option value="{{ $subject['id'] }}">{{ $subject['value'] }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-1 card-row-button text-md-right">
                                    <button type="submit" class="btn btn-primary" title="Выбрать">
                                        <i class="fa fa-solid fa-check"></i>
                                    </button>
                                </div>
                                <div class="col-md-1 card-row-button">
                                    <a href="{{ route('dict-subject-create') }}" class="btn btn-success" title="Создать новую запись">
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
