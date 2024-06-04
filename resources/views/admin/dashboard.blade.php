@extends('admin.layout.layout')


@section('content')
<div class="main-panel">
    <div class="content-wrapper">
        <div class="row">
            <div class="col-md-12 grid-margin">
                <div class="row">
                    <div class="col-12 col-xl-8 mb-4 mb-xl-0">
                        <h3 class="font-weight-bold">Welcome {{ Auth::guard('admin')->user()->name }}</h3>
                        <!-- <h6 class="font-weight-normal mb-0">All systems are running smoothly!</h6> -->
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <!-- <div class="col-md-6 grid-margin transparent">


                    <div class="row">
                        <div class="col-md-6 mb-4 stretch-card transparent">
                            <div class="card card-tale">
                                <div class="card-body">
                                    <p class="mb-4">Total Sections</p>
                                    <p class="fs-30 mb-2">{{ $sectionsCount }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 mb-4 stretch-card transparent">
                            <div class="card card-dark-blue">
                                <div class="card-body">
                                    <p class="mb-4">Total Categories</p>
                                    <p class="fs-30 mb-2">{{ $categoriesCount }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-4 mb-lg-0 stretch-card transparent">
                            <div class="card card-light-blue">
                                <div class="card-body">
                                    <p class="mb-4">Total Listings</p>
                                    <p class="fs-30 mb-2">{{ $productsCount }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 stretch-card transparent">
                            <div class="card card-light-danger">
                                <div class="card-body">
                                    <p class="mb-4">Total Brands</p>
                                    <p class="fs-30 mb-2">{{ $brandsCount }}</p>
                                </div>
                            </div>
                        </div>
                    </div>


                </div>
                <div class="col-md-6 grid-margin transparent">
                    <div class="row">
                        <div class="col-md-6 mb-4 stretch-card transparent">
                            <div class="card card-tale">
                                <div class="card-body">
                                    <p class="mb-4">Total Orders</p>
                                    <p class="fs-30 mb-2">{{ $ordersCount }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 mb-4 stretch-card transparent">
                            <div class="card card-dark-blue">
                                <div class="card-body">
                                    <p class="mb-4">Total Coupons</p>
                                    <p class="fs-30 mb-2">{{ $couponsCount }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-4 mb-lg-0 stretch-card transparent">
                            <div class="card card-light-blue">
                                <div class="card-body">
                                    <p class="mb-4">Total Users</p>
                                    <p class="fs-30 mb-2">{{ $usersCount }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 stretch-card transparent">
                            <div class="card card-light-danger">
                                <div class="card-body">
                                    <p class="mb-4">Total Subscribers</p>
                                    <p class="fs-30 mb-2">0</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> -->
            <div class="col-md-12 grid-margin">
            <section >
                <div class="container">

                    <h4 class="section_heading">Your Listings</h4>
                    <table id="products" class="table table-bordered"> {{-- using the id here for the DataTable --}}
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Listing Image</th>
                                <th>Listing Name</th>
                                <th>Listing Code</th>
                                <!-- <th>Listing Color</th> -->
                                <th>Category</th> {{-- Through the relationship --}}
                                <th>Section</th>  {{-- Through the relationship --}}
                                <!-- <th>Added by</th> {{-- Through the relationship --}} -->
                                <!-- <th>Status</th>
                                <th>Actions</th> -->
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($newProducts as $product)
                                @php
                                $product_image_path = 'front/images/product_images/small/' . $product->product_image;
                                @endphp
                                <tr>
                                    <td>{{ $product['id'] }}</td>
                                    <td>
                                        @if (!empty($product['product_image']))
                                            <img style="border-radius: 17%; width:120px; height:100px" src="{{ asset('front/images/product_images/small/' . $product['product_image']) }}"> {{-- Show the 'small' image size from the 'small' folder --}}
                                        @else
                                            <img style="border-radius: 17%;  width:120px; height:100px" src="{{ asset('front/images/product_images/small/no-image.png') }}"> {{-- Show the 'no-image' Dummy Image: If you have for example a table with an 'images' column (that can exist or not exist), use a 'Dummy Image' in case there's no image. Example: https://dummyimage.com/  --}}
                                        @endif
                                    </td>
                                    <td>{{ $product['product_name'] }}</td>
                                    <td>{{ $product['product_code'] }}</td>
                                    <!-- <td>{{ $product['product_color'] }}</td> -->
                                    <td>{{ $product['category']['category_name'] }}</td> {{-- Through the relationship --}}
                                    <td>{{ $product['section']['name'] }}</td> {{-- Through the relationship --}}
                                   
                                    <!-- <td>
                                        @if ($product['status'] == 1)
                                            <a title="Listing Status" class="updateProductStatus" id="product-{{ $product['id'] }}" product_id="{{ $product['id'] }}" href="javascript:void(0)"> {{-- Using HTML Custom Attributes. Check admin/js/custom.js --}}
                                                <i style="font-size: 25px" class="mdi mdi-bookmark-check" status="Active"></i> {{-- Icons from Skydash Admin Panel Template --}}
                                            </a>
                                        @else {{-- if the admin status is inactive --}}
                                            <a title="Listing Status" class="updateProductStatus" id="product-{{ $product['id'] }}" product_id="{{ $product['id'] }}" href="javascript:void(0)"> {{-- Using HTML Custom Attributes. Check admin/js/custom.js --}}
                                                <i style="font-size: 25px" class="mdi mdi-bookmark-outline" status="Inactive"></i> {{-- Icons from Skydash Admin Panel Template --}}
                                            </a>
                                        @endif
                                    </td> -->
                                    <!-- <td>
                                        <a title="Edit Listing" href="{{ url('admin/add-edit-product/' . $product['id']) }}">
                                            <i style="font-size: 25px" class="mdi mdi-pencil-box"></i> {{-- Icons from Skydash Admin Panel Template --}}
                                        </a>
                                        <a title="Add Multiple Images" href="{{ url('admin/add-images/' . $product['id']) }}">
                                            <i style="font-size: 25px" class="mdi mdi-library-plus"></i> {{-- Icons from Skydash Admin Panel Template --}}
                                        </a>

                                        {{-- Confirm Deletion JS alert and Sweet Alert --}}
                                        {{-- <a title="Listing" class="confirmDelete" href="{{ url('admin/delete-product/' . $product['id']) }}"> --}}
                                            {{-- <i style="font-size: 25px" class="mdi mdi-file-excel-box"></i> --}} {{-- Icons from Skydash Admin Panel Template --}}
                                        {{-- </a> --}}
                                        <a  title="Delete Listing" href="JavaScript:void(0)" class="confirmDelete" module="product" moduleid="{{ $product['id'] }}"> {{-- Check admin/js/custom.js and web.php (routes) --}}
                                            <i style="font-size: 25px" class="mdi mdi-file-excel-box"></i> {{-- Icons from Skydash Admin Panel Template --}}
                                        </a>
                                    </td> -->
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </section>
            </div>
        </div>
    </div>
    <!-- content-wrapper ends -->
    @include('admin.layout.footer')
    <!-- partial -->
</div>
@endsection