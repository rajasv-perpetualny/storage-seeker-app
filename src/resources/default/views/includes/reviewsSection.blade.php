@if($reviews->numRatings > 0 )
    @php
        $reviewsBlock = array_chunk($reviews->items(), $perPage, true);
        $index = ($reviews->currentPage()>$reviews->lastPage()) ? $reviews->lastPage() : $reviews->currentPage();
        $reviewsBlock = $reviewsBlock[$index-1];
    @endphp
    {{$reviews->links()}}
    <ul class="reviews">
        @foreach($reviewsBlock as $index => $review)
            <li> @include('includes.review', ['i' => $index]) </li>
        @endforeach
    </ul>
    <div class="pagination-wrapper"> {{$reviews->links()}} </div>
    <div class="review-btn-wrapper"><a href="#review-form" class="leave-a-review" data-toggle="modal" data-target="#review-form" >Leave a review</a></div>
@endif
