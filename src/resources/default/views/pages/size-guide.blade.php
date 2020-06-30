@extends('layout')
@section('content')
<div class="page-hero home-hero state-hero">
    <div class="page-hero-cell">

        <div class="home-hero-heading no-bottom-margin">
          <h1>Self Storage Size Guide</h1>
        </div>
        @include('includes.homeForm')
    </div>
</div>

    <article class="size-guide-container">
        <div class="container">
            <div class="size-guide">

              <h2 class="content-h2">Self-Storage Size Guide</h2>
              <p class="content-p">
                StorageSeeker.com not only helps you find and compare the best facilities, units and
                prices for storing your belongings, we also provide this valuable self-storage size guide
                so you can make an informed decision about storage. Use the chart below to see the
                most common self-storage unit sizes and about how much can fit in each one, along
                with a convenient visual example. Once you've chosen the right storage size for you,
                start searching for self-storage facilities in your area.
            </p>

            <h2 class="content-h2">Many Sizes to Fit Every Storage Need</h2>
            <p class="content-p">
              There are a variety of self-storage unit sizes that you can reserve using StorageSeeker.com. Some are smaller spaces that are approximately the size of a household closet, while others are much larger and can fit an entire family’s home or corporation’s business inventory. There are also average, middle-of-the-road storage unit sizes (typically 10’x10’ or 10’x15’ in dimension), that are usually a good choice if you do now know exactly what size you might need. Remember – you can often change your unit’s size before or during your lease term if you outgrow it or need to downsize.
            </p>

            <h2 class="content-h2">Measure Before You Rent!</h2>
            <p class="content-p">
              One of the most important things to do before you <a href="/find-storage">rent a self-storage unit</a> is to measure all of the items that you want to store so you know how much room they will fill. While this could be time consuming at first, it will eventually pay off and save you time when you move in to your facility. We recommend you tape-off or mark-off the dimensions of your new space either outside or in a large-enough space in your home. This will give you an excellent visual representation of the space you will have to work with in your storage unit rental. It could save you an unwelcome surprise when you eventually move in!
            </p>

            <h2 class="content-h2">Sizes to Store Different Types of Things</h2>
            <p class="content-p">
              Due to the variety of unit sizes available for customers to rent, many customers underestimate the quantity or types of items that can be stored. These can range from smaller household goods like winter/summer clothing or decorations, to larger business inventory such as products and customer files. The largest self-storage units can even accommodate the contents of entire homes, massive quantities of business records or even cars, boats, or recreational vehicles. Sometimes storage facilities will have outdoor parking available to rent for these vehicles and boats as well. StorageSeeker.com has a thousands and thousands of all types of these units to compare and reserve online for free – so be sure to find the size that best fits!
            </p>

                <img src="{{ url('/storage/images/storageseeker-sizeguide_top.gif') }}" alt="Storage Size Guide" class="size-guide-header" />
                <table width="885" cellpading="0" cellspacing="0" class="table-striped table-bordered">
                    <tbody>
                        <tr height="20" align="center"><td width="119"><h2 class="content-h2"><strong>5 X 5</strong></h2></td><td width="165"><h4>Average closet</h4></td><td width="165"> <h4>Furniture and household items.</h4></td><td><img src="{{ url('/storage/images/5x5.gif') }}"></td></tr>
                        <tr height="20" align="center"><td width="119"><h2 class="content-h2"><strong>5 X 10</strong></h2></td><td width="165"><h4>Walk-in closet</h4></td><td width="165"> <h4>1 bedroom house or apartment.</h4></td><td><img src="{{ url('/storage/images/5X10.gif') }}"></td></tr>
                        <tr height="20" align="center"><td width="119"><h2 class="content-h2"><strong>10 X 10</strong></h2></td><td width="165"><h4>Small bedroom</h4></td><td width="165"><h4>1 - 2 bedroom house or apartment.</h4></td><td><img src="{{ url('/storage/images/10x10.gif') }}"></td></tr>
                        <tr height="20" align="center"><td width="119"><h2 class="content-h2"><strong>10 X 15</strong></h2></td><td width="165"><h4>Average bedroom</h4></td><td width="165"><h4>2 - 3 bedroom house or apartment.</h4></td><td><img src="{{ url('/storage/images/10x20.gif') }}"></td></tr>
                        <tr height="20" align="center"><td width="119"><h2 class="content-h2"><strong>10 X 20</strong></h2></td><td width="165"><h4>One car garage</h4></td><td width="165"><h4>3 - 4 bedroom house or apartment or one car or boat.</h4></td><td><img src="{{ url('/storage/images/10x20.gif ') }}"></td></tr>
                        <tr height="20" align="center"><td width="119"><h2 class="content-h2"><strong>10 X 30</strong></h2></td><td width="165"><h4>Extra large bedroom</h4></td><td width="165"><h4>2 - 3 bedroom house or apartment + one car or boat.</h4></td><td><img src="{{ url('/storage/images/10x30.gif') }}"></td></tr>
                    </tbody>
                </table>
            </div>
        </div>
    </article>
@endsection
@section('scripts')
    @include('includes.googlemapsIncludes')
@endsection
