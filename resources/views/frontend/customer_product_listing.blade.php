<?php
 use App\Models\CustomerProduct;
 use App\Models\Category;
 use App\Models\Brand;
 use App\Utility\CategoryUtility;
 use App\Models\State;
?>

@extends('frontend.layouts.app')

@if (isset($category_id))
    @php
        $meta_title = Category::find($category_id)->meta_title;
        $meta_description = Category::find($category_id)->meta_description;
    @endphp
@elseif (isset($brand_id))
    @php
        $meta_title = Brand::find($brand_id)->meta_title;
        $meta_description = Brand::find($brand_id)->meta_description;
    @endphp
@else
    @php
        $meta_title         = get_setting('meta_title');
        $meta_description   = get_setting('meta_description');
    @endphp
@endif

@section('meta_title'){{ $meta_title }}@stop
@section('meta_description'){{ $meta_description }}@stop

@section('meta')
    <!-- Schema.org markup for Google+ -->
    <meta itemprop="name" content="{{ $meta_title }}">
    <meta itemprop="description" content="{{ $meta_description }}">

    <!-- Twitter Card data -->
    <meta name="twitter:title" content="{{ $meta_title }}">
    <meta name="twitter:description" content="{{ $meta_description }}">

    <!-- Open Graph data -->
    <meta property="og:title" content="{{ $meta_title }}" />
    <meta property="og:description" content="{{ $meta_description }}" />
@endsection

@section('content')


    <section class="mb-4 pt-3">
        <div class="container sm-px-0">
            <form class="" id="search-form" action="" method="GET">
                <div class="row">
                    <div class="col-xl-3 side-filter d-xl-block">
                        <div class="aiz-filter-sidebar collapse-sidebar-wrap sidebar-xl sidebar-right z-1035">
                            <div class="overlay overlay-fixed dark c-pointer" data-toggle="class-toggle" data-target=".aiz-filter-sidebar" data-same=".filter-sidebar-thumb"></div>
                            <div class="collapse-sidebar c-scrollbar-light text-left">
                                <div class="d-flex d-xl-none justify-content-between align-items-center pl-3 border-bottom">
                                    <h3 class="h6 mb-0 fw-600">{{ translate('Filters') }}</h3>
                                    <button type="button" class="btn btn-sm p-2 filter-sidebar-thumb" data-toggle="class-toggle" data-target=".aiz-filter-sidebar" type="button">
                                        <i class="las la-times la-2x"></i>
                                    </button>
                                </div>
                                <div class="bg-white shadow-sm rounded mb-3 text-left">
                                    <div class="fs-15 fw-600 p-3 border-bottom">
                                        {{ translate('By Categories')}}
                                    </div>
                                    <div class="p-3">
                                        <ul class="list-unstyled">
                                            @if (!isset($category_id))
                                                @foreach (Category::where('level', 0)->get() as $category)
                                                @php
                                                $productCount =CustomerProduct::where('category_id',$category->id)->count();
                                                @endphp
                                                    <li class="mb-2 ml-2">
                                                        <a class="text-reset fs-14" href="{{ route('customer_products.category', $category->slug) }}">{{ $category->getTranslation('name') }}({{ $productCount  }})</a>
                                                    </li>
                                                @endforeach
                                            @else
                                                <li class="mb-2">
                                                    <a class="text-reset fs-14 fw-600" href="{{ route('customer.products') }}">
                                                        <i class="las la-angle-left"></i>
                                                        {{ translate('All Categories')}}
                                                    </a>
                                                </li>
                                                @if (Category::find($category_id)->parent_id != 0)
                                                    <li class="mb-2">
                                                        <a class="text-reset fs-14 fw-600" href="{{ route('customer_products.category', Category::find(Category::find($category_id)->parent_id)->slug) }}">
                                                            <i class="las la-angle-left"></i>
                                                            {{ Category::find(Category::find($category_id)->parent_id)->getTranslation('name') }}
                                                        </a>
                                                    </li>
                                                @endif
                                                <li class="mb-2">
                                                    <a class="text-reset fs-14 fw-600" href="{{ route('customer_products.category', Category::find($category_id)->slug) }}">
                                                        <i class="las la-angle-left"></i>
                                                        {{Category::find($category_id)->getTranslation('name') }}
                                                    </a>
                                                </li>
                                                @foreach (CategoryUtility::get_immediate_children_ids($category_id) as $key => $id)
                                                    <li class="ml-4 mb-2">
                                                        <a class="text-reset fs-14" href="{{ route('customer_products.category', Category::find($id)->slug) }}">{{Category::find($id)->getTranslation('name') }}</a>
                                                    </li>
                                                @endforeach
                                            @endif
                                        </ul>
                                    </div>
                                </div>


                                <div class="bg-white shadow-sm rounded mb-3 text-left">
                                    <div class="fs-15 fw-600 p-3 border-bottom">
                                        <i class="las la-map-marker"></i>
                                        {{ translate('All Of Bangladesh')}}
                                    </div>
                                    <div class="p-3">
                                        <ul class="list-unstyled">
                                               @foreach (State::orderBy('name','asc')->where('status', 1)->get() as $state)
                                               @php
                                                 $stateProductCount =CustomerProduct::where('state_id',$state->id)->count();
                                                @endphp
                                                <li class="mb-2">
                                                    <a href="{{ route('customer_products.state', $state->id) }}">{{ $state->name }}({{ $stateProductCount }})</a>
                                                </li>
                                                @endforeach


                                        </ul>
                                    </div>
                                </div>

                                @isset($category_id)
                                <input type="hidden" name="category" value="{{Category::find($category_id)->slug }}">
                            @endisset
                            <div class="text-left">
                                <div class="">
                                    <div class="form-group">
                                        <label class="mb-0 opacity-50">{{ translate('Sort by')}}</label>
                                        <select class="form-control form-control-sm aiz-selectpicker" name="sort_by" onchange="filter()">
                                            <option value="1" @isset($sort_by) @if ($sort_by == '1') selected @endif @endisset>{{ translate('Newest')}}</option>
                                            <option value="2" @isset($sort_by) @if ($sort_by == '2') selected @endif @endisset>{{ translate('Oldest')}}</option>
                                            <option value="3" @isset($sort_by) @if ($sort_by == '3') selected @endif @endisset>{{ translate('Price low to high')}}</option>
                                            <option value="4" @isset($sort_by) @if ($sort_by == '4') selected @endif @endisset>{{ translate('Price high to low')}}</option>
                                        </select>
                                    </div>
                                    <div class="form-group ml-auto mr-0  d-none d-md-block">
                                        <label class="mb-0 opacity-50">{{ translate('Condition')}}</label>
                                        <select class="form-control form-control-sm aiz-selectpicker" name="condition" onchange="filter()">
                                            <option value="">{{ translate('All Type')}}</option>
                                            <option value="new" @isset($condition) @if ($condition == 'new') selected @endif @endisset>{{ translate('New')}}</option>
                                            <option value="used" @isset($condition) @if ($condition == 'used') selected @endif @endisset>{{ translate('Used')}}</option>
                                        </select>
                                    </div>
                                    <div class="form-group ml-2 mr-0 d-none d-md-block">
                                        <label class="mb-0 opacity-50">{{ translate('Brands')}}</label>
                                        <select class="form-control form-control-sm aiz-selectpicker" data-live-search="true" name="brand" onchange="filter()">
                                            <option value="">{{ translate('All Brands')}}</option>
                                            @foreach (Brand::all() as $brand)
                                                <option value="{{ $brand->slug }}" @isset($brand_id) @if ($brand_id == $brand->id) selected @endif @endisset>{{ $brand->getTranslation('name') }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="d-xl-none ml-auto ml-md-3 mr-0 form-group align-self-end">
                                        <button type="button" class="btn btn-icon p-0" data-toggle="class-toggle" data-target=".aiz-filter-sidebar">
                                            <i class="la la-filter la-2x"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-9">

                        <section class="mb-4">

                                <div class="row">

                                    <div class="col-lg-9">
                                        <div class="px-2 py-4 px-md-4 py-md-3  shadow-sm rounded ">
                                            <div class="d-flex mb-3 align-items-baseline border-bottom">

                                            </div>

                                            <div class="row gutters-5 ">
                                                @forelse ($customer_products as $key => $product)
                                                            <div class="col-lg-12 col-md-12 m-auto">
                                                                <div class="d-flex  ">
                                                                    <div class="media ">
                                                                        <div class="absolute-top-left pt-2 pl-2 mt-3">
                                                                            @if ($product->conditon == 'new')
                                                                                <span
                                                                                    class="badge badge-inline badge-success">{{ translate('new') }}</span>
                                                                            @elseif($product->conditon == 'used')
                                                                                <span
                                                                                    class="badge badge-inline badge-danger">{{ translate('Used') }}</span>
                                                                            @endif
                                                                        </div>
                                                                       <a href="{{ route('customer.product', $product->slug) }}">
                                                                        <img style="width: 150px"
                                                                        src="{{ uploaded_asset($product->photos) }}"
                                                                        class="mr-3 " alt="..."></a>
                                                                        <div class="media-body py-2">
                                                                            <a
                                                                                href="{{ route('customer.product', $product->slug) }}">
                                                                                <h4 class="mt-0">
                                                                                    {{ $product->getTranslation('name') }}</h4>
                                                                            </a>
                                                                            <p>{{ single_price($product->unit_price) }}</p>
                                                                            <strong>{{ $product->location }}</strong>
                                                                        </div>
                                                                        <p>{{ $product->created_at->diffForHumans() }}</p>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            @empty
                                                            <h5>Woops! Ads not found.</h5>
                                                        @endforelse

                                                     <div class="paginate mt-3">
                                                            {{$customer_products->links()  }}
                                                     </div>



                                            </div>
                                        </div>
                                    </div>
                                    @if (get_setting('home_banner2_images') != null)
                                        <div class="col-lg-3 px-2 py-4 px-md-4 py-md-3 bg-white shadow-sm rounded">
                                            {{-- Banner Section 2 --}}

                                            <div class="mb-4">

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
                                    @endif

                                </div>


                        </section>

                        <div class="aiz-pagination aiz-pagination-center mt-4">
                            {{ $customer_products->links() }}
                        </div>

                    </div>
                </div>
            </form>
        </div>
    </section>

@endsection

@section('script')
    <script type="text/javascript">
        function filter(){
            $('#search-form').submit();
        }
    </script>
@endsection