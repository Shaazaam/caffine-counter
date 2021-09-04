<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="no-js">
    <head>
        <title>Caffeine Counter</title>

        <meta charset="utf-8" />
        <meta content="IE=edge" http-equiv="X-UA-Compatible" />
        <meta content="{{csrf_token()}}" name="csrf-token" />
        <meta content="width=device-width, initial-scale=1" name="viewport" />

        <link href="{{asset('dist/css/all.css')}}" rel="stylesheet" />

        {{-- global templates --}}
        @include('link')

        @stack('templates')
    </head>
    <body>

        <div class="container-fluid">
            <div class="row">
                <div class="col-xs-12">
                    @yield('body')
                </div>
            </div>
        </div>

        <script type="text/javascript" src="{{asset('dist/js/all.js')}}"></script>
        <script type="text/javascript" src="{{asset('dist/js/constants.js')}}"></script>
        <script type="text/javascript" src="{{asset('dist/js/mixins.js')}}"></script>
        <script type="text/javascript" src="{{asset('dist/js/serializers.js')}}"></script>
        <script type="text/javascript" src="{{asset('dist/js/init.js')}}"></script>

        @stack('scripts')
    </body>
</html>
