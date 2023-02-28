@extends('layouts.app')

@section('scripts')
    $(document).ready(function() {
        /* подсветка кнопки меню */
        $('a.button-home').parent().addClass('selected-button');

        $('button.group_delete').on('click', function () {
            let answer = confirm('{{ __('are you sure') }}');
            if (!answer) {
                return false;
            }
        });
    });
@endsection

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">{{ __('app.pages.group.title.index') }}</div>

                    @foreach($groups as $group)
                        <div class="card-body">
                            <div class="row">
                                <label for="name" class="col-md-4 text-md-right">{{ __('app.pages.group.name') }}</label>

                                <div class="col-md-6">
                                    <div id="name">{{ $group['name'] }}</div>
                                </div>

                                <div class="col-md-1">
                                    <form method="POST" name="group" action="{{ route('group-edit') }}">
                                        @csrf
                                        <input type="hidden" name="group_id" value="{{ $group['id'] }}">
                                        <button type="submit" class="btn btn-primary" title="{{ __('app.buttons.edit') }}">
                                            <i class="fa-solid fa-pen-to-square"></i>
                                        </button>
                                    </form>
                                </div>
                                <div class="col-md-1">
                                    <form method="POST" name="group" action="{{ route('group-delete') }}">
                                        @csrf
                                        <input type="hidden" name="group_id" value="{{ $group['id'] }}">
                                        <button type="submit" class="group_delete btn btn-danger" title="{{ __('app.buttons.delete') }}">
                                            <i class="fa-solid fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                &nbsp;

                <ul class="row navbar-row">
                    <li class="nav-item">
                        <a href="{{ route('group-create') }}">{{ __('app.pages.home.cards.groups.add_button') }}</a>
                    </li>
                </ul>

            </div>
        </div>
    </div>
@endsection
