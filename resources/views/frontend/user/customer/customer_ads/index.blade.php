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
              <strong class="ml-3">Select a category</strong>
            @foreach (\App\Models\Category::orderBy('name','ASC')->where('level', 0)->where('featured',1)->limit(8)->get() as $category)
            <a href="{{ route('category.select',encrypt($category->id)) }}">
            <div class="media">
                <div class="media-body">
                  <p class="mt-0 mb-1">{{ $category->name }}</p>
                </div>

                <i class='fas fa-arrow-right'></i>
              </div>
            </a>
              @endforeach

            <div>

              </div>
        </div>
        <div class="col-md-5">

        </div>


      </div>


@endsection
