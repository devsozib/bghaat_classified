@extends('frontend.layouts.app')
@section('meta')
    <!-- Schema.org markup for Google+ -->
    <meta itemprop="name" content="{{ $customer_product->meta_title }}">
    <meta itemprop="description" content="{{ $customer_product->meta_description }}">
    <meta itemprop="image" content="{{ uploaded_asset($customer_product->meta_img) }}">

    <!-- Twitter Card data -->
    <meta name="twitter:card" content="product">
    <meta name="twitter:site" content="@publisher_handle">
    <meta name="twitter:title" content="{{ $customer_product->meta_title }}">
    <meta name="twitter:description" content="{{ $customer_product->meta_description }}">
    <meta name="twitter:creator" content="@author_handle">
    <meta name="twitter:image" content="{{ uploaded_asset($customer_product->meta_img) }}">
    <meta name="twitter:data1" content="{{ single_price($customer_product->unit_price) }}">
    <meta name="twitter:label1" content="Price">

    <!-- Open Graph data -->
    <meta property="og:title" content="{{ $customer_product->meta_title }}" />
    <meta property="og:type" content="product" />
    <meta property="og:url" content="{{ route('product', $customer_product->slug) }}" />
    <meta property="og:image" content="{{ uploaded_asset($customer_product->meta_img) }}" />
    <meta property="og:description" content="{{ $customer_product->meta_description }}" />
    <meta property="og:site_name" content="{{ get_setting('meta_title') }}" />
    <meta property="og:price:amount" content="{{ single_price($customer_product->unit_price) }}" />
@endsection

@section('content')
<style>
    .sidebar .nav-link {
    font-weight: 500;
    color: var(--bs-dark);
}
.sidebar .nav-link:hover {
    background: var(--bs-light);
    color: var(--bs-primary);
}

ul li {
    list-style: none;
}
</style>
    <section class="mb-4 pt-3" >

        <div class="container" >

            <div class="shadow-sm rounded p-3" >
                <div class="row ">
                    <div class="col-lg-3 position-static d-none d-lg-block">


                            @include('frontend.partials.category_menu')


                    </div>

              <div class="bg-white col-xl-6 col-lg-6 col-md-12 mb-4" >

                        <h2 class="mb-2 fs-20 fw-700">
                            {{ $customer_product->getTranslation('name') }}
                        </h2>
                        <span style="color: #707676; font-weight:400">Posted on:{{ $customer_product->getTranslation('created_at') }},  {{ $customer_product->location }}</span>
                        <div class=" mt-2 z-3 row gutters-10">

                            @if($customer_product->photos != null)
                                @php
                                    $photos = explode(',',$customer_product->photos);
                                @endphp
                                <div class="col order-1 order-md-2">
                                    <div class="aiz-carousel product-gallery" data-nav-for='.product-gallery-thumb' data-fade='true'>
                                        @foreach ($photos as $key => $photo)
                                        <div class="carousel-box img-zoom rounded">
                                            <img style="width: 500px"
                                                class="img-fluid lazyload"
                                                src="{{ static_asset('assets/img/placeholder.jpg') }}"
                                                data-src="{{ uploaded_asset($photo) }}"
                                                onerror="this.onerror=null;this.src='{{ static_asset('assets/img/placeholder.jpg') }}';"
                                            >
                                        </div>
                                        @endforeach
                                    </div>
                                </div>
                                <div class="col-12 col-md-auto w-md-80px order-2 order-md-1 mt-3 mt-md-0">
                                    <div class="aiz-carousel product-gallery-thumb" data-items='5' data-nav-for='.product-gallery' data-vertical='true' data-vertical-sm='false' data-focus-select='true'>
                                        @foreach ($photos as $key => $photo)
                                        <div class="carousel-box c-pointer  p-1 rounded">
                                            <img
                                                class="lazyload mw-100 size-43px mx-auto"
                                                src="{{ static_asset('assets/img/placeholder.jpg') }}"
                                                data-src="{{ uploaded_asset($photo) }}"
                                                onerror="this.onerror=null;this.src='{{ static_asset('assets/img/placeholder.jpg') }}';"
                                            >
                                        </div>
                                        @endforeach
                                    </div>
                                </div>
                            @endif
                        </div>
                        <div class="row no-gutters mt-3 ">

                            <div class="col-10">
                                <div class="">
                                    <strong class="h5 fw-600 text-primary">
                                        Price:
                                        {{ single_price($customer_product->unit_price) }}
                                    </strong>
                                    @if($customer_product->unit != null || $customer_product->unit != '')
                                        <span class="opacity-70">/{{ $customer_product->getTranslation('unit') }}</span>
                                    @endif
                                    @if ($customer_product->negotiable == 1)
                                       <small class=""><b>Negotiable</b></small>
                                    @endif

                                </div>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-md-6">
                                @if ($customer_product->conditon)
                                    <span class="p text-secondary text-uppercase">Condition: {{ $customer_product->conditon }} </span><br><br>
                                @endif
                                @if ($customer_product->authenticity)
                                    <span class="p text-secondary text-uppercase">Authenticity: {{ $customer_product->authenticity }} </span>
                                @endif

                                @if ($customer_product->manufacture_year)
                                    <span class="p text-secondary text-uppercase">Manufature Year: {{ $customer_product->manufacture_year }} </span><br>
                                @endif
                                @if ($customer_product->run_kilometers)
                                     <span class="p text-secondary text-uppercase">Run Kilometers: {{ $customer_product->run_kilometers }} </span><br>
                                @endif

                                @if ($customer_product->registration_year)
                                    <span class="p text-secondary text-uppercase">Registration Year: {{ $customer_product->registration_year }} </span><br>
                                @endif
                                @if ($customer_product->bathrooms)
                                     <span class="p text-secondary text-uppercase">Bathrooms: {{ $customer_product->bathrooms }} </span><br/>
                                @endif
                                 @if ($customer_product->completion_status)
                                 @if ( $customer_product->completion_status== "on_going")
                                     <span class="p text-secondary text-uppercase">Completation Status: On Going

                                </span>
                                  @else
                                     <span class="p text-secondary text-uppercase">Completation Status: Ready

                                </span><br>
                                 @endif

                                 @endif

                            </div>

                            <div class="col-md-6">
                                 @if ($customer_product->brand_id)
                                    <span class="p text-secondary text-uppercase">Brand: {{       $customer_product->brand->name}} </span>
                                 @endif
                                 @if ($customer_product->engine_capacity)
                                      <span class="p text-secondary text-uppercase">Engine Capacity: {{       $customer_product->engine_capacity}} </span>
                                 @endif
                                 @if ($customer_product->transmission)
                                    <span class="p text-secondary text-uppercase">Transmission: {{       $customer_product->transmission}} </span>
                                 @endif
                                 @if ($customer_product->body_type)
                                     <span class="p text-secondary text-uppercase">Body Type: {{ $customer_product->body_type }} </span><br>
                                 @endif
                                 @if ($customer_product->bedrooms)
                                      <span class="p text-secondary text-uppercase">Bedrooms: {{ $customer_product->bedrooms }} </span><br>
                                 @endif

                                 @if ($customer_product->size_sqft)
                                    <span class="p text-secondary text-uppercase">Size: {{ $customer_product->size_sqft }} @if($customer_product->unit != null || $customer_product->unit != '')
                                    <span class="opacity-70">/{{ $customer_product->getTranslation('unit') }}</span>@endif
                                    </span><br>
                                 @endif
                                 @if ($customer_product->facing)
                                     <span class="p text-secondary text-uppercase">Facing: {{ $customer_product->facing }} </span><br>
                                 @endif
                                 @if ($customer_product->land_size)
                                    <span class="p text-secondary text-uppercase">Land Size: {{ $customer_product->land_size }} {{ $customer_product->land_size_unit }}</span><br>
                                 @endif

                                 @if ($customer_product->house_size)
                                      <span class="p text-secondary text-uppercase">House Size: {{       $customer_product->house_size}} {{ $customer_product->land_size_unit }}</span><br>
                                 @endif
                            </div>
                        </div>

                        <div class="features mt-3">
                            @if($customer_product->features)

                                    <strong class="fw-bold">Features:-</strong>
                                    <div class="row">
                                        <div class="col-md-8">
                                            <p>{{ $customer_product->features }}</p>
                                        </div>
                                        <div class="col-md-4">

                                    </div>
                                    </div>
                            @endif

                        </div>

                        <div class="features mt-3">
                         @if($customer_product->fuel_type)

                                    <strong class="fw-bold">Fuel Type:-</strong>
                                    <div class="row">
                                        <div class="col-md-8">
                                            <p>{{ $customer_product->fuel_type }}</p>
                                        </div>
                                        <div class="col-md-4">

                                    </div>
                                    </div>
                          @endif

                        </div>
                        <div class="features mt-3">
                            @if($customer_product->more_info)

                                    <strong class="fw-bold">More Information:-</strong>
                                    <div class="row">
                                        <div class="col-md-8">
                                            <p>{{ $customer_product->more_info }}</p>
                                        </div>
                                        <div class="col-md-4">

                                    </div>
                                    </div>
                            @endif

                        </div>

                        <section class="mb-4">
                            <div class="container-fulid">
                                <div class="bg-white mb-3 shadow-sm rounded">
                                    <div class="nav border-bottom aiz-nav-tabs">
                                        <a href="#tab_default_1" data-toggle="tab" class="p-3 fs-16 fw-600 text-reset active show">{{ translate('Description')}}</a>

                                    </div>

                                    <div class="tab-content pt-0">
                                        <div class="tab-pane active show" id="tab_default_1">
                                            <div class="p-4">
                                                <div class="mw-100 overflow-hidden text-left">
                                                    <?php echo $customer_product->getTranslation('description'); ?>
                                                </div>
                                            </div>
                                        </div>


                                    </div>
                                </div>
                            </div>
                        </section>


 </div>

                    <div class="col-xl-3 col-lg-3 col-md-12 float-right">
                        <div class="text-left">


                          <div class="posted-by">
                              <h6 class="text-secondary">Posted By</h6>
                          </div>

                            <ul class="list-group rounded mt-5">


                                            @if ($customer_product->user->avatar_original != null)
                                            <img src="{{ uploaded_asset($customer_product->user->avatar_original) }}" class="image rounded-circle" >
                                            @else
                                            <img style="width: 50px; margin:auto" src="{{ static_asset('assets/img/avatar-place.png') }}" class="image rounded-circle" onerror="this.onerror=null;this.src='{{ static_asset('assets/img/avatar-place.png') }}';">
                                            @endif




                                    </span>
                                     <div class="text-center fs-17 fw-600">
                                            {{ $customer_product->user->name }}
                                        </div>
                                <div class="contact-info" style="border-radius:10px;">


                                <li class="list-group-item">
                                    <h5 class="fs-12">Contact Info</h5>

                                </li>
                                <li class="list-group-item">
                                    <div class="d-flex">
                                        <span class="d-flex align-items-center justify-content-center rounded-circle size-30px bg-soft-secondary mr-2">
                                            <i class="la la-map-marker fs-14"></i>
                                        </span>
                                        <div class="flex-grow-1 fs-12 fw-600">
                                            {{ $customer_product->location }}
                                        </div>
                                    </div>
                                </li>



                                <li class="list-group-item c-pointer" onclick="show_number(this)">
                                    <div class="d-flex">
                                        <span class="d-flex align-items-center justify-content-center rounded-circle size-30px bg-primary text-white mr-2">
                                            <i class="la la-phone fs-18"></i>
                                        </span>
                                        <div class="flex-grow-1">
                                            <h3 class="h5 fw-700 mb-0">
                                                <span class="dummy">{{ str_replace(substr($customer_product->phone,5),'XXXXXXXX', $customer_product->phone) }}</span>
                                                <span class="real d-none">{{ $customer_product->phone}}</span>
                                            </h3>
                                            <p class="mb-0 opacity-50">{{ translate('Click to show phone number') }}</p>

                                    </div>
                                </li>
                                <li class="list-group-item">
                                    <div class="d-flex">
                                        <span class="d-flex align-items-center justify-content-center rounded-circle size-30px bg-primary text-white mr-2">
                                            <i class="las la-comment-alt"></i>
                                        </span>

                                        <div class="flex-grow-1 fs-12 fw-600">
                                             Chat
                                        </div>
                                    </div>
                                </li>

                                                     </div>
                            </ul>

                            <div class="row no-gutters mt-5">
                                <div class="col-2">
                                    <div class="opacity-50 mt-2">{{ translate('Share')}}:</div>
                                </div>
                                <div class="col-10">
                                    <div class="aiz-share"></div>
                                </div>
                            </div>
                        </div>

                            @if (get_setting('home_banner2_images') != null)

                    {{-- Banner Section 2 --}}

                    <div class="mb-4">


                                @php $banner_2_imags = json_decode(get_setting('home_banner2_images')); @endphp
                                @foreach ($banner_2_imags as $key => $value)
                                    <div class="col-xl-12 col-md-6">
                                        <div class="mb-3 mb-lg-0 py-4">
                                            <a href="{{ json_decode(get_setting('home_banner2_links'), true)[$key] }}"
                                                class="d-block text-reset">
                                                <img src="{{ static_asset('assets/img/placeholder-rect.jpg') }}"
                                                    data-src="{{ uploaded_asset($banner_2_imags[$key]) }}"
                                                    alt="{{ env('APP_NAME') }} promo"
                                                    class="img-fluid lazyload w-100">
                                            </a>
                                        </div>
                                    </div>
                                @endforeach




                </div>
            @endif
                    </div>

                    <section class="mb-4" >
                        <div class="container ml-auto">
                           <div class="bg-white shadow-sm rounded">
                                <div class="d-flex mb-3 align-items-baseline border-bottom px-3 py-2">
                                    <h3 class="fs-16 fw-600 mb-0">
                                        {{ translate('Other Ads of') }} {{$customer_product->category->getTranslation('name') }}
                                    </h3>
                                    <a href="{{ route('customer_products.category', $customer_product->category->slug) }}" class="ml-auto mr-0 btn btn-primary btn-sm shadow-md">{{ translate('Related Ads') }}</a>
                                </div>
                                <div class="p-3">
                                    <div class="aiz-carousel gutters-2 half-outside-arrow" data-items="4" data-xl-items="4" data-lg-items="4"  data-md-items="2" data-sm-items="2" data-xs-items="2" data-arrows='true' data-infinite='false'>
                                        @php
                                            $products = \App\Models\CustomerProduct::where('category_id', $customer_product->category_id)->where('id', '!=', $customer_product->id)->where('status', '1')->where('published', '1')->limit(10)->get();
                                        @endphp
                                        @foreach ($products as $key => $product)
                                        <div class="carousel-box">
                                            <div class="aiz-card-box border border-light rounded hov-shadow-md my-2 has-transition">
                                                <div class="position-relative">
                                                    <a href="{{ route('customer.product', $product->slug) }}" class="d-block">
                                                        <img
                                                            class="img-fit lazyload mx-auto h-140px h-md-210px"
                                                            src="{{ static_asset('assets/img/placeholder.jpg') }}"
                                                            data-src="{{ uploaded_asset($product->photos) }}"
                                                            alt="{{  $product->getTranslation('name')  }}"
                                                            onerror="this.onerror=null;this.src='{{ static_asset('assets/img/placeholder.jpg') }}';"
                                                        >
                                                    </a>
                                                    <div class="absolute-top-left pt-2 pl-2">
                                                        @if($product->conditon == 'new')
                                                           <span class="badge badge-inline badge-success">{{translate('new')}}</span>
                                                       @elseif($product->conditon == 'used')
                                                           <span class="badge badge-inline badge-danger">{{translate('Used')}}</span>
                                                       @endif
                                                    </div>
                                                </div>
                                                <div class="p-md-3 p-2 text-left">
                                                    <div class="fs-15 mb-1">
                                                        <span class="fw-700 text-secondary">{{ single_price($product->unit_price) }}</span>
                                                    </div>
                                                    <h3 class="fw-600 fs-13 text-truncate-2 lh-1-4 mb-0 h-35px">
                                                        <a href="{{ route('customer.product', $product->slug) }}" class="d-block text-reset">{{  $product->getTranslation('name')  }}</a>
                                                    </h3>
                                                </div>
                                           </div>
                                        </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                </div>
            </div>
        </div>
    </section>

<script type="text/javascript">
    function show_number(el){
            $(el).find('.dummy').addClass('d-none');
            $(el).find('.real').removeClass('d-none').addClass('d-block');
        }
</script>



@endsection


