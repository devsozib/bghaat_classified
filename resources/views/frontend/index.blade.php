<?php
 use App\Models\CustomerProduct;
 use App\Models\Category;
?>
@extends('frontend.layouts.app')

@section('content')



    {{-- Categories , Sliders . Today's deal --}}
    <div class="home-banner-area mb-4 pt-3">
        <div class="container">
            <div class="row gutters-10 position-relative">

                    <div class="col-lg-2 position-static d-none d-lg-block">
                        @include('frontend.partials.category_menu')
                    </div>



                @php
                    $num_todays_deal = count($todays_deal_products);
                @endphp

                <div class="@if($num_todays_deal > 0) col-lg-10 @else col-lg-10 @endif">
                    @if (get_setting('home_slider_images') != null)
                        <div class="aiz-carousel dots-inside-bottom mobile-img-auto-height" data-arrows="true" data-dots="true" data-autoplay="true">
                            @php $slider_images = json_decode(get_setting('home_slider_images'), true);  @endphp
                            @foreach ($slider_images as $key => $value)
                                <div class="carousel-box">
                                    <a href="{{ json_decode(get_setting('home_slider_links'), true)[$key] }}">
                                        <img
                                            class="d-block mw-100 img-fit rounded shadow-sm overflow-hidden"
                                            src="{{ uploaded_asset($slider_images[$key]) }}"
                                            alt="{{ env('APP_NAME')}} promo"
                                            @if(count($featured_categories) == 0)
                                            height="457"
                                            @else
                                            height="315"
                                            @endif
                                            onerror="this.onerror=null;this.src='{{ static_asset('assets/img/placeholder-rect.jpg') }}';"
                                        >
                                    </a>
                                </div>
                            @endforeach
                        </div>
                    @endif

                    @if (get_setting('home_banner1_images') != null)
                    <div class="mb-4">

                            <div class="row gutters-10">
                                @php $banner_1_imags = json_decode(get_setting('home_banner1_images')); @endphp
                                @foreach ($banner_1_imags as $key => $value)
                                    <div class="col-6">
                                        <div class="mb-3 mb-lg-0">
                                            <a href="{{ json_decode(get_setting('home_banner1_links'), true)[$key] }}" class="d-block text-reset">
                                                <img src="{{ static_asset('assets/img/placeholder-rect.jpg') }}" data-src="{{ uploaded_asset($banner_1_imags[$key]) }}" alt="{{ env('APP_NAME') }} promo" class="img-fluid lazyload w-100">
                                            </a>
                                        </div>
                                    </div>
                                @endforeach

                        </div>
                    </div>
                    @endif

                    <div class="container-fluid">
                        <section>
                          <div class="row">
                            <div class="col-12 mt-3 mb-1">
                              <h5 class="text-uppercase text-center">Browse items by category
                            </h5>

                            </div>
                          </div>
                          <div class="row  gutters-10">
                            @foreach (Category::where('level', 0)->where('featured',1)->limit(8)->get() as $category)
                            @php
                             $productCount =CustomerProduct::where('category_id',$category->id)->count();
                           @endphp
                           <style>
                                .cat_items:hover{
                                    transform: translateY(-7px);
                                    transition: all 1s ease;
                                    box-shadow: 0 0 30px rgb(0 0 0 / 25%);
}

                           </style>
                            <div class="col-md-3 col-6 ">
                              <div class="card rounded cat_items"  style="height:120px;">
                                <div class="card-body">
                                  <div class=" justify-content-between px-md-1">
                                    <div class="align-self-center text-center">
                                        <a href="{{ route('customer_products.category', $category->slug) }}">
                                        <img style="width:70px;height:70px;" src="{{ uploaded_asset($category->banner) }}" alt="">

                                        </a>
                                    </div>
                                    <div class="col-sm-t text-center" >
                                    <a href="{{ route('customer_products.category', $category->slug) }}"> <p class="">{{ $category->name }}({{ $productCount  }} Ads)</p></a>

                                    </div>
                                  </div>
                                </div>
                              </div>
                            </div>

                           @endforeach

                          </div>

                        </section>
                      </div>
                </div>




            </div>
        </div>
    </div>







    {{-- Customer Ads Section --}}
<div id="section_featured" >
<section class="">
    <div class="container">
        <div class="row">
            <div class="col-lg-2 px-2  px-md-4 py-md-3  shadow-sm rounded">

            </div>
            <div class="col-lg-7">
                <div class="px-2  px-md-4 py-md-3  shadow-sm rounded ">
                    <div class="d-flex mb-3 align-items-baseline border-bottom">

                    </div>

                    <div class="row gutters-5 ">
                        @foreach ($classified_products as $key => $classified_product)
                                    <div class="col-lg-12 col-md-12 m-auto">
                                        <div class="d-flex  ">
                                            <div class="media ">
                                                <div class="absolute-top-left pt-2 pl-2 mt-3">
                                                    @if ($classified_product->conditon == 'new')
                                                        <span
                                                            class="badge badge-inline badge-success">{{ translate('new') }}</span>
                                                    @elseif($classified_product->conditon == 'used')
                                                        <span
                                                            class="badge badge-inline badge-danger">{{ translate('Used') }}</span>
                                                    @endif
                                                </div>
                                                <a href="{{ route('customer.product', $classified_product->slug) }}"><img style="width: 150px"
                                                    src="{{ uploaded_asset($classified_product->photos) }}"
                                                    class="mr-3 " alt=""></a>

                                                <div class="media-body py-2">
                                                    <a
                                                        href="{{ route('customer.product', $classified_product->slug) }}">
                                                        <h4 class="mt-0">
                                                            {{ $classified_product->name }}</h4>
                                                    </a>
                                                    <p>{{ single_price($classified_product->unit_price) }}@if($classified_product->unit != null || $classified_product->unit != '')
                                                        <span class="opacity-70">/{{ $classified_product->getTranslation('unit') }}</span>
                                                    @endif</p>
                                                    <strong class="text-muted">{{ $classified_product->location }}</strong>

                                                </div>
                                                <p class="post-time">{{ $classified_product->created_at->diffForHumans() }}</p>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach

                             <div class="paginate mt-3">
                                    {{$classified_products->links()  }}
                             </div>



                    </div>
                </div>
            </div>
            @if (get_setting('home_banner2_images') != null)
                <div class="col-lg-3 px-2 py-4 px-md-4 py-md-3 bg-white shadow-sm rounded">
                    {{-- Banner Section 2 --}}

                    <div class="mb-4">
                        <div class="container">
                            <div class="row gutters-10">
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
                        </div>
                    </div>

                </div>
            @endif

        </div>

    </div>
</section>



    </div>






    {{-- Banner Section 2 --}}
    @if (get_setting('home_banner3_images') != null)
    <div class="mb-4">
        <div class="container">
            <div class="row gutters-10">
                @php $banner_3_imags = json_decode(get_setting('home_banner3_images')); @endphp
                @foreach ($banner_3_imags as $key => $value)
                    <div class="col-xl col-md-6">
                        <div class="mb-3 mb-lg-0">
                            <a href="{{ json_decode(get_setting('home_banner3_links'), true)[$key] }}" class="d-block text-reset">
                                <img src="{{ static_asset('assets/img/placeholder-rect.jpg') }}" data-src="{{ uploaded_asset($banner_3_imags[$key]) }}" alt="{{ env('APP_NAME') }} promo" class="img-fluid lazyload w-100">
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    @endif



@endsection

@section('script')
    <script>
        $(document).ready(function(){
            $.post('{{ route('home.section.featured') }}', {_token:'{{ csrf_token() }}'}, function(data){
                $('#section_featured').html(data);
                AIZ.plugins.slickCarousel();
            });
            $.post('{{ route('home.section.best_selling') }}', {_token:'{{ csrf_token() }}'}, function(data){
                $('#section_best_selling').html(data);
                AIZ.plugins.slickCarousel();
            });
            $.post('{{ route('home.section.auction_products') }}', {_token:'{{ csrf_token() }}'}, function(data){
                $('#auction_products').html(data);
                AIZ.plugins.slickCarousel();
            });
            $.post('{{ route('home.section.home_categories') }}', {_token:'{{ csrf_token() }}'}, function(data){
                $('#section_home_categories').html(data);
                AIZ.plugins.slickCarousel();
            });
            $.post('{{ route('home.section.best_sellers') }}', {_token:'{{ csrf_token() }}'}, function(data){
                $('#section_best_sellers').html(data);
                AIZ.plugins.slickCarousel();
            });
        });
    </script>
@endsection
