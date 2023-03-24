@extends('layouts.app')

@section('scripts')
    $(document).ready(function() {
        /* подсветка кнопки меню */
        $('a.button-home').parent().addClass('selected-button');

        $('a.pupil-delete').on('click', function(e) {
            let pupilId = $(this).attr('data-delete');
            if (confirm('Будут удален ученик и все связанные с ним записи. Удалить?')) {
                let formName = 'pupil_' + pupilId;
                $("form[name='" + formName + "']").submit();
            } else {
                e.preventDefault();
            }
        });
    });
@endsection

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Состав группы (класса): {{ $group['value'] }}</div>

                    <div class="card-body">
                        <div class="card-row col-md-12">
                            <div class="col-md-3 card-row-title"></div>
                            <div class="col-md-7 card-row-head"></div>
                            <div class="col-md-1 card-row-button text-md-right">
                                <a class="btn btn-primary" href="{{ route('home') }}" title="На уровень выше">
                                    <i class="fa fa-solid fa-arrow-up"></i>
                                </a>
                            </div>
                            <div class="col-md-1 card-row-button">
                                <a class="btn btn-success" href="{{ route('group-pupil-create', $group['id']) }}" title="Добавить ученика">
                                    <i class="fa fa-solid fa-plus"></i>
                                </a>
                            </div>
                        </div>

                        <div class="card-row col-md-12">
                            <div class="col-md-1 card-row-head text-md-center">№ п/п</div>
                            <div class="col-md-4 card-row-head text-md-left">Фамилия имя отчество</div>
                            <div class="col-md-2 card-row-head text-md-left">Дата рождения</div>
                            <div class="col-md-2 card-row-head text-md-left">Примечание</div>
                            <div class="col-md-1 card-row-head text-md-left">Роль</div>
                            <div class="col-md-2 card-row-head text-md-center">Действия</div>
                        </div>

                        <hr>

                        @foreach($pupils as $pupil)
                            <div class="card-row col-md-12">
                                <div class="col-md-1 card-row-title text-md-center">{{ $loop->iteration }}</div>
                                <div class="col-md-4 card-row-value text-md-left">{{ $pupil['fio'] }}</div>
                                <div class="col-md-2 card-row-value text-md-left">{{ $pupil['birthdate'] }}</div>
                                <div class="col-md-2 card-row-value text-md-left">{{ $pupil['description'] }}</div>
                                <div class="col-md-1 card-row-value text-md-left">{{ $pupil['role'] }}</div>
                                <div class="col-md-1 card-row-button  text-md-right">
                                    <a class="btn btn-primary" href="{{ route('group-pupil-edit', $pupil['id']) }}" title="Редактировать">
                                        <i class="fa fa-solid fa-pencil"></i>
                                    </a>
                                </div>
                                <div class="col-md-1 card-row-button text-md-left">
                                    <form name="pupil_{{ $pupil['id'] }}" method="POST" action="{{ route('group-pupil-delete') }}">
                                        @csrf
                                        <input type="hidden" name="id" value="{{ $pupil['id'] }}">
                                        <input type="hidden" name="unit_group_id" value="{{ $unit_group_id }}">
                                    </form>
                                    <a class="btn btn-danger pupil-delete" data-delete="{{ $pupil['id'] }}" href="#" title=" Удалить">
                                        <i class="fa fa-solid fa-trash"></i>
                                    </a>
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
