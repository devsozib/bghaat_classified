
<link rel='stylesheet' id='pacz-styles-css'  href='{{ static_asset('assets/css/pacz-styles.css') }}' type='text/css' media='all' />

<link rel='stylesheet' id='theme-options-css'  href='{{ static_asset('assets/css/classiadspro-dynamic.css') }}' type='text/css' media='all' />
<style>
    .input-group.serach-form.mt-2 {
    width: 400px;
}
</style>
<!-- END Top Bar -->

{{-- <header class="@if(get_setting('header_stikcy') == 'on') sticky-top @endif z-1020 border-bottom shadow-sm" style="background-color:#272727!important">
    <div class="position-relative logo-bar-area z-1">
        <div class="container">
            <div class="d-flex align-items-center">

                <div class="col-auto col-xl-3 pl-0 pr-3 d-flex align-items-center">
                    <a class="d-block py-2 mr-5 ml-0" href="{{ route('home') }}">
                        <strong> <h5 style="color:#fff">BGHaat</h5> </strong>



                </div>
                <div class="d-lg-none  mr-0">
                    <a class="p-2 d-block text-reset " style="margin-top:-10px;" href="javascript:void(0);" data-toggle="class-toggle" data-target=".front-header-search">
                        <i class="las la-search la-flip-horizontal " style="font-size:16px; margin-left: -10px; color:#fff"></i>
                    </a>
                </div>

                <div class="flex-grow-1 front-header-search d-flex align-items-center" style="background-color:#272727!important">
                    <div class="position-relative flex-grow-1 ">
                        <form action="{{ route('search') }}" method="GET" class="stop-propagation">
                            <div class="d-flex position-relative align-items-center">
                                <div class="d-lg-none" data-toggle="class-toggle" data-target=".front-header-search">
                                    <button class="btn px-2" type="button"><i class="la la-2x la-long-arrow-left"></i></button>
                                </div>
                                <div class="input-group serach-form mt-2">
                                    <input type="text" class=" form-control" id="search" name="query"  placeholder="{{translate('What are you looking for?')}}" value="{{ isset($old_query)? $old_query: "" }}">
                                    <div class=" ">
                                        <button class="btn" style="margin-left:-50px;" type="submit">
                                            <i class="la la-search la-flip-horizontal fs-18"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </form>

                    </div>
                </div>

                <div class="d-none d-lg-none  mr-0">
                    <div class="nav-search-box">
                        <a href="#" class="nav-box-link">
                            <i class="la la-search la-flip-horizontal d-inline-block nav-box-icon"></i>
                        </a>
                    </div>
                </div>




                    <ul class="list-inline page-bar mb-0 h-100  d-flex justify-content-end align-items-center">
                        @if (get_setting('helpline_number'))
                            <li class="list-inline-item mr-3 border-right border-left-0 pr-3 pl-0">
                                <a href="tel:{{ get_setting('helpline_number') }}" class="text-reset d-inline-block opacity-60 py-2">
                                    <i class="la la-phone"></i>
                                    <span>{{ translate('Help line')}}</span>
                                    <span>{{ get_setting('helpline_number') }}</span>
                                </a>
                            </li>
                        @endif
                        @auth
                            @if(isAdmin())
                                <li class="list-inline-item mr-3 border-right border-left-0 pr-3 pl-0">
                                    <a href="{{ route('admin.dashboard') }}" class="text-reset d-inline-block opacity-60 py-2">{{ translate('My Panel')}}</a>
                                </li>
                            @else



                                <li class="jiu">

                                    <a class="btn btn-sm" style="color:#fff" href="{{ route('selectCategory') }}"><i class="las la-cloud-upload-alt"></i>Post Ads</a>
                                </li>
                                <li class="list-inline-item mr-3 border-right border-left-0 pr-3 pl-0">
                                    <a href="{{ route('dashboard') }}"  style="color:#fff!important" class="text-reset d-inline-block opacity-60 py-2">{{ translate('Account')}}</a>
                                </li>
                            @endif
                            <li class="list-inline-item">
                                <a href="{{ route('logout') }}"  style="color:#fff!important" class="text-reset d-inline-block opacity-60 py-2">{{ translate('Logout')}}</a>
                            </li>
                        @else
                            <li class="jiu">

                                <a class="btn btn-sm" style="color:#fff" href="{{ route('selectCategory') }}"><i class="las la-cloud-upload-alt"></i>Post Ads</a>
                            </li>
                            <li class="list-inline-item mr-3 border-right border-left-0 pr-3 pl-0">
                                <a  style="color:#fff!important" href="{{ route('user.login') }}" class="text-reset d-inline-block opacity-60 py-2">{{ translate('Login')}}</a>
                            </li>
                            <li class="list-inline-item">
                                <a  style="color:#fff!important" href="{{ route('user.registration') }}" class="text-reset d-inline-block opacity-60 py-2">{{ translate('Registration')}}</a>
                            </li>
                        @endauth
                    </ul>


            </div>
        </div>
        @if(Route::currentRouteName() != 'home')
        <div class="hover-category-menu position-absolute w-100 top-100 left-0 right-0 d-none z-3" id="hover-category-menu">
            <div class="container">
                <div class="row gutters-10 position-relative">
                    <div class="col-lg-3 position-static">
                        @include('frontend.partials.category_menu')
                    </div>
                </div>
            </div>
        </div>
        @endif
    </div>
    @if ( get_setting('header_menu_labels') !=  null )
        <div class="bg-white border-top border-gray-200 py-1">
            <div class="container">
                <ul class="list-inline mb-0 pl-0 mobile-hor-swipe text-center">
                    @foreach (json_decode( get_setting('header_menu_labels'), true) as $key => $value)
                    <li class="list-inline-item mr-0">
                        <a href="{{ json_decode( get_setting('header_menu_links'), true)[$key] }}" class="opacity-60 fs-14 px-3 py-2 d-inline-block fw-600 hov-opacity-100 text-reset">
                            {{ translate($value) }}
                        </a>
                    </li>
                    @endforeach
                </ul>
            </div>
        </div>
    @endif
</header> --}}
	<header id="pacz-header" class="block-header boxed-header header-style-v11 header-align-left header-structure-standard header-hover-style- put-header-top 0 header_grid_margin  theme-main-header pacz-header-module" data-header-style="block" data-header-structure="standard" data-transparent-skin="dark" data-height="103" data-sticky-height="103"><div class="pacz-header-mainnavbar"><div class="pacz-grid clearfix"><nav id="pacz-main-navigation" class="clearfix">
        <ul id="menu-main" class="main-navigation-ul clearfix">
        <li class="list-inline-item mt-2">
            <div class="d-lg-none mr-0" style="margin-top: 45px;">
                <a class="p-2 d-block text-reset " style="margin-top:-10px;" href="javascript:void(0);" data-toggle="class-toggle" data-target=".front-header-search">
                    <i class="las la-search la-flip-horizontal "></i>
                </a>
            </div>

            <div class=" front-header-search d-flex align-items-center">
                <div class="position-relative  ">
                    <form action="{{ route('search') }}" method="GET" class="stop-propagation mt-3">

                        <div class="d-flex position-relative align-items-center">
                            <div class="d-lg-none" data-toggle="class-toggle" data-target=".front-header-search">
                                <button class="btn px-2" type="button"><i class="la la-2x la-long-arrow-left"></i></button>
                            </div>
                            <div class="input-group serach-form mt-2" >
                                <input type="text" class=" form-control" id="search" name="query"  placeholder="{{translate('What are you looking for?')}}" value="{{ isset($old_query)? $old_query: "" }}">
                                <div class=" ">
                                    <button class="btn" style="margin-left:-50px; margin-top:5px" type="submit">
                                        <i class="la la-search la-flip-horizontal fs-18"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>

                    <div id="suggest-ads">

                    </div>

                </div>
            </div>

            <div class="d-none d-lg-none  mr-0 ">
                <div class="nav-search-box">
                    <a href="#" class="nav-box-link">
                        <i class="la la-search la-flip-horizontal d-inline-block nav-box-icon"></i>
                    </a>
                </div>
            </div>


		</li>
        <li class="pacz-header-logo"><a href="{{ route('home') }}" title="Best Classified WordPress Theme"><img alt="Best Classified WordPress Theme" class="pacz-dark-logo" src="{{ static_asset('assets/img/logo.jpg') }}" data-retina-src="{{ static_asset('assets/img/logo.jpg') }}" /><img alt="Best Classified Website" class="pacz-transparent-logo" src="{{ static_asset('assets/img/logo.jpg') }}" data-retina-src="{{ static_asset('assets/img/logo.jpg') }}" /></a></li>

        @auth
        @if(isAdmin())
        <li class="logreg-header right"><i class="pacz-flaticon-user73"></i><span class="pacz-login-2-div">&#047;</span><a class="pacz-register-2" href="{{ route('admin.dashboard') }}">My Panel</a></li>
        @else
            <li class="desktop listing-btn "><a class="submit-listing-button-single btn btn-primary" href="{{ route('selectCategory') }}" rel="nofollow"><span>Post Your Ad</span></a><a class="submit-listing-button-single" href="{{ route('selectCategory') }}" rel="nofollow"><i class="fas fa-plus d-lg-none"></i></a>

                <a class="pacz-register-2" href="{{ route('dashboard') }}">Account</a>
            </li>

        @endif
        <li class="list-inline-item right">
            <a class="pacz-login-2 clearfix" href="{{ route('logout') }}">Logout</a>
        </li>
        @else


        <li class="logreg-header right"><i class="las la-user"></i><a class="pacz-login-2 clearfix" href="{{ route('user.login') }}">login</a><span class="pacz-login-2-div">&#047;</span><a class="pacz-register-2" href="{{ route('user.registration') }}">Register</a></li>
        <li class="desktop listing-btn right"><a class="submit-listing-button-single btn btn-primary" href="{{ route('selectCategory') }}" rel="nofollow"><span>Post Your Ad</span></a><a class="submit-listing-button-single" href="{{ route('selectCategory') }}" rel="nofollow"><i class="fas fa-plus"></i></a></li>
        @endauth


</ul>
</nav>
</div>
</div>
</header>
<style>
    .mobile-hor-swipe{
        display: none;
    }
</style>
