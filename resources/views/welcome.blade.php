@extends('layout')
@section('seo')
    <title>Finsol | Sampurna Suvidha Kendra</title>
@endsection
@section('content')
    <!-- ============================================-->
    <!-- <section> begin ============================-->
    <section class="overflow-hidden" id="banner" data-bs-theme="light">
        <div class="bg-holder overlay"
            style="background-image:url({{ asset('assets/img/generic/AdobeStock_511533588.jpeg') }});background-position: center bottom;">
        </div>
        <!--/.bg-holder-->
        <div class="container">
            <div class="row flex-center pt-8 pt-lg-10 pb-lg-9 pb-xl-0">
                <div class="col-md-11 col-lg-8 col-xl-4 pb-7 pb-xl-9 text-center text-xl-start">
                    <h1 class="text-white fw-bold">Sampurna Suvidha Kendra</h1>
                    <h1 class="text-white fw-light">Save <span class="typed-text fw-bold"
                            data-typed-text='["Time","Money"]'></span><br />with Finsol</h1>
                    <p class="lead text-white opacity-75">India’s largest tax and financial services software
                        platform specially
                        designed to cater all your financial needs at ease</p><a
                        class="btn btn-outline-light border-2 rounded-pill btn-lg mt-4 fs-0 py-2"
                        href="{{ route('register_page') }}">Register Now<span class="fas fa-play ms-2"
                            data-fa-transform="shrink-6 down-1"></span></a>
                </div>
                <div class="col-xl-7 offset-xl-1 align-self-end mt-4 mt-xl-0">
                </div>
            </div>
        </div><!-- end of .container-->
    </section><!-- <section> close ============================-->
    <!-- ============================================-->

    <!-- ============================================-->
    <!-- <section> begin ============================-->
    <section id="about-us">
        <div class="container">
            <div class="row justify-content-center text-center">
                <div class="col-lg-8 col-xl-7 col-xxl-6">
                    <h1 class="fs-2 fs-sm-4 bluecolor fw-bold fs-md-5">Sampurna Suvidha Kendra</h1>
                    <p class="lead">Finsol is your trusted partner for comprehensive financial and tax services.
                        We understand
                        that managing your finances and navigating the complex world of taxes can be overwhelming.
                        That's why we
                        are here to simplify the process and help you make informed decisions that will secure your
                        financial
                        future.</p>
                </div>
            </div>
            <div class="row flex-center mt-8">
                <div class="col-md col-lg-5 col-xl-4 ps-lg-6"><img class="img-fluid px-6 px-md-0"
                        src="{{ asset('assets/img/icons/spot-illustrations/Asset 1.svg') }}" alt="Asset 1" />
                </div>
                <div class="col-md col-lg-5 col-xl-4 mt-4 mt-md-0">
                    <h5 class="text-danger"><span class="far fa-lightbulb me-2"></span>PLAN</h5>
                    <h3>Tax Planning and Preparation </h3>
                    <p>Our skilled tax experts stay up-to-date with the latest tax laws and regulations to ensure
                        you maximize
                        your deductions and minimize your tax liability. We will work closely with you to develop
                        effective tax
                        strategies that align with your financial goals.</p>
                </div>
            </div>
            <div class="row flex-center mt-7">
                <div class="col-md col-lg-5 col-xl-4 pe-lg-6 order-md-2"><img class="img-fluid px-6 px-md-0"
                        src="{{ asset('assets/img/icons/spot-illustrations/Asset 5.svg') }}" alt="Asset 5" />
                </div>
                <div class="col-md col-lg-5 col-xl-4 mt-4 mt-md-0">
                    <h5 class="text-info"> <span class="far fa-object-ungroup me-2"></span>CONSULT</h5>
                    <h3>Financial and Legal Consulting</h3>
                    <p>We offer comprehensive financial and legal consulting services to help you develop a solid
                        financial
                        plan and legal plan. Our
                        experts will assess your current financial situation, identify areas for improvement, and
                        create a roadmap
                        to achieve your objectives. From budgeting and debt management to investment advice, we are
                        committed to
                        your financial success.</p>
                </div>
            </div>
            <div class="row flex-center mt-7">
                <div class="col-md col-lg-5 col-xl-4 ps-lg-6"><img class="img-fluid px-6 px-md-0"
                        src="{{ asset('assets/img/icons/spot-illustrations/Asset 6.svg') }}" alt="Asset 6" />
                </div>
                <div class="col-md col-lg-5 col-xl-4 mt-4 mt-md-0">
                    <h5 class="text-success"><span class="far fa-paper-plane me-2"></span>RECORDS</h5>
                    <h3>Accounting and Bookkeeping</h3>
                    <p>Maintaining accurate and up-to-date financial records is essential for any business. Our team
                        of skilled
                        accountants will handle your bookkeeping tasks, ensuring that your financial statements are
                        accurate and
                        compliant. We also provide financial analysis to help you make informed decisions and
                        improve your
                        business's financial performance.</p>
                </div>
            </div>
        </div><!-- end of .container-->
    </section><!-- <section> close ============================-->
    <!-- ============================================-->

    <!-- ============================================-->
    <!-- <section> begin ============================-->
    <section class="bg-dark" data-bs-theme="light">
        <div class="bg-holder overlay"
            style="background-image:url({{ asset('assets/img/generic/AdobeStock_555123735.jpeg') }});background-position: center top; filter: brightness(0.5);">
        </div>
        <!--/.bg-holder-->
        <div class="container">
            <div class="row justify-content-center text-center">
                <div class="col-lg-8">
                    <p class="fs-3 fs-sm-4 text-white">Client satisfaction is not just our goal; it's our
                        commitment. We go above and beyond to understand our clients' unique needs, provide
                        personalized solutions, and deliver exceptional service. Our measure of success lies in the
                        satisfaction and success of our clients.</p><a href="{{ route('register_page') }}"><button
                            class="btn btn-outline-light border-2 rounded-pill btn-lg mt-4 fs-0 py-2" type="button">Start
                            your
                            Journey</button></a>
                </div>
            </div>
        </div><!-- end of .container-->
    </section><!-- <section> close ============================-->
    <!-- ============================================-->

    <!-- ============================================-->
    <!-- <section> begin ============================-->
    <section class="bg-light text-center" id="services">
        <div class="container">
            <div class="row">
                <div class="col">
                    <h1 class="fs-2 fw-bold fs-sm-4 fs-md-5">Here's what's in it for you</h1>
                    <p class="lead">Trust us to handle the complexities while you focus on what you do
                        best - running and growing your business.</p>
                </div>
            </div>
            <div class="row mt-6">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body overflow-hidden p-lg-6">
                            <div class="row align-items-center">
                                <div class="col-lg-3"><img class="img-fluid"
                                        src="{{ asset('assets/img/icons/gstfile.svg') }}" alt="gstfile" /></div>
                                <div class="col-lg-9 ps-lg-4 my-5 text-center text-lg-start">
                                    <h3 class="text-primary">Business Registration</h3>
                                    <p class="lead">Starting a new business? Our business registration services
                                        streamline the process,
                                        ensuring that
                                        your business is set up legally and efficiently. We handle all the necessary
                                        paperwork and
                                        registrations, saving you time and providing peace of mind.</p>
                                    <a href="{{ route('register_page') }}"><button class="btn btn-primary me-1 mb-1"
                                            type="button">Register
                                            Now</button></a>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mt-6">
                <div class="col-lg-6">
                    <div class="card">
                        <div class="card-body overflow-hidden p-lg-6">
                            <div class="row align-items-center">
                                <div class="col-lg-3"><img class="img-fluid" src="{{ asset('assets/img/icons/tax.svg') }}"
                                        alt="tax" /></div>
                                <div class="col-lg-9"></div>
                                <div class="col-lg-12 my-2 text-center text-lg-start">
                                    <h3 class="text-primary">GST Filing</h3>
                                    <p class="lead">Goods and Services Tax (GST) compliance can be complex, but
                                        we've got you covered.
                                        Our experts will
                                        ensure accurate and timely filing of your GST returns, helping you navigate
                                        the regulations and
                                        avoid
                                        penalties. Stay compliant with GST and focus on growing your business.</p>
                                    <a href="{{ route('register_page') }}"> <button class="btn btn-primary me-1 mb-1"
                                            type="button">Register
                                            Now</button></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="card">
                        <div class="card-body overflow-hidden p-lg-6">
                            <div class="row align-items-center">
                                <div class="col-lg-3"><img class="img-fluid"
                                        src="{{ asset('assets/img/icons/tax.svg') }}" alt="tax" /></div>
                                <div class="col-lg-9"></div>
                                <div class="col-lg-12 my-2 text-center text-lg-start">
                                    <h3 class="text-primary">Income Tax</h3>
                                    <p class="lead">Tax season can be stressful, but our income tax services make
                                        it hassle-free. Our
                                        knowledgeable
                                        professionals will assist you in preparing and filing your income tax
                                        returns, maximizing your
                                        deductions and minimizing your tax liability. Let us handle your taxes and
                                        enjoy peace of
                                        mind.</p>
                                    <a href="{{ route('register_page') }}"><button class="btn btn-primary me-1 mb-1"
                                            type="button">Register
                                            Now</button></a>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row mt-8">
                <div class="col-lg-4">
                    <div class="card card-span h-100">
                        <div class="card-span-img cardbr"><img class="cardimgwidth"
                                src="{{ asset('assets/img/icons/company.svg') }}" alt="company"></div>
                        <div class="card-body pt-6 pb-4">
                            <h5 class="mb-2 fw-bold">Company Compliances</h5>
                            <p>Staying compliant with company regulations is crucial for maintaining a strong legal
                                standing. Our
                                company compliance services help you meet all the necessary requirements, from
                                annual filings to
                                corporate governance. We'll ensure that your company operates within the legal
                                framework, minimizing
                                risks and ensuring smooth operations.</p>
                            <a href="{{ route('register_page') }}"><button class="btn btn-primary me-1 mb-1"
                                    type="button">Get Started</button></a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 mt-6 mt-lg-0">
                    <div class="card card-span h-100">
                        <div class="card-span-img cardbr"><img class="cardimgwidth"
                                src="{{ asset('assets/img/icons/loan.svg') }}" alt="loan"></div>
                        <div class="card-body pt-6 pb-4">
                            <h5 class="mb-2 fw-bold">Loans and Finance</h5>
                            <p>Securing financing for your business or personal needs can be challenging. Our loan
                                and finance
                                services provide expert guidance and support in finding the right financial
                                solutions for you. From
                                business loans to personal mortgages, we work with you to navigate the lending
                                landscape and secure
                                the funds you need.</p>
                            <a href="{{ route('register_page') }}"> <button class="btn btn-primary me-1 mb-1"
                                    type="button">Get Started</button></a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 mt-6 mt-lg-0">
                    <div class="card card-span h-100">
                        <div class="card-span-img cardbr"><img class="cardimgwidth"
                                src="{{ asset('assets/img/icons/certificate.svg') }}" alt="certificate">
                        </div>
                        <div class="card-body pt-6 pb-4">
                            <h5 class="mb-2 fw-bold">Certifications</h5>
                            <p>Certifications can open doors to new opportunities and enhance your credibility. Our
                                certification
                                services help you obtain the necessary licenses and accreditations to meet industry
                                standards and
                                regulatory requirements. We guide you through the certification process, ensuring
                                your business stands
                                out in the market.</p>
                            <a href="{{ route('register_page') }}"><button class="btn btn-primary me-1 mb-1"
                                    type="button">Get Started</button></a>
                        </div>
                    </div>
                </div>
            </div>
        </div><!-- end of .container-->
    </section><!-- <section> close ============================-->
    <!-- ============================================-->

    <!-- ============================================-->
    <!-- <section> begin ============================-->
    <section class="bg-200 text-center">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-9 col-xl-8">
                    <div class="swiper-container theme-slider"
                        data-swiper='{"autoplay":true,"spaceBetween":5,"loop":true,"loopedSlides":5,"slideToClickedSlide":true}'>
                        <div class="swiper-wrapper">
                            <div class="swiper-slide">
                                <div class="px-5 px-sm-6">
                                    <p class="fs-sm-1 fs-md-2 fst-italic text-dark">Working with Finsol has been a
                                        game-changer for my
                                        financial well-being. Their expertise and personalized approach helped me
                                        develop a comprehensive
                                        financial plan that aligns perfectly with my goals. I highly recommend their
                                        services to anyone
                                        seeking sound financial advice and guidance.</p>
                                    <p class="fs-0 text-600">- Ashwin Kumar - Iscon Enterprises, Pharma</p>
                                </div>
                            </div>
                            <div class="swiper-slide">
                                <div class="px-5 px-sm-6">
                                    <p class="fs-sm-1 fs-md-2 fst-italic text-dark">I was struggling with managing
                                        my debts and didn't
                                        know where to turn for help. Thankfully, I found Finsol. Their debt
                                        management strategies and
                                        practical solutions have been invaluable in helping me regain control of my
                                        finances. I'm truly
                                        grateful for their expertise and support.</p>
                                    <p class="fs-0 text-600">- A K Pathak- Legal Consultancy</p>
                                </div>
                            </div>
                            <div class="swiper-slide">
                                <div class="px-5 px-sm-6">
                                    <p class="fs-sm-1 fs-md-2 fst-italic text-dark">I had the pleasure of working
                                        with Finsol for my
                                        business's financial consulting needs, and I couldn't be happier with the
                                        results. Their deep
                                        understanding of the financial landscape and ability to tailor their advice
                                        to my specific
                                        industry was impressive. They provided actionable insights that have
                                        positively impacted my
                                        business's bottom line.
                                    </p>
                                    <p class="fs-0 text-600">- Avinav, Moletro Films Pvt Ltd, Film Making</p>
                                </div>
                            </div>
                        </div>
                        <div class="swiper-nav">
                            <div class="swiper-button-next swiper-button-white"></div>
                            <div class="swiper-button-prev swiper-button-white"> </div>
                        </div>
                    </div>
                </div>
            </div>
        </div><!-- end of .container-->
    </section><!-- <section> close ============================-->
    <!-- ============================================-->

    <!-- ============================================-->
    <!-- <section> begin ============================-->
    <section class="bg-dark" data-bs-theme="light">
        <div class="bg-holder overlay"
            style="background-image:url({{ asset('assets/img/generic/AdobeStock_587357119.jpeg') }});background-position: center center;">
        </div>
        <!--/.bg-holder-->
        <div class="container">
            <div class="row justify-content-center text-center">
                <div class="col-lg-8">
                    <p class="fs-3 fs-sm-4 text-white">We prioritize client satisfaction and strive to build
                        long-lasting
                        relationships based on trust and integrity.</p><a href="{{ route('register_page') }}"><button
                            class="btn btn-outline-light border-2 rounded-pill btn-lg mt-4 fs-0 py-2" type="button">Start
                            your
                            Journey</button></a>
                </div>
            </div>
        </div><!-- end of .container-->
    </section><!-- <section> close ============================-->
    <!-- ============================================-->

    <!---------FAQ----------------->
    <div class="container" id="faqs">
        <div class="mt-5 mb-3 row justify-content-center text-center">
            <div class="col-lg-8 col-xl-7 col-xxl-6">
                <h1 class="fs-2 fs-sm-4 bluecolor fw-bold fs-md-5">FAQ's</h1>

            </div>
        </div>

        <div class="card mb-5" style=" box-shadow: none; background: #edf2f9;">
            <div class="card-body">
                <div class="accordion border rounded overflow-hidden" id="accordionFaq"
                    style="--falcon-accordion-bg: #edf2f9;">

                    <div class="card shadow-none rounded-bottom-0 border-bottom">
                        <div class="accordion-item border-0">
                            <div class="card-header p-0" id="faqAccordionHeading1"><button
                                    class="accordion-button btn btn-link text-decoration-none d-block w-100 py-2 px-3 collapsed border-0 text-start rounded-0 shadow-none"
                                    data-bs-toggle="collapse" data-bs-target="#collapseFaqAccordion1"
                                    aria-expanded="false" aria-controls="collapseFaqAccordion1"><span
                                        class="fas fa-caret-right accordion-icon me-3"
                                        data-fa-transform="shrink-2"></span><span
                                        class="fw-medium font-sans-serif text-900">How do I get started with
                                        Finsol's services?</span></button></div>
                            <div class="accordion-collapse collapse" id="collapseFaqAccordion1"
                                aria-labelledby="faqAccordionHeading1" data-parent="#accordionFaq">
                                <div class="accordion-body p-0">
                                    <div class="card-body pt-2">
                                        <p class="ps-3 mb-0">To begin using Finsol's financial services, simply
                                            visit our website and click on the "Get Started" button. You will be
                                            guided through the registration process, where you can create an account
                                            and start uploading your documents.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card shadow-none rounded-0 border-bottom">
                        <div class="accordion-item border-0">
                            <div class="card-header p-0" id="faqAccordionHeading2"><button
                                    class="accordion-button btn btn-link text-decoration-none d-block w-100 py-2 px-3 collapsed border-0 text-start rounded-0 shadow-none"
                                    data-bs-toggle="collapse" data-bs-target="#collapseFaqAccordion2"
                                    aria-expanded="false" aria-controls="collapseFaqAccordion2"><span
                                        class="fas fa-caret-right accordion-icon me-3"
                                        data-fa-transform="shrink-2"></span><span
                                        class="fw-medium font-sans-serif text-900">Can I trust Finsol with my
                                        financial information?</span></button></div>
                            <div class="accordion-collapse collapse" id="collapseFaqAccordion2"
                                aria-labelledby="faqAccordionHeading2" data-parent="#accordionFaq">
                                <div class="accordion-body p-0">
                                    <div class="card-body pt-2">
                                        <p class="ps-3 mb-0">Absolutely! Finsol follows strict privacy and
                                            confidentiality protocols to safeguard your information. We adhere to
                                            all applicable laws and regulations to ensure your data remains secure.
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card shadow-none rounded-0 border-bottom">
                        <div class="accordion-item border-0">
                            <div class="card-header p-0" id="faqAccordionHeading3"><button
                                    class="accordion-button btn btn-link text-decoration-none d-block w-100 py-2 px-3 collapsed border-0 text-start rounded-0 shadow-none"
                                    data-bs-toggle="collapse" data-bs-target="#collapseFaqAccordion3"
                                    aria-expanded="false" aria-controls="collapseFaqAccordion3"><span
                                        class="fas fa-caret-right accordion-icon me-3"
                                        data-fa-transform="shrink-2"></span><span
                                        class="fw-medium font-sans-serif text-900">How do I make a payment for the
                                        services I require?</span></button></div>
                            <div class="accordion-collapse collapse" id="collapseFaqAccordion3"
                                aria-labelledby="faqAccordionHeading3" data-parent="#accordionFaq">
                                <div class="accordion-body p-0">
                                    <div class="card-body pt-2">
                                        <p class="ps-3 mb-0">Once you have uploaded your documents and selected the
                                            services you need, you can proceed to the payment section. Finsol offers
                                            a variety of payment methods, including credit/debit cards and online
                                            bank transfers.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card shadow-none rounded-0 ">
                        <div class="accordion-item border-0">
                            <div class="card-header p-0" id="faqAccordionHeading4"><button
                                    class="accordion-button btn btn-link text-decoration-none d-block w-100 py-2 px-3 collapsed border-0 text-start rounded-0 shadow-none"
                                    data-bs-toggle="collapse" data-bs-target="#collapseFaqAccordion4"
                                    aria-expanded="false" aria-controls="collapseFaqAccordion4"><span
                                        class="fas fa-caret-right accordion-icon me-3"
                                        data-fa-transform="shrink-2"></span><span
                                        class="fw-medium font-sans-serif text-900">What if I need assistance during
                                        the registration process or have questions about the
                                        services?</span></button></div>
                            <div class="accordion-collapse collapse" id="collapseFaqAccordion4"
                                aria-labelledby="faqAccordionHeading4" data-parent="#accordionFaq">
                                <div class="accordion-body p-0">
                                    <div class="card-body pt-2">
                                        <p class="ps-3 mb-0">Our customer support team is here to help you every
                                            step of the way. If you have any questions or encounter any issues, feel
                                            free to contact us through our support channels, including email and
                                            phone.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card shadow-none rounded-0 border-bottom">
                        <div class="accordion-item border-0">
                            <div class="card-header p-0" id="faqAccordionHeading3"><button
                                    class="accordion-button btn btn-link text-decoration-none d-block w-100 py-2 px-3 collapsed border-0 text-start rounded-0 shadow-none"
                                    data-bs-toggle="collapse" data-bs-target="#collapseFaqAccordion5"
                                    aria-expanded="false" aria-controls="collapseFaqAccordion5"><span
                                        class="fas fa-caret-right accordion-icon me-3"
                                        data-fa-transform="shrink-2"></span><span
                                        class="fw-medium font-sans-serif text-900">Is Finsol registered and
                                        accredited to provide financial services?</span></button></div>
                            <div class="accordion-collapse collapse" id="collapseFaqAccordion5"
                                aria-labelledby="faqAccordionHeading5" data-parent="#accordionFaq">
                                <div class="accordion-body p-0">
                                    <div class="card-body pt-2">
                                        <p class="ps-3 mb-0">Yes, Finsol is a registered and accredited financial
                                            services provider. We comply with all the necessary regulations and
                                            standards to ensure that you receive reliable and professional
                                            assistance.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card shadow-none rounded-0 border-bottom">
                        <div class="accordion-item border-0">
                            <div class="card-header p-0" id="faqAccordionHeading3"><button
                                    class="accordion-button btn btn-link text-decoration-none d-block w-100 py-2 px-3 collapsed border-0 text-start rounded-0 shadow-none"
                                    data-bs-toggle="collapse" data-bs-target="#collapseFaqAccordion6"
                                    aria-expanded="false" aria-controls="collapseFaqAccordion6"><span
                                        class="fas fa-caret-right accordion-icon me-3"
                                        data-fa-transform="shrink-2"></span><span
                                        class="fw-medium font-sans-serif text-900">Can I track the progress of my
                                        financial services request?</span></button></div>
                            <div class="accordion-collapse collapse" id="collapseFaqAccordion6"
                                aria-labelledby="faqAccordionHeading6" data-parent="#accordionFaq">
                                <div class="accordion-body p-0">
                                    <div class="card-body pt-2">
                                        <p class="ps-3 mb-0">Certainly! Once you have registered and submitted your
                                            documents, you can log in to your account and track the progress of your
                                            request in real-time.

                                            At Finsol, we aim to provide you with seamless financial solutions and
                                            outstanding customer support. If you have any other questions or require
                                            further information, please don't hesitate to reach out to us.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <!---------FAQ close----------->
@endsection
