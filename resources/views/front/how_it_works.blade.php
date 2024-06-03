@extends('front.layout.layout')
@section('content')

    <section class="ly-page-top-section home-banner company-work" style="background-image: url('{{ asset('front/images/banners/banner.png') }}');">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="page-content-wrapper">
                      
                        <h1>How The Company Works</h1>
                        <p>Unlock exclusive savings with our premium discount membership platform today!</p>
                       
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="more-about" style="margin-top: 40px;">
        <div class="container">
            <div class="row">
                <div class="col-lg-4">
                    <div class="snet-started-company-box">
                      
                        <h4>Get login into the BODE</h4>
                        <p>Create your account and add basic details</p>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="snet-started-company-box">
                       
                        <h4>Buy or Post Listing</h4>
                        <p>You can buy a listing or create one on the basis of the role selected </p>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="snet-started-company-box remove-arrow">
                      
                        <h4>Resell Listing</h4>
                        <p>Once bought, you can resell your listing again.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="ly-works-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="work-process-content">
                        <h3>How does it work</h3>
                        <!--<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>-->
                        <div class="work-steps-box">
                            <div class="step-counter">
                                <span>1</span>
                            </div>
                            <div class="step-meta">
                                <h6>Sign Up as a Business Entity or Buyer/Reseller</h6>
                                <p>Join our platform by registering either as a business entity or a buyer/reseller.</p>
                            </div>
                        </div>
                        <div class="work-steps-box">
                            <div class="step-counter">
                                <span>2</span>
                            </div>
                            <div class="step-meta">
                                <h6>Upload Discounts and Promote Your Business to Boost Sales</h6>
                                <p>Share your exclusive discounts and promotions to enhance your business visibility and drive sales.</p>
                            </div>
                        </div>
                        <div class="work-steps-box">
                            <div class="step-counter">
                                <span>3</span>
                            </div>
                            <div class="step-meta">
                                <h6>Enjoy Discounts/Memberships</h6>
                                <p>Benefit from exclusive discounts and membership perks tailored to your business needs.</p>
                            </div>
                        </div>
                        <div class="work-steps-box">
                            <div class="step-counter">
                                <span>4</span>
                            </div>
                            <div class="step-meta">
                                <h6>Resell and Recoup Your Investment</h6>
                                <p>Utilize our platform to resell products and services, enabling you to regain your investment and maximize profitability</p>
                            </div>
                        </div>
                        <button class="ly-button-1">Get Started <span class="iconify" data-icon="tabler:chevron-right"></span></button>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="work-img-box">
                        <img src="{{asset('front/images/banners/work-2.png')}}" alt="main-img">
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="ly-works-section">
        <div class="container">
            <div class="row">

                <div class="col-lg-6">
                    <div class="work-img-box">
                        <img src="{{asset('front/images/banners/work-1.png')}}" alt="main-img">
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="work-process-content">
                        <h3>Business Entity Benefits</h3>
                        <!--<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>-->
                        <div class="work-steps-box">
                            <div class="step-counter">
                                <span>1</span>
                            </div>
                            <div class="step-meta">
                                <h6>Increased Exposure</h6>
                                <p>Reach a wider audience by showcasing your discounts and memberships on our platform, expanding your brand visibility and customer base</p>
                            </div>
                        </div>
                        <div class="work-steps-box">
                            <div class="step-counter">
                                <span>2</span>
                            </div>
                            <div class="step-meta">
                                <h6>Targeted Marketing</h6>
                                <p>Connect with customers who are actively seeking deals and memberships, allowing you to tailor your offerings to a receptive audience</p>
                            </div>
                        </div>
                        <div class="work-steps-box">
                            <div class="step-counter">
                                <span>3</span>
                            </div>
                            <div class="step-meta">
                                <h6>Boosted Sales</h6>
                                <p>Drive sales through incentivized purchases, as customers are drawn to exclusive discounts and membership perks offered through our platform</p>
                            </div>
                        </div>
                        <div class="work-steps-box">
                            <div class="step-counter">
                                <span>4</span>
                            </div>
                            <div class="step-meta">
                                <h6>Enhanced Brand Reputation</h6>
                                <p>Position your brand as customer-friendly and value-driven by providing attractive discounts and membership options, fostering positive perceptions among consumers</p>
                            </div>
                        </div>
                        <!--<div class="work-steps-box">-->
                        <!--    <div class="step-counter">-->
                        <!--        <span>5</span>-->
                        <!--    </div>-->
                        <!--    <div class="step-meta">-->
                        <!--        <h6>Streamlined Marketing Efforts</h6>-->
                        <!--        <p>Leverage our platform's marketing tools and resources to efficiently promote your discounts and memberships, saving you time and resources on advertising campaigns</p>-->
                        <!--    </div>-->
                        <!--</div>-->
                        <!--<div class="work-steps-box">-->
                        <!--    <div class="step-counter">-->
                        <!--        <span>6</span>-->
                        <!--    </div>-->
                        <!--    <div class="step-meta">-->
                        <!--        <h6>Additional Revenue Streams</h6>-->
                        <!--        <p>Generate additional revenue by selling discounts and memberships, diversifying your income sources and increasing overall profitability</p>-->
                        <!--    </div>-->
                        <!--</div>-->
                        <!--<div class="work-steps-box">-->
                        <!--    <div class="step-counter">-->
                        <!--        <span>7</span>-->
                        <!--    </div>-->
                        <!--    <div class="step-meta">-->
                        <!--        <h6>Competitive Advantage</h6>-->
                        <!--        <p>Stay ahead of competitors by offering unique and compelling discounts and membership benefits through our platform, attracting and retaining customers in a competitive market landscape</p>-->
                        <!--    </div>-->
                        <!--</div>-->
                        <button class="ly-button-1">Get Started <span class="iconify" data-icon="tabler:chevron-right"></span></button>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="ly-faq-section">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="ly-heading-content">
                        <h2 class="ly-heading">Frequently Asked Questions</h2>
                    </div>
                    <div class="accordion ly-accordion" id="accordionPanelsStayOpenExample">
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseOne" aria-expanded="true" aria-controls="panelsStayOpen-collapseOne">
                                    What happens if the company I purchased a discount from goes out of business?
                                </button>
                            </h2>
                            <div id="panelsStayOpen-collapseOne" class="accordion-collapse collapse show">
                                <div class="accordion-body">
                                Like a stock market, a permanent discount can go to zero value if a business folds, however the upside also means that value can increase much more than 100%. There are some exceptions. Many businesses will include a smaller discount between 5-15% to similar types of discount owners. So you will have a potentially vast network of additional discounts that you will receive even if your primary investment business fails.
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseTwo" aria-expanded="false" aria-controls="panelsStayOpen-collapseTwo">
                                   How does BODE make a profit?
                                </button>
                            </h2>
                            <div id="panelsStayOpen-collapseTwo" class="accordion-collapse collapse">
                                <div class="accordion-body">
                                BODE takes a flat rate of 3% of each transaction each time a discount is sold and resold. We practice what we promote and have a finite amount of forever discounts available which will reduce that fee.
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseThree" aria-expanded="false" aria-controls="panelsStayOpen-collapseThree">
                                    How will you protect against fraudulent buyers and sellers?
                                </button>
                            </h2>
                            <div id="panelsStayOpen-collapseThree" class="accordion-collapse collapse">
                                <div class="accordion-body">
                                Although nothing is perfect at keeping bad actors from operating we have several safeguards in place that will make it very challenging to take advantage. First, businesses are marketing to their existing clients to purchase these. Although we cannot verify every business legitimacy, when a client purchases a discount they will have 30-60 days to verify the functionality of the discount provided. Money will sit on hold until that window of time closes or until the buyer verifies a successful transaction took place. For businesses that are less established or at higher risk of folding, we recommend a payment plan where only a third of the purchase price is paid and released to the business owner each year to mitigate the risk to the buyer. Business owners can chose whether they allow any speculative buyers or not when creating their product listing so they have control of who can own.
                                </div>
                            </div>
                        </div>

                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseFour" aria-expanded="false" aria-controls="panelsStayOpen-collapseFour">
                                    There seams to be a lot of potential lawsuits between BODE, Business Owners, and Discount buyers. How will you protect all the parties. 
                                </button>
                            </h2>
                            <div id="panelsStayOpen-collapseFour" class="accordion-collapse collapse">
                                <div class="accordion-body">
                                Unfortunately, anyone can sue anyone for any reason they want. However, we aim to protect all three parties equally. BODE’s mission is to protect buyers and sellers equally. We are clear that it is up to buyers to verify the legitimacy of the discount the purchase. WE require each business to provide verification options to new discount owners. When conflict of legitimacy or the ability to function arises, all sales from that business will be suspended until resolved. BODE is not responsible for any fraudulent activity conducted by buyers or sellers or for any losses. Our goal is to empower businesses of all sizes. We will not support illegal businesses or fraudulent activity.
                                </div>
                            </div>
                        </div>

                        <!--<div class="accordion-item">-->
                        <!--    <h2 class="accordion-header">-->
                        <!--        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseFive" aria-expanded="false" aria-controls="panelsStayOpen-collapseFive">-->
                        <!--            What sets your agency apart from competitors?-->
                        <!--        </button>-->
                        <!--    </h2>-->
                        <!--    <div id="panelsStayOpen-collapseFive" class="accordion-collapse collapse">-->
                        <!--        <div class="accordion-body">-->
                        <!--        <strong>This is the third item's accordion body.</strong> It is hidden by default, until the collapse plugin adds the appropriate classes that we use to style each element. These classes control the overall appearance, as well as the showing and hiding via CSS transitions. You can modify any of this with custom CSS or overriding our default variables. It's also worth noting that just about any HTML can go within the <code>.accordion-body</code>, though the transition does limit overflow.-->
                        <!--        </div>-->
                        <!--    </div>-->
                        <!--</div>-->
                    </div>
                    <div class="faq-btn-box">
                        <button class="ly-button-1" onclick="window.location.href='{{route('front.faqs')}}'">View All <span class="iconify" data-icon="tabler:chevron-right"></span></button>
                    </div>
                </div>
            </div>
        </div>
    </section>
    @endsection