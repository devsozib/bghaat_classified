@extends('frontend.layouts.user_panel')

@section('panel_content')
    <div class="aiz-titlebar  mb-4">
      <div class="row align-items-center">
        <div class="col-md-6">
            <h1 class="h3">{{ translate('Fill in the details') }}</h1>
        </div>
      </div>
    </div>
    <form class="" action="{{route('store')}}" method="POST" enctype="multipart/form-data" id="choice_form">
        @csrf
        <input type="hidden" name="added_by" value="{{ Auth::user()->user_type }}">
        <input type="hidden" name="status" value="available">
        <div class="card ">

            <div class="card-body">
                <div class="form-group row">
                    <div class="col-md-12">
                    <label class=" col-from-label font-weight-bold">{{translate('Ads Name')}} <span class="text-danger">*</span></label>

                        <input type="text" class="form-control" name="name" placeholder="{{ translate('Enter Your Ads Name')}}" required>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-12">
                    <label class="col-from-label font-weight-bold">{{translate('Authenticity')}} <span class="text-danger">*</span></label>

                <div class="auhentication d-flex mb-2 col-md-12">
                    <br>
                    <div class="form-check">
                        <input class="form-check-input" value="original" type="radio" name="authenticity" id="flexRadioDefault1">
                        <label class="form-check-label " for="flexRadioDefault1">
                            Original
                        </label>
                      </div>

                      <div class="form-check ml-3">
                        <input class="form-check-input" name="authenticity" type="radio" value="refurbished"  id="flexRadioDefault1">
                        <label class="form-check-label" for="flexRadioDefault1">
                            Refurbished
                        </label>
                      </div>
                </div>
                    </div>
                </div>


                <div class="form-group row">
                    <div class="col-md-12">
                    <label class=" col-from-label font-weight-bold">{{translate('Select Category')}} <span class="text-danger">*</span></label>

                        <select class="form-control aiz-selectpicker" data-placeholder="{{ translate('Select a Category')}}" id="categories" name="category_id" data-live-search="true" required>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->getTranslation('name') }}</option>
                                @foreach ($category->childrenCategories as $childCategory)
                                    @include('categories.child_category', ['child_category' => $childCategory])
                                @endforeach
                            @endforeach
                        </select>
                    </div>
                </div>


                <div class="form-group row">
                    <div class="col-md-12">
                    <label class="col-from-label font-weight-bold">{{translate('Select Brand')}} <span class="text-danger">*</span></label>

                        <select class="form-control aiz-selectpicker" data-placeholder="{{ translate('Select a brand')}}" data-live-search="true"  id="brands" name="brand_id">
                            <option value=""></option>
                            @foreach (\App\Models\Brand::all() as $brand)
                                <option value="{{ $brand->id }}">{{ $brand->getTranslation('name') }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                {{-- <div class="form-group row">
                    <label class="col-md-2 col-from-label">{{translate('Product Unit')}} <span class="text-danger">*</span></label>
                    <div class="col-md-10">
                        <input type="text" class="form-control" name="unit" placeholder="{{ translate('Product unit')}}" required>
                    </div>
                </div> --}}
                <div class="form-group row">
                    <div class="col-md-12">
                    <label class=" col-from-label font-weight-bold">{{translate('Select Condition')}} <span class="text-danger">*</span></label>

                        <select class="form-control selectpicker" data-placeholder="{{ translate('Select a condition')}}" id="conditon" name="conditon" required>
                            <option value="new">{{ translate('New')}}</option>
                            <option value="used">{{ translate('Used')}}</option>
                        </select>
                    </div>
                </div>
                <div class="row">

                    <div class="col-md-12">
                        <div class="font-weight-bold">
                            <label>{{ translate('Select Country')}}<span class="text-danger ">*</span></label>
                        </div>
                        <div class="mb-3">
                            <select class="form-control aiz-selectpicker" data-live-search="true" data-placeholder="{{ translate('Select your country') }}" name="country_id" required>
                                <option value="">{{ translate('Select your country') }}</option>
                                @foreach (\App\Models\Country::where('status', 1)->get() as $key => $country)
                                    <option value="{{ $country->id }}">{{ $country->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-md-12">
                    <label class="col-from-label font-weight-bold">{{translate('Select State')}} <span class="text-danger">*</span></label>

                        {{-- <select class="form-control aiz-selectpicker" data-placeholder="{{ translate('Select a state')}}" data-live-search="true"  id="state" name="state_id">
                            <option value=""></option>
                            @foreach ($states as $state)
                            @foreach ($address as $state_id)
                            <option value="{{ $state->id }}" {{ $state_id->state_id == $state->id? 'selected':'' }}>{{ ($state->name) }}</option>
                            @endforeach
                            @endforeach
                        </select> --}}
                        <select class="form-control mb-3 aiz-selectpicker" data-live-search="true" name="state_id" required>

                        </select>
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-md-12">
                    <label class=" col-from-label font-weight-bold">{{translate('Select City')}} <span class="text-danger">*</span></label>

                        {{-- <select class="form-control aiz-selectpicker" data-placeholder="{{ translate('Select a cities')}}" data-live-search="true"  id="city" name="city_id">
                            <option value=""></option>
                            @foreach ($cities as $city)
                              @foreach ($address as $city_id)
                                <option value="{{ $city->id }}" {{ $city_id->city_id == $city->id? 'selected':'' }}>{{ ($city->name) }}</option>
                                @endforeach
                            @endforeach
                        </select> --}}
                        <select class="form-control mb-3 aiz-selectpicker" data-live-search="true" name="city_id" required>

                        </select>

                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-md-12 font-weight-bold">
                    <label class=" col-from-label">{{translate('Your Local Address')}} <span class="text-danger">*</span></label>

                        <input type="text" value="@foreach ($address as $location ){{ $location->address }}
                        @endforeach" class="form-control" name="location" placeholder="{{ translate('Type your local address')}}" required>
                    </div>
                </div>
                {{-- <div class="form-group row">
                    <label class="col-md-2 col-from-label">{{ translate('Product Tag')}} <span class="text-danger">*</span></label>
                    <div class="col-md-10">
                        <input type="text" class="form-control aiz-tag-input" name="tags[]" placeholder="{{ translate('Type & hit enter')}}">
                    </div>
                </div> --}}
            </div>
        </div>
        <div class="card w-100" >
            <div class="card-header">
                <h5 class="mb-0 h6">{{translate('Price')}}</h5>
            </div>
            <div class="card-body">
                <div class="form-group row">
                    <div class="col-md-12">
                    <label class=" col-from-label font-weight-bold">{{ translate('Price(TK)')}} <span class="text-danger">*</span></label>

                        <input type="number" lang="en" min="0" step="0.01" class="form-control" name="unit_price" placeholder="{{ translate('Write Price')}} " required>
                    </div>
                </div>
            </div>
        </div>

        <div class="card w-100" >

            <div class="card-body">
                <div class="form-group row">
                    <div class="col-md-12">
                    <label class=" col-from-label font-weight-bold">{{ translate('Model')}} </label>

                        <input type="text" lang="en" class="form-control" name="model" placeholder="{{ translate('Write Model(if you have)')}} " required>
                    </div>
                </div>
            </div>
        </div>

        <div class="card w-100">

            <div class="card-body">
                <div class="form-group row">

                    <div class="col-md-12">

                    <label class=" col-from-label font-weight-bold">{{translate('Product images')}} <span class="text-danger">*</span></label>
                        <div class="input-group" data-toggle="aizuploader" data-type="image" data-multiple="true">
                            <div class="input-group-prepend">
                                <div class="input-group-text bg-soft-secondary font-weight-medium">{{ translate('Browse')}}</div>
                            </div>
                            <div class="form-control file-amount">{{ translate('Choose File') }}</div>
                            <input type="hidden" name="photos" class="selected-files">
                        </div>
                        <div class="file-preview box sm">
                        </div>
                    </div>
                </div>
                {{-- <div class="form-group row">
                    <label class="col-md-2 col-from-label">{{translate('Thumbnail Image')}} <span class="text-danger">*</span></label>
                    <div class="col-md-10">
                        <div class="input-group" data-toggle="aizuploader" data-type="image">
                            <div class="input-group-prepend">
                                <div class="input-group-text bg-soft-secondary font-weight-medium">{{ translate('Browse')}}</div>
                            </div>
                            <div class="form-control file-amount">{{ translate('Choose File') }}</div>
                            <input type="hidden" name="thumbnail_img" class="selected-files">
                        </div>
                        <div class="file-preview box sm">
                        </div>
                    </div>
                </div> --}}
            </div>
        </div>
        {{-- <div class="card">
            <div class="card-header">
                <h5 class="mb-0 h6">{{translate('Videos')}}</h5>
            </div>
            <div class="card-body">
                <div class="form-group row">
                    <label class="col-md-2 col-from-label">{{translate('Video From')}}</label>
                    <div class="col-md-10">
                        <select class="form-control aiz-selectpicker" data-minimum-results-for-search="Infinity" name="video_provider">
                            <option value="youtube">{{ translate('Youtube')}}</option>
                            <option value="dailymotion">{{ translate('Dailymotion')}}</option>
                            <option value="vimeo">{{ translate('Vimeo')}}</option>
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-md-2 col-from-label">{{translate('Video URL')}}</label>
                    <div class="col-md-10">
                        <input type="text" class="form-control" name="video_link" placeholder="{{ translate('Video link')}}">
                    </div>
                </div>
            </div>
        </div> --}}
        {{-- <div class="card">
            <div class="card-header">
                <h5 class="mb-0 h6">{{translate('Meta Tags')}}</h5>
            </div>
            <div class="card-body">
                <div class="form-group row">
                    <label class="col-md-2 col-from-label">{{translate('Meta Title')}}</label>
                    <div class="col-md-10">
                        <input type="text" name="meta_title" class="form-control" placeholder="{{ translate('Meta Title')}}">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-md-2 col-from-label">{{translate('Description')}}</label>
                    <div class="col-md-10">
                        <textarea name="meta_description" rows="8" class="form-control"></textarea>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-md-2 col-from-label">{{ translate('Meta Image')}}</label>
                    <div class="col-md-10">
                        <div class="input-group" data-toggle="aizuploader" data-type="image">
                            <div class="input-group-prepend">
                                <div class="input-group-text bg-soft-secondary font-weight-medium">{{ translate('Browse')}}</div>
                            </div>
                            <div class="form-control file-amount">{{ translate('Choose File') }}</div>
                            <input type="hidden" name="meta_img" class="selected-files">
                        </div>
                        <div class="file-preview box sm">
                        </div>
                    </div>
                </div>
            </div>
        </div> --}}

        <div class="card w-100">

            <div class="card-body">
                <div class="form-group row">

                    <div class="col-md-12">
                        <label class="col-from-label font-weight-bold">{{ translate('Your Ads Description Write Here!')}}</label>
                        <div class="mb-3">
                            <span class="text-right">0/5000</span>
                            <textarea class="aiz-text-editor" placeholder="{{ translate('More Descriptions == More Buyers😊')}}"name="description" required></textarea>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card w-100">
            <div class="card-header">
                <h5 class="mb-0 h6">{{translate('Contact Info')}} <span class="text-danger">*</span></h5>
            </div>
            <div class="card-body">
                <div class="form-group">
                    <div>
                        <label for="name">Name</label>
                        <h6>{{ Auth::user()->name }}</h6>
                    </div>

                    <div>
                        <label for="name">Email</label> <br>
                        <h6>{{ Auth::user()->email }}</h6>
                    </div>
                    <div>
                        <label for="name">Phone</label> <br>

                        <input type="text" value="@foreach ($address as $location ){{ $location->phone }}@endforeach" class="form-control" name="phone" placeholder="{{ translate('017********')}}" required>
                    </div>

                </div>
            </div>
        </div>
        {{-- <div class="card">
            <div class="card-header">
                <h5 class="mb-0 h6">{{translate('PDF Specification')}}</h5>
            </div>
            <div class="card-body">
                <div class="form-group row">
                    <label class="col-md-2 col-from-label">{{ translate('PDF')}}</label>
                    <div class="col-md-10">
                        <div class="input-group" data-toggle="aizuploader" data-type="document">
                            <div class="input-group-prepend">
                                <div class="input-group-text bg-soft-secondary font-weight-medium">{{ translate('Browse')}}</div>
                            </div>
                            <div class="form-control file-amount">{{ translate('Choose File') }}</div>
                            <input type="hidden" name="pdf" class="selected-files">
                        </div>
                        <div class="file-preview box sm">
                        </div>
                    </div>
                </div>
            </div>
        </div> --}}
        <button type="submit" class="btn btn-primary btn-sm" >Post Ad<i class="las la-upload"></i></button>


    </form>

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
