<!doctype html>
<html lang="{{ app()->getLocale() }}">
    @include('includes.head', ['titlePage' => !empty($titlePage)?$titlePage:'StorageSeeker'])
    <body class="{{!empty($bodyClass) ? $bodyClass : 'storageseeker home'}}">
    @include('includes.header')
    <main>
        @yield('content')
    </main>
    @if(!empty($bodyClass) && $bodyClass=='storageseeker home' )
        @include('includes.homeFooter')
    @endif
        <script>
            CONFIG = {
                locale  : 'en'
                , cdn   : '/stv1.2/'
            };

        </script>
    <script src="/js/app.js"></script>
    @yield('scripts')
    </body>
</html>
