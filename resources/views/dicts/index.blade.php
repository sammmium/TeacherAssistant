@extends('layouts.app')

@section('scripts')
    $(document).ready(function() {
        /* подсветка кнопки меню */
        $('a.button-dicts').parent().addClass('selected-button');
    });
@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Справочник</div>

                <div class="card-body">
                    @if(!empty($items))
                        @foreach($items as $item)
                            <div class="card-row col-md-12">
                                <div class="col-md-4 card-row-title"></div>
                                <div class="col-md-7 card-row-value">
                                    <a href="{{ route('dicts-select', $item['id']) }}">
                                        <div class="btn btn-secondary col-md-5">{{ $item['value'] }}</div>
                                    </a>
                                </div>
                                <div class="col-md-1 card-row-button"></div>
                            </div>
                        @endforeach
                    @else
                        <div class="card-row col-md-12">
                            <div class="col-md-4 card-row-title"></div>
                            <div class="col-md-7 card-row-value">
                                Справочники отсутствуют
                            </div>
                            <div class="col-md-1 card-row-button"></div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
