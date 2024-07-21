@extends('front.users.layout.layout')


@section('content')
<style>
    .qrcode-container {
    white-space: nowrap;
}
.btn.btn-theme {
  color: rgb(252, 252, 253);
  text-align: center;
  font-size: 16px;
  font-weight: 700;
  line-height: 16px;
  padding: 5px 10px !important;
  border: 0px;
  border-radius: 90px;
  background: rgb(59, 113, 254);
  margin-bottom: 15px;
}
    </style>
    <div class="main-panel">
        <div class="content-wrapper">
            <div class="row">
                <div class="col-lg-12 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Products</h4>
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
                                            <th>SR#</th>
                                            <th>Listing Image</th>
                                            <th>Listing Name</th>
                                            <th>Listing Code</th>
                                            <th>Listing QR</th>
                                            <th>Category</th> {{-- Through the relationship --}}
                                            <th>Section</th>  {{-- Through the relationship --}}
                                            <!-- <th>Added by</th> {{-- Through the relationship --}} -->
                                            <!-- <th>Status</th> -->
                                            <th>Action</th>
                                            
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($products as $key=>$product)
                                            <tr>
                                                <td>{{ $key + 1 }}</td>
                                                 <td>
                                                    @if (!empty($product['product']['product_image']))
                                                        <img style=" border-radius: 7%; width:120px; height:100px" src="{{ asset('front/images/product_images/large/' . $product['product']['product_image']) }}">
                                                    @else
                                                        <img style="border-radius: 7%; width:120px; height:100px" src="{{ asset('front/images/product_images/small/no-image.png') }}"> 
                                                    @endif
                                                </td>
                                                <td>{{ $product['product_name'] }}</td>
                                                <td>{{ $product['product_code'] }}</td>
                                                <td class="qrcode-container">{!! QrCode::generate($product['QRdata']) !!}</td>
                                                <td>{{ $product['product']['category']['category_name'] }}</td> {{-- Through the relationship --}}
                                                <td>{{ $product['product']['section']['name'] }}</td> {{-- Through the relationship --}}
                                                <!-- <td>
                                                    @if ($product['admin_type'] == 'vendor')
                                                        <a target="_blank" href="{{ url('admin/view-vendor-details/' . $product['admin_id']) }}">{{ ucfirst($product['admin_type']) }}</a>
                                                    @else
                                                        {{ ucfirst($product['admin_type']) }}
                                                    @endif
                                                </td> -->
                                                <!-- <td>
                                                    @if ($product['product']['status'] == 1)
                                                        <a class="updateProductStatus" id="product-{{ $product['product']['id'] }}" product_id="{{ $product['product']['id'] }}" href="javascript:void(0)"> {{-- Using HTML Custom Attributes. Check admin/js/custom.js --}}
                                                            <i style="font-size: 25px" class="mdi mdi-bookmark-check" status="Active"></i> {{-- Icons from Skydash Admin Panel Template --}}
                                                        </a>
                                                    @else {{-- if the admin status is inactive --}}
                                                        <a class="updateProductStatus" id="product-{{ $product['product']['id'] }}" product_id="{{ $product['product']['id'] }}" href="javascript:void(0)"> {{-- Using HTML Custom Attributes. Check admin/js/custom.js --}}
                                                            <i style="font-size: 25px" class="mdi mdi-bookmark-outline" status="Inactive"></i> {{-- Icons from Skydash Admin Panel Template --}}
                                                        </a>
                                                    @endif
                                                </td> -->
                                                <td><form method="POST" action="{{ route('add.user.products', ['id' => $product['id']]) }}">
                                                    
                                                    @csrf
                                                    <button type="submit" class="btn btn-theme" style="display:{{$product['is_resell'] == false ? 'none' : 'block'}}">Resell</button>
                                                </form>
                                                <button type="submit" class="btn btn-theme" onclick="createDispute({{$product['product']['id']}})">Create Dispute</button>
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
            <div id="dispute" class="modal-style-2 dark modal ">
                <div class="modal-dialog modal-login">
                    <div class="modal-content">
                        <div class="modal-header p-0">				
                            <h4 class="modal-title">Create Dispute</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        </div>
                        <div class="modal-body">
                            <!-- dont forget to add action and action method  -->
                                <form  method="post" class="mt-3" action="{{route('add.dispute')}}" enctype="multipart/form-data">
                                    @csrf 
                                    <input type="hidden" name="product_id" id="product_id" value="">
                                <div class="form-group">
                                    <div class="input-group">
                                        
                                    
                                        <input type="text" name="title" id="dispute_title" class="form-control" placeholder="Enter Dispute Title" required="required" autocomplete="off">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="input-group">
                                        <input type="text" class="form-control" name="dispute_description" placeholder="Enter Dispute Description" required="required" autocomplete="off" id="dispute_description">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="input-group">
                                        <input type="file" class="form-control" name="dispute_image" placeholder="Select Image" id="dispute_image">
                                    </div>
                                </div>
                                <div class="form-group text-center mt-2 mb-0">
                                    <button type="submit" class="btn btn-primary btn-sm">Submit Dispute</button>
                                </div>
                            </form>
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
    <script type="text/javascript">
        function createDispute(value){
            document.getElementById("product_id").value = value;
            $("#dispute").show()
            
        }
    </script>
@endsection