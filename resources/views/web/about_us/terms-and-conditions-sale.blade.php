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
                    <h2 class="text-purple">Terms and Conditions of Sale</h2>
                    {{--<p class="pt30">{{ getSettingValue('about_us') }}</p>--}}
                    <div class="conditions">
                        <div class="code-block code-block-9" style="margin: 8px auto; text-align: center; display: block; clear: both;">
                            <h3 style="text-align: left;"><strong>1. These Terms</strong></h3>
                            <p style="text-align: left;"><strong>1.1 What these terms cover.</strong>&nbsp;These are the terms and conditions on which we supply products to you, whether these are goods, services or digital content.</p>
                            <p style="text-align: left;"><strong>1.2 Other applicable terms.</strong>&nbsp;In addition to these terms, the following additional terms also govern our supply of products to you:</p>
                            <ul style="text-align: left;">
                                <li>Our&nbsp;<u>Website Terms of Use</u>.</li>
                            </ul>
                            <p style="text-align: left;"><strong>1.3 Why you should read them.</strong>&nbsp;Please read these terms carefully before you submit your order to us. These terms tell you who we are, how we will provide products to you, how you and we may change or end the contract, what to do if there is a problem and other important information. If you think that there is a mistake in these terms, please contact us to discuss.</p>
                            <h3 style="text-align: left;"><strong>2. Information About Us and How to Contact Us</strong></h3>
                            <p style="text-align: left;"><strong>2.1 Who we are.</strong>&nbsp;We are Epvate International Consultancy Limited a company registered in Tanzania. Our company registration number is 137553 and our registered office is at 9<sup>th</sup> Floor, PSSSF Commercial Complez, Sam Nujoma Rd, Dar es Salaam, Tanzania. Our TIN is 135-704-903 and VAT Registration number is 40-032717-W.</p>
                            <p style="text-align: left;"><strong>2.2 How to contact us.</strong>&nbsp;You can contact us via&nbsp;<u>info@epvate-fortune.com</u></p>
                            <p style="text-align: left;"><strong>2.3 How we may contact you.</strong>&nbsp;If we have to contact you we will do so by telephone or by writing to you at the email address or postal address you provided to us in your order.</p>
                            <p style="text-align: left;"><strong>2.4 "Writing" includes emails.</strong>&nbsp;When we use the words "writing" or "written" in these terms, this includes emails.</p>
                            <h3 style="text-align: left;"><strong>3. Our Contract With You</strong></h3>
                            <p style="text-align: left;"><strong>3.1 How we will accept your order.</strong>&nbsp;Our acceptance of your order will take place when we email you to confirm it, at which point a contract will come into existence between you and us.</p>
                            <p style="text-align: left;"><strong>3.2 If we cannot fulfil your order.</strong>&nbsp;If we are unable to fulfil your order, we will inform you of this in writing and provide you with a refund of the sums paid. This might be because the product is out of stock, because of unexpected limits on our resources which we could not reasonably plan for or because we have identified an error in the price or description of the product.</p>
                            <p style="text-align: left;"><strong>3.3 Your order number.</strong>&nbsp;We will assign an order number to your order and tell you what it is when we accept your order. It will help us if you can tell us the order number whenever you contact us about your order.</p>
                            <p style="text-align: left;"><strong>3.4</strong> <strong>Subscriptions.</strong> All Epvate &amp; Fortune created employer accounts will be assigned a trial subscription. After subscribing to a plan, the service is billed in advance on a monthly or annual basis and is non-refundable; no refunds will be issued. Epvate Fortune does not offer prorated refunds for canceled subscription plans. There will be no refunds or credits for partial months of service, upgrade/downgrade refunds, or refunds for months unused with an open account. In order to treat everyone equally, no exceptions will be made. All subscriptions, both month-to-month and annual plans, are recurring and will automatically renew after the end of each paid subscription period.</p>
                            <h3 style="text-align: left;"><strong>4. Our Products</strong></h3>
                            <p style="text-align: left;"><strong>4.1 Products may vary slightly from their pictures.</strong>&nbsp;The images of the products on our website are for illustrative purposes only. Although we have made every effort to display the colours accurately, we cannot guarantee that a device's display of the colours accurately reflects the colour of the products. Your product may vary slightly from those images.</p>
                            <p style="text-align: left;"><strong>4.2 Product packaging may vary.</strong>&nbsp;The packaging of the product may vary from that shown on images on our website.</p>
                            <h3 style="text-align: left;"><strong>5. Your Rights to Make Changes</strong></h3>
                            <p style="text-align: left;">If you wish to make a change to the product you have ordered please contact us. We will let you know if the change is possible. If it is possible we will let you know about any changes to the price of the product, the timing of supply or anything else which would be necessary as a result of your requested change and ask you to confirm whether you wish to go ahead with the change.</p>
                            <h3 style="text-align: left;"><strong>6. Our Rights to Make Changes</strong></h3>
                            <p style="text-align: left;"><strong>6.1 Minor changes to the products.</strong>&nbsp;We may change any of our products or these terms:</p>
                            <ol style="text-align: left;">
                                <li>to reflect changes in relevant laws and regulatory requirements; and</li>
                                <li>to implement minor technical adjustments and improvements, for example to address a security threat. We will inform of these changes when they are made and let know the extent, if any, to which any such changes may affect your use of the relevant product.</li>
                            </ol>
                            <p style="text-align: left;"><strong>6.2 More significant changes to the products and these terms.</strong>&nbsp;In addition, we may make significant changes to these terms or our products, but if we do so we will notify you and you may then contact us to end the contract.</p>
                            <p style="text-align: left;"><strong>6.3 Updates to digital content.</strong>&nbsp;We may update or require you to update digital content, provided that the digital content shall, in all material respects, always match the description of it that we provided to you before you bought it.</p>
                            <h3 style="text-align: left;"><strong>7. Providing the Products</strong></h3>
                            <p style="text-align: left;"><strong>7.1 Delivery costs and estimates.</strong>&nbsp;The costs of delivery will be as displayed to you on our website. Delivery estimates on our website are for your guidance only. They are not guaranteed and should not be relied upon as such.</p>
                            <p style="text-align: left;"><strong>7.2 When we will provide the products.</strong></p>
                            <ol style="text-align: left;">
                                <li><strong>If the products are goods.</strong>Delivery of all goods is fulfilled by us in 30 days within Tanzania and in 90 days outside Tanzania<br /> &nbsp;</li>
                                <li><strong>If the product is a one-off purchase of digital content.</strong>We will make the digital content available for download by you as soon as we accept your order.&nbsp;<strong>You expressly accept that, at the time of purchase we start providing you with this content, and that you cannot cancel it once delivery has started.</strong></li>
                                <li><strong>If the products are ongoing services or a subscription to receive goods or digital content.</strong>We will supply the services, goods or digital content to you until either the services are completed or the subscription expires (if applicable) or you end the contract as described in clause 8 or we end the contract by written notice to you as described in clause 10.<br /> <br /> <strong>Membership:</strong>&nbsp;When you purchase a Membership,&nbsp;<strong>you provide your explicit consent to the immediate commencement of the provision of that service by us, which allows you to directly access the service. You acknowledge that in doing so, you lose your right to cancel as set out in clause 8 below, but this does not affect your right to cancel the service at any time.</strong></li>
                            </ol>
                            <p style="text-align: left;"><strong>7.3 We are not responsible for delays outside our control.</strong>&nbsp;If our supply of the products is delayed by an event outside our control then we will contact you as soon as possible to let you know and we will take steps to minimize the effect of the delay. Provided we do this we will not be liable for delays caused by the event, but if there is a risk of substantial delay you may contact us to end the contract and receive a refund for any products you have paid for but not received.</p>
                            <p style="text-align: left;"><strong>7.4 When you become responsible for the product.</strong>&nbsp;The product will be your responsibility from the time we deliver the product to the address you gave us.</p>
                            <p style="text-align: left;"><strong>7.5 When you own goods.</strong>&nbsp;You own a product which is goods once we have received payment in full.</p>
                            <p style="text-align: left;"><strong>7.6 What will happen if you do not give required information to us.</strong>&nbsp;We may need certain information from you so that we can supply the products to you, for example, the address to which you would the goods delivered. If so, this will have been stated in the description of the products on our website. We will contact you in writing to ask for this information. If you do not give us this information within a reasonable time of us asking for it, or if you give us incomplete or incorrect information, we may either end the contract (and clause 10.2 will apply) or make an additional charge of a reasonable sum to compensate us for any extra work that is required as a result. We will not be responsible for supplying the products late or not supplying any part of them if this is caused by you not giving us the information we need within a reasonable time of us asking for it.</p>
                            <p style="text-align: left;"><strong>7.7 Reasons we may suspend the supply of products to you.</strong>&nbsp;We may have to suspend the supply of a product to:</p>
                            <ol style="text-align: left;">
                                <li>deal with technical problems or make minor technical changes;</li>
                                <li>update the product to reflect changes in relevant laws and regulatory requirements;</li>
                                <li>make changes to the product as notified by us to you (see clause 6).</li>
                            </ol>
                            <p style="text-align: left;"><strong>7.8 Your rights if we suspend the supply of products.</strong>&nbsp;We will contact you in advance to tell you we will be suspending supply of a product, unless the problem is urgent or an emergency. If we have to suspend a product for longer than 30 days in any calendar year we may adjust the price so that you do not pay for products while they are suspended. You may contact us to end the contract for a product if we suspend it, or tell you we are going to suspend it, in each case for a period of more than 30 days and we will refund any sums you have paid in advance for the product in respect of the period after you end the contract&nbsp;<strong>unless the product is either digital content or a Membership subscription.</strong></p>
                            <p style="text-align: left;"><strong>7.9 We may also suspend supply of the products if you do not pay.</strong>&nbsp;If you do not pay us for the products when you are supposed to (see clause 12.4) and you still do not make payment within 7 days of us reminding you that payment is due, we may suspend supply of the products until you have paid us the outstanding amounts. We will contact you to tell you we are suspending supply of the products. We will not suspend the products where you dispute the unpaid invoice (see clause 12.6). As well as suspending the products we can also charge you interest on your overdue payments (see clause 12.5).</p>
                            <h3 style="text-align: left;"><strong>8. Your Rights to End the Contract</strong></h3>
                            <p style="text-align: left;"><strong>8.1 You can always end your contract with us.</strong>&nbsp;Your rights when you end the contract will depend on what you have bought, whether there is anything wrong with it, how we are performing and when you decide to end the contract:</p>
                            <ol style="text-align: left;">
                                <li><strong>If what you have bought is faulty or mis-described you may have a legal right to end the contract</strong>(or to get the product repaired or replaced or a service re-performed or to get some or all of your money back),&nbsp;<strong>see clause 11</strong>;</li>
                                <li><strong>If you want to end the contract because of something we have done or have told you we are going to do, see clause 8.2;</strong></li>
                                <li><strong>If you have just changed your mind about the product, see clause 8.3.&nbsp;</strong>You may be able to get a refund if you are within the cooling-off period, but this may be subject to deductions and you will have to pay the costs of return of any goods;</li>
                                <li><strong>In all other cases (if we are not at fault and there is no right to change your mind), see clause 8.6.</strong></li>
                            </ol>
                            <p style="text-align: left;"><strong>8.2 Ending the contract because of something we have done or are going to do.</strong>&nbsp;If you are ending a contract for a reason set out at (a) to (e) below the contract will end immediately and we will refund you in full for any products which have not been provided. The reasons are:</p>
                            <ol style="text-align: left;" start="6">
                                <li>we have told you about an upcoming change to the product or these terms which you do not agree to (see clause 6.2);</li>
                                <li>we have told you about an error in the price or description of the product you have ordered and you do not wish to proceed;</li>
                                <li>there is a risk that supply of the products may be significantly delayed because of events outside our control;</li>
                                <li>we have suspended supply of the products for technical reasons, or notify you we are going to suspend them for technical reasons, in each case for a period of more than 30 days; or</li>
                                <li>you have a legal right to end the contract because of something we have done wrong.</li>
                            </ol>
                            <p style="text-align: left;"><strong>8.3 Exercising your right to change your mind <br /> </strong>For most products bought online you have a legal right to change your mind within 14 days and receive a refund.</p>
                            <p style="text-align: left;"><strong>8.4 When you don't have the right to change your mind.</strong>&nbsp;You do not have a right to change your mind in respect of:</p>
                            <ol style="text-align: left;">
                                <li><strong>Membership;</strong></li>
                                <li>digital products after we have made these available to you to download or stream;</li>
                                <li>services, once these have been completed, even if the cancellation period is still running;</li>
                                <li>sealed audio or sealed video recordings or sealed computer software, once these products are unsealed after you receive them; and</li>
                                <li>any products which become mixed inseparably with other items after their delivery.</li>
                            </ol>
                            <p style="text-align: left;"><strong>8.5 How long do I have to change my mind?</strong>&nbsp;How long you have depends on what you have ordered and how it is delivered.</p>
                            <ol style="text-align: left;">
                                <li><strong>Have you bought ongoing services (for example, Membership)?</strong><br /> If so,&nbsp;<strong>you provide your explicit consent to the immediate commencement of the provision of that service by us, which allows you to directly access the service. You acknowledge that in doing so, you lose your right to cancel as set out in clause 8 below, but this does not affect your right to cancel the service at any time.</strong></li>
                                <li><strong>Have you bought digital content for download or streaming (for example, an e-book)?</strong>if so,&nbsp;<strong>we delivered the digital content to you immediately, and you agreed to this when ordering, you will not have a right to change your mind.</strong></li>
                                <li><strong>Have you bought goods (for example, one of our publications in a physical format)?</strong>, if so you have 14 days after the day you (or someone you nominate) receives the goods,&nbsp;<strong>unless:</strong>
                                    <ul>
                                        <li><strong>Your goods are split into several deliveries over different days.</strong>In this case you have until 14 days after the day you (or someone you nominate) receives the last delivery to change your mind about the goods.</li>
                                    </ul>
                                </li>
                            </ol>
                            <p style="text-align: left;"><strong>8.6 Ending the contract where we are not at fault and there is no right to change your mind.</strong>&nbsp;If you do not have any other rights to end the contract (see clause 8.1), you can still contact us before it is completed and tell us you want to end it. If you do this the contract will end immediately and we will refund any sums paid by you for products not provided but we may deduct from that refund reasonable compensation for the net costs we will incur as a result of your ending the contract.&nbsp;<strong>Please note this does not apply if you have purchased digital content or an Membership subscription.</strong></p>
                            <h3 style="text-align: left;"><strong>9. How to End the Contract with Us (including if you have changed your mind)</strong></h3>
                            <p style="text-align: left;"><strong>9.1 Tell us you want to end the contract.</strong>&nbsp;To end the contract with us, please let us know by&nbsp;<a href="https://epvate-fortune.com/contact-us/">contacting us</a>, confirming which goods/service you wish to cancel, the date you ordered/received said goods/service, and your name and address. If you would prefer to confirm you wish to cancel in writing, please write to&nbsp;Epvate &amp; Fortune International Consulting, P. O. Box 1235, Dar es Salaam, confirming the above details as well as signing and dating the document.</p>
                            <p style="text-align: left;"><strong>9.2 Returning products after ending the contract.</strong>&nbsp;If you end the contract for any reason after products have been dispatched to you or you have received them, you must return them to us. You must post them back to us or (if they are not suitable for posting) allow us to collect them from you. Please&nbsp;<a href="https://epvate-fortune.com/contact-us/">contact us</a>&nbsp;for a return label or to arrange collection. If you are exercising your right to change your mind you must send off the goods within 14 days of telling us you wish to end the contract.</p>
                            <p style="text-align: left;"><strong>9.3 When we will pay the costs of return.</strong>&nbsp;We will pay the costs of return:</p>
                            <ol style="text-align: left;">
                                <li>if the products are faulty or incorrectly described; or</li>
                                <li>if you are ending the contract because we have told you of an upcoming change to the product or these terms, an error in pricing or description, a delay in delivery due to events outside our control or because you have a legal right to do so as a result of something we have done wrong.<br /> <br /> <strong>In all other circumstances (including where you are exercising your right to change your mind) you must pay the costs of return.</strong></li>
                            </ol>
                            <p style="text-align: left;"><strong>9.4 What we charge for collection.</strong>&nbsp;If you are responsible for the costs of return and we are collecting the product from you, we will charge you the direct cost to us of collection. The costs of collection will be the same as our charges for standard delivery.</p>
                            <p style="text-align: left;"><strong>9.5 How we will refund you.</strong>&nbsp;We will refund you the price you paid for the products including delivery costs, by the method you used for payment. However, we may make deductions from the price, as described below.</p>
                            <p style="text-align: left;"><strong>9.6 Deductions from refunds.</strong>&nbsp;If you are exercising your right to change your mind we may reduce your refund of the price (excluding delivery costs) to reflect any reduction in the value of the goods, if this has been caused by your handling them in a way which would not be permitted in a shop. If we refund you the price paid before we are able to inspect the goods and later discover you have handled them in an unacceptable way, you must pay us an appropriate amount.</p>
                            <p style="text-align: left;"><strong>9.7 When your refund will be made.&nbsp;</strong>We will make any refunds due to you as soon as possible. If you are exercising your right to change your mind then:</p>
                            <ol style="text-align: left;" start="9">
                                <li>If the products are goods and we have not offered to collect them, your refund will be made within 14 days from the day on which we receive the product back from you or, if earlier, the day on which you provide us with evidence that you have sent the product back to us. For information about how to return a product to us, see clause 9.2.</li>
                                <li>In all other cases, your refund will be made within 14 days of your telling us you have changed your mind.</li>
                            </ol>
                            <h3 style="text-align: left;"><strong>10. Our Rights to End the Contract</strong></h3>
                            <p style="text-align: left;"><strong>10.1 We may end the contract if you break it.</strong>&nbsp;We may end the contract for a product at any time by writing to you if:</p>
                            <ol style="text-align: left;">
                                <li>you do not make any payment to us when it is due and you still do not make payment within 7 days of us reminding you that payment is due;</li>
                                <li>you do not, within a reasonable time of us asking for it, provide us with information that is necessary for us to provide the products, for example, the correct address for delivery; or</li>
                                <li>you do not, within a reasonable time, allow us to deliver the products to you or collect them from us.</li>
                            </ol>
                            <p style="text-align: left;"><strong>10.2 You must compensate us if you break the contract.</strong>&nbsp;If we end the contract in the situations set out in clause 10.1 we will refund any money you have paid in advance for products we have not provided but we may deduct reasonable compensation for the net costs we will incur as a result of your breaking the contract.</p>
                            <ol style="text-align: left;" start="11">
                                <li>If There is a Problem with the Product</li>
                            </ol>
                            <h3 style="text-align: left;"><strong>11.1 How to tell us about problems.&nbsp;</strong></h3>
                            <p style="text-align: left;">If you have any questions or complaints about the product, please&nbsp;<a href="https://epvate-fortune.com/contact-us/">contact us</a>&nbsp;via our online form or alternatively via email at&nbsp;<a href="mailto:info@epvate-fortune.com">info@epvate-fortune.com</a></p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="text-primary">
                <span class="float-right"><a href="">View Terms and Conditions of Sale Here</a></span>
            </div>
        </div>
    </section>

@endsection
