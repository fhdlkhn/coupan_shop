{{-- This page is rendered by orders() method inside Front/OrderController.php (depending on if the order id Optional Parameter (slug) is passed in or not) --}}


@extends('front.layout.layout')



@section('content')
<style>
    .qrcode-container {
    white-space: nowrap;
}
    </style>
    <!-- Page Introduction Wrapper -->
    <div class="page-style-a">
         @if (Session::has('success_message'))
            <div id="success-message" class="alert alert-success alert-dismissible fade show" role="alert" style="position: fixed; top: 10px; right: 10px; width: 500px; z-index: 999;">
                <strong>Success:</strong> {{ Session::get('success_message') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <script>
                // Automatically close the error message after 5000 milliseconds (5 seconds)
                setTimeout(function () {
                    document.getElementById('success-message').style.display = 'none';
                }, 5000);
            </script>
        @endif
         @if (Session::has('error_message'))
            <div id="error_message" class="alert alert-danger alert-dismissible fade show" role="alert" style="position: fixed; top: 10px; right: 10px; width: 500px; z-index: 999;">
                <strong>Success:</strong> {{ Session::get('error_message') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <script>
                // Automatically close the error message after 5000 milliseconds (5 seconds)
                setTimeout(function () {
                    document.getElementById('error_message').style.display = 'none';
                }, 5000);
            </script>
        @endif
        <div class="container">
            <div class="page-intro">
                <h2>My Orders</h2>
                <ul class="bread-crumb">
                    <li class="has-separator">
                        <i class="ion ion-md-home"></i>
                        <a href="index.html">Home</a>
                    </li>
                    <li class="is-marked">
                        <a href="#">Orders</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <!-- Page Introduction Wrapper /- -->
    <!-- Cart-Page -->
    <div class="page-cart u-s-p-t-80">
        <div class="container">
            <div class="row">
                <table class="table table-striped table-borderless">
                    <tr class="table-danger">
                        <th>Order ID</th>
                        <th>QR Code</th>
                        <th>Ordered Listings</th> {{-- We'll display products codes --}}
                        <th>Payment Method</th>
                        <th>Grand Total</th>
                        <th>Created on</th>
                        <!-- <th></th>
                        <th></th> -->
                        @foreach ($orders as $order)
                            <tr>
                                <td>
                                    <a href="{{ url('user/orders/' . $order['id']) }}">{{ $order['id'] }}</a>
                                </td>
                                <td class="qrcode-container">
                                    @foreach ($order['orders_products'] as $product)
                                        {!! QrCode::generate($product['QRdata']) !!}
                                        <br>
                                    @endforeach
                                </td>
                                <td> {{-- We'll display products codes --}}
                                    @foreach ($order['orders_products'] as $product)
                                        {{ $product['product_code'] }}
                                        <br>
                                    @endforeach
                                </td>
                                <td>{{ $order['payment_method'] }}</td>
                                <td>${{ $order['grand_total'] }}</td>
                                <td>{{ date('Y-m-d h:i:s', strtotime($order['created_at'])) }}</td>
                                <!-- <td><form method="POST" action="{{ route('add.user.products', ['id' => $order['id']]) }}">
                                    @csrf
                                    <button type="submit" class="btn btn-theme">Resell</button>
                                </form></td>
                                <td>
                                    <button type="submit" class="btn btn-theme" onclick="createDispute({{$order['id']}})">Create Dispute</button>
                                </td> -->
                            </tr>
                        @endforeach
                    </tr>
                </table>
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
                                    <input type="hidden" name="order_id" id="order_id" value="">
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
    </div>
    <!-- Cart-Page /- -->
    <!-- <script type="text/javascript">
        function createDispute(value){
            document.getElementById("order_id").value = value;
            $("#dispute").show()
            
        }
    </script> -->
@endsection