 @if(Auth::check() && Auth::user()->is_role_set == '0')
    <?php $checkRole = 1;
    $pass = session('data');?>
    @else
    <?php $checkRole = 0;
    $pass = null?>
    @endif
        <div class="modal fade show" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-modal="true" style="display: block; padding-left: 0px;">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header text-center">
                        <h5 class="modal-title w-100" id="exampleModalCenterTitle">Proceed as</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                    
                        <div class="sign-in-up">
                            <section class="snet-company-started-section inventory-section">
                                <div class="container">
                                        <div class="row" style="margin-top: 150px;">
                                            <div class="col-lg-1">
                                            </div>
                                                <div class="col-lg-5">
                                                    <div class="snet-started-company-box">
                                                        <form action="{{route('save.role')}}" method="post" class="mt-3">
                                                            <h4>BODE</h4>
                                                            <ol style="text-align: left;">
                                                                <li>Enhanced market reach</li>
                                                                <li>Increased customer engagement</li>
                                                                <li>Streamlined sales process</li>
                                                                <li>Cost-effective promotion</li>
                                                                <li>Access to new demographics</li>
                                                                <li>Improved brand visibility</li>
                                                                <li>Efficient inventory management</li>
                                                                <li>Data-driven insights</li>
                                                                <li>Flexible pricing options</li>
                                                                <li>Scalable growth potential</li>
                                                            </ol>
                                                                <!-- <button class="ly-button-inv"><a href="https://coupon-shop.smartdevpk.com/admin/add-edit-product">Post Listings</a><svg xmlns="http://www.w3.org/2000/svg" aria-hidden="true" role="img" width="1em" height="1em" viewBox="0 0 24 24" data-icon="tabler:chevron-right" class="iconify iconify--tabler"><path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m9 6l6 6l-6 6"></path></svg></button> -->
                                                                @csrf 
                                                            <input type="hidden" name="email" id="passed_email">
                                                            <input type="hidden" name="password" value = "{{$pass}}"id="passed_password">
                                                            <button class="ly-button-3" name="button" value="vendor" type="submit"> Business Entity </button>
                                                        </form>
                                                    </div>
                                                </div>
                                            <div class="col-lg-5">
                                                <div class="snet-started-company-box"> 
                                                    <form action="{{route('save.role')}}" method="post" class="mt-3">
                                                        <h4>Buyers/Investors</h4>
                                                        <ol style="text-align: left;">
                                                            <li>Exclusive discounts offered.</li>
                                                            <li>Easy registration process.</li>
                                                            <li>Profitable resale opportunities.</li>
                                                            <li>Access to unique deals.</li>
                                                            <li>Increased savings potential.</li>
                                                            <li>Flexible membership options.</li>
                                                            <li>Enhanced resale network.</li>
                                                            <li>Quick coupon redemption.</li>
                                                            <li>Wide product selection.</li>
                                                            <li>Competitive pricing advantage.</li>
                                                        </ol>
                                                                <!-- <button class="ly-button-inv"><a href="https://coupon-shop.smartdevpk.com/search-products">View Inventory</a> <svg xmlns="http://www.w3.org/2000/svg" aria-hidden="true" role="img" width="1em" height="1em" viewBox="0 0 24 24" data-icon="tabler:chevron-right" class="iconify iconify--tabler"><path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m9 6l6 6l-6 6"></path></svg></button> -->
                                                    @csrf 
                                                    <input type="hidden" name="email" id="passed_email2">
                                                    <input type="hidden" name="password" id="passed_password2">
                                                    <button class="ly-button-3" name="button" value="buyer" type="submit"> Buyer/Reseller </button>
                                                </form>
                                                </div>
                                            </div>
                                            <div class="col-lg-1">
                                            </div>  
                                        </div>
                                </div>
                            </section>
                        </div>
                    </div>
                </div>
            </div>
        </div>