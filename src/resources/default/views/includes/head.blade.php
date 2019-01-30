<head>
    <title>@if(!empty($titlePage)) {{$titlePage}} @endif</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="/css/app.css" rel="stylesheet" type="text/css">
    <script type="text/javascript">
        basePath = '{{ url('') }}';
    </script>
    <link rel="shortcut icon" href="{{ url('storage/icons/storageseeker/favicon.ico') }}" />
</head>
