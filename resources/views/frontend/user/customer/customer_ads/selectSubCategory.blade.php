@extends('frontend.layouts.user_panel')

@section('panel_content')
<style>

.media{
    border:none;
    border-bottom: 1px solid #e7edee;
}

</style>
<div class="row  gutters-10">

      <div class="col-md-2">

      </div>

      <div class="col-md-5">
        <strong class="ml-3">Select a subcategory</strong>
        @forelse ($subcategory as $items)
        <a href="{{ route('customer.products.upload.form',encrypt($items->id)) }}">
            <ul class="list-group">
                <li class="list-group-item">{{ $items->name }}
                    <i class='fas fa-arrow-right float-right'></i>
                </li>

              </ul>
        </a>
          @empty
          <br/>
          <strong class="text-danger">Woops! not found</strong>
          @endforelse

        <div>

          </div>
    </div>
    <div class="col-md-5">

    </div>


  </div>

@endsection
