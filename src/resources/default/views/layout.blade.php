<!doctype html>
<html lang="{{ app()->getLocale() }}">
    @include('includes.head', ['titlePage' => !empty($titlePage)?$titlePage:'StorageSeeker'])
    <body class="{{!empty($bodyClass) ? $bodyClass : 'storageseeker home'}}">
    @include('includes.header')
    <main>
        @yield('content')
    </main>
    @if(!empty($bodyClass) )
      @if($bodyClass=='storageseeker home featured-cities')
        @include('includes.featuredCities')
        @include('includes.homeFooter')
      @elseif($bodyClass=='storageseeker home')
        @include('includes.homeFooter')
      @endif
    @endif
        <script>
            CONFIG = {
                locale  : 'en'
                , cdn   : '/stv1.2/'
            };

        </script>
    <script src="/js/app.js"></script>

<!-- Twitter universal website tag code -->

<script>

!function(e,t,n,s,u,a){e.twq||(s=e.twq=function(){s.exe?s.exe.apply(s,arguments):s.queue.push(arguments);

},s.version='1.1',s.queue=[],u=t.createElement(n),u.async=!0,u.src='//static.ads-twitter.com/uwt.js',

a=t.getElementsByTagName(n)[0],a.parentNode.insertBefore(u,a))}(window,document,'script');

// Insert Twitter Pixel ID and Standard Event data below

twq('init','o1na4');

twq('track','PageView');

</script>

<!-- End Twitter universal website tag code -->

    @yield('scripts')
    </body>
</html>
