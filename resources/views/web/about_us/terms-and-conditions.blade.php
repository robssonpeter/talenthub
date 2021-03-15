@extends('web.layouts.app')
@section('title')
    {{ __('messages.about_us') }}
@endsection
@section('content')
    <section class="page-header">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h2>{{ __('web.term_and_conditions') }}</h2>
                </div>
            </div>
        </div>
    </section>

    <section class="about-us ptb80">
        <div class="container">
            <div class="row">
                <div class="col-md-12 col-xs-12">
                    <h2 class="text-purple">Terms and Conditions of Website Use</h2>
                    {{--<p class="pt30">{{ getSettingValue('about_us') }}</p>--}}
                    <div class="conditions">
                        {{--<h2>Website Disclaimer and Terms and Conditions of Use</h2>--}}
                        <p>These are Epvate International Consultancy Limited&rsquo;s (Epvate &amp; Fortune International Consulting) (hereafter referred to as &ldquo;EFIC&rdquo; or &ldquo;the Company&rdquo;) Conditions of Website Use. EFIC websites are maintained for the personal use and viewing of users. Access to and use of&nbsp;our website is subject to the following Terms and Conditions.</p>
                        <h3><strong>1. Rights Granted and Main Restrictions</strong></h3>
                        <p><strong>1.1</strong> The access and use of any EFIC website featuring these Terms and Conditions constitutes the user's acceptance of these Terms and Conditions which take effect from the date from which each user first uses&nbsp;our website.<br /> <br /> <strong>1.2</strong> All rights, including copyright, in the content of EFIC web pages are owned or controlled for these purposes by EFIC. Users may download printed copies of the material displayed on an EFIC website for personal use only; provided that each user retains all copyright and trade mark notices and other proprietary notices contained on or in relation to the materials included on that EFIC website. Users may not print, copy, reproduce, download, republish, broadcast, transmit, display, modify or re-use the materials from a EFIC website for any other purpose, including in particular any purpose which publicly re-sells or re-uses the materials.<br /> <br /> <strong>1.3</strong> The trademarks, wordmarks, logos, names, and images displayed on EFIC websites are the registered or unregistered trademarks of EFIC and others. Nothing on an EFIC website should be taken as conferring by implication, estoppel or otherwise any licence or right to use any&nbsp;of the aforementioned&nbsp;marks displayed on such website without the prior written approval of EFIC or such third party as may own the relevant mark.</p>
                        <h3><strong>2. Disclaimer</strong></h3>
                        <p><strong>2.1</strong> EFIC websites and the content, names, text and images included on them are provided 'as is'. While reasonable care has been taken in the preparation of such websites to ensure that the information contained on it is accurate, no warranty or representation of satisfactory quality or fitness for a particular purpose, non-infringement of title, whether express or implied, is given, nor is any warranty or representation given that the information and materials contained on such websites are free from errors or inaccuracy.<br /> <br /> <strong>2.2</strong> Our websites contain guidance and notes on certain aspects of law as they might affect the average person. They are intended only as broad guidance and are by no means definitive. The law is constantly changing, thus expert advice should always be sought.<br /> <br /> <strong>2.3</strong> To the extent permitted by applicable laws, no liability is accepted for any direct, indirect or consequential loss or damage resulting from the access to and use of EFIC websites and the information and materials contained on them.<br /> <br /> <strong>2.4</strong> Links contained within EFIC websites may lead to websites not under the control of EFIC and EFIC is not responsible for the contents of any linked site or any link contained in a linked site. Links provided on EFIC websites are provided to users only as a convenience and the inclusion of any link does not imply endorsement by EFIC of, and EFIC accepts no liability in respect of the content of, any such linked site. Users link to any linked sites at their own risk.</p>
                        <h3><strong>3. Linking</strong></h3>
                        <p>Users shall not be entitled (nor shall they assist others) to set up links from their own websites to any EFIC website (whether by hypertext linking, deep-linking, framing, tagging or otherwise) without the prior written consent of EFIC. The&nbsp;consent of&nbsp;EFIC is at its absolute discretion, and without providing a reason, may grant or withhold.</p>
                        <h3><strong>4. Supply of Information</strong></h3>
                        <p><strong>4.1</strong> Any communication or information (apart from payment transaction information, including credit card particulars) transmitted by a user to a EFIC website by email or otherwise will be treated as non-proprietary and non-confidential. Anything transmitted by any user may be used by EFIC or its affiliates for any purpose, including, without limitation, broadcast, transmission, publication, reproduction, disclosure, posting and any other use whatsoever.<br /> <br /> Although EFIC may from time to time monitor or review discussions, chats, postings, transmissions, bulletin boards and the like on its websites, EFIC is under no obligation to do so and assumes no responsibility or liability arising from the content of any such locations nor for any error, omission, infringement, defamation, obscenity, or inaccuracy contained in any information within such locations on its websites.<br /> <br /> If applicable, users are prohibited from posting or transmitting any unlawful, defamatory, obscene or scandalous material or any material that constitutes or encourages conduct that would be considered a criminal offence, likely to give rise to civil liability, or otherwise violates any law. EFIC will fully cooperate with any law enforcement authorities or court order requesting or directing EFIC to disclose the identity of anyone posting any such information or materials on its websites.<br /> <br /> <strong>4.2</strong> If applicable, EFIC' web server may automatically recognize the domain name and email address (where possible) of users of its websites. EFIC may collect the domain name and email address of visitors to its websites, the email addresses of those who communicate with EFIC via email and aggregate information on the pages users access or visit and information volunteered by the user, such as survey information and/or site registrations.<br /> <br /> <strong>4.3</strong> The information collected by EFIC is used for internal review, used to improve the content of its website, used to customize the content and/or layout of its websites for each individual user, used to notify users about updates to its websites, used by EFIC to contact users for marketing purposes and is not shared with other organizations for commercial purposes.</p>
                        <h3><strong>5. Revision of Terms and Conditions</strong></h3>
                        <p><strong>5.1</strong> EFIC may at any time revise these terms and conditions without notice by posting changes online. Users are responsible for reviewing all information posted online and the continued use of EFIC websites after changes are posted constitutes the user's acceptance of modified terms and conditions.<br /> <br /> <strong>5.2</strong> A user's authorization to use EFIC websites automatically terminates without notice if in EFIC' sole discretion the user fails to comply with any of the terms and conditions. On termination, the user must cease all use of EFIC websites and destroy all and any materials copied directly or indirectly from any such websites.</p>
                        <h3><strong>6. General</strong></h3>
                        <p>These terms and conditions are governed by the laws of the United Republic of Tanzania. If any provision of the foregoing is held to be unlawful, void or for any reason unenforceable, then that provision shall be deemed severable and shall not affect the validity and enforceability of the remaining provisions. EFIC websites are maintained for the personal use and viewing of users. Access to and use of these websites is subject to the terms and conditions of use ('terms and conditions') above.</p>
                    </div>
                </div>
            </div>
            <div class="text-primary">
                <span class="float-right"><a href="{{route('terms.conditions.sale')}}">View Terms and Conditions of Sale Here</a></span>
            </div>
        </div>
    </section>

@endsection
