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
                    <div class="card-header">{{ __('app.pages.teacher.title.index') }}</div>

                    <div class="card-body">

                        <div class="form-group row">
                            <label for="first_name" class="col-md-4 text-md-right">{{ __('app.pages.teacher.first_name') }}</label>

                            <div class="col-md-6">
                                <div id="first_name">{{ $teacher['first_name'] }}</div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="last_name" class="col-md-4 text-md-right">{{ __('app.pages.teacher.last_name') }}</label>

                            <div class="col-md-6">
                                <div id="last_name">{{ $teacher['last_name'] }}</div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="job_title" class="col-md-4 text-md-right">{{ __('app.pages.teacher.job_title') }}</label>

                            <div class="col-md-6">
                                <div id="job_title">{{ $teacher['job_title'] }}</div>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <form method="POST" name="teacher" action="{{ route('teacher-edit') }}">
                                    @csrf
                                    <input type="hidden" name="teacher_id" value="{{ $teacher['id'] }}">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('app.pages.teacher.edit') }}
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

