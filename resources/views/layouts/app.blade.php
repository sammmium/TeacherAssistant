<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('bootstrap/js/bootstrap.js') }}" defer></script>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://unpkg.com/imask"></script>
    <script src="{{ asset('js/jquery.maskedinput.min.js') }}" defer></script>
    <script src="{{ asset('fontawesome/js/fontawesome.js') }}" defer></script>
    <script src="{{ asset('fontawesome/js/solid.js') }}" defer></script>
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="{{ asset('js/main.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('fontawesome/css/fontawesome.css') }}" rel="stylesheet">
    <link href="{{ asset('fontawesome/css/solid.css') }}" rel="stylesheet">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('bootstrap/css/bootstrap.css') }}" rel="stylesheet">
    <link href="{{ asset('css/main.css') }}" rel="stylesheet">

    <script type="application/javascript">

        document.addEventListener('DOMContentLoaded', () => {

            const mask = (dataValue, options) => { // создаем универсальную функцию
                const elements = document.querySelectorAll(`[data-mask="${dataValue}"]`) // ищем поля ввода по селектору с переданным значением data-атрибута
                if (!elements) return // если таких полей ввода нет, прерываем функцию

                elements.forEach(el => { // для каждого из полей ввода
                    IMask(el, options) // инициализируем плагин imask для необходимых полей ввода с переданными параметрами маски
                })
            }

            // Используем наше функцию mask для разных типов масок

            // Маска для номера телефона
            mask('phone', {
                mask: '+{375}(00)000-00-00'
            })

            // Маска для почтового индекса
            mask('postalCode', {
                mask: '000000' // шесть цифр
            })

            // Маска для даты
            mask('date', {
                mask: Date,
                min: new Date(1900, 0, 1), // минимальная дата 01.01.1900
            })

            // Маска для числа
            mask('number', {
                mask: Number,
                thousandsSeparator: ' ' // разделитель тысяч в числе
            })

        });
        @yield('scripts')
    </script>
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    @auth
                        <ul class="navbar-nav mr-3">
                            <li class="nav-item">
                                <a class="button-home" href="{{ url('/home') }}">{{ __('app.buttons.home') }}</a>
                            </li>
{{--                            <li class="nav-item">--}}
{{--                                <a class="button-tests" href="{{ url('/tests') }}">{{ __('app.buttons.tests') }}</a>--}}
{{--                            </li>--}}
                            <li class="nav-item">
                                <a class="button-settings" href="{{ url('/settings') }}">{{ __('app.buttons.settings') }}</a>
                            </li>
                            <li class="nav-item">
                                <a class="button-dicts" href="{{ url('/dicts') }}">Справочник</a>
                            </li>
{{--                            <li class="nav-item">--}}
{{--                                <a class="button-test" href="{{ url('/test') }}">{{ __('app.buttons.test') }}</a>--}}
{{--                            </li>--}}
                        </ul>
                    @endauth

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            @if ($_SERVER['REQUEST_URI'] == '/register')
                                <li class="nav-item">
                                    <a href="{{ route('login') }}">{{ __('app.buttons.login') }}</a>
                                </li>
                            @endif
                            @if ($_SERVER['REQUEST_URI'] == '/login')
                                <li class="nav-item">
                                    <a href="{{ route('register') }}">{{ __('app.buttons.register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item">
                                <a href="{{ route('logout') }}"
                                   onclick="event.preventDefault();
                                   document.getElementById('logout-form').submit();">
                                    {{ __('app.buttons.logout') }}
                                </a>
                            </li>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            @yield('content')
        </main>
    </div>
</body>
</html>
