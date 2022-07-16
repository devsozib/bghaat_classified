<?php

namespace App\Http\Controllers;

use Auth;
use ImageOptimizer;
use App\Models\City;
use App\Models\Brand;
use App\Models\State;
use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\SubSubCategory;
use App\Models\CustomerProduct;
use App\Utility\CategoryUtility;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use App\Models\CustomerProductTranslation;

class CustomerProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      
        $products = CustomerProduct::where('user_id', Auth::user()->id)->orderBy('created_at', 'desc')->paginate(10);

       
        return view('frontend.user.customer.products', compact('products'));
    }
       
    public function customer_product_index()
    {
        
        $products = CustomerProduct::orderBy('created_at', 'desc')->paginate(10);
        
        return view('backend.customer.classified_products.index', compact('products'));
    }
    
    

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($sid)
    {
         $ID = decrypt($sid);
        
        $subcategory_info = Category::where('id',$ID)->first();
        $subcategoryName =   $subcategory_info->name;
        
        $subcategoryId =   $subcategory_info->id;
        $categoryId =$subcategory_info->parent_id;
        $categoryInfo = Category::where('id',$categoryId)->select('name')->first();
        $categoryName =       $categoryInfo->name;
        $address = DB::table('addresses')->where('user_id', Auth::id())->get();
        $states = State::where('status',1)->get();
        $cities = City::where('status',1)->get();
        if(Auth::user()->user_type == "customer" && Auth::user()->remaining_uploads > 0){
            return view('frontend.user.customer.individual_form.add_layout', compact('subcategoryId','subcategoryName','categoryName','address','states','cities'));
        }
        // elseif (Auth::user()->user_type == "seller" && Auth::user()->remaining_uploads > 0) {
        //     return view('frontend.user.customer.product_upload', compact('categories'));
        // }
        else{
            flash(translate('Your  product ads upload limit has been reached. Please buy a package.'))->error();
            return redirect()->route('customer_packages_list_show');
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request,$id)
    {

        if( $request->has('negotiable') ){
            $negotiable = $request->negotiable;
        }else{
            $negotiable  = " ";
        }
    
        $category= Category::where('id',$id)->first();
        $categoryId= $category->parent_id;
        
         $features = $request->features;
         if(!$features){
             $featuresData = $request->features;
         }else{
            $featuresData =implode(",",$features);
         }

         $fuel_type = $request->fuel_type;
         if(!$fuel_type){
             $fuel_typeData = $request->fuel_type;
         }else{
            $fuel_typeData =implode(" ",$fuel_type);
         }
       
        $customer_product                       = new CustomerProduct;
        $customer_product->name                 = $request->name;
        $customer_product->added_by             = $request->added_by;
        $customer_product->user_id              = Auth::user()->id;
        $customer_product->category_id          = $categoryId;
        $customer_product->subcategory_id       = $id;
        $customer_product->brand_id             = $request->brand_id;
        $customer_product->more_info            = $request->more_info;
        $customer_product->manufacture_year     = $request->manufacture_year;
        $customer_product->run_kilometers       = $request->run_kilometers;
        $customer_product->engine_capacity      = $request->engine_capacity;
        $customer_product->fuel_type            = $fuel_typeData;
        $customer_product->features             = $featuresData;
        $customer_product->bedrooms             = $request->bedrooms;
        $customer_product->bathrooms            = $request->bathrooms;
        $customer_product->size_sqft            = $request->size_sqft;
        $customer_product->facing               = $request->facing;
        $customer_product->completion_status    = $request->completion_status;
        $customer_product->land_size            = $request->land_size;
        $customer_product->land_size_unit       = $request->land_size_unit;
        $customer_product->house_size           = $request->house_size;
        $customer_product->house_size_unit      = $request->house_size_unit;
        $customer_product->transmission         = $request->transmission;
        $customer_product->body_type            = $request->body_type;
        $customer_product->registration_year    = $request->registration_year;
        $customer_product->country_id           = $request->country_id;
        $customer_product->state_id             = $request->state_id;
        $customer_product->city_id              = $request->city_id;
        $customer_product->conditon             = $request->conditon;
        $customer_product->location             = $request->location;
        $customer_product->photos               = $request->photos;
        $customer_product->thumbnail_img        = $request->thumbnail_img;
        $customer_product->phone                = $request->phone;
        $customer_product->model                = $request->model;
        $customer_product->negotiable           = $negotiable;
        $customer_product->authenticity         = $request->authenticity;
        $customer_product->description          = $request->description;
        $customer_product->unit_price           = $request->unit_price;
        $customer_product->unit                 = $request->unit;
        $customer_product->slug                 = strtolower(preg_replace('/[^A-Za-z0-9\-]/', '', str_replace(' ', '-', $request->name)).'-'.Str::random(5));
        if($customer_product->save()){
            $user = Auth::user();
            $user->remaining_uploads -= 1;
            $user->save();

            $customer_product_translation               = CustomerProductTranslation::firstOrNew(['lang' => env('DEFAULT_LANGUAGE'), 'customer_product_id' => $customer_product->id]);
            $customer_product_translation->name         = $request->name;
            $customer_product_translation->unit         = $request->unit;
            $customer_product_translation->description  = $request->description;
            $customer_product_translation->save();

            flash(translate('Product has been inserted successfully'))->success();
            return redirect()->back();
        }
        else{
            flash(translate('Something went wrong'))->error();
            return back();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {
        
        $ID = decrypt($id);
        $product= CustomerProduct::find($ID);
        $adsFeaturesString = $product->features;
        $adsFeaturesConvertArray = explode(",",$adsFeaturesString );
        $categoryId = $product->category_id;
        $categoryName= Category::where('id',$categoryId)->where('level',0)->pluck('name')->first();
        $subcategoryId = $product->subcategory_id;
        $subcategoryName= Category::where('id',$subcategoryId)->where('level',1)->pluck('name')->first();
        $lang= $request->lang;
        $address = DB::table('addresses')->where('user_id', Auth::id())->get();
        $states = State::where('status',1)->get();
        $cities = City::where('status',1)->get();
        $fuel_type = $product->fuel_type;
        $fuelTypeConvertArray = explode(" ",$fuel_type);
        return view('frontend.user.customer.product_edit', compact('fuelTypeConvertArray','subcategoryId','categoryId','categoryName','subcategoryName','product','lang','states','cities','address','adsFeaturesConvertArray'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
      
        if( $request->has('negotiable') ){
            $negotiable = $request->negotiable;
        }else{
            $negotiable  = " ";
        }
    
        $category= Category::where('id',$id)->first();
       
        
         $features = $request->features;
         if(!$features){
             $featuresData =$request->features;
         }else{
            $featuresData =implode(",",$features);
         }
         $fuel_type = $request->fuel_type;
         if(!$fuel_type){
             $fuel_typeData = $request->fuel_type;
         }else{
            $fuel_typeData =implode(" ",$fuel_type);
         }

        $customer_product                       = CustomerProduct::find($id);
       
        $customer_product->name             = $request->name;
        $customer_product->unit             = $request->unit;
        $customer_product->description      = $request->description;
        
        
        $customer_product->user_id              = Auth::user()->id;
        $customer_product->category_id          = $request->categoryId;
        $customer_product->subcategory_id       = $request->subcategoryId;
        $customer_product->brand_id             = $request->brand_id;
        $customer_product->more_info            = $request->more_info;
        $customer_product->manufacture_year     = $request->manufacture_year;
        $customer_product->run_kilometers       = $request->run_kilometers;
        $customer_product->engine_capacity      = $request->engine_capacity;
        $customer_product->fuel_type            = $fuel_typeData;
        $customer_product->features             = $featuresData;
        $customer_product->bedrooms             = $request->bedrooms;
        $customer_product->bathrooms            = $request->bathrooms;
        $customer_product->size_sqft            = $request->size_sqft;
        $customer_product->facing               = $request->facing;
        $customer_product->completion_status    = $request->completion_status;
        $customer_product->land_size            = $request->land_size;
        $customer_product->land_size_unit       = $request->land_size_unit;
        $customer_product->house_size           = $request->house_size;
        $customer_product->house_size_unit      = $request->house_size_unit;
        $customer_product->transmission         = $request->transmission;
        $customer_product->body_type            = $request->body_type;
        $customer_product->registration_year    = $request->registration_year;
        $customer_product->fuel_type            = $fuel_typeData;
        $customer_product->country_id           = $request->country_id;
        $customer_product->state_id             = $request->state_id;
        $customer_product->city_id              = $request->city_id;
        $customer_product->conditon             = $request->conditon;
        $customer_product->location             = $request->location;
        $customer_product->photos               = $request->photos;
        $customer_product->negotiable           =  $negotiable;
        $customer_product->authenticity         =$request->authenticity;
        $customer_product->model                = $request->model;
        $customer_product->unit_price           = $request->unit_price;
        $customer_product->unit                 = $request->unit;
        $customer_product->phone                =$request->phone;
        $customer_product->slug                 = strtolower(preg_replace('/[^A-Za-z0-9\-]/', '', str_replace(' ', '-', $request->name)).'-'.Str::random(5));
        if($customer_product->save()){

            $customer_product_translation               = CustomerProductTranslation::firstOrNew(['lang' => $request->lang, 'customer_product_id' => $customer_product->id]);
            $customer_product_translation->name         = $request->name;
        
            $customer_product_translation->description  = $request->description;
            $customer_product_translation->save();

            flash(translate('Product has been updated successfully'))->success();
            return back();
        }
        else{
            flash(translate('Something went wrong'))->error();
            return back();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

       
        $product = CustomerProduct::findOrFail($id);

        foreach ($product->customer_product_translations as $key => $customer_product_translations) {
            $customer_product_translations->delete();
        }

        if (CustomerProduct::destroy($id)) {
            if(Auth::user()->user_type == "customer" || Auth::user()->user_type == "seller"){
                flash(translate('Product has been deleted successfully'))->success();
                return redirect()->back();
            }
            else {
                return back();
            }
        }
    }

    public function updateStatus(Request $request)
    {
        $product = CustomerProduct::findOrFail($request->id);
        $product->status = $request->status;
        if($product->save()){
            return 1;
        }
        return 0;
    }

    public function updatePublished(Request $request)
    {
        $product = CustomerProduct::findOrFail($request->id);
        $product->published = $request->status;
        if($product->save()){
            return 1;
        }
        return 0;
    }

    public function customer_products_listing(Request $request)
    {
        return $this->search($request);
    }

    public function customer_product($slug)
    {
        $customer_product  = CustomerProduct::where('slug', $slug)->with('brand')->first();
        if($customer_product!=null){
            return view('frontend.customer_product_details', compact('customer_product'));
        }
        abort(404);
    }

    public function search(Request $request)
    {
     
        //  Session::put('old_query', $request->query);
        // $query = $request->q;
        $brand_id = (Brand::where('slug', $request->brand)->first() != null) ? Brand::where('slug', $request->brand)->first()->id : null;
        $category_id = (Category::where('slug', $request->category)->first() != null) ? Category::where('slug', $request->category)->first()->id : null;
        $sort_by = $request->sort_by;
        $condition = $request->condition;

        $conditions = ['published' => 1, 'status' => 1];

        if($brand_id != null){
            $conditions = array_merge($conditions, ['brand_id' => $brand_id]);
        }

        $customer_products = CustomerProduct::where($conditions);

        if($category_id != null){
            $category_ids = CategoryUtility::children_ids($category_id);
            $category_ids[] = $category_id;

            $customer_products = $customer_products->where('category_id', $category_ids)->orWhere('subcategory_id', $category_ids);
        }

        // if($query != null){
        //     $customer_products = $customer_products->where('name', 'like', '%'.$query.'%')->orWhere('tags', 'like', '%'.$query.'%');
        // }

        if($sort_by != null){
            switch ($sort_by) {
                case '1':
                    $customer_products->orderBy('created_at', 'desc');
                    break;
                case '2':
                    $customer_products->orderBy('created_at', 'asc');
                    break;
                case '3':
                    $customer_products->orderBy('unit_price', 'asc');
                    break;
                case '4':
                    $customer_products->orderBy('unit_price', 'desc');
                    break;
                case '5':
                    $customer_products->where('conditon', 'new');
                    break;
                case '6':
                    $customer_products->where('conditon', 'used');
                    break;
                default:
                    // code...
                    break;
            }
        }

        if($condition != null){
            $customer_products->where('conditon', $condition);
        }
        
        $customer_products = $customer_products->paginate(12)->appends(request()->query());
        $states = State::where('status',1)->get();
        return view('frontend.customer_product_listing', compact('customer_products', 'category_id', 'brand_id', 'sort_by', 'condition', 'states'));
    }

    public function searchProduct(Request $request){
         
         return "Not found";
          
    }

    public function searchByState(Request $request , $state_id=null){

        $getCities = City::where('state_id', $state_id)->get();
        
        $getStateName = State::where('id', $state_id)->first();
      
        $customer_products = CustomerProduct::where('status',1)->where('state_id',$state_id)->paginate(10);
        return view('frontend.product_serach_by_state',compact('getStateName','customer_products','getCities'));
    }
    
    public function searchByCity(Request $request , $city_id){
        $getCityName = City::where('id', $city_id)->first();
        
        // $getStateName = State::where('id', $state_id)->first();
        
        $customer_products = CustomerProduct::where('status',1)->where('city_id',$city_id)->paginate(10);
        return view('frontend.product_serach_by_city',compact('customer_products','getCityName'));
    }

    public function categoryIndex(){
        return view('frontend.user.customer.customer_ads.index');
    }

    public function selectCategory($id){
        $ID = decrypt($id);
        $subcategory = Category::orderBy('name','ASC')->where('parent_id', $ID)->where('level',1)->where('featured',1)->get();
        return view('frontend.user.customer.customer_ads.selectSubCategory',compact('subcategory'));
    }

  
}
