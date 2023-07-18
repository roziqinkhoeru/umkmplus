@extends('user.layout.app')
@section('content')
    <main>
        {{-- header area start --}}
        <section class="pt-60 pb-50" style="background: #3083FF;">
            <div class="container">
                <div class="d-sm-flex align-items-sm-center">
                    <div class="mb-sm-22 me-sm-4">
                        <figure class="image-header-category-wrapper">
                            <img src="{{ asset('assets/img/decoration/terms-clock.png') }}" alt="faq">
                        </figure>
                    </div>
                    <div class="">
                        <h3 class="text-white text-4xl">Syarat dan Ketentuan</h3>
                        <p class="fw-medium text-base mb-0" style="color: #ffffffc5">#PembelajaranAman</p>
                    </div>
                </div>
            </div>
        </section>
        {{-- header area end --}}

        {{-- terms area start --}}
        <section class="cart-area pt-65 pb-70">
            <div class="container">
                <div class="row">
                    <div class="col-12 col-sm-10 mx-auto">
                        <div class="text-justify">
                            <p class="text-base fst-italic mb-25">Effective date: September 01, 2021</p>
                            <p class="text-base mb-35">At UMKMPlus, we understand the importance of privacy and are
                                committed to
                                protecting our users' personal information. This Privacy Policy outlines how we collect,
                                use, disclose, and safeguard your information when you access our website or use our
                                services. By using UMKMPlus, you consent to the practices described in this Privacy Policy.
                            </p>
                            <div class="mb-30">
                                <h4 class="mb-20">1. Information We Collect</h4>
                                <div class="ms-4">
                                    <h5 class="text-lg mb-15">1.1 Personal Information:</h5>
                                    <p class="text-base mb-25">We may collect personal information that you voluntarily
                                        provide to us when you register for an account, subscribe to our services, or
                                        communicate with us. This may include your name, email address, contact number,
                                        company name, and any other information you provide during the registration or
                                        usage process.</p>
                                    <h5 class="text-lg mb-15">1.2 Payment Information:</h5>
                                    <p class="text-base mb-25">If you make a payment for our services, we may collect
                                        certain payment information, such as your credit card or other payment method
                                        details. However, we do not store this payment information on our servers. We
                                        utilize reputable third-party payment processors who handle all payment
                                        transactions securely.</p>
                                    <h5 class="text-lg mb-15">1.3 Log Data and Analytics:</h5>
                                    <p class="text-base mb-25">When you access UMKMPlus, we may collect certain
                                        information automatically, including your IP address, browser type, device type,
                                        operating system, and other technical information. We may also gather data about
                                        your usage patterns, preferences, and interactions with our website to improve
                                        our services and provide a better user experience.</p>
                                </div>
                            </div>
                            <div class="mb-30">
                                <h4 class="mb-20">2. Use of Collected Information</h4>
                                <div class="ms-4">
                                    <h5 class="text-lg mb-15">2.1 Provision of Services:</h5>
                                    <p class="text-base mb-25">We may use the information we collect to provide and improve
                                        our services, respond to your inquiries, fulfill your requests, process payments,
                                        and deliver educational content that matches your interests and needs.</p>
                                    <h5 class="text-lg mb-15">2.2 Communication:</h5>
                                    <p class="text-base mb-25">We may use your contact information to send you important
                                        updates, notifications, newsletters, marketing materials, and other relevant
                                        information related to UMKMPlus. You can opt out of receiving these communications
                                        at any time by following the instructions provided in the communication.</p>
                                    <h5 class="text-lg mb-15">2.3 Aggregated Data:</h5>
                                    <p class="text-base mb-25">We may use aggregated and anonymized data for statistical and
                                        research purposes to analyze trends, measure the effectiveness of our services, and
                                        develop new features and functionalities.
                                    </p>
                                </div>
                            </div>
                            <div class="mb-30">
                                <h4 class="mb-20">3. Information Sharing and Disclosure</h4>
                                <div class="ms-4">
                                    <h5 class="text-lg mb-15">3.1 Service Providers:</h5>
                                    <p class="text-base mb-25">We may engage trusted third-party service providers to assist
                                        us in operating our website, analyzing data, processing payments, or providing other
                                        essential services. These providers have access to your information but are
                                        obligated to maintain its confidentiality and use it solely to provide the requested
                                        services.</p>
                                    <h5 class="text-lg mb-15">3.2 Legal Compliance:</h5>
                                    <p class="text-base mb-25">We may disclose your information if required by law,
                                        regulation, legal process, or governmental request. We may also disclose information
                                        to protect the rights, property, or safety of UMKMPlus, its users, or others.</p>
                                </div>
                            </div>
                            <div class="mb-30">
                                <h4 class="mb-20">4. Data Security</h4>
                                <p class="text-base mb-25">We take appropriate technical and organizational measures to
                                    protect your information from unauthorized access, loss, misuse, or alteration.
                                    However, please note that no method of transmission over the Internet or electronic
                                    storage is completely secure. While we strive to protect your personal information,
                                    we cannot guarantee its absolute security.</p>
                            </div>
                            <div class="mb-30">
                                <h4 class="mb-20">5. Third-Party Links</h4>
                                <p class="text-base mb-25">UMKMPlus may contain links to third-party websites, applications,
                                    or services that we do not control or operate. We are not responsible for these
                                    third-party platforms' privacy practices or content. We encourage you to review their
                                    privacy policies before providing any personal information.
                                </p>
                            </div>
                            <div class="mb-30">
                                <h4 class="mb-20">6. Children's Privacy</h4>
                                <p class="text-base mb-25">UMKMPlus is not intended for children under the age of 13. We do
                                    not knowingly collect personal information from children. If you believe we have
                                    inadvertently collected personal information from a child, please contact us
                                    immediately, and we will take steps to delete it.
                                </p>
                            </div>
                            <div class="mb-30">
                                <h4 class="mb-20">7. Changes to the Privacy Policy</h4>
                                <p class="text-base mb-25">We may update this Privacy Policy from time to time to reflect
                                    changes in our practices or legal requirements. We will notify you of any material
                                    changes by posting the updated Privacy Policy on our website or through other
                                    communication channels. We encourage you to review this Privacy Policy periodically for
                                    the latest information on our privacy practices.
                                </p>
                            </div>
                            <div class="mb-30">
                                <h4 class="mb-20">8. User Rights</h4>
                                <div class="ms-4">
                                    <h5 class="text-lg mb-15">8.1 Access and Update:</h5>
                                    <p class="text-base mb-25">You have the right to access and update your personal
                                        information stored in your UMKMPlus account. You can review and modify your account
                                        details by logging into your account settings. Please ensure that your information
                                        is accurate and up to date.</p>
                                    <h5 class="text-lg mb-15">8.2 Data Retention:</h5>
                                    <p class="text-base mb-25">We retain your personal information for as long as necessary
                                        to fulfill the purposes outlined in this Privacy Policy, unless a longer retention
                                        period is required or permitted by law. If you wish to request the deletion of your
                                        personal information, please contact us using the information provided in Section 7.
                                    </p>
                                    <h5 class="text-lg mb-15">8.3 Consent Withdrawal:</h5>
                                    <p class="text-base mb-25">You have the right to withdraw your consent to the processing
                                        of your personal information at any time. To withdraw your consent or opt out of
                                        specific data processing activities (such as receiving marketing communications),
                                        please follow the instructions provided in the applicable communication or contact
                                        us using the information provided in Section 7.</p>
                                </div>
                            </div>
                            <div class="mb-30">
                                <h4 class="mb-20">9. Cookies and Tracking Technologies</h4>
                                <div class="ms-4">
                                    <h5 class="text-lg mb-15">9.1 Cookies:</h5>
                                    <p class="text-base mb-25">UMKMPlus uses cookies and similar tracking technologies to
                                        enhance your browsing experience and gather information about how you interact with
                                        our website. These technologies may collect information such as your IP address,
                                        browser type, operating system, and browsing behavior. You can manage your cookie
                                        preferences through your browser settings or using the options provided on our
                                        website.</p>
                                    <h5 class="text-lg mb-15">9.2 Third-Party Analytics:</h5>
                                    <p class="text-base mb-25">We may use third-party analytics services to collect and
                                        analyze information about the usage of UMKMPlus. These services may use cookies, web
                                        beacons, and other tracking technologies to collect data and generate reports. The
                                        information generated by these services is used to evaluate website usage, compile
                                        statistical reports, and improve our services.
                                    </p>
                                </div>
                            </div>
                            <div class="mb-30">
                                <h4 class="mb-20">10. International Data Transfers</h4>
                                <p class="text-base mb-25">UMKMPlus is primarily operated and managed in Indonesia. If you
                                    are accessing UMKMPlus from outside Indonesia or providing personal information to us
                                    from outside Indonesia, please be aware that your information may be transferred to,
                                    stored in, and processed in Indonesia. By using UMKMPlus and providing your information,
                                    you consent to the transfer, storage, and processing of your information in Indonesia.
                                </p>
                            </div>
                            <div class="mb-30">
                                <h4 class="mb-20">11. Changes to the Privacy Policy</h4>
                                <p class="text-base mb-25">We reserve the right to modify or update this Privacy Policy at
                                    any time to reflect changes in our practices, legal requirements, or industry standards.
                                    We will notify you of any material changes by posting the updated Privacy Policy on our
                                    website or through other communication channels. Your continued use of UMKMPlus after
                                    the effective date of any revised Privacy Policy constitutes your acceptance of the
                                    revised policy.
                                </p>
                            </div>
                            <div class="mb-30">
                                <h4 class="mb-20">12. Governing Law and Dispute Resolution</h4>
                                <p class="text-base mb-25">This Privacy Policy is governed by and construed following the
                                    laws of Indonesia. Any disputes arising from or related to this Privacy Policy shall be
                                    subject to the exclusive jurisdiction of the courts located in Indonesia.
                                </p>
                            </div>
                            <div class="mb-30">
                                <h4 class="mb-20">13. Severability</h4>
                                <p class="text-base mb-25">If any provision of this Privacy Policy is found to be invalid,
                                    illegal, or unenforceable, the remaining provisions shall continue in full force and
                                    effect.
                                </p>
                            </div>
                            <div class="mb-30">
                                <h4 class="mb-20">14. Contact Us</h4>
                                <p class="text-base mb-25">If you have any questions, concerns, or requests regarding this
                                    Privacy Policy or the handling of your personal information, please contact us at
                                    <a class="btn-anchor" href="mailto:info@umkmplus.site">info@umkmplus.site</a>. We will
                                    make reasonable
                                    efforts to address
                                    your inquiries and
                                    resolve
                                    any issues.
                                </p>
                            </div>
                            <p class="mb-20 text-base">By using UMKMPlus, you acknowledge that you have read, understood,
                                and agree
                                to be bound by this Privacy Policy.</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        {{-- terms area end --}}
    </main>
@endsection
@section('script')
    <script></script>
@endsection
