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
                    <div class="card-header">{{ __('app.pages.teacher.title.edit') }}</div>

                    <div class="card-body">

                        <form method="POST" name="teacher" action="{{ route('teacher-store') }}">
                            @csrf

                            <div class="form-group row">
                                <label for="first_name" class="col-md-4 col-form-label text-md-right">{{ __('app.pages.teacher.first_name') }}</label>

                                <div class="col-md-6">
                                    <input id="first_name" type="text" class="form-control @error('teacher_first_name') is-invalid @enderror" name="first_name" value="{{ $first_name }}" required autocomplete="first_name" autofocus>

                                    @error('teacher_first_name')
                                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="last_name" class="col-md-4 col-form-label text-md-right">{{ __('app.pages.teacher.last_name') }}</label>

                                <div class="col-md-6">
                                    <input id="last_name" type="text" class="form-control @error('teacher_last_name') is-invalid @enderror" name="last_name" value="{{ $last_name }}" required autocomplete="last_name" autofocus>

                                    @error('teacher_last_name')
                                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="job_title" class="col-md-4 col-form-label text-md-right">{{ __('app.pages.teacher.job_title') }}</label>

                                <div class="col-md-6">
                                    <input id="job_title" type="text" class="form-control @error('teacher_job_title') is-invalid @enderror" name="job_title" value="{{ $job_title }}" required autocomplete="job_title" autofocus>

                                    @error('teacher_job_title')
                                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-8 offset-md-4">
                                    <input type="hidden" name="teacher_id" value="{{ $id }}">

                                    <button type="submit" class="btn btn-primary">
                                        {{ __('app.pages.teacher.submit') }}
                                    </button>

                                    <a class="btn btn-secondary" href="{{ route('teacher') }}">{{ __('app.buttons.back') }}</a>
                                </div>
                            </div>

                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
