
<div class="row product-container grid-style">
    <!-- <div class="ly-car-show-map"> -->
    @forelse ($categoryProducts as $product)
        <div class="col-lg-12">
            <div class="fr-latest-grid">
                <div class="ly-car-card ly-car-card-list  ly-grid-2">
                    <div class="car-img-box">
                        @if (!empty($product['product_image']))
                            <a href="{{ url('product/' . $product['id']) }}"><img src="{{ asset('front/images/product_images/small/' . $product['product_image']) }}" alt="list-img"></a>
                        @else
                            <a href="{{ url('product/' . $product['id']) }}"><img src="{{ asset('front/images/product_images/small/no-image.png') }}" alt="list-img"></a>
                        @endif
                        <span class="card-tag">listed</span>
                    </div>
                    <div class="car-detail-box">
                        <div class="car-title-box">
                            <div class="meta-box ">
                                <h5 class="car-title"><a href="{{ url('product/' . $product['id']) }}">{{ $product['product_name'] }}</a></h5>
                                <span>{{ $product['product_code'] }}</span>
                                <div class="car-meta-box">
                                    <div class="sub-meta car-location">
                                        <span class="iconify" data-icon="ri:route-line" data-flip="vertical"></span>
                                        <span>{{ $product['category']['category_name'] }}</span>
                                        <!-- <span>{{ $product['section']['name'] }}</span> -->
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="car-price-rating-box">
                            <h6 class="total-price">{{Session::get('currency')}} {{round($product['product_price'] * $selectedCurrencyRate, 2)}} total</h6>
                            <div class="rating-box">
                                <span class="iconify" data-icon="lets-icons:star-fill"></span>
                                <strong>4.9</strong>
                                <span>(12 reviews)</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @empty
         <div id="noProduc" class="fr-latest-grid">No Product Found</div>
    @endforelse   
    <!-- </div> -->
</div>
<!-- Row-of-Product-Container /- -->