@extends('layouts.gym-merchant.gymbasic')

@section('CSS')
    {!! HTML::style('front/css/business-agreement-reset.css')  !!}
    {!! HTML::style('front/css/agreement-page-responsive.css')  !!}
@stop

@section('content')
    <div class="container-fluid">
        <!-- BEGIN PAGE BREADCRUMBS -->
        <ul class="page-breadcrumb breadcrumb">
            <li>
                <a href="{{route('gym-admin.dashboard.index')}}">Home</a>
                <i class="fa fa-circle"></i>
            </li>
            <li>
                <span>Agreement</span>
            </li>
        </ul>
        <!-- END PAGE BREADCRUMBS -->
        <!-- BEGIN PAGE CONTENT INNER -->
        <div class="page-content-inner">
            <div class="row">
                <div class="col-md-12">
                    <div class="portlet light ">
                        <div class="portlet-title">
                            <div class="caption font-dark">
                                <i class="fa fa-file-text-o font-red"></i>
                                <span class="caption-subject font-red bold uppercase">Merchant Agreement</span>
                            </div>
                        </div>


                        <div class="portlet-body">

                            <!--Section Start HEADER-->

                            <section class="section-header">
                                <div class="container">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <h1>Merchant Agreement</h1>
                                        </div>

                                    </div>
                                </div>
                            </section>
                            <!--Section End HEADER-->


                            <!--Section Start FEATURES-->

                            <section class="section-features">
                                <div class="container">
                                    <div class="row">

                                        <div class="col-md-12">


                                            <p>This Service Provider Agreement (“Agreement”) is made, executed and agreed upon by the following parties;</p>

                                            <p>
                                                Merchant Company (“Merchant”), a company incorporated under the Companies Act, 1956, having its registered office in India ( here inafter refer as “Merchant” which expression shall unless repugnant to the subject or context shall mean and include its successors and permitted assigns) which has sought to use Froiden’s services of First Part.
                                            </p>

                                            <p>
                                                AND
                                            </p>

                                            <p>
                                                Froiden Technologies Private Limited (“Froiden”), a company incorporated under the Companies Act, 1956, having its registered office at 10/850, Malviya Nagar, Opp. Brain Tower., Jaipur - 302017, (which expression shall unless repugnant to the subject or context shall mean and include its successors and assigns); agree to the terms and conditions set out hereunder of the Other Part.
                                            </p>

                                        </div>

                                        <div class="agreement-section">

                                            <div class="col-md-8 left">

                                                <h3>
                                                    Acceptance of Terms
                                                </h3>

                                                <p>
                                                    Your use of services offered by Froiden (referred to Services in this document) is subject to the terms of a legal agreement between you and Froiden. This page explains how the agreement is made up, and sets out some of the terms of that agreement (referred as Terms of Service (TOS) in this document).
                                                </p>
                                                <p>
                                                    Froiden provides a platform for businesses called Fitsigma by which Merchant can manage their business.
                                                </p>
                                                <p>

                                                    In order to use the Services, you must first agree to the Terms. You may not use the Services if you do not accept the Terms of Use. You can accept the Terms by:
                                                </p>
                                                <p>

                                                    Clicking to accept or agree to the Terms, where this option is made available to you by Froiden in the user interface for any particular Service; or
                                                </p>
                                                <p>

                                                    Actually using the Services. In this case, you understand and agree that Froiden will treat your use of the Services as acceptance of the Terms from that point onwards.
                                                </p>

                                            </div>

                                            <div class="col-md-4 right">
                                                <h3>
                                                    Basically
                                                </h3>

                                                <p>
                                                    Froiden provides service called Fitsigma to manage day-to-day business work. By using Fitsigma, you agree to all the terms below.
                                                </p>
                                            </div>

                                            <div class="clearfix"></div>

                                        </div>

                                        <div class="agreement-section">

                                            <div class="col-md-8 left">

                                                <h3>
                                                    Provision of the Services being offered by Froiden
                                                </h3>

                                                <p>
                                                    Froiden is constantly evolving in order to provide the best possible experience and information for its users. You acknowledge and agree that the form and nature of the Services which Froiden provides may change from time to time without prior notice to you.
                                                </p>
                                                <p>

                                                    As part of this continuing process, you acknowledge and agree that Froiden may stop (permanently or temporarily) providing the Services (or any features within the Services) to you or to users generally at Frodien's sole discretion, without prior notice to you. You may stop using the Services at any time. You do not need to specifically inform Froiden when you stop using the Services.
                                                </p>
                                                <p>

                                                    You acknowledge and agree that if Froiden disables access to your account, you may be prevented from accessing the Services, your account details or any files or other content which is contained in your account.
                                                </p>

                                                <p>
                                                    By using Froiden's services you agree to the following disclaimer: Froiden disclaims any liability for any information that may have become outdated since the last time the particular piece of information was updated. Froiden reserves the right to make changes and corrections to any part of the content of this website at any time without prior notice. Unless stated otherwise, all pictures and information contained on this website are believed to be in the public domain as either promotional materials, publicity photos, photoshoot rejects or press media stock. Please email a Takedown Request (by using the Contact Us on the home page) to the webmaster under the terms of the Digital Millennium Copyright Act if you are the copyright owner of any content on this website and you think the use of the above material violates the Copyright act in any way. Please indicate the exact URL of the webpage in your request. All images shown here have been digitised by Froiden. No other party is authorised to reproduce or republish these digital versions in any format whatsoever without the written permission of Froiden.
                                                </p>

                                            </div>

                                            <div class="col-md-4 right">
                                                <h3>
                                                    Basically
                                                </h3>

                                                <p>
                                                    If these terms change, we will notify you. As well, at times things can go wrong and the service may be interrupted. It’s unlikely, but sometimes things can go really wrong. You can stop using your account or close your account at any time.
                                                </p>
                                            </div>
                                            <div class="clearfix"></div>

                                        </div>

                                        <div class="agreement-section">

                                            <div class="col-md-8 left">

                                                <h3>
                                                    Use of the Services by You
                                                </h3>

                                                <p>
                                                    In order to access certain Services, you may be required to provide information about yourself (such as identification or contact details) as part of the registration process for the Service, or as part of your continued use of the Services. You agree that any registration information you give to Froiden will always be accurate, correct and up to date.
                                                </p>
                                                <p>
                                                    You agree to use the Services only for purposes that are permitted by (a) the Terms and (b) any applicable law, regulation or generally accepted practices or guidelines in the relevant jurisdictions.
                                                </p>
                                                <p>

                                                    You agree to use the data owned by Froiden (as available on the website or through any other means like API etc) only for personal purposes and not for any commercial use unless agreed to with Froiden in writing.
                                                </p>
                                                <p>

                                                    You agree not to access (or attempt to access) any of the Services by any means other than through the interface that is provided by Froiden, unless you have been specifically allowed to do so in a separate agreement with Froiden. You specifically agree not to access (or attempt to access) any of the Services through any automated means (including use of scripts or web crawlers) and shall ensure that you comply with the instructions set out in any robots.txt file present on the Services.
                                                </p>
                                                <p>
                                                    You agree that you will not engage in any activity that interferes with or disrupts the Services (or the servers and networks which are connected to the Services).
                                                </p>
                                                <p>
                                                    Unless you have been specifically permitted to do so in a separate agreement with Froiden, you agree that you will not reproduce, duplicate, copy, sell, trade or resell the Services for any purpose.
                                                </p>
                                                <p>
                                                    You agree that you are solely responsible for (and that Froiden has no responsibility to you or to any third party for) any breach of your obligations under the Terms and for the consequences (including any loss or damage which Froiden may suffer) of any such breach.

                                                    You agree to the use of your data in accordance with Froiden's Privacy Policy.
                                                </p>

                                            </div>

                                            <div class="col-md-4 right">
                                                <h3>
                                                    Basically
                                                </h3>

                                                <p>
                                                    You cannot use our site to post pornographic material, harass people, send spam, and do other crazy stuff. Be reasonable and responsible, don't do anything stupid, and you'll be fine.
                                                </p>
                                            </div>
                                            <div class="clearfix"></div>

                                        </div>

                                        <div class="agreement-section">

                                            <div class="col-md-8 left">

                                                <h3>
                                                    Content in the Services
                                                </h3>

                                                <p>
                                                    You should be aware that Content (such as data files, written text, computer software, music, audio files or other sounds, photographs, videos or other images) presented to you as part of the Services, including but not limited to advertisements in the Services and sponsored Content within the Services may be protected by intellectual property rights which are owned by the sponsors or advertisers who provide that Content to Froiden (or by other persons or companies on their behalf). You may not modify, rent, lease, loan, sell, distribute or create derivative works based on this Content (either in whole or in part) unless you have been specifically told that you may do so by Froiden or by the owners of that Content, in writing and in a separate agreement.
                                                </p>
                                                <p>

                                                    Froiden reserves the right (but shall have no obligation) to pre-screen, review, flag, filter, modify, refuse or remove any or all Content from any Service.
                                                </p>
                                                <p>
                                                    Froiden reserves the right to moderate, publish, re-publish, and use all user generated contributions and comments (including but not limited to reviews, profile pictures, comments, likes, favorites, votes) posted on the website as it deems appropriate (whether in whole or in part) for its product(s), whether owned or affiliated. Froiden is not liable to pay royalty to any user for re-publishing any content across any of its platforms.
                                                </p>
                                                <p>
                                                    If you submit any material on the website, you agree thereby to grant Froiden the right to use, moderate, publish any such work worldwide for any of its product(s), whether owned of affiliated.
                                                </p>

                                                <p>

                                                    You understand that by using the Services you may be exposed to Content that you may find offensive, indecent or objectionable and that, in this respect, you use the Services at your own risk.
                                                </p>


                                            </div>

                                            <div class="col-md-4 right">
                                                <h3>
                                                    Basically
                                                </h3>

                                                <p>
                                                    Your photos/videos will preserve whatever copyright they had before uploading to this site. We will protect the copyright and we will not sell your photos/videos or any other data without your permission.
                                                </p>
                                            </div>
                                            <div class="clearfix"></div>

                                        </div>

                                        <div class="agreement-section">

                                            <div class="col-md-8 left">

                                                <h3>
                                                    Proprietary Rights
                                                </h3>

                                                <p>
                                                    You acknowledge and agree that Froiden (or Froiden's licensors) own all legal right, title and interest in and to the Services, including any intellectual property rights which subsist in the Services (whether those rights happen to be registered or not, and wherever in the world those rights may exist). You further acknowledge that the Services may contain information which is designated confidential by Froiden and that you shall not disclose such information without Froiden's prior written consent.
                                                </p>
                                                <p>

                                                    Unless you have agreed otherwise in writing with Froiden, nothing in the Terms gives you a right to use any of Froiden's trade names, trade marks, service marks, logos, domain names, and other distinctive brand features.
                                                </p>
                                                <p>

                                                    Unless you have been expressly authorized to do so in writing by Froiden, you agree that in using the Services, you will not use any trade mark, service mark, trade name, logo of any company or organization in a way that is likely or intended to cause confusion about the owner or authorized user of such marks, names or logos.
                                                </p>


                                            </div>

                                            <div class="col-md-4 right">
                                                <h3>
                                                    Basically
                                                </h3>

                                                <p>
                                                    You cannot use Froiden's or its services' trade names, trade marks, service marks, logos, domain names, and other distinctive brand features without taking the permisssion from us.
                                                </p>
                                            </div>
                                            <div class="clearfix"></div>

                                        </div>

                                        <div class="agreement-section">

                                            <div class="col-md-8 left">

                                                <h3>
                                                    Confidential Information
                                                </h3>

                                                <p>
                                                    Each party acknowledges and agrees that any Confidential Information received from the other party will be the sole and exclusive property of the other party and may not be used or disclosed except as necessary to perform the obligations required under this Agreement.
                                                </p>


                                            </div>

                                            <div class="col-md-4 right">
                                                <h3>
                                                    Basically
                                                </h3>

                                                <p>
                                                    We will keep your and your customer's data confidential.
                                                </p>
                                            </div>
                                            <div class="clearfix"></div>

                                        </div>

                                        <div class="agreement-section">

                                            <div class="col-md-8 left">

                                                <h3>
                                                    Technical Issues & Delivery Policy
                                                </h3>

                                                <p>
                                                    In case of any technical issues, please raise a support ticket by emailing support@fitsigma.com or from your service dashboard to let us know of the same. You can also contact us on 9001021919 in case of urgent matters.
                                                </p>


                                            </div>

                                            <div class="col-md-4 right">
                                                <h3>
                                                    Basically
                                                </h3>

                                                <p>
                                                    In case of any question or complaint email at support@fitsigma.com
                                                </p>
                                            </div>
                                            <div class="clearfix"></div>

                                        </div>


                                    </div>
                                </div>
                            </section>

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- END PAGE CONTENT INNER -->
    </div>






@stop
