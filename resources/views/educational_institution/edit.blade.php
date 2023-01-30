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
                    <div class="card-header">{{ __('app.pages.educational_institution.title.edit') }}</div>

                    <div class="card-body">

                        <form method="POST" name="educational-institution" action="{{ route('educational-institution-store') }}">
                            @csrf

                            <div class="form-group row">
                                <label for="full_name" class="col-md-4 col-form-label text-md-right">{{ __('app.pages.educational_institution.full_name') }}</label>

                                <div class="col-md-6">
                                    <input id="full_name" type="text" class="form-control @error('educational_institution_full_name') is-invalid @enderror" name="full_name" value="{{ $full_name }}" required autocomplete="full_name" autofocus>

                                    @error('educational_institution_full_name')
                                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="short_name" class="col-md-4 col-form-label text-md-right">{{ __('app.pages.educational_institution.short_name') }}</label>

                                <div class="col-md-6">
                                    <input id="short_name" type="text" class="form-control @error('educational_institution_short_name') is-invalid @enderror" name="short_name" value="{{ $short_name }}" required autocomplete="short_name" autofocus>

                                    @error('educational_institution_short_name')
                                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="address" class="col-md-4 col-form-label text-md-right">{{ __('app.pages.educational_institution.address') }}</label>

                                <div class="col-md-6">
                                    <input id="address" type="text" class="form-control @error('educational_institution_address') is-invalid @enderror" name="address" value="{{ $address }}" required autocomplete="address" autofocus>

                                    @error('educational_institution_address')
                                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-8 offset-md-4">
                                    <input type="hidden" name="educational_institution_id" value="{{ $id }}">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('app.pages.educational_institution.submit') }}
                                    </button>

                                    <a class="btn btn-secondary" href="{{ route('educational-institution') }}">{{ __('app.buttons.back') }}</a>
                                </div>
                            </div>

                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
