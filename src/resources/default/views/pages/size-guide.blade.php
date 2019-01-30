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
                <h3>Self Storage Size Guide</h3>
                <p>StorageSeeker.com not only helps you find and compare the best locations and prices for storing your items, we also provide this helpful self storage size guide for even more information. Use our chart to see the common self storage sizes, how to visualize them, about how much can fit in each self storage container, along with a convenient example. Once you've chosen the right storage size for you, start searching for the self storage facilities in your area.</p>

                <img src="{{ url('/storage/images/storageseeker-sizeguide_top.gif') }}" alt="Storage Size Guide" class="size-guide-header" />
                <table width="885" cellpading="0" cellspacing="0" class="table-striped table-bordered">
                    <tbody>
                        <tr height="20" align="center"><td width="119"><h2><strong>5 X 5</strong></h2></td><td width="165"><h4>Average closet</h4></td><td width="165"> <h4>Furniture and household items.</h4></td><td><img src="{{ url('/storage/images/5x5.gif') }}"></td></tr>
                        <tr height="20" align="center"><td width="119"><h2><strong>5 X 10</strong></h2></td><td width="165"><h4>Walk-in closet</h4></td><td width="165"> <h4>1 bedroom house or apartment.</h4></td><td><img src="{{ url('/storage/images/5X10.gif') }}"></td></tr>
                        <tr height="20" align="center"><td width="119"><h2><strong>10 X 10</strong></h2></td><td width="165"><h4>Small bedroom</h4></td><td width="165"><h4>1 - 2 bedroom house or apartment.</h4></td><td><img src="{{ url('/storage/images/10x10.gif') }}"></td></tr>
                        <tr height="20" align="center"><td width="119"><h2><strong>10 X 15</strong></h2></td><td width="165"><h4>Average bedroom</h4></td><td width="165"><h4>2 - 3 bedroom house or apartment.</h4></td><td><img src="{{ url('/storage/images/10x20.gif') }}"></td></tr>
                        <tr height="20" align="center"><td width="119"><h2><strong>10 X 20</strong></h2></td><td width="165"><h4>One car garage</h4></td><td width="165"><h4>3 - 4 bedroom house or apartment or one car or boat.</h4></td><td><img src="{{ url('/storage/images/10x20.gif ') }}"></td></tr>
                        <tr height="20" align="center"><td width="119"><h2><strong>10 X 30</strong></h2></td><td width="165"><h4>Extra large bedroom</h4></td><td width="165"><h4>2 - 3 bedroom house or apartment + one car or boat.</h4></td><td><img src="{{ url('/storage/images/10x30.gif') }}"></td></tr>
                    </tbody>
                </table>
            </div>
        </div>
    </article>
@endsection
