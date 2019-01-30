<nav class="breadcrumb">
  <ul>
    <li><a href="{{config('host')}}/">Find Storage</a></li>
    @if($breadcumb->facilityPage)
      <li><a href="{{config('host')}}/search/{{$breadcumb->city . ", " . $breadcumb->fullstate}}">{{$breadcumb->city}}, {{$breadcumb->state}}</a></li>
      <li>{{$breadcumb->facilityName}}</li>
    @elseif($breadcumb->facilityId)
      <li><a href="{{config('host')}}/search/{{$breadcumb->city . ", " . $breadcumb->fullstate}}">{{$breadcumb->city}}, {{$breadcumb->state}}</a></li>
      <li><a href="{{config('host')}}/facility/{{$breadcumb->facilityId}}">{{$breadcumb->facilityName}}</a></li>
      <li><a href="{{config('host')}}/facility/{{$breadcumb->facilityId}}">{{$breadcumb->unitSize}}</a></li>
    @else
      <li><a href="{{config('host')}}/search/{{$breadcumb->city . ", " . $breadcumb->fullstate}}">{{$breadcumb->city}}, {{$breadcumb->state}}</a></li>
    @endif
  </ul>
</nav>