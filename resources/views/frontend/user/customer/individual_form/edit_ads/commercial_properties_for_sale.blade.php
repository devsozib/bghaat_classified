<form class="" action="{{route('customer.products.update', $product->id )}}" method="POST" enctype="multipart/form-data" id="choice_form">
    @csrf
    @method('PATCH')
    <input type="hidden" name="categoryId" value={{ $categoryId }}>
    <input type="hidden" name="subcategoryId" value={{ $subcategoryId }}>
    <input type="hidden" name="added_by" value="{{ Auth::user()->user_type }}">
    <input type="hidden" name="status" value="available">
    <div class="card w-md-75 m-auto w-sm-100">
        <h5 class="p-3">Edit Commercial Properties For Sale</h5>
        <div class="card-body">
            <div class="form-group row">
                <div class="col-md-12">
                <label class=" col-from-label font-weight-bold">{{translate('Title')}} <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" name="name" placeholder="{{ translate('Enter the title')}}" value="{{ $product->name }}"  required>
                </div>
            </div>

            <div class="form-group row">
                <div class="col-md-6">
                    <label class=" col-from-label font-weight-bold">{{ translate('Size')}}<span class="text-danger">*</span> </label>
                    <input type="number" lang="en" class="form-control" name="land_size" placeholder="Size" value="{{ $product->land_size }}" required>
                </div>

                <div class="col-md-6">
                    <label class=" col-from-label font-weight-bold">{{translate('Unit')}} <span class="text-danger">*</span></label>

                <select class="form-control selectpicker" data-placeholder="" id="land_size_unit" name="land_size_unit" required>
                    <option value="">--Choose One--</option>
                    <option {{  ($product->land_size_unit) == 'Sqft' ? 'selected' : ''  }} value="Sqft">Sqft</option>
                    <option {{  ($product->land_size_unit) == 'Katha' ? 'selected' : ''  }}  value="Katha">Katha</option>

                </select>
                </div>

        </div>


        <div class="form-group row">
            <div class="col-md-12">
            <label class=" col-from-label font-weight-bold">{{translate('Facing')}} <span class="text-danger">*</span></label>
                <select class="form-control selectpicker" data-placeholder="" id="facing" name="facing" required>
                    <option value="">--Choose One--</option>
                    <option {{ ($product->facing) == 'South Facing' ? 'selected' : '' }} value="South Facing">South Facing</option>
                    <option {{ ($product->facing) == 'East Facing' ? 'selected' : '' }} value="East Facing">East Facing</option>
                    <option {{ ($product->facing) == 'West Facing' ? 'selected' : '' }}  value="West Facing">West Facing</option>
                    <option {{ ($product->facing) == 'North Facing' ? 'selected' : '' }} value="North Facing">North Facing</option>
                </select>
            </div>
        </div>



        <div class="form-group row">
            <div class="col-md-12">
            <label class="col-from-label font-weight-bold">{{translate('Completion Status')}} <span class="text-danger">*</span></label>

        <div class="auhentication d-flex mb-2 col-md-12">
            <br>
            <div class="form-check">
                <input {{($product->completion_status == 'ready' ? 'checked' : '')}}  class="form-check-input" value="ready" type="radio" name="completion_status" id="flexRadioDefault1">
                <label class="form-check-label " for="flexRadioDefault1">
                   Ready
                </label>
              </div>

              <div class="form-check ml-3">
                <input {{($product->completion_status == 'on_going' ? 'checked' : '')}}   class="form-check-input" name="completion_status" type="radio" value="on_going"  id="flexRadioDefault1">
                <label class="form-check-label" for="flexRadioDefault1">
                    On Going
                </label>
              </div>
        </div>
            </div>
        </div>



            <div class="form-group row">
                <div class="col-md-12">
                <label class=" col-from-label font-weight-bold">{{translate('Category')}} </label>
                <input type="text" lang="en" class="form-control" name="cat" value="{{ $categoryName }}" disabled>
                </div>
            </div>

            <div class="form-group row">
                <div class="col-md-12">
                <label class=" col-from-label font-weight-bold">{{translate('Sub Category')}} </label>
                <input type="text" lang="en" class="form-control" name="subcat" value="{{ $subcategoryName }}" disabled>
                </div>
            </div>


            <div class="card w-100" >
                <div class="form-group row">
                    <div class="col-md-6">

                        <label><input type="checkbox" {{($product->negotiable == 1 ? 'checked' : '')}} name="negotiable" value="1">
                            Negotiable</label>
                    </div>
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


                    <select class="form-control mb-3 aiz-selectpicker" data-live-search="true" name="state_id" required>

                    </select>
                </div>
            </div>

            <div class="form-group row">
                <div class="col-md-12">
                <label class=" col-from-label font-weight-bold">{{translate('Select City')}} <span class="text-danger">*</span></label>


                    <select class="form-control mb-3 aiz-selectpicker" data-live-search="true" name="city_id" required>

                    </select>

                </div>
            </div>

            <div class="form-group row">
                <div class="col-md-12 font-weight-bold">
                <label class=" col-from-label">{{translate('Your Local Address')}} <span class="text-danger">*</span></label>

                    <input type="text" value="{{ $product->location }}" class="form-control" name="location" placeholder="{{ translate('Type your local address')}}" required>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-md-6">
                <label class=" col-from-label font-weight-bold">{{ translate('Price(TK)')}} <span class="text-danger">*</span></label>

                    <input value="{{ $product->unit_price }}" type="number" lang="en" min="0" step="0.01" class="form-control" name="unit_price" placeholder="{{ translate('Write Price')}} " required>
                </div>
                <div class="col-md-6">
                    <label class=" col-from-label font-weight-bold">Unit<span class="text-danger">*</span></label>
                    <select class="form-control selectpicker" data-placeholder="" id="unit" name="unit" required>
                        <option {{ ($product->unit) == 'Total Price' ? 'selected' : '' }} value="Total Price">Total Price</option>
                        <option {{ ($product->unit) == 'Per Sqft' ? 'selected' : '' }} value="Per Sqft">Per Sqft</option>
                    </select>
                </div>
            </div>

            <div class="form-group row">

                <div class="col-md-12">

                <label class=" col-from-label font-weight-bold">{{translate('Product images')}} <span class="text-danger">*</span></label>
                    <div class="input-group" data-toggle="aizuploader" data-type="image" data-multiple="true">
                        <div class="input-group-prepend">
                            <div class="input-group-text bg-soft-secondary font-weight-medium">{{ translate('Browse')}}</div>
                        </div>
                        <div class="form-control file-amount">{{ translate('Choose File') }}</div>
                        <input type="hidden" name="photos" value="{{ $product->photos }}" class="selected-files">
                    </div>
                    <div class="file-preview box sm">
                    </div>
                </div>
            </div>

            <div class="form-group row">

                <div class="col-md-12">
                    <label class="col-from-label font-weight-bold">{{ translate('Your Ads Description Write Here!')}}</label>
                    <div class="mb-3">
                        <span class="text-right">0/5000</span>
                        <textarea class="aiz-text-editor" placeholder="{{ translate('More Descriptions == More Buyers😊')}}"name="description" required>{{ $product->description }}</textarea>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label class="col-from-label font-weight-bold">{{ translate('Contact Info')}}</label>
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
        <button type="submit" class="btn btn-primary btn-sm w-25 m-auto py-3" >Update Ad<i class="las la-upload"></i></button>
    </div>

</form>

