@extends('front.layout.layout')
@section('content')

    <!-- ly-page-top-section-start -->
    <section class="ly-page-top-section">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <h1>Frequently Asked Questions</h1>
                </div>
            </div>
        </div>
    </section>
    
    <section class="ly-faq-section">
        <div class="container">
            <div class="row">
                <div class="col-12">
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

                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseFive" aria-expanded="false" aria-controls="panelsStayOpen-collapseFive">
                                    Is insider trading a concern?
                                </button>
                            </h2>
                            <div id="panelsStayOpen-collapseFive" class="accordion-collapse collapse">
                                <div class="accordion-body">
                                Although we are not a stock exchange there is the possibility we will one day be regulated. It is our hope and intention that businesses can give these products to employees, shareholders etc as an incentive. If you have insider information and use it to purchase these products inappropriately, we will not regulate or verify your association, but your information will be disclosed upon request by a government agency. We believe and support Free Market principals.
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--<div class="faq-btn-box">-->
                    <!--    <button class="ly-button-1">Get Started <span class="iconify" data-icon="tabler:chevron-right"></span></button>-->
                    <!--</div>-->
                </div>
            </div>
        </div>
    </section>
@endsection