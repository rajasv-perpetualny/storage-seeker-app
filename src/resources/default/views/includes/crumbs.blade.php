<nav class="breadcrumb">
  <ul>
    <li><a href="{{config('host')}}/">Find Storage</a></li>
    @if($breadcrumb->facilityPage)
      <li><a href="{{config('host')}}/search/{{$breadcrumb->city . ", " . $breadcrumb->fullstate}}">{{$breadcrumb->city}}, {{$breadcrumb->state}}</a></li>
      <li>{{$breadcrumb->facilityName}}</li>
    @elseif($breadcrumb->facilityId)
      <li><a href="{{config('host')}}/search/{{$breadcrumb->city . ", " . $breadcrumb->fullstate}}">{{$breadcrumb->city}}, {{$breadcrumb->state}}</a></li>
      <li><a href="{{config('host')}}/facility/{{$breadcrumb->facilityId}}">{{$breadcrumb->facilityName}}</a></li>
      <li><a href="{{config('host')}}/facility/{{$breadcrumb->facilityId}}">{{$breadcrumb->unitSize}}</a></li>
    @else
      <li><a href="{{config('host')}}/search/{{$breadcrumb->city . ", " . $breadcrumb->fullstate}}">{{$breadcrumb->city}}, {{$breadcrumb->state}}</a></li>
    @endif
  </ul>
</nav>