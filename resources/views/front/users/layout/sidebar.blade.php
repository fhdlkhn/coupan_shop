{{-- Correcting issues in the Skydash Admin Panel Sidebar using Session --}}


<!-- partial:partials/_sidebar.html -->
<nav class="sidebar sidebar-offcanvas" id="sidebar">
    <ul class="nav">
        <!-- <li class="nav-item">
            <a @if (Session::get('page') == 'dashboard') style="background: #052CA3 !important; color: #FFF !important" @endif class="nav-link" href="{{ url('admin/dashboard') }}">
                <i class="icon-grid menu-icon"></i>
                <span class="menu-title">Dashboard</span>
            </a>
        </li> -->
        <li class="nav-item">
                <a @if (Session::get('page') == 'ordered_listing') style="background: #052CA3 !important; color: #FFF !important" @endif class="nav-link" href="{{ route('user.ordered.listings') }}">
                <i class="icon-layout menu-icon"></i>
                    <span class="menu-title">Ordered Listing</span>
                </a>
            </li>
        <li class="nav-item">
            <a @if (Session::get('page') == 'personal_details') style="background: #052CA3 !important; color: #FFF !important" @endif class="nav-link" href="{{ route('user.ordered.listings') }}">
            <i class="icon-layout menu-icon"></i>
                <span class="menu-title">Personal Details</span>
            </a>
        </li>
        <li class="nav-item">
                <a @if (Session::get('page') == 'sections' || Session::get('page') == 'categories' || Session::get('page') == 'products' || Session::get('page') == 'brands' || Session::get('page') == 'filters' || Session::get('page') == 'coupons') style="background: #052CA3 !important; color: #FFF !important" @endif class="nav-link" href="{{ route('get.user.products') }}">
                <i class="icon-layout menu-icon"></i>
                    <span class="menu-title">Listing Management</span>
                </a>
            </li>

            {{-- If the authenticated/logged-in user is 'vendor', show ONLY the orders of the products added by that specific 'vendor' (In constrast to the case where the authenticated/logged-in user is 'admin', we show ALL orders) --}} 
            <!-- <li class="nav-item">
                <a @if (Session::get('page') == 'orders') style="background: #052CA3 !important; color: #FFF !important" @endif class="nav-link" data-toggle="collapse" href="#ui-orders" aria-expanded="false" aria-controls="ui-orders">
                    <i class="icon-layout menu-icon"></i>
                    <span class="menu-title">Orders Management</span>
                    <i class="menu-arrow"></i>
                </a>
                <div class="collapse" id="ui-orders">
                    <ul class="nav flex-column sub-menu" style="background: #fff !important; color: #052CA3 !important">
                        <li class="nav-item"> <a  style="background: #fff !important; color: #052CA3 !important" class="nav-link" href="{{ route('user.resell.orders') }}">Orders</a></li>
                    </ul>
                </div>
            </li> -->
            <li class="nav-item">
                <a @if (Session::get('page') == 'orders') style="background: #052CA3 !important; color: #FFF !important" @endif class="nav-link" href="{{ route('user.resell.orders') }}">
                <i class="icon-layout menu-icon"></i>
                    <span class="menu-title">Orders Management</span>
                </a>
            </li>
            <li class="nav-item">
                <a @if (Session::get('page') == 'payout') style="background: #052CA3 !important; color: #FFF !important" @endif class="nav-link" href="{{ route('payout.index') }}">
                <i class="icon-layout menu-icon"></i>
                    <span class="menu-title">Payout Requests</span>
                </a>
            </li>
            <li class="nav-item">
                <a @if (Session::get('page') == 'dispute') style="background: #052CA3 !important; color: #FFF !important" @endif class="nav-link" href="{{ route('get.dispute') }}">
                <i class="icon-layout menu-icon"></i>
                    <span class="menu-title">Disputes</span>
                </a>
                <div class="collapse" id="ui-vendors">
                    <ul class="nav flex-column sub-menu" style="background: #fff !important; color: #052CA3 !important">
                        <li class="nav-item"> <a @if (Session::get('page') == 'dispute') style="background: #052CA3 !important; color: #FFF !important" @else style="background: #fff !important; color: #052CA3 !important" @endif class="nav-link" href="{{ route('get.dispute') }}">Created Disputes</a></li>
                        <li class="nav-item"> <a @if (Session::get('page') == 'received_dispute') style="background: #052CA3 !important; color: #FFF !important" @else style="background: #fff !important; color: #052CA3 !important" @endif class="nav-link" href="{{ route('received.dispute') }}">Received Disputes</a></li>
                    </ul>
                </div>
            </li>
    </ul>
</nav>