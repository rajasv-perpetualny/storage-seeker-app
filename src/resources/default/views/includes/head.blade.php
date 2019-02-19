<head>
    <title>@if(!empty($titlePage)) {{$titlePage}} @endif</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @if(Request::is('search/zip/*'))
      <meta name="robots" contents="noindex" >
    @endif
    <link rel="canonical" href="{{ Request::url() }}">
    <link href="/css/app.css" rel="stylesheet" type="text/css">
    <script type="text/javascript">
        basePath = '{{ url('') }}';
    </script>
    <link rel="shortcut icon" href="{{ url('storage/icons/storageseeker/favicon.ico') }}" />
</head>
