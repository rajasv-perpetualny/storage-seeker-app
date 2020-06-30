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
                    <li><a href="/size-guides">Storage Size Guide</a></li>
                    <li><a href="http://blog.storageseeker.com">Blog</a></li>
                </ul>
            </nav>
        </div>
    </div>

    <article class="page">
        <div class="container">
            <h1>Privacy Policy</h1>
            <p>Effective date: November 20, 2008<br>
                <br>
                Your use of StorageSeeker.com is your consent to this Online Privacy Policy and to our Legal Disclaimers. If you do not agree to the terms of this Online Privacy Policy or Legal Disclaimers, you may not use StorageSeeker.com.<br>
                <br>
                Customer information is not made available to third party companies or individuals other than the storage facilities at which you are reserving space.  StorageSeeker.com may contain links to other web sites. Neither StorageSeeker.com nor its owner Store It Here, LLC is responsible for the privacy practices, policies or content of such web sites.<br>
                <br>
                To reserve a unit at a storage facility through StorageSeeker.com, you must fill out the form on this website which requires you to provide certain personal information.  StorageSeeker.com sends the information on that form to the specific self storage facility at which you are reserving a unit.  Further, any personal information you provide to us via email available on our Contact page is available to our employees so that we may follow-up with you.<br>
                <br>
                We use online cookies to track customer visits through our site and we identify IP addresses, Internet Service Providers and internet browser types to analyze consumer usage of StorageSeeker.com. This information is not disseminated to any third party, including storage facilities, although our analysis of customer usage may be so provided.<br>
                <br>
                Standard-based Internet protocols are used to safeguard the information you provide during a purchase, payment and information submittal processes. There is a secure server implementing the Secure Sockets Layer protocol to interact with you when you provide personal information during the purchase and payment processes. These processes use up to 128 bit encryption. <br>
                <br>
                We reserve the right, in our sole and absolute discretion, to modify or change this privacy policy at any time.  We do not undertake to inform you of such changes but our current policy will always be available on our website.<br>
                <br>
                If you have any questions about this privacy policy or the practices of this site you can contact:<br>
                <br>
                StorageSeeker.com<br>
                315 Montgomery Street, 8th Floor<br>
                San Francisco, CA  94104<br>
                <a href="mailto:info@storageseeker.com">info@storageseeker.com</a></p>
        </div>
    </article>
@endsection
