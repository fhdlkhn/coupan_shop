@extends('admin.layout.layout')


@section('content')
    <div class="main-panel">
        <div class="content-wrapper">
            <div class="row">
                <div class="col-lg-12 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Listing</h4>



                            
                            <a href="{{ url('admin/add-edit-product') }}" style="max-width: 150px; float: right; display: inline-block" class="btn btn-block btn-primary">Add Listing</a>

                            {{-- Displaying The Validation Errors: https://laravel.com/docs/9.x/validation#quick-displaying-the-validation-errors AND https://laravel.com/docs/9.x/blade#validation-errors --}}
                            {{-- Determining If An Item Exists In The Session (using has() method): https://laravel.com/docs/9.x/session#determining-if-an-item-exists-in-the-session --}}
                            {{-- Our Bootstrap success message in case of updating admin password is successful: --}}
                            @if (Session::has('success_message')) <!-- Check AdminController.php, updateAdminPassword() method -->
                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                    <strong>Success:</strong> {{ Session::get('success_message') }}
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            @endif


                            <div class="table-responsive pt-3">
                                {{-- DataTable --}}
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
                                            <th>Status</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($products as $product)
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
                                                <!-- arslaaaa@gmail.com -->
                                                <td>
                                                    @if ($product['status'] == 1)
                                                        <a title="Listing Status" class="updateProductStatus" id="product-{{ $product['id'] }}" product_id="{{ $product['id'] }}" href="javascript:void(0)"> {{-- Using HTML Custom Attributes. Check admin/js/custom.js --}}
                                                            <i style="font-size: 25px" class="mdi mdi-bookmark-check" status="Active"></i> {{-- Icons from Skydash Admin Panel Template --}}
                                                        </a>
                                                    @else {{-- if the admin status is inactive --}}
                                                        <a title="Listing Status" class="updateProductStatus" id="product-{{ $product['id'] }}" product_id="{{ $product['id'] }}" href="javascript:void(0)"> {{-- Using HTML Custom Attributes. Check admin/js/custom.js --}}
                                                            <i style="font-size: 25px" class="mdi mdi-bookmark-outline" status="Inactive"></i> {{-- Icons from Skydash Admin Panel Template --}}
                                                        </a>
                                                    @endif
                                                </td>
                                                <td>
                                                    <a title="Edit Listing" href="{{ url('admin/add-edit-product/' . $product['id']) }}">
                                                        <i style="font-size: 25px" class="mdi mdi-pencil-box"></i> {{-- Icons from Skydash Admin Panel Template --}}
                                                    </a>
                                                    <!-- <a title="Add Attributes" href="{{ url('admin/add-edit-attributes/' . $product['id']) }}">
                                                        <i style="font-size: 25px" class="mdi mdi-plus-box"></i> {{-- Icons from Skydash Admin Panel Template --}}
                                                    </a> -->
                                                    <!-- <a title="Add Multiple Images" href="{{ url('admin/add-images/' . $product['id']) }}">
                                                        <i style="font-size: 25px" class="mdi mdi-library-plus"></i> {{-- Icons from Skydash Admin Panel Template --}}
                                                    </a> -->

                                                    {{-- Confirm Deletion JS alert and Sweet Alert --}}
                                                    {{-- <a title="Listing" class="confirmDelete" href="{{ url('admin/delete-product/' . $product['id']) }}"> --}}
                                                        {{-- <i style="font-size: 25px" class="mdi mdi-file-excel-box"></i> --}} {{-- Icons from Skydash Admin Panel Template --}}
                                                    {{-- </a> --}}
                                                    <a  title="Delete Listing" href="JavaScript:void(0)" class="confirmDelete" module="product" moduleid="{{ $product['id'] }}"> {{-- Check admin/js/custom.js and web.php (routes) --}}
                                                        <i style="font-size: 25px" class="mdi mdi-file-excel-box"></i> {{-- Icons from Skydash Admin Panel Template --}}
                                                    </a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- content-wrapper ends -->
        <!-- partial:../../partials/_footer.html -->
        <footer class="footer">
            <div class="d-sm-flex justify-content-center justify-content-sm-between">
                <span class="text-muted text-center text-sm-left d-block d-sm-inline-block">Copyright © 2022. All rights reserved.</span>
            </div>
        </footer>
        <!-- partial -->
    </div>
@endsection