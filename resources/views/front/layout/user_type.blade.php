 @if(Auth::check() && Auth::user()->is_role_set == '0')
    <?php $checkRole = 1;
    $pass = session('data');?>
    @else
    <?php $checkRole = 0;
    $pass = null?>
    @endif
        <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalCenterTitle">Want to proceed as</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                    
                        <div class="sign-in-up">
                            <ul class="list-sign-in ">                  
                                <li class="ad-post-btn">
                                <form action="{{route('save.role')}}" method="post" class="mt-3">
                                @csrf 
                                    <input type="hidden" name="email" id="passed_email">
                                    <input type="hidden" name="password" value = "{{$pass}}"id="passed_password">
                                    <button class="btn btn-theme login-me-vendor" name="button" value="vendor" type="submit"> Business Trader </button>
                                </form>
                                </li>
                                <li class="ad-post-btn">
                                <form action="{{route('save.role')}}" method="post" class="mt-3">
                                @csrf 
                                    <input type="hidden" name="email" id="passed_email2">
                                    <input type="hidden" name="password" id="passed_password2">
                                    <button class="btn btn-theme text-white login-me-buyer" name="button" value="buyer" type="submit"> Buyer/Reseller </button>
                                </form>
                                </li>
                            </ul>
                        </div>
                    </form>
                    </div>
                </div>
            </div>
        </div>