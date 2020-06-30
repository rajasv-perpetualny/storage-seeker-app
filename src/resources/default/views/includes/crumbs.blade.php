<nav class="breadcrumb">
  <ul>
    <li><a href="{{config('host')}}/self-storage">Find Storage</a></li>
    @if($breadcrumb->facilityPage)
    <li><a href="{{config('host')}}/self-storage/{{$breadcrumb->state}}">{{$breadcrumb->fullstate}}</a></li>
    <li><a href="{{config('host')}}/self-storage/{{$breadcrumb->state}}/{{str_slug(strtolower($breadcrumb->city), '-')}}">{{$breadcrumb->city}}</a></li>
    <li>{{$breadcrumb->facilityName}}</li>
    @elseif($breadcrumb->facilityId)
      <li><a href="{{config('host')}}/self-storage/{{$breadcrumb->state}}">{{$breadcrumb->fullstate}}</a></li>
      <li><a href="{{config('host')}}/self-storage/{{$breadcrumb->state}}/{{str_slug(strtolower($breadcrumb->city), '-')}}">{{$breadcrumb->city}}</a></li>
      <li><a href="{{config('host')}}/self-storage/{{$breadcrumb->state}}/{{str_slug(strtolower($breadcrumb->city), '-')}}/{{str_slug(strtolower($breadcrumb->facilityName), '-')}}/{{$breadcrumb->facilityId}}">{{$breadcrumb->facilityName}}</a></li>
      <li>{{$breadcrumb->unitSize}}</li>
    @elseif($breadcrumb->city)
          <li><a href="{{config('host')}}/self-storage/{{$breadcrumb->state}}">{{$breadcrumb->fullstate}}</a></li>
      <li>{{$breadcrumb->city}}</li>
    @else
      <li>{{$breadcrumb->fullstate}}</li>
    @endif
  </ul>
</nav>
