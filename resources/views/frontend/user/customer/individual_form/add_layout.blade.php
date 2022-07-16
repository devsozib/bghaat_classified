@extends('frontend.layouts.user_panel')

@section('panel_content')


    @if ($subcategoryId == 22)
     @include('frontend.user.customer.individual_form.mobile')
    @elseif ($subcategoryId == 23)
    @include('frontend.user.customer.individual_form.mobile_accessories')
    @elseif ($subcategoryId == 24)
    @include('frontend.user.customer.individual_form.desktop_computer')
    @elseif ($subcategoryId == 25)
    @include('frontend.user.customer.individual_form.laptops')
    @elseif ($subcategoryId == 26)
    @include('frontend.user.customer.individual_form.laptop_and_computer_accessories')
    @elseif ($subcategoryId == 27)
    @include('frontend.user.customer.individual_form.other_electronics')
    @elseif ($subcategoryId == 29)
    @include('frontend.user.customer.individual_form.cars')
    @elseif ($subcategoryId == 30)
    @include('frontend.user.customer.individual_form.motorbike')
    @elseif ($subcategoryId == 31)
    @include('frontend.user.customer.individual_form.bicycles')
    @elseif ($subcategoryId == 32)
    @include('frontend.user.customer.individual_form.auto_parts_and_accessories')
    @elseif ($subcategoryId == 33)
    @include('frontend.user.customer.individual_form.other')
    @elseif ($subcategoryId == 35)
    @include('frontend.user.customer.individual_form.crops_seeds_and_plants')
    @elseif ($subcategoryId == 36)
    @include('frontend.user.customer.individual_form.farming_tools_and_machinary')
    @elseif ($subcategoryId == 38)
    @include('frontend.user.customer.individual_form.other_agriculture')
    @elseif ($subcategoryId == 40)
    @include('frontend.user.customer.individual_form.apartment_for_sale')
    @elseif ($subcategoryId == 41)
    @include('frontend.user.customer.individual_form.house_for_sale')
    @elseif ($subcategoryId == 42)
    @include('frontend.user.customer.individual_form.commercial_properties_for_sale')
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

