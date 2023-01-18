@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Dashboard</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        <!-- Данные школы -->
                        @if (isset($school))
                            @include('dashboard.school.index')
                        @else
                            @include('dashboard.school.add')
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection





<div class="school-container">
    <div class="container">
        <div class="title-container">
            Учреждение образования
        </div>
    <form action="/school/add" method="post">
        @csrf
        <div class="row">
            <div class="label col-4">
                <label for="input_school_name">Наименование</label>
            </div>
            <div class="field col-8">
                <input type="text" name="school_name" id="input_school_name" value="" placeholder="Введите наименование учреждения образования">
            </div>
        </div>
        <div class="row">
            <div class="label col-4">
                <label for="input_school_name">Адрес</label>
            </div>
            <div class="field col-8">
                <input type="text" name="school_address" id="input_school_address" value="" placeholder="Введите адрес учреждения образования">
            </div>
        </div>

    </form>
    </div>
</div>
add button
