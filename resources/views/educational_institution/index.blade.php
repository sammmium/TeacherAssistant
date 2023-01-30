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
                    <div class="card-header">{{ __('app.pages.educational_institution.title.index') }}</div>

                    <div class="card-body">

                        <div class="form-group row">
                            <label for="full_name" class="col-md-4 text-md-right">{{ __('app.pages.educational_institution.full_name') }}</label>

                            <div class="col-md-6">
                                <div id="full_name">{{ $educational_institution['full_name'] }}</div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="short_name" class="col-md-4 text-md-right">{{ __('app.pages.educational_institution.short_name') }}</label>

                            <div class="col-md-6">
                                <div id="short_name">{{ $educational_institution['short_name'] }}</div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="address" class="col-md-4 text-md-right">{{ __('app.pages.educational_institution.address') }}</label>

                            <div class="col-md-6">
                                <div id="address">{{ $educational_institution['address'] }}</div>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <form method="POST" name="educational_institution" action="{{ route('educational-institution-edit') }}">
                                    @csrf
                                    <input type="hidden" name="educational_institution_id" value="{{ $educational_institution['id'] }}">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('app.pages.educational_institution.edit') }}
                                    </button>
                                </form>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
