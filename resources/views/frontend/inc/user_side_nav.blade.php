<style>
#account_box {
  position: -webkit-sticky;
  position: sticky;

}
</style>
<div class="aiz-user-sidenav-wrap position-relative z-1 shadow-sm">
    <div class="aiz-user-sidenav rounded overflow-auto c-scrollbar-light pb-5 pb-xl-0" id="account_box">
         <div class="p-4 text-xl-center mb-4 border-bottom  text-white position-relative">
             <h5 class="text-dark">My Account</h5>
            <span class="avatar avatar-md mb-3">
                @if (Auth::user()->avatar_original != null)
                    <img src="{{ uploaded_asset(Auth::user()->avatar_original) }}" onerror="this.onerror=null;this.src='{{ static_asset('assets/img/avatar-place.png') }}';">
                @else
                    <img src="{{ static_asset('assets/img/avatar-place.png') }}" class="image rounded-circle" onerror="this.onerror=null;this.src='{{ static_asset('assets/img/avatar-place.png') }}';">
                @endif
            </span>
            <h4 class="h5 fs-16 mb-1 text-dark fw-600">{{ Auth::user()->name }}</h4>
            @if(Auth::user()->phone != null)
                <div class="text-truncate text-dark opacity-60">{{ Auth::user()->phone }}</div>
            @else
                <div class="text-truncate text-dark opacity-60">{{ Auth::user()->email }}</div>
            @endif
        </div>

        <div class="sidemnenu mb-3">
            <ul class="aiz-side-nav-list px-2" data-toggle="aiz-side-menu">

                <li class="aiz-side-nav-item">
                    <a href="{{ route('dashboard') }}" class="aiz-side-nav-link {{ areActiveRoutes(['dashboard'])}}">

                        <span class="aiz-side-nav-text">{{ translate('Dashboard') }}</span>
                    </a>
                </li>


                    @if(get_setting('classified_product') == 1)
                        <li class="aiz-side-nav-item">
                            <a href="{{ route('selectCategory') }}" class="aiz-side-nav-link {{ areActiveRoutes(['customer_products.index', 'customer_products.create', 'customer_products.edit'])}}">

                                <span class="aiz-side-nav-text">{{ translate('Post Your Ads') }}</span>
                            </a>
                        </li>
                    @endif
                    <li class="aiz-side-nav-item">
                        <a href="{{ route('customer.all.products') }}" class="aiz-side-nav-link {{ areActiveRoutes(['customer_products.index', 'customer_products.create', 'customer_products.edit'])}}">


                            <span class="aiz-side-nav-text">{{ translate('See Your Products') }}</span>
                        </a>
                    </li>

                <li class="aiz-side-nav-item">
                    <a href="{{ route('profile') }}" class="aiz-side-nav-link {{ areActiveRoutes(['profile'])}}">

                        <span class="aiz-side-nav-text">{{translate('Manage Profile')}}</span>
                    </a>
                </li>

            </ul>
        </div>



    </div>


</div>

