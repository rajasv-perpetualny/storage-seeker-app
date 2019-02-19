<footer>
    <div class="container">
        <div id="featured-cities" class="featured-cities">
            <h3>Featured cities</h3>
            <ul>
                <li><a id="city-landing-01" href="{{ url('/search', ['slug' => 'ca-san-diego']) }}">San Diego storage units</a></li>
                <li><a id="city-landing-02" href="{{ url('/search', ['slug' => 'il-chicago']) }}">Chicago storage units</a></li>
                <li><a id="city-landing-03" href="{{ url('/search', ['slug' => 'ga-atlanta']) }}">Atlanta storage units</a></li>
                <li><a id="city-landing-04" href="{{ url('/search', ['slug' => 'tx-plano']) }}">Plano storage units</a></li>
                <li><a id="city-landing-05" href="{{ url('/search', ['slug' => 'or-portland']) }}">Portland storage units</a></li>
            </ul>
            <ul>
                <li><a id="city-landing-06" href="{{ url('/search', ['slug' => 'az-phoenix']) }}">Phoenix storage units</a></li>
                <li><a id="city-landing-07" href="{{ url('/search', ['slug' => 'ny-brooklyn']) }}">Brooklyn storage units</a></li>
                <li><a id="city-landing-08" href="{{ url('/search', ['slug' => 'nv-las-vegas']) }}">Las Vegas storage units</a></li>
                <li><a id="city-landing-09" href="{{ url('/search', ['slug' => 'ca-los-angeles']) }}">Los Angeles storage units</a></li>
                <li><a id="city-landing-10" href="{{ url('/search', ['slug' => 'tx-austin']) }}">Austin storage units</a></li>
            </ul>
            <ul>
                <li><a id="city-landing-11" href="{{ url('/search', ['slug' => 'tx-dallas']) }}">Dallas storage units</a></li>
                <li><a id="city-landing-12" href="{{ url('/search', ['slug' => 'co-denver']) }}">Denver storage units</a></li>
                <li><a id="city-landing-13" href="{{ url('/search', ['slug' => 'tx-houston']) }}">Houston storage units</a></li>
                <li><a id="city-landing-14" href="{{ url('/search', ['slug' => 'ny-new-yor']) }}">New York storage units</a></li>
                <li><a id="city-landing-15" href="{{ url('/search', ['slug' => 'tx-el-paso']) }}">El Paso storage units</a></li>
            </ul>
        </div>

        <div class="footer-content">
            <div class="logo-wrapper">
                <a href="/"><img src="{{url('/storage/images/storageseeker-logo.png')}}" class="logo" alt="Storage Seeker" width="250" /></a>
            </div>
            <nav class="nav-menu">
                <ul>
                    <li><a href="{{ url('size-guide') }}">Storage Size Guide</a></li>
                    <li><a href="http://blog.storageseeker.com">Blog</a></li>
                </ul>
            </nav>

            <div class="social-icons">
                <ul>
                    <li><a href="https://www.facebook.com/storageseekermain1" class="fa fa-facebook-square"></a></li>
                    <li><a href="https://plus.google.com/117386096536501401135/posts" class="fa fa-google-plus-square"></a></li>
                    <li><a href="https://twitter.com/storageseeker" class="fa fa-twitter-square"></a></li>
                    <li><a href="https://www.pinterest.com/storageseeker/" class="fa fa-pinterest-square"></a></li>
                    <li><a href="https://www.instagram.com/storage_seeker/" class="fa fa-instagram"></a></li>
                    <li><a href="https://storestuff500.tumblr.com/" class="fa fa-tumblr-square"></a></li>
                    <li><a href="https://www.youtube.com/channel/UC5xxHsdp46m2GLvMpDMzSxA" class="fa fa-youtube-square"></a></li>
                    <li><a href="https://www.linkedin.com/company/storageseeker-com" class="fa fa-linkedin-square"></a></li>
                </ul>
            </div>

            <nav class="extra-links">
                <ul>
                    <li><a href="{{ url('/find-storage') }}">Find Storage Facilities By Zip Code</a></li>
                    <li><a href="{{ url('/terms') }}">Terms & Conditions</a></li>
                    <li><a href="{{ url('/privacy') }}">Privacy Policy</a></li>
                    <li><a href="{{ url('/legal') }}">Legal & Company Info</a></li>
                    <li><a href="mailto:info@storageseeker.com">Contact Us</a></li>
                </ul>
                <p>© 2018 Storage Seeker. All Rights Reserved</p>
            </nav>
        </div>
    </div>
</footer>
