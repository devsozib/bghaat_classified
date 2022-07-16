
<section class="mb-4">
    <div class="container">
        <div class="row">
            <div class="col-lg-2 px-2 py-4 px-md-4 py-md-3 bg-white shadow-sm rounded">
               
            </div>
            <div class="col-lg-5 ">
                <div class="px-2 py-4 px-md-4 py-md-3 bg-white shadow-sm rounded ">
                    <div class="d-flex mb-3 align-items-baseline border-bottom">
                        
                    </div>
                   
                    <div class="row gutters-5 ">
                        @foreach ($classified_products as $key => $classified_product)
                                    <div class="col-lg-12 ">
                                        <div class="d-flex  ">
                                            <div class="media ">
                                                <div class="absolute-top-left pt-2 pl-2">
                                                    @if ($classified_product->conditon == 'new')
                                                        <span
                                                            class="badge badge-inline badge-success">{{ translate('new') }}</span>
                                                    @elseif($classified_product->conditon == 'used')
                                                        <span
                                                            class="badge badge-inline badge-danger">{{ translate('Used') }}</span>
                                                    @endif
                                                </div>
                                                <img style="width: 150px"
                                                    src="{{ uploaded_asset($classified_product->photos) }}"
                                                    class="mr-3 " alt="...">
                                                <div class="media-body py-2">
                                                    <a
                                                        href="{{ route('customer.product', $classified_product->slug) }}">
                                                        <h4 class="mt-0">
                                                            {{ $classified_product->getTranslation('name') }}</h4>
                                                    </a>
                                                    <p>{{ single_price($classified_product->unit_price) }}</p>
                                                    <strong>{{ $classified_product->location }}</strong>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                         
                             <div class="paginate">
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
