@extends('frontend.layouts.user_panel')

@section('panel_content')


<style>

    .media{
        border:none;
        border-bottom: 1px solid #e7edee;
    }

    </style>
    <div class="row ">

         <div class="col-md-2">

         </div>

          <div class="col-md-5">
              <strong class="ml-3">Select a category</strong>
            @foreach (\App\Models\Category::orderBy('name','ASC')->where('level', 0)->where('featured',1)->limit(8)->get() as $category)
            <a href="{{ route('category.select',encrypt($category->id)) }}">


                <ul class="list-group">
                    <li class="list-group-item">{{ $category->name }}
                        <i class='fas fa-arrow-right float-right'></i>
                    </li>

                  </ul>





            </a>
              @endforeach


        </div>
        <div class="col-md-5">

        </div>



      </div>


@endsection
