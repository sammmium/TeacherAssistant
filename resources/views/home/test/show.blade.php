@extends('layouts.app')

@section('scripts')
    $(document).ready(function() {
    /* подсветка кнопки меню */
    $('a.button-home').parent().addClass('selected-button');
    });
@endsection

@section('content')
    show
@endsection
