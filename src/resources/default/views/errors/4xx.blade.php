@extends('layout')
@section('content')
        <div class="page-hero">
        <div class="page-hero-cell">
            <div class="phone-number">
                <h3>{{ config('site.default.phone')  }}</h3>
            </div>
            <div class="logo-wrapper">
                <a href="/"><img src="{{url('/storage/images/storageseeker-logo.png')}}" class="logo" alt="Storage Seeker" width="375" /></a>
            </div>
            <nav class="nav-menu">
                <ul>
                    <li><a href="/size-guide">Storage Size Guide</a></li>
                    <li><a href="http://blog.storageseeker.com">Blog</a></li>
                </ul>
            </nav>
            @include('includes.homeForm')
        </div>
    </div>

    <article class="size-guide-container">
        <div class="container">
            <div class="size-guide">
                @if(stripos($errorMessage, 'location') && stripos($errorMessage, 'validation.regex'))
                    <h3>Oops...</h3>
                    <p class="textmessage" tabindex="0">No self-storage found in the location </p>
                @else
                    <h3>Something went wrong...</h3>
                    <p>{{$errorMessage}}</p>
                @endif
            </div>
        </div>
    </article>

@endsection
@section('scripts')
    @include('includes.googlempasIncludes')
@endsection