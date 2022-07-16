@extends('frontend.layouts.user_panel')

@section('panel_content')
<div class="aiz-titlebar ">
    <div class="row align-items-center">

    </div>
</div>
<div class="row gutters-10">
    <div class="col-md-1">

    </div>
    <div class="col-md-10 shadow-lg rounded">

        <div class="row mx-md-n5">
            <div class="col  px-md-5"><div class="p-3 border-0 bg-light"><h4 class="h5  fs-16 mb-1 fw-600">Welcome to {{ Auth::user()->name }} Let's post and ad.</h4></div></div>
          </div>

        <div class="text-black  rounded-lg mb-4 overflow-hidden">

           <div class="media border-0 py-5">
            <img src="https://w.bikroy-st.com/dist/img/all/shop/empty-1x-6561cc5e.png" class="mr-3" alt="...">
            <div class="media-body py-3">
                @if ($products->count() > 0)
                <h5 class="mt-0 mb-3">You have {{ $products->count() }} Ads</h5>
                   <a href="{{ route('customer.all.products') }}" class="float-left">Se Your ads</a>

                  @else
                  <h5 class="mt-0">You don't have any ads yet.</h5>
                  <p>Click the "Post an ad now!" button to post your ad.</p>
                   @endif


             @if ($products->count() > 0)
              <a class="ui-btn float-left is-primary " href="{{ route('selectCategory') }}">Post your new ad!</a>

              @else
              <a class="ui-btn float-left is-primary " href="{{ route('selectCategory') }}">Post your ad now!</a>

              @endif

            </div>
          </div>
        </div>
    </div>
    <div class="col-md-1">
        {{-- <div class="bg-grad-3 text-white rounded-lg mb-4 overflow-hidden">
            <div class="px-3 pt-3">
                @php
                    $orders = \App\Models\Order::where('user_id', Auth::user()->id)->get();
                    $total = 0;
                    foreach ($orders as $key => $order) {
                        $total += count($order->orderDetails);
                    }
                @endphp
                <div class="h3 fw-700">{{ $total }} {{ translate('Product(s)') }}</div>
                <div class="opacity-50">{{ translate('you ordered') }}</div>
            </div>
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320">
                <path fill="rgba(255,255,255,0.3)" fill-opacity="1" d="M0,192L26.7,192C53.3,192,107,192,160,202.7C213.3,213,267,235,320,218.7C373.3,203,427,149,480,117.3C533.3,85,587,75,640,90.7C693.3,107,747,149,800,149.3C853.3,149,907,107,960,112C1013.3,117,1067,171,1120,202.7C1173.3,235,1227,245,1280,213.3C1333.3,181,1387,107,1413,69.3L1440,32L1440,320L1413.3,320C1386.7,320,1333,320,1280,320C1226.7,320,1173,320,1120,320C1066.7,320,1013,320,960,320C906.7,320,853,320,800,320C746.7,320,693,320,640,320C586.7,320,533,320,480,320C426.7,320,373,320,320,320C266.7,320,213,320,160,320C106.7,320,53,320,27,320L0,320Z"></path>
            </svg>
        </div> --}}
    </div>
</div>
{{-- <div class="row gutters-10">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <h6 class="mb-0">{{ translate('Default Shipping Address') }}</h6>
            </div>
            <div class="card-body">
                @if(Auth::user()->addresses != null)
                    @php
                        $address = Auth::user()->addresses->where('set_default', 1)->first();
                    @endphp
                    @if($address != null)
                        <ul class="list-unstyled mb-0">
                            <li class=" py-2"><span>{{ translate('Address') }} : {{ $address->address }}</span></li>
                            <li class=" py-2"><span>{{ translate('Country') }} : {{ $address->country->name }}</span></li>
                            <li class=" py-2"><span>{{ translate('State') }} : {{ $address->state->name }}</span></li>
                            <li class=" py-2"><span>{{ translate('City') }} : {{ $address->city->name }}</span></li>
                            <li class=" py-2"><span>{{ translate('Postal Code') }} : {{ $address->postal_code }}</span></li>
                            <li class=" py-2"><span>{{ translate('Phone') }} : {{ $address->phone }}</span></li>
                        </ul>
                    @endif
                @endif
            </div>
        </div>
    </div>
    @if (get_setting('classified_product'))
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <h6 class="mb-0">{{ translate('Purchased Package') }}</h6>
            </div>
            <div class="card-body text-center">
                @php
                    $customer_package = \App\Models\CustomerPackage::find(Auth::user()->customer_package_id);
                @endphp
                @if($customer_package != null)
                    <img src="{{ uploaded_asset($customer_package->logo) }}" class="img-fluid mb-4 h-110px">
                    <p class="mb-1 text-muted">{{ translate('Product Upload') }}: {{ $customer_package->product_upload }} {{ translate('Times')}}</p>
                    <p class="text-muted mb-4">{{ translate('Product Upload Remaining') }}: {{ Auth::user()->remaining_uploads }} {{ translate('Times')}}</p>
                    <h5 class="fw-600 mb-3 text-primary">{{ translate('Current Package') }}: {{ $customer_package->getTranslation('name') }}</h5>
                @else
                    <h5 class="fw-600 mb-3 text-primary">{{translate('Package Not Found')}}</h5>
                @endif
                    <a href="{{ route('customer_packages_list_show') }}" class="btn btn-success d-inline-block">{{ translate('Upgrade Package') }}</a>
            </div>
        </div>
    </div>
    @endif
</div> --}}
@endsection

<style>
    .ui-btn.is-primary {
    color: #fff;
    background: #008000;
    -webkit-box-shadow: 0 2px 0 #afb7ad;
    box-shadow: 0 2px 0 #afb7ad;


}

.ui-btn {
    margin-top: 3rem;
    font-size: 1rem;
    font-weight: 600;
    padding:0 24px;
    line-height: 42px;
}
</style>
