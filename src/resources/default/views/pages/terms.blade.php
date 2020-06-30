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
            <h1>Legal Disclaimer and Terms &amp; Conditions</h1>
            <p>StorageSeeker.com is owned by Store It Here, LLC and service is provided subject to the following disclaimers, terms and conditions.</p>
            <br>
            <p>StorageSeeker.com and Store It Here are registered trademarks of Store It Here, LLC in the United States and other countries.</p>
            <br>
            <p>StorageSeeker.com may provide links to third party web sites not maintained by or related to Store It Here, LLC. These links are submitted by third parties and are provided by StorageSeeker.com as a service to our users.  Store It Here, LLC is not responsible for and makes no representations or warranties of any kind regarding the content, practices or policies of these third party web sites.  Store It Here, LLC has not reviewed the content of these third party web sites nor does it endorse or sponsor them.  Any reservation of a self storage unit made through StorageSeeker.com is subject to the policies and availability of the specific storage facility.  The information concerning each storage facility and the storage units in that facility is provided by the storage facility and StorageSeeker.com has not verified that information and disclaims any representation or warranty, express or implied, as to this information including any implied warranty of merchantability or fitness for particular purpose.  </p>
            <br>
            <p>Under no circumstances will StorageSeeker.com be liable for direct, indirect, incidental, special, consequential or exemplary damages (even if StorageSeeker.com has been advised of the possibility of such damages), resulting from your use of the StorageSeeker.com site or the service, whether the damages arise from use, inability to use or misuse of the StorageSeeker.com site.  Such limitation also applies to damages incurred by reason of other services or products received through the site or any links on the StorageSeeker.com site, as well as by reason of any information or advice received through the site or any links thereon.</p>
            <br>
            <p>Your transaction and other dealings with third parties found on or through StorageSeeker.com, including payment and delivery of goods or services, and any other terms, conditions, warranties or representations associated with such dealings, are solely between you and such third parties.  You should make whatever investigation you feel necessary or appropriate before proceeding with any online or offline transaction with any of these third parties. </p>
            <br>
            <p>You agree that StorageSeeker.com is not responsible or liable for any loss or damage of any sort incurred as the result of any such dealings. If there is a dispute between you and any third party, you understand and agree that StorageSeeker.com is under no obligation to become involved. </p>
            <br>
            <p>Your use of the StorageSeeker.com site and its service is entirely at your own risk. The StorageSeeker.com site and the service are provided on an "as is" or "as available" basis, without any warranties of any kind.  </p>
            <br>
            <p>ALL EXPRESS AND IMPLIED WARRANTIES, INCLUDING, WITHOUT LIMITATION, THE WARRANTIES OF MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE, AND NON-INFRINGEMENT OF PROPRIETARY RIGHTS ARE EXPRESSLY DISCLAIMED TO THE FULLEST EXTENT PERMITTED BY LAW.  </p>
            <br>
            <p>TO THE FULLEST EXTENT PERMITTED BY LAW, STORAGESEEKER.COM ALSO DISCLAIMS ANY WARRANTIES FOR OTHER SERVICES OR GOODS RECEIVED THROUGH STORAGESEEKER.COM SITE OR ACCESSED THROUGH ANY LINKS ON THE STORAGESEEKER.COM SITE.  TO THE FULLEST EXTENT PERMITTED BY LAW, STORAGESEEKER.COM DISCLAIMS ANY WARRANTIES FOR VIRUSES OR OTHER HARMFUL COMPONENTS IN CONNECTION WITH THE STORAGESEEKER.COM SITE OR THE SERVICE.  </p>
            <br>
            <p>This site is maintained in the state of California and its laws govern these disclaimers, terms and conditions, without giving effect to any principles of conflicts of laws.  We reserve the right to make changes to our site, privacy policy and these disclaimers, terms, and conditions at any time without notice.</p>
            <br>
            <p>  Cancellation Policy: StorageSeeker.com's service is billed
                monthly in advance on the first of each calendar month. Should
                you decide to cancel your subscription, please let us know via
                email (<a href="mailto:info@storageseeker.com">info@storageseeker.com</a>) and we will cancel your
                subscription effective as of the last day of the month in which
                the notice was given. There will be no refunds for prorated
                amounts between the notice of cancellation date and the last day
                of the month.</p>
            <br>
            <p>Please read our <a class="modallinkload" href="/privacy">privacy policy</a> for details concerning StorageSeeker.com's policy as to the information its user's provide.</p>
        </div>
    </article>
@endsection
