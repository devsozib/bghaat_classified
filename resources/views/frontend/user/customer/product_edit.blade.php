@extends('frontend.layouts.user_panel')

@section('panel_content')

    {{-- <ul class="nav nav-tabs nav-fill border-light">
			@foreach (\App\Models\Language::all() as $key => $language)
				<li class="nav-item">
					<a class="nav-link text-reset @if ($language->code == $lang) active @else bg-soft-dark border-light border-left-0 @endif py-3" href="{{ route('customer.products.edit', ['id'=>$product->id, 'lang'=> $language->code] ) }}">
						<img src="{{ static_asset('assets/img/flags/'.$language->code.'.png') }}" height="11" class="mr-1">
						<span>{{ $language->name }}</span>
					</a>
				</li>
        @endforeach
		</ul> --}}

        @if ($product->subcategory_id == 22)
        @include('frontend.user.customer.individual_form.edit_ads.mobile')
        @elseif($product->subcategory_id == 23)
        @include('frontend.user.customer.individual_form.edit_ads.mobilephone_accessories')
        @elseif($product->subcategory_id == 24)
        @include('frontend.user.customer.individual_form.edit_ads.desktop_computer')
        @elseif($product->subcategory_id == 25)
        @include('frontend.user.customer.individual_form.edit_ads.laptops')
        @elseif($product->subcategory_id == 26)
        @include('frontend.user.customer.individual_form.edit_ads.laptop_and_computer_accessories')
        @elseif($product->subcategory_id == 27)
        @include('frontend.user.customer.individual_form.edit_ads.other_electronics')
        @elseif($product->subcategory_id == 27)
        @include('frontend.user.customer.individual_form.edit_ads.other_electronics')
        @elseif($product->subcategory_id == 29)
        @include('frontend.user.customer.individual_form.edit_ads.cars')
        @elseif($product->subcategory_id == 30)
        @include('frontend.user.customer.individual_form.edit_ads.motorbike')
        @elseif($product->subcategory_id == 31)
        @include('frontend.user.customer.individual_form.edit_ads.bicyles')
        @elseif($product->subcategory_id == 32)
        @include('frontend.user.customer.individual_form.edit_ads.auto_parts_and_accessories')
        @elseif($product->subcategory_id == 33)
        @include('frontend.user.customer.individual_form.edit_ads.other')
        @elseif($product->subcategory_id == 35)
        @include('frontend.user.customer.individual_form.edit_ads.crops_seeds_and_plants')
        @elseif($product->subcategory_id == 36)
        @include('frontend.user.customer.individual_form.edit_ads.farming_tools_and_machinary')
        @elseif($product->subcategory_id == 38)
        @include('frontend.user.customer.individual_form.edit_ads.other_agriculture')
        @elseif($product->subcategory_id == 40)
        @include('frontend.user.customer.individual_form.edit_ads.apartment_for_sale')
        @elseif($product->subcategory_id == 41)
        @include('frontend.user.customer.individual_form.edit_ads.house_for_sale')
        @elseif($product->subcategory_id == 42)
        @include('frontend.user.customer.individual_form.edit_ads.commercial_properties_for_sale')
        @endif


@endsection
@section('script')
    <script type="text/javascript">
        function add_new_address(){
            $('#new-address-modal').modal('show');
        }

        function edit_address(address) {
            var url = '{{ route("addresses.edit", ":id") }}';
            url = url.replace(':id', address);

            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: url,
                type: 'GET',
                success: function (response) {
                    $('#edit_modal_body').html(response.html);
                    $('#edit-address-modal').modal('show');
                    AIZ.plugins.bootstrapSelect('refresh');

                    @if (get_setting('google_map') == 1)
                        var lat     = -33.8688;
                        var long    = 151.2195;

                        if(response.data.address_data.latitude && response.data.address_data.longitude) {
                            lat     = response.data.address_data.latitude;
                            long    = response.data.address_data.longitude;
                        }

                        initialize(lat, long, 'edit_');
                    @endif
                }
            });
        }

        $(document).on('change', '[name=country_id]', function() {
            var country_id = $(this).val();
            get_states(country_id);
        });

        $(document).on('change', '[name=state_id]', function() {
            var state_id = $(this).val();
            get_city(state_id);
        });

        function get_states(country_id) {
            $('[name="state"]').html("");
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: "{{route('get-state')}}",
                type: 'POST',
                data: {
                    country_id  : country_id
                },
                success: function (response) {
                    var obj = JSON.parse(response);
                    if(obj != '') {
                        $('[name="state_id"]').html(obj);
                        AIZ.plugins.bootstrapSelect('refresh');
                    }
                }
            });
        }

        function get_city(state_id) {
            $('[name="city"]').html("");
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: "{{route('get-city')}}",
                type: 'POST',
                data: {
                    state_id: state_id
                },
                success: function (response) {
                    var obj = JSON.parse(response);
                    if(obj != '') {
                        $('[name="city_id"]').html(obj);
                        AIZ.plugins.bootstrapSelect('refresh');
                    }
                }
            });
        }
    </script>


    @if (get_setting('google_map') == 1)
        @include('frontend.partials.google_map')
    @endif
@endsection
