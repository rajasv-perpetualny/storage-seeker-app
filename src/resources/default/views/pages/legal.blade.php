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
        </div>
    </div>

    <article class="page">
        <div class="container">
            <div class="legal">
                <h1>Website Terms of Use</h1>
                <p>This website or portion of it pertaining to self-storage (the “Website”), is operated by SpareFoot, Inc., a Delaware Corporation. The Website is provided as part of a free reservation service (including the Website, the “Service”) designed to assist users in determining the availability of self-storage units (“Units”) and initiating reservations for specific Units or other third-party services available via the Service (“Reservations”).</p>
                <p>The term “you” refers to the user visiting the Website and/or making Reservations through the Website or via the telephone related features of the Service.</p>
                <p>The Services is offered to you conditioned upon your acceptance without modification of all the terms, conditions, and notices set forth below (collectively, the “Agreement”). By accessing or using this Website or other elements of the Service, you agree to be bound by the Agreement. We reserve the right to change or otherwise modify the Agreement without prior notice at any time, and your continued access or use of this Website signifies your acceptance of the updated or modified Agreement.
                </p>

                <h2>Reservation Terms</h2>

                <h3>Use of the Reservation Service</h3>
                <p>As a condition of your use of the Reservation Service, you warrant that:</p>
                <ul>
                    <li>you will use the Service in accordance with this Agreement;</li>
                    <li>you possess the legal authority to create a binding legal obligation;</li>
                    <li>you will only use the Service to initiate legitimate Reservations for you or for another person or company for whom you are legally authorized to act;</li>
                    <li>all information supplied by you via the Service is true, accurate, current and complete; and</li>
                    <li>you are at least 18 years of age.</li>
                </ul>
                <p>We retain the right to deny access to the Service and decline Reservations, at any time and for any reason.</p>

                <h3>Calls May Be Recorded</h3>
                <p>If you use the telephone related features of the Service (including calling to reserve a Unit or accepting a call placed as a result of the automated dialing features described below), those calls may be recorded, and the content may be used for quality control purposes and also for purposes permitted by our Privacy Policy (below). Further, if you use the Service to make a reservation online, certain automated dialing features of the Service may call you at the telephone number(s) that you provide to us including without limitation in order to try to connect you with the lessor of the Unit(s) that you have expressed interest in via the Service. The personnel with whom you speak as a result of any such call are the personnel of the third party lessors, not SpareFoot.
                </p>

                <h3>Communications.</h3>
                <p>IF YOU HAVE AGREED THAT WE CAN SEND YOU MESSAGES CONTAINING ADVERTISEMENTS OR OFFERS FOR GOODS AND SERVICES, WE MAY DO SO FROM TIME TO TIME AND MAY SEND SUCH OFFERS BY VOICE OR SMS (OR TEXT) MESSAGE TO THE MOBILE PHONE NUMBER YOU DESIGNATE FOR SUCH PURPOSE. Message and data rates for such SMS messages may apply. Your consent to receipt of such messages is not, and will not be, a condition to any purchase. If at any time you change your mind regarding your consent to such messages, you must contact us at privacy@sparefoot.com or write to us at SpareFoot, Inc., Attn: Privacy Dept., 3300 N IH35, Suite 200, Austin, TX 78705.
                </p>

                <h3>Prohibited Activities</h3>
                <p>While you may make copies of your Reservation information, you agree not to otherwise modify, copy, distribute, transmit, display, perform, reproduce, publish, license, create derivative works from, transfer, sell, or re-sell any information, software, products, or services obtained from or through this Website. Additionally, you agree not to:</p>
                <ul>
                    <li>use the Service (including this Website or its contents) for any commercial purpose other than making Reservations for yourself or on behalf of your company;</li>
                    <li>access, monitor or copy any content or information of this Website using automated means or bulk manual processing for any purpose without our express written permission;</li>
                    <li>make any speculative, false, or fraudulent Reservation;</li>
                    <li>violate the restrictions in any robot exclusion headers on this Website or bypass or circumvent other measures employed to prevent or limit access to this Website;</li>
                    <li>take any action that, in our discretion, imposes an unreasonable or disproportionately large load on our infrastructure;</li>
                    <li>“frame,” “mirror” or otherwise incorporate any part of this Website into any other website without our prior written authorization.</li>
                </ul>

                <h3>Disclaimer</h3>
                <p>SpareFoot's role in the rental of storage spaces is limited to publishing advertising provided by lessors and communicating your requests for reservations to storage operators. SpareFoot is not responsible for, and does not engage in, brokering, selling, purchasing, exchanging, or leasing posted properties. SpareFoot does not purport to broker transactions, even though SpareFoot may be licensed as a real estate broker in one or more states. SpareFoot does not counsel lessors or lessees, show properties, negotiate sales contracts, or hold a position of trust and confidence, whether or not in connection with the Service. No brokerage relationship or any agency or fiduciary relationship is intended to be or shall be deemed to have been created between SpareFoot and any lessee of a storage space. SpareFoot makes no representations about properties advertised on this Website, about the lessors of such properties, or about the accuracy of information provided by such lessors. Prospective lessees are advised to perform all due diligence before entering into a contract to rent or lease storage space.
                </p>
                <p>SpareFoot is not involved in any lease transaction pertaining to a Unit, and any such transaction is solely between you and the lessor. SpareFoot has no control over and does not guarantee the quality, safety or legality of spaces advertised, the truth or accuracy of listings, the ability of lessors to lease the storage space, or that a lessor will actually complete a transaction.
                </p>

                <h3>Review Terms</h3>
                <p>In connection with the Service, you may submit reviews of facilities from which you rented Units via the Website, by survey or otherwise.  You acknowledge SpareFoot’s right to publish any reviews you submit. </p>
                <p>SpareFoot only posts reviews submitted by customers who have had a firsthand experience with the facility being reviewed.  You may not submit a review if you have a relationship with the facility being reviewed, whether as an owner, manager, employee or competitor.  You may not submit a review if you receive compensation or the promise of compensation (such as a discount off the facility’s rental fees or a free product) in exchange for the review.
                </p>
                <p>Reviews submitted to SpareFoot and posted on the Website reflect the opinions and beliefs of the individual reviewers and not of SpareFoot or any of its affiliates, officers, directors or employees. SpareFoot does not endorse any of the opinions expressed by reviewers. SpareFoot is not affiliated with any facility listed or reviewed on the Website.</p>

                <h2>Website Terms</h2>

                <h3>Inappropriate Content</h3>
                <p>When accessing the Website, you agree not to upload, display, perform, transmit or otherwise distribute any content that</p>
                <ul>
                    <li>is libelous, defamatory, obscene, pornographic, abusive or threatening;</li>
                    <li>encourages conduct that could constitute a criminal offense, give rise to civil liability or otherwise violate any applicable local, state, national or foreign law or regulation; or</li>
                    <li>advertises or otherwise solicits funds, goods, or services.</li>
                </ul>
                <p>SpareFoot will cooperate fully with any law enforcement officials or agencies in the investigation of any violation of this Agreement or of any applicable laws. SpareFoot reserves the right to remove any content from the site at any time, for any reason.</p>

                <h3>Links to Third-Party Sites</h3>
                <p>This Website may contain hyperlinks to websites operated by parties other than SpareFoot. Such hyperlinks are provided for your reference only. In addition, the content and functionality of the Service may be embedded within another website operated by third party. We do not control such websites and are not responsible for their contents or the privacy practices of such websites. Further, it is up to you to take precautions to ensure that whatever links you select or software you download is free of such items as viruses, worms, Trojan horses, defects and other items of a destructive nature. Our inclusion of hyperlinks to such websites, or embedding of SpareFoot content within another website, does not imply any endorsement of the material on such websites or any association with their operators.</p>

                <h3>Copyright Infringement</h3>
                <p>Certain areas of the Website  allow individuals to post comment and reviews.  If you believe that your work has been copied and posted on the Website in a way that constitutes copyright infringement, whether in such comments, reviews, or otherwise please provide our Copyright Agent with the following information: (i) an electronic or physical signature of the person authorized to act on behalf of the owner of the copyright interest; (ii) a description of the copyrighted work that you claim has been infringed; (iii) a description of where the material that you claim is infringing is located on the Website; (iv) your address, telephone number, and primary email address; (v) a written statement by you that you have a good faith belief that the disputed use is not authorized by the copyright owner, its agent, or the law; and (vi) a statement by you, made under penalty of perjury, that the above information in your notice is accurate and that you are the copyright owner or authorized to act on the copyright owner's behalf.</p>
                <p>Send any notices of suspected copyright infringement issues to legal@sparefoot.com and reference Copyright in the subject line.</p>

                <h2>Privacy Policy</h2>
                <p>SpareFoot believes in protecting your privacy. The SpareFoot Privacy Policy also governs your use of the Website, and you acknowledge it as part of this Agreement.
                </p>

                <h3>SpareFoot Privacy Policy</h3>
                <p>This Website or portion of it pertaining to self-storage is operated by SpareFoot, Inc., a Delaware corporation. This Privacy Policy applies when you access SpareFoot content or share information with SpareFoot, as discussed below. By using the Website, you accept this Privacy Policy, which may be updated by us at any time. If you do not agree to this Privacy Policy for any reason, do not use this Website or share your information with us. Please note that this Privacy Policy applies only to this Website or portion of it pertaining to self-storage, and not to any other website linked to or from it, or any website in which SpareFoot content or functionality is embedded. We do not control the privacy policies or practices of others.</p>

                <h3>Information We Collect From You</h3>
                <p>In General, we receive and store any information you provide via our Website, telephone, or give us in any other way. This includes information that can identify you (“personal information”), including but not limited to your first and last name, telephone number, postal address, and email address. You can choose not to provide information to us, but in general some information about you is required in order for you to make reservations or initiate other transactions on our site.
                </p>
                <p>We also record the phone calls made in connection with the Service, including when you call us or when the automated dialing features of the Service call you to try to connect you with the applicable lessor.
                </p>
                <p>We also may periodically obtain both personal and non-personal information about you from affiliated entities, business partners and other independent third-party sources and add it to our account information. Examples of information we may receive include updated postal address information and demographic information.
                </p>
                <p>We automatically collect some information about your computer when you visit this Website. For example, we will collect your IP address, Web browser software details, and the address of any referring website. We may also collect information about your online activity, such as pages viewed and reservations made.
                </p>

                <h3>How We Use Your Information</h3>
                <p>We use information about you for the following general purposes: to provide you with the products and services you request; to provide you with reservation confirmation and updates; to communicate with you in general; to respond to your questions and comments; to measure interest in and improve our products, services, and the Website; to notify you about special offers and products or services that may be of interest to you; to otherwise customize your experience with the Website; to solicit information from you, including through surveys; to resolve disputes or troubleshoot problems; to prevent potentially prohibited or illegal activities; for quality control purposes; to enforce our Terms of Use agreement; and as otherwise described to you at the point of collection.
                </p>

                <h3>Email Communications</h3>
                <p>We want to make it easy for you to take advantage of the services on our website. One way we do this is by sending you email messages that contain information about your apparent interests. For example, if you search for self-storage in New York on our Website but have not made a reservation, we may send you an email message about available storage in that area. We believe these email messages will provide you with useful information about storage related special offers available through our site. Please note that you will have the opportunity to choose not to receive these email messages in any such email we send.
                </p>

                <h3>How We Share Your Information</h3>
                <p>We share your information with our partners as they need it to fulfill services you have requested via the Website, and we restrict their use of this information to that purpose. Please note that our partners may contact you as necessary to obtain additional information about you, facilitate any reservations, or respond to a review you may submit.
                </p>
                <p>Third-parties who provide services or functions on our behalf may include business analytics companies, customer service vendors, communications service vendors, credit card processors, marketing vendors, and fraud prevention vendors. We may also authorize third-party vendors to collect information on our behalf, including as necessary to operate features of our Website or to facilitate the delivery of online advertising tailored to your interests. Third-party vendors have access to and may collect information only as needed to perform their functions and are not permitted to share or use the information for any other purpose.</p>
                <p>We also may share your information:</p>
                <ul>
                    <li>In response to subpoenas, court orders, or other legal process; to establish or exercise our legal rights; to defend against legal claims; or as otherwise required by law. In such cases we reserve the right to raise or waive any legal objection or right available to us.
                    </li>
                    <li>When we believe it is appropriate to investigate, prevent, or take action regarding illegal or suspected illegal activities; to protect and defend the rights, property, or safety of our company or this website, our customers, or others; and in connection with our Terms of Use and other agreements.
                    </li>
                    <li>In connection with a corporate transaction, such as a divestiture, merger, consolidation, or asset sale, or in the unlikely event of bankruptcy.
                    </li>
                </ul>
                <p>Other than as set out above, we will attempt to notify you when personal information about you will be shared with third parties.</p>

                <h3>Personal Information You Post in Public Areas</h3>
                <p>When you post a message in a SpareFoot forum, chat room, review, or customer feedback, the information you post is accessible to the public. If you post personal information anywhere on the Website that is accessible to the public, you are advised that such personally identifiable information can be read, collected, used or disseminated by others and could be used to send you unsolicited information or otherwise. Accordingly, you assume full responsibility for posting such information and agree that SpareFoot is not responsible in any way for personally identifiable information you choose to post in these public areas.</p>

                <h3>Disclaimer Regarding International Use</h3>
                <p>SpareFoot makes no claim that its Website is appropriate or lawful for use or access outside the United States. Furthermore, our databases are located in the United States. If you access the Website from outside the United States, you do so at your own risk. You are solely responsible for complying with all local laws, rules and regulations regarding online conduct and website access. By sending us your data, you consent to its transfer to and storage within the United States.</p>

                <h3>How Can You Access and Update Your Information?</h3>
                <p>You may request access to all your personally identifiable information that we collect online and maintain in our database by emailing support@sparefoot.com.</p>

                <h3>Your California Privacy Rights</h3>
                <p>California Civil Code Section 1798.83 permits our customers who are California residents to request certain information regarding our disclosure of personal information to third parties for their direct marketing purposes. To make such a request, please e-mail us or write to us as described below.
                </p>

                <h3>How to Contact Us</h3>
                <p>You can e-mail us at privacy@sparefoot.com or write to us at SpareFoot, Inc., Attn: Privacy Dept., 3300 N IH35, Suite 200, Austin, TX 78705.</p>

                <h2>General</h2>

                <p>THE SERVICE IS PROVIDED TO YOU STRICTLY ON AN "AS IS" BASIS. ALL CONDITIONS, REPRESENTATIONS AND WARRANTIES, WHETHER EXPRESS, IMPLIED, STATUTORY OR OTHERWISE, INCLUDING, WITHOUT LIMITATION, ANY IMPLIED WARRANTY OF MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE, OR NON-INFRINGEMENT OF THIRD PARTY RIGHTS, ARE HEREBY DISCLAIMED TO THE MAXIMUM EXTENT PERMITTED BY APPLICABLE LAW.
                </p>

                <h3>Limitations of Liability</h3>

                <p>IN NO EVENT SHALL SPAREFOOT (AND/OR ITS OFFICERS, DIRECTORS, AGENTS, SUBSIDIARIES, JOINT VENTURES AND EMPLOYEES) BE LIABLE FOR ANY INDIRECT, PUNITIVE, SPECIAL, INCIDENTAL OR CONSEQUENTIAL DAMAGE (INCLUDING BUT NOT LIMITED TO LOSS OF BUSINESS, REVENUE, PROFITS, USE, DATA OR OTHER ECONOMIC ADVANTAGE), HOWEVER SUCH DAMAGE ARISES, WHETHER IN ACTION OR INACTION OF CONTRACT, NEGLIGENCE OR OTHER TORTIOUS ACTION, OR ARISING OUT OF OR IN CONNECTION WITH THE USE OR INABILITY TO USE THE SERVICE OR MATERIALS AVAILABLE FROM THIS WEBSITE, EVEN IF SPAREFOOT HAS BEEN PREVIOUSLY ADVISED OF THE POSSIBILITY OF SUCH DAMAGE. Some states do not allow the exclusion or limitation of incidental or consequential damages, so the above limitation or exclusion may not apply to you.</p>
            </div>
        </div>
    </article>
@endsection
