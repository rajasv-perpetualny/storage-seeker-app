@extends('layout')
@section('content')
    <div class="content-container container">
        <h1>Information About Your Reservation</h1>

        An unexpected error occurred. We have been notified and will contact you if necessary.
        <br /><br />
        <a href="javascript: history.go(-1)">&larr; Back</a>

        @if ($errorMessage)
            <br/>
            <br/>
            <pre>
                {{$errorMessage}}
            </pre>
        @endif
    </div>
@endsection