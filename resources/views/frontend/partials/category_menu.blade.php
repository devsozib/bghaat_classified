<style>

    ul li {
        list-style:none;
    }
</style>
<?php
 use App\Models\CustomerProduct;
use App\Models\Category;
 use App\Utility\CategoryUtility;
 use App\Models\State;
?>
<div class="left-side  aiz-category-menu category-position bg-white rounded @if(Route::currentRouteName() == 'home') shadow-sm" @else shadow-lg id="category-sidebar" @endif >


    <div class="menu" >

        <nav class="sidebar card mb-4" style="background:#ebebeb!important">

            <ul class="list-unstyled">
                <li class="heading" style="
                background:#212529!important;
                padding: 10px; margin-bottom:15px"> <a class="text-light" href="{{ route('categories.all') }}">All Categories</a></li>
                @if (!isset($category_id))
                    @foreach (Category::where('level', 0)->get() as $category)
                        @php
                            $productCount =CustomerProduct::where('category_id',$category->id)->count();
                        @endphp
                        <li class="mb-2 ml-2">
                            <a class="text-reset fs-14" href="{{ route('customer_products.category', $category->slug) }}">{{ $category->getTranslation('name')}}({{ $productCount  }})</a>
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
                                {{Category::find(Category::find($category_id)->parent_id)->getTranslation('name') }}
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
            </nav>
     <style>
        .location-heading{
            background:#212529;
            padding:10px;
        }
     </style>

        <div class="item" style="background:#ebebeb!important" data-id="">

            <a class=" text-white sub-category location-heading fw-bold" >
               <span><i class="las la-map-marker"></i></span>
                All Of Bangladesh<i class="fas fa-angle-down dropdown "></i>
            </a>
           <div class="sub-menu" style="margin-left: -20px">
            <ul>

                   @if (!isset($category_id))
                   @foreach (State::orderBy('name','asc')->where('status', 1)->get() as $state)
                   @php
                   $stateProductCount =CustomerProduct::where('state_id',$state->id)->count();
                 @endphp
                <li class="mb-2">
                     <a href="{{ route('customer_products.state', $state->id) }}" class="text-dark">{{$state->name}}({{ $stateProductCount }})</a>
                </li>
                @endforeach
                @endif


            </ul>

           </div>
        </div>


      </div>
</div>





<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>

@section('script')

<script>
jQuery(function () {
	var rightSidebar = jQuery('.rightSidebar');
	var top = rightSidebar.offset().top - parseFloat(rightSidebar.css('margin-top'));
	jQuery(window).scroll(function (event) {
		var y = jQuery(this).scrollTop();
		if (y >= top) {
			rightSidebar.addClass('stickyRightSidebar');
		} else {
			rightSidebar.removeClass('stickyRightSidebar');
		}
	});
});
</script>

@endsection
