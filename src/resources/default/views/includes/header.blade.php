<header>
    <div class="facility-header">
        <a href="{{url('')}}" class="header-logo"><img src="{{asset('/storage/images/storageseeker-logo.png')}}" alt="Storage Seeker" name="Storage Seeker" title="Storage Seeker" height="36"></a>
        <nav class="nav-menu">
            <ul>
                <li><a href="{{url('/self-storage')}}">Find Storage By State</a></li>
                <li><a href="{{url('/size-guides')}}">Storage Size Guide</a></li>
                <li><a href="http://blog.storageseeker.com">Blog</a></li>
                <li><a href="{{ url('/find-storage') }}">Find Storage Near Me</a></li>
            </ul>
        </nav>
        <div id="header-phone-number" class="phone">{{ config('site.' . config('domain') . '.phone') }}</div>
        @includeWhen(is_object($breadcrumb), 'includes.crumbs', ['breadcrumb' => $breadcrumb])
    </div>
</header>


