<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel='shortcut icon' type='image/x-icon' href='{{ asset('imgs/favicon.ico') }}' />

        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Styles -->
        <link href="{{ asset('plugins/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
        <link href="{{ asset('plugins/datatables/datatables.min.css') }}" rel="stylesheet">
         <link href="{{ asset('plugins/chosen/chosen.css') }}" rel="stylesheet">
<!--          <link href="{{ asset('plugins/chosen/chosen-bootstrap.css') }}" rel="stylesheet">-->
          <link href="{{ asset('plugins/datepicker/bootstrap-datepicker.min.css') }}" rel="stylesheet">
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
       
        <!-- Scripts -->
        <script> var laravel_token = '{{ csrf_token() }}';</script>
        <script src="{{ asset('plugins/jquery.min.js') }}"></script>
<!--         <script src="{{ asset('plugins/moderniz.js') }}"></script>-->
        <script src="{{ asset('plugins/bootstrap/js/bootstrap.min.js') }}"></script>
        <script src="{{ asset('plugins/datatables/datatables.min.js') }}"></script>
         <script src="{{ asset('plugins/jquery.mask.js') }}"></script>
        <script src="{{ asset('plugins/chosen/chosen.jquery.js') }}"></script>
        <script src="{{ asset('plugins/jquery.confirm.js') }}"></script>
        <script src="{{ asset('plugins/datepicker/bootstrap-datepicker.min.js') }}"></script>
        <script src="{{ asset('plugins/datepicker/bootstrap-datepicker.pt-BR.min.js') }}"></script>
        <script src="{{ asset('js/app.js') }}"></script>
        <script src="{{ asset('js/tabela.js') }}"></script>

    </head>
    <body>
        <div id="app">

            @yield('navbar')

            @yield('content')
        </div> <!--fim div app-->

    </body>
</html>