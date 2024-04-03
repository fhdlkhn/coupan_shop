@extends('front.layout.layout')
@section('content')
        <section class="ly-page-top-section">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <h1>Shop</h1>
                    <p>Join top UK hosts who make an average of £6,492 every year for each listing they list</p>
                </div>
            </div>
        </div>
    </section>
    <section class="ly-listing-projects-section">
        <div class="page-shop u-s-p-t-80">
            <div class="container">
                <div class="row">
                    <div class="col-lg-3 col-md-3 col-sm-12">
                        <div class="fetch-categories">
                            <h3 class="title-name">Browse Categories</h3>
                            @foreach($fetchAllCategories as $allCats)
                            <h3 class="fetch-mark-category">
                                <a href="#">{{$allCats->category_name}}
                                    <span class="total-fetch-items">(5)</span>
                                </a>
                            </h3>
                            <ul>
                                @if($allCats->subCategories != null)
                                    @foreach($allCats->subCategories as $allSubCats)
                                    <li>
                                        <a href="#">{{$allSubCats->category_name}}
                                            <span class="total-fetch-items">(2)</span>
                                        </a>
                                    </li>
                                    @endforeach
                                @endif
                            </ul>
                            @endforeach
                        </div>
                        @if (!isset($_REQUEST['search']))
                            
                            <div class="facet-filter-associates">
                                <h3 class="title-name">Price</h3>
                                <form class="facet-form" action="#" method="post">
                                    <div class="associate-wrapper">
                                        @php
                                            $prices = array('0-1000', '1000-2000', '2000-5000', '5000-10000', '10000-100000');
                                        @endphp

                                        @foreach ($prices as $key => $price)
                                            <input type="checkbox" class="check-box price" id="price{{ $key }}" name="price[]" value="{{ $price }}"> {{-- Note!!: PLEASE NOTE THE SQUARE BRACKETS [] OF THE "name" ATTRIBUTE!! --}} {{-- echo the $price as a 'CSS class' to be able to use it in jQuery for filtering --}} {{-- the checked checkboxes <input> fields of the price filter values (like '1000-2000', '2000-5000', ...) will be submitted as an ARRAY because we used SQUARE BRACKETS [] with the "name" HTML attribute in the checkbox <input> field in filters.blade.php, or else, AJAX is used to send the <input> values WITHOUT submitting the <form> at all --}}
                                            <label class="label-text" for="price{{ $key }}">$ {{ $price }}
                                            </label>
                                        @endforeach
                                    </div>
                                </form>
                            </div>  
                        @endif
                    </div>
                    <div class="col-lg-9 col-md-9 col-sm-12">
                        <div class="page-bar clearfix">
                            @if (!isset($_REQUEST['search']))
                                <form name="sortProducts" id="sortProducts"> 
                                    <input type="hidden" name="url" id="url" value="{{ $url }}">

                                    <div class="toolbar-sorter">
                                        <div class="select-box-wrapper">
                                            <label class="sr-only" for="sort-by">Sort By</label>
                                            <select name="sort" id="sort" class="select-box">
                                                <option value="" selected>Select</option>
                                                <option value="product_latest" @if(isset($_GET['sort']) && $_GET['sort'] == 'product_latest') selected @endif>Sort By: Latest</option>
                                                <option value="price_lowest"   @if(isset($_GET['sort']) && $_GET['sort'] == 'price_lowest')   selected @endif>Sort By: Lowest Price</option>
                                                <option value="price_highest"  @if(isset($_GET['sort']) && $_GET['sort'] == 'price_highest')  selected @endif>Sort By: Highest Price</option>
                                                <option value="name_a_z"       @if(isset($_GET['sort']) && $_GET['sort'] == 'name_a_z')       selected @endif>Sort By: Name A - Z</option>
                                                <option value="name_z_a"       @if(isset($_GET['sort']) && $_GET['sort'] == 'name_z_a')       selected @endif>Sort By: Name Z - A</option>
                                            </select>
                                        </div>
                                    </div>
                                </form>
                            @endif
                            <div class="toolbar-sorter-2">
                                <div class="select-box-wrapper">
                                    <label class="sr-only" for="show-records">Show Records Per Page</label>
                                    <select class="select-box" id="show-records">
                                        <option selected="selected" value="">Showing: {{ count($categoryProducts) }}</option>
                                        <option value="">Showing: All</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="filter_products">
                            @include('front.products.ajax_products_listing')
                        </div>
                        @if (!isset($_REQUEST['search']))
                            @if (isset($_GET['sort']))
                                <div>
                                    {{ $categoryProducts->appends(['sort' => $_GET['sort']])->links() }}
                                </div>
                            @else
                                <div>
                                    {{ $categoryProducts->links() }}
                                </div>
                            @endif
                        @endif
                        <div>&nbsp;</div>
                        <div>{{ $categoryDetails != null ? $categoryDetails['categoryDetails']['description'] : ''}}</div>



                    </div>
                    <!-- Shop-Right-Wrapper /- -->


                    <!-- Shop-Pagination -->


                    <!-- Shop-Pagination /- -->


                </div>
            </div>
        </div>
    </section>
@endsection