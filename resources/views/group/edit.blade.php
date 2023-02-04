@extends('layouts.app')

@section('scripts')
    $(document).ready(function() {
        /* подсветка кнопки меню */
        $('a.button-settings').parent().addClass('selected-button');
    });
@endsection

@section('content')
    <div class="container">
        <div class="row justify-content-center">

            <div class="col-md-12">

                <div class="card">
                    <div class="card-header">{{ __('app.pages.group.title.edit') }}</div>

                    <div class="card-body">

                        <form method="POST" name="teacher" action="{{ route('group-store') }}">
                            @csrf

                            <div class="form-group row">
                                <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('app.pages.group.name') }}</label>

                                <div class="col-md-6">
                                    <input id="name" type="text" class="form-control @error('group_name') is-invalid @enderror" name="name" value="{{ $name }}" required autocomplete="name" autofocus>

                                    @error('group_name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-8 offset-md-4">
                                    <input type="hidden" name="group_id" value="{{ $id }}">

                                    <button type="submit" class="btn btn-primary">
                                        {{ __('app.pages.teacher.submit') }}
                                    </button>

                                    <a class="btn btn-secondary" href="{{ route('group') }}">{{ __('app.buttons.back') }}</a>
                                </div>
                            </div>

                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
