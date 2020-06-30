<head>
    <title>@if(!empty($titlePage)) {{$titlePage}} @endif</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @if(isset($metaDescription))
      <meta name="description" content="{{ $metaDescription }}">
    @endif
    @if(Request::is('search/zip/*'))
      <meta name="robots" contents="noindex" >
    @endif
    @if(isset($canonicalUrl))
    <link rel="canonical" href="{{ $canonicalUrl }}">
    @else
    <link rel="canonical" href="{{ Request::url() }}">
    @endif
    <link href="/css/app.css" rel="stylesheet" type="text/css">
    <script type="text/javascript">
        basePath = '{{ url('') }}';
    </script>
    <link rel="shortcut icon" href="{{ url('storage/icons/storageseeker/favicon.ico') }}" />
    <!-- Facebook Pixel Code -->

<script>
!function(f,b,e,v,n,t,s)
  {if(f.fbq)return;n=f.fbq=function(){n.callMethod?
  n.callMethod.apply(n,arguments):n.queue.push(arguments)};
  if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';
  n.queue=[];t=b.createElement(e);t.async=!0;
  t.src=v;s=b.getElementsByTagName(e)[0];
  s.parentNode.insertBefore(t,s)}(window, document,'script',
  'https://connect.facebook.net/en_US/fbevents.js');
  fbq('init', '2317993108445000');
  fbq('track', 'PageView');
</script>
<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-6649134-1"></script>
<script>
window.dataLayer = window.dataLayer || [];
function gtag(){dataLayer.push(arguments);}
gtag('js', new Date());

gtag('config', 'UA-6649134-1');
gtag('config', 'AW-1037189963');
</script>
@yield('tracking')
<noscript><img height="1" width="1" style="display:none"
  src="https://www.facebook.com/tr?id=2317993108445000&ev=PageView&noscript=1"
/></noscript>
<!-- End Facebook Pixel Code -->
</head>
