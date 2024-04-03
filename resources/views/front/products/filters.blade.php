{{-- This is the filters sidebar which is included by 'listing.blade.php' --}}
@php
    
    $productFilters = \App\Models\ProductsFilter::productFilters(); // Get all the (enabled/active) Filters
    // dd($productFilters);
@endphp

<div class="col-lg-3 col-md-3 col-sm-12">
    <div class="fetch-categories">
        <h3 class="title-name">Browse Categories</h3>
        <h3 class="fetch-mark-category">
            <a href="listing.html">T-Shirts
                <span class="total-fetch-items">(5)</span>
            </a>
        </h3>
        <ul>
            <li>
                <a href="shop-v3-sub-sub-category.html">Casual T-Shirts
                    <span class="total-fetch-items">(3)</span>
                </a>
            </li>
            <li>
                <a href="listing.html">Formal T-Shirts
                    <span class="total-fetch-items">(2)</span>
                </a>
            </li>
        </ul>
        <h3 class="fetch-mark-category">
            <a href="listing.html">Shirts
                <span class="total-fetch-items">(5)</span>
            </a>
        </h3>
        <ul>
            <li>
                <a href="shop-v3-sub-sub-category.html">Casual Shirts
                    <span class="total-fetch-items">(3)</span>
                </a>
            </li>
            <li>
                <a href="listing.html">Formal Shirts
                    <span class="total-fetch-items">(2)</span>
                </a>
            </li>
        </ul>
    </div>
    @if (!isset($_REQUEST['search']))
        
        <div class="facet-filter-associates">
            <h3 class="title-name">Price</h3>
            <form class="facet-form" action="#" method="post">
                <div class="associate-wrapper">


                    {{-- Third: the 'price' filter --}} 
                    @php
                        // our desired array of price ranges
                        $prices = array('0-1000', '1000-2000', '2000-5000', '5000-10000', '10000-100000');
                    @endphp

                    @foreach ($prices as $key => $price)
                        <input type="checkbox" class="check-box price" id="price{{ $key }}" name="price[]" value="{{ $price }}"> {{-- Note!!: PLEASE NOTE THE SQUARE BRACKETS [] OF THE "name" ATTRIBUTE!! --}} {{-- echo the $price as a 'CSS class' to be able to use it in jQuery for filtering --}} {{-- the checked checkboxes <input> fields of the price filter values (like '1000-2000', '2000-5000', ...) will be submitted as an ARRAY because we used SQUARE BRACKETS [] with the "name" HTML attribute in the checkbox <input> field in filters.blade.php, or else, AJAX is used to send the <input> values WITHOUT submitting the <form> at all --}}
                        <label class="label-text" for="price{{ $key }}">EGP {{ $price }}
                        </label>
                    @endforeach
                </div>
            </form>
        </div>        
        @foreach ($productFilters as $filter) {{-- $productFilters comes from the far top of this file --}}
            @php
                $filterAvailable = \App\Models\ProductsFilter::filterAvailable($filter['id'], $categoryDetails['categoryDetails']['id']); // $categoryDetails was passed from the listing() method in the Front/ProductsController
            @endphp
            @if ($filterAvailable == 'Yes')
                @if (count($filter['filter_values']) > 0)
                    <div class="facet-filter-associates">
                        <h3 class="title-name">{{ $filter['filter_name'] }}</h3>
                        {{-- Sidenote: There are TWO ways to submit a <form> to the backed: firstly, the regular one using the <button type="submit">, secondly, using AJAX by sending the "value" attributes of the <input> fields --}}
                        <form class="facet-form" action="#" method="post">
                            <div class="associate-wrapper">
                                @foreach ($filter['filter_values'] as $value)
                                    <input type="checkbox" class="check-box {{ $filter['filter_column'] }}" id="{{ $value['filter_value'] }}" name="{{ $filter['filter_column'] }}[]" value="{{ $value['filter_value'] }}"> {{-- Note!!: PLEASE NOTE THE SQUARE BRACKETS [] OF THE "name" ATTRIBUTE!! --}} {{-- echo the filter name as a 'CSS class' to be able to use it in jQuery for filtering, and also add the "name" (as an array!! PLEASE NOTE THE SQUARE BRACKETS [] !!! e.g.    'fabric' => ['cotton', 'polyester']    ) and "value" HTML attributes too --}}    {{-- the checked checkboxes <input> fields will be submitted as an ARRAY because we used SQUARE BRACKETS [] with the "name" HTML attribute in the checkbox <input> field in filters.blade.php e.g.    'fabric' => ['cotton', 'polyester']    , or else, AJAX is used to send the <input> values WITHOUT submitting the <form> at all --}}
                                    <label class="label-text" for="{{ $value['filter_value'] }}">{{ ucwords($value['filter_value']) }}
                                    </label>
                                @endforeach
                            </div>
                        </form>
                    </div>
                @endif
            @endif
        @endforeach
    @endif
</div>