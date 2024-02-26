@extends('admin.layout.layout')


@section('content')
    <div class="main-panel">
        <div class="content-wrapper">
            @if (Session::has('success_message')) <!-- Check AdminController.php, updateAdminPassword() method -->
                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                    <strong>Success:</strong> {{ Session::get('success_message') }}
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            @endif
                            @if (Session::has('error_message')) <!-- Check AdminController.php, updateAdminPassword() method -->
                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    <strong>Success:</strong> {{ Session::get('error_message') }}
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            @endif
            <div class="row">
                <div class="col-lg-12 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Disputes</h4>
                            <!-- <form action="{{route('save.payout')}}" method="POST">
                                @csrf
                                <div class="form-group col-lg-6">
                                    <label for="amount">Add Payout Amount</label>
                                    <input type="number" class="form-control" id="amount" placeholder="Enter Payout Amount" name="amount" value="{{ old('amount') }}"> 
                                </div>
                                <button type="submit" style="max-width: 150px; float: right; display: inline-block" class=" form-group col-lg-6 btn btn-block btn-primary">Request Payout</button>
                            </form> -->
                            <!-- <h5>Available Balance: {{isset($getWallet) ? $getWallet->amount : 0}}$</h5> -->
                            <div class="table-responsive pt-3">
                                {{-- DataTable --}}
                                <table id="products" class="table table-bordered"> {{-- using the id here for the DataTable --}}
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Title</th>
                                            <th>Description</th>
                                            <th>Image</th>
                                            <th>Created On</th>
                                            <th>Vendor Response</th>
                                            <th>Admin Response</th>
                                            <th>Status</th>
                                            <th>Dispute Winner</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($getDispute as $key=>$dispute)
                                            <tr>
                                                <td>{{  $key + 1}}</td>
                                                <td>{{ $dispute->dispute_title }}</td>
                                                <td>{{ $dispute->dispute_description }}</td>
                                                <td><img src="{{ asset('front/images/dispute/'.$dispute->dispute_image) }}"></td>
                                                <td>{{ date("Y-M-d", strtotime($dispute->created_at)) }}</td>
                                                <td>{{  $dispute->vendor_response }}</td>
                                                <td>{{  $dispute->admin_response }}</td>
                                                <td>{{ $dispute->status}}</td>
                                                <td>{{ $dispute->dispute_winner}}</td>
                                                <td><button type="submit" class="btn btn-theme" onclick="createDispute({{$dispute->id}})">Add Response</button></td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div id="dispute" class="modal-style-2 dark modal ">
                <div class="modal-dialog modal-login">
                    <div class="modal-content">
                        <div class="modal-header p-0">				
                            <h4 class="modal-title">Dispute Response</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        </div>
                        <div class="modal-body">
                            <!-- dont forget to add action and action method  -->
                                <form  method="post" class="mt-3" action="{{route('add.dispute.response')}}" enctype="multipart/form-data">
                                    @csrf 
                                    <input type="hidden" name="dispute_id" id="dispute_id" value="">
                                <div class="form-group">
                                    <div class="input-group">
                                        <input type="text" class="form-control" name="dispute_description" placeholder="Enter Dispute Description" required="required" autocomplete="off" id="dispute_description">
                                    </div>
                                </div>
                                @if(Auth::guard('admin')->user() != null  && Auth::guard('admin')->user()->type == 'superadmin')
                                <div class="form-group">
                                    <div class="input-group">
                                        <label for="cars">Choose a car:</label>
                                            <select name="dispute_winner" id="dispute_winner">
                                            <option value="Vendor">Vendor</option>
                                            <option value="User">User</option>
                                        </select>
                                    </div>
                                </div>
                                @endif

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
            document.getElementById("dispute_id").value = value;
            $("#dispute").show()
            
        }
    </script>
@endsection