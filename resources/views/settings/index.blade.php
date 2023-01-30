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
                    <div class="card-header">{{ __('app.pages.settings.title') }}</div>

                    <div class="card-body">
                        <div class="info">
                            {{ __('app.pages.settings.info') }}
                        </div>

                        <div class="links-container">
                            <a href="{{ url('/teacher') }}">{{ __('app.pages.settings.teacher') }}</a>
                            <a href="{{ url('/educational_institution') }}">{{ __('app.pages.settings.educational_institution') }}</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
