@extends('layouts.app')

@section('scripts')
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
                <div class="card-header">{{ __('app.pages.home.cards.groups.title') }}</div>

                <div class="card-body">
                    @if (!@empty($groups))
                        <ul class="row navbar-row">
                            <li class="nav-item">
                                <a href="{{ route('group-create') }}">{{ __('app.pages.home.cards.groups.add_button') }}</a>
                            </li>
                            @foreach($groups as $group)
                                <li class="nav-item">
                                    <a href="{{ route('group-select', $group['id']) }}">{{ $group['name'] }}</a>
                                </li>
                            @endforeach
                        </ul>
                    @endif
                </div>
            </div>

            &nbsp;

            @if (session('group_id'))
                <div class="card">
                    <div class="card-header">{{ __('app.pages.home.cards.tests.title') }}</div>

                    <div class="card-body">

                        @if (!empty($tests))
                            @if (!@empty($tests))
                                <ul class="row navbar-row">
                                    <li class="nav-item">
                                        <a href="#">{{ __('app.pages.home.cards.tests.add_button') }}</a>
                                    </li>
                                    @foreach($tests as $test)
                                        <li class="nav-item">
                                            <a href="#">{{ $test['date'] }} <br> {{ $test['subject'] }}</a>
                                        </li>
                                    @endforeach
                                </ul>
                            @endif
                        @endif

                    </div>
                </div>

            @endif
        </div>
    </div>
</div>
@endsection
