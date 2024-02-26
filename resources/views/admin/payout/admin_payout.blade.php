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
            <div class="row">
                <div class="col-lg-12 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Payout</h4>
                            <!-- <form action="{{route('save.payout')}}" method="POST">
                                @csrf
                                <div class="form-group col-lg-6">
                                    <label for="amount">Add Payout Amount</label>
                                    <input type="number" class="form-control" id="amount" placeholder="Enter Payout Amount" name="amount" value="{{ old('amount') }}"> 
                                </div>
                                <button type="submit" style="max-width: 150px; float: right; display: inline-block" class=" form-group col-lg-6 btn btn-block btn-primary">Request Payout</button>
                            </form> -->
                            <div>
                            <h5>Available Balance: {{isset($getWallet) ? $getWallet->amount: 0}}$</h5>
                            <div class="table-responsive pt-3">
                                {{-- DataTable --}}
                                <table id="products" class="table table-bordered"> {{-- using the id here for the DataTable --}}
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>User Name</th>
                                            <th>Payout Amount</th>
                                            <th>Payout Date</th>
                                            <th>Payout Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($getUserWallet as $key=>$wallet)
                                            <tr>
                                                <td>{{  $key + 1}}</td>
                                                <td>{{  $wallet->userName}}</td>
                                                <td>{{ $wallet->amount }}</td>
                                                <td>{{ date("Y-M-d", strtotime($wallet->created_at)) }}</td>
                                                <td>{{ $wallet->status }}</td>
                                                <form method="post" action="{{ route('update.payout') }}">
                                                    @csrf
                                                    <input type="hidden" value="{{$wallet->id}}" name="payout_id">
                                                    <td>
                                                        <button type="submit" name="status" value="Cancelled">Cancel</button>
                                                        <button type="submit" name="status" value="Processed">Complete</button>
                                                        <button type="submit" name="status" value="Hold">Hold</button>
                                                    </td>
                                                </form>
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