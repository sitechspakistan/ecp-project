<?php

namespace App\Http\Controllers;

use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Models\Pages;
use App\Models\PageComponents;
use App\Models\News;
use App\Models\NewsCategories;
use App\Models\Events;
use App\Models\EventCategories;
use App\Models\Blogs;
use App\Models\BlogCategories;
use App\Models\Services;
use App\Models\ContactMails;
use App\Models\Subscribers;
use App\Models\Albums;
use App\Models\BlogCategoryRelation;
use App\Models\BlogReviews;
use App\Models\Countries;
use App\Models\States;
use App\Models\Cities;
use App\Models\ProductBookmark;
use App\Models\ProductCategories;
use App\Models\ProductMessage;
use App\Models\ProductReviews;
use App\Models\Products;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;
use Session;
use Mail;
use File;
use Illuminate\Support\Str;

class HomeController extends Controller
{
    public function index()
    {
        $data = Pages::where('is_home',1)->first();
        $components = PageComponents::where('page_id',$data['id'])->OrderBy('sort_order','ASC')->get();
        // return view('frontend.home');
        return view('frontend.page',['data'=>$data,'components'=>$components]);
    }

    public function page($slug, $sub=null)
    {
        /* Service */
        $service = Services::where('slug', $slug)->where('is_active', 1)->first();
        if($service) {
            if ($service->childrens->where('is_active', 1)->count() > 0) {
                $childrens = $service->childrens->where('is_active', 1);
            } else {
                $s = Services::where('id', $service->parent_id)->where('is_active',1)->first();
	            $childrens = $s->childrens->where('id', '!=', $service->id);
            }
            $others = Services::whereNull('parent_id')->where('is_active', 1)->where('id', '!=', $service['id'])->get();
            $sidebar = [];
            if(isset(getConfigurations()['sidebar_meta']['on_service']) && getConfigurations()['sidebar_meta']['on_service']==1) {
                $sidebar = getConfigurations()['sidebar_meta']['service'];
            }
            return view('frontend.service', ['data'=>$service, 'childrens'=>$childrens, 'others'=> $others, 'sidebar'=>$sidebar]);
        }
        /* Page */
        // $page = Pages::where('slug',$slug)->where('parent_id', null)->first();
        $page = Pages::where('slug',$slug)->first();
        if($page) {
            $sub_page=null;
            if($sub!==null){
                $sub_page = Pages::where('slug',$sub)->where('is_active', 1)->where('parent_id', ($page->id)??0)->first();
                $page=null;
            }
            $components = PageComponents::where('page_id',$page['id'])->OrderBy('sort_order','ASC')->get();
            return view('frontend.page',['data'=>$page,'components'=>$components]);
        }
        abort(404);
    }

    public function news(Request $request)
    {
        if($request->has('category')) {
            $categoryId = $request->category;
            $data = News::where('is_active', 1)->whereHas('newsCategoryRelations', function ($query) use ($categoryId) {
                        $query->where('category_id', $categoryId);
                    })->orderBy('id', 'DESC')->paginate(10);
        } else {
            $data = News::where('is_active', 1)->OrderBy('id', 'DESC')->paginate(10);
        }
        $categories = NewsCategories::where('is_active', 1)->OrderBy('sort_order')->get();
        $sidebar = [];
        if(isset(getConfigurations()['sidebar_meta']['on_news']) && getConfigurations()['sidebar_meta']['on_news']==1) {
            $sidebar = getConfigurations()['sidebar_meta']['news'];
        }
        $seo = getConfigurations()['news_seo']??[];
        return view('frontend.news', compact('data', 'categories', 'sidebar', 'seo'));
    }

    public function news_detail($slug)
    {
        $data = News::where('is_active', 1)->where('slug', $slug)->first();
        $categories = NewsCategories::where('is_active', 1)->OrderBy('sort_order')->get();
        $recents = [];
        if(!empty($data)) {
            $recents = News::where('id', '!=', $data['id'])->where('is_active', 1)->OrderBy('id', 'DESC')->limit(4)->get();
        }
        $sidebar = [];
        if(isset(getConfigurations()['sidebar_meta']['on_news']) && getConfigurations()['sidebar_meta']['on_news']==1) {
            $sidebar = getConfigurations()['sidebar_meta']['news'];
        }
        return view('frontend.news_detail', compact('data', 'categories', 'recents', 'sidebar'));
    }

    public function blogs(Request $request)
    {
        if($request->has('category')) {
            $categoryId = $request->category;
            $data = Blogs::where('is_active', 1)->whereHas('blogCategoryRelations', function ($query) use ($categoryId) {
                        $query->where('category_id', $categoryId);
                    })->orderBy('id', 'DESC')->paginate(10);
        } else {
            $data = Blogs::where('is_active', 1)->OrderBy('id', 'DESC')->paginate(10);
        }
        $seo = getConfigurations()['blogs_seo']??[];
        return view('frontend.blogs', compact('data', 'seo'));
    }

    public function blog_detail($slug)
    {
        $data = Blogs::with('categories')->where('is_active', 1)->where('slug', $slug)->first();
        // $categories = BlogCategories::where('is_active', 1)->OrderBy('sort_order')->get();
        $categories = $data->categories;
        $recents = [];
        if(!empty($data)) {
            $recents = Blogs::where('id', '!=', $data['id'])->where('is_active', 1)->OrderBy('id', 'DESC')->inRandomOrder()->limit(2)->get();
        }
        $reviews = BlogReviews::where('blog_id',$data->id)->get();

        return view('frontend.blog_detail', compact('data', 'categories', 'recents', 'reviews'));
    }

    public function events(Request $request)
    {
        if($request->has('category')) {
            $categoryId = $request->category;
            $data = Events::where('is_active', 1)->whereHas('eventCategoryRelations', function ($query) use ($categoryId) {
                        $query->where('category_id', $categoryId);
                    })->orderBy('id', 'DESC')->paginate(10);
        } else {
            $data = Events::where('is_active', 1)->OrderBy('id', 'DESC')->paginate(10);
        }
        $categories = EventCategories::where('is_active', 1)->OrderBy('sort_order')->get();
        $sidebar = [];
        if(isset(getConfigurations()['sidebar_meta']['on_events']) && getConfigurations()['sidebar_meta']['on_events']==1) {
            $sidebar = getConfigurations()['sidebar_meta']['events'];
        }
        $seo = getConfigurations()['events_seo']??[];
        return view('frontend.events', compact('data', 'categories', 'sidebar', 'seo'));
    }

    public function events_detail($slug)
    {
        $data = Events::where('is_active', 1)->where('slug', $slug)->first();
        $categories = EventCategories::where('is_active', 1)->OrderBy('sort_order')->get();
        $recents = [];
        if(!empty($data)) {
            $recents = Events::where('id', '!=', $data['id'])->where('is_active', 1)->OrderBy('id', 'DESC')->limit(4)->get();
        }
        $sidebar = [];
        if(isset(getConfigurations()['sidebar_meta']['on_events']) && getConfigurations()['sidebar_meta']['on_events']==1) {
            $sidebar = getConfigurations()['sidebar_meta']['events'];
        }
        return view('frontend.event_detail', compact('data', 'categories', 'recents', 'sidebar'));
    }

    public function album_detail($slug)
    {
        $data = Albums::where('is_active', 1)->where('slug', $slug)->first();
        $recents = Albums::where('id', '!=', $data['id'])->where('is_active', 1)->OrderBy('id', 'DESC')->get();
        $sidebar = [];
        if(isset(getConfigurations()['sidebar_meta']['on_album']) && getConfigurations()['sidebar_meta']['on_album']==1) {
            $sidebar = getConfigurations()['sidebar_meta']['album'];
        }
        return view('frontend.album', compact('data', 'recents', 'sidebar'));
    }

    public function contact_mail(Request $request)
    {
        $request->validate([
            'g-recaptcha-response' => 'required',
        ]);
        $data = $request->except(['_token', 'fields_meta', 'phone']);
        $data['msg']= $request->message??'';
        $data['phone'] = '+'.$request->country_code.$request->phone;
        $fields_meta = $request->input('fields_meta', []);
        $cityName = isset($fields_meta['city']) ? Cities::find($fields_meta['city'])->name ?? null : null;
        $stateName = isset($fields_meta['state']) ? States::find($fields_meta['state'])->name ?? null : null;
        $countryName = isset($fields_meta['country']) ? Countries::find($fields_meta['country'])->name ?? null : null;
        $address = collect([
            $fields_meta['address_1'] ?? null,
            $fields_meta['address_2'] ?? null,
            $cityName,
            $stateName,
            $fields_meta['postal'] ?? null,
            $countryName,
        ])->filter()->implode(', ');
        $data['address'] = $address;
        $data['fields_meta']['address'] = $address;
        $recaptchaResponse = $request->input('g-recaptcha-response');
        $secretKey = env('RECAPTCHA_SECRET_KEY');

        $response = Http::asForm()->post('https://www.google.com/recaptcha/api/siteverify', [
            'secret' => $secretKey,
            'response' => $recaptchaResponse,
            'remoteip' => $request->ip(),
        ]);

        $result = $response->json();

        if (!$result['success']) {
            return back()->withErrors(['captcha' => 'reCAPTCHA verification failed. Please try again.']);
        }
        try{
            $emails = getConfigurations()['contact_mails'];
            $to = explode(",", trim($emails));
            Mail::send('emails.contact', $data, function ($m) use($to) {
                $m->from('info@mainitsol.com', 'Main IT Services');
                $m->to($to)->subject('Contact Form Submittion from  Main IT Services');
            });
        }catch(\Exception $e){
            dd($e);
        }
        ContactMails::create($data);
        Session::flash('success', 'Thank You for contacting us.');
        return redirect()->back();
    }

    public function subscribe(Request $request)
    {
        $msg = "";
        $subs = Subscribers::where('email',$request->email)->first();
        if(empty($subs)) {
            Subscribers::create([
                'email'=>$request->email,
                'name'=>$request->name??null,
                // 'phone'=>$request->phone??'',
            ]);
            $msg = "You have successfully Subscribed";
        } else { $msg = 'You are already subscribed.'; }
        return $msg;
    }

    public function getStates($countryId)
    {
        $states = States::where('country_id', $countryId)->pluck('name', 'id');
        return response()->json($states);
    }

    public function getCities($stateId)
    {
        $cities = Cities::where('state_id', $stateId)->pluck('name', 'id');
        return response()->json($cities);
    }

    public function fetchCities(Request $request){
        $cities = Cities::where('name', 'LIKE' , '%'.$request->term.'%')->select('id', 'name')->get();
        return response()->json($cities);
    }

    public function product_detail($category_slug, $slug){
        $data = Products::with('category','location','reviews','user')
                        ->where('is_active', 1)
                        ->where('slug', $slug)
                        ->whereHas('category', function ($query) use ($category_slug) {
                            $query->where('slug', $category_slug);
                        })
                        ->firstOrFail();

        return view('frontend.product_detail', compact('data'));
    }

    public function product_detail_legacy($slug){
        $data = Products::with('category')
                        ->where('is_active', 1)
                        ->where('slug', $slug)
                        ->firstOrFail();

        if (!empty($data->category) && !empty($data->category->slug)) {
            return redirect()->route('productDetail', [
                'category_slug' => $data->category->slug,
                'slug' => $data->slug,
            ], 301);
        }

        abort(404);
    }

    public function product_review_store($id, Request $request){
        $data = $request->except('_token');
        $data['created_by'] = Auth::user()->id;
        $review = ProductReviews::create($data);
        Session::flash('success', 'Thank You For Your Review');
        return redirect()->back();
    }

    public function blog_review_store($id, Request $request){
        $data = $request->except('_token');
        $data['created_by'] = Auth::user()->id;
        $review = BlogReviews::create($data);
        Session::flash('success', 'Thank You For Your Review');
        return redirect()->back();
    }

    public function login(){
        if(Auth::check()){
            return redirect('/');
        }
        return view('frontend.auth.login');
    }

    public function dashboard(){

        $products = Products::where('is_active','=',1)
                            ->where('user_id',auth()->user()->id)
                            ->get();

        $reviews = ProductReviews::whereIn('product_id',$products->pluck('id')->toArray())
                                ->get();

        $activeListing = count($products);
        $totalReview = count($reviews);
        $messages = 0;
        $bookmark = 0;

        // dd($products, $reviews);


        return view('frontend.dashbaord', compact('activeListing','totalReview','messages','bookmark','reviews','products'));
    }

    public function mylisting(){

        $products = Products::where('is_active','=',1)
                            ->where('user_id',auth()->user()->id)
                            ->get();

        return view('frontend.dashboardfl.my_listing', compact('products'));
    }

    public function listingdelete($id){

        $products = Products::find($id)->delete();

        return response()->json(['message'=>'Successfully Deleted']);

    }

    public function reviews(){

        $products = Products::where('is_active','=',1)
                            ->where('user_id',auth()->user()->id)
                            ->get();

        $reviews = ProductReviews::whereIn('product_id',$products->pluck('id')->toArray())
                                ->get();

        $myreviews = ProductReviews::where('created_by',auth()->user()->id)
                                    ->get();


        return view('frontend.dashboardfl.reviews', compact('reviews', 'myreviews'));

    }

    public function product_bookmark_store($slug){

        $product = Products::where('slug',$slug)->first();

        $bookmark = ProductBookmark::where('user_id',Auth::user()->id)
                                    ->where('product_id',$product->id)
                                    ->first();


        if(isset($bookmark)){

            $bookmark->delete();

            Session::flash('success', 'Product bookmark removed successfully');

        }else{
            if(isset($product)){
                ProductBookmark::create([
                    'product_id' => $product->id,
                    'user_id' => Auth::user()->id,
                ]);

                Session::flash('success', 'Product bookmark successfully');
            }


        }
        return redirect()->back();
    }

    public function bookmark_listing(){

        $bookmarks = ProductBookmark::with('product.user')
                                    ->where('user_id',Auth::user()->id)
                                    ->paginate(9);

        return view('frontend.dashboardfl.bookmarks', compact('bookmarks'));
    }

    public function ask_question(Request $request){

        $data = $request->except('_token');
        $data['type'] = 'ask_question';
        $data['user_id'] = Auth::user()->id;

        ProductMessage::create($data);

        Session::flash('success', 'Question Created Successfully');

        return redirect()->back();
    }


    public function make_offer(Request $request){

        $data = $request->except('_token');
        $data['type'] = 'make_offer';
        $data['user_id'] = Auth::user()->id;

        ProductMessage::create($data);

        Session::flash('success', 'Offer Created Successfully');

        return redirect()->back();
    }

    public function askquestion(){

        $questions = ProductMessage::with('user','product')->where('type','ask_question')->where('product_user_id',Auth::user()->id)->get();

        $my_questions = ProductMessage::with('productuser','product')->where('type','ask_question')->where('user_id',Auth::user()->id)->get();

        return view('frontend.dashboardfl.questions', compact('questions', 'my_questions'));
    }

    public function offers(){

        $offers = ProductMessage::with('user','product')->where('type','make_offer')->where('product_user_id',Auth::user()->id)->get();

        $my_offers = ProductMessage::with('productuser','product')->where('type','make_offer')->where('user_id',Auth::user()->id)->get();

        return view('frontend.dashboardfl.offers', compact('offers', 'my_offers'));
    }

    public function accept_offer(Request $request, $id){

        $status = 2;

        $offer = ProductMessage::find($id);

        Session::flash('error', 'Offer Rejected Successfully');

        if($request->status === 'accept'){
            $status = 1;
            Session::flash('success', 'Offer Accepted Successfully');
        }

        $offer->update(['status' => $status]);

        return redirect()->back();
    }

    public function add_product(){

        $categories = ProductCategories::where('is_active',1)->OrderBy('title')->get()->groupBy('category_type');
        $states = States::where('country_id', '233')->orderBy('name', 'ASC')->pluck('name', 'id');

        return view('frontend.dashboardfl.add_product', compact('categories','states'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'category_id' => 'required',
            'location_id' => 'required',
            'cost_price' => 'required',
            'sell_price' => 'required',
            'gender' => 'required',
            'size' => 'required',
            'image' => 'required',
        ]);

        $data = $request->except('_token');

        /* Make Images Directory */
            $p_img = public_path().'/storage/photos/'.Auth::user()->id;
            File::isDirectory($p_img) or File::makeDirectory($p_img, 0777, true, true);
        /* Make Images Directory */

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = $file->getClientOriginalName();
            $filepath = $p_img.'/'.$filename;

            // create image manager with desired driver
            $manager = new ImageManager(new Driver());
            $image = $manager->read($request->file('image'));
            $image->save($filepath);

            $data['image'] = '/storage/photos/'.Auth::user()->id.'/'.$filename;
        }

        if(isset($request->gallery) && count($request->gallery)){
            foreach($request->gallery as $k => $gallery){
                $filename = $gallery->getClientOriginalName();
                $filepath = $p_img.'/'.$filename;
                // create image manager with desired driver
                $manager = new ImageManager(new Driver());
                $image = $manager->read($gallery);
                $image->save($filepath);

                $data['gallery'][$k] = '/storage/photos/'.Auth::user()->id.'/'.$filename;
            }
        }

        $data['slug'] = generateUniqueProductSlug($request->title);
        $data['is_active'] = 1;
        $data['created_by'] = Auth::user()->id;
        $data['user_id'] = Auth::user()->id;
        $data['health_certificate'] = ($request->health_certificate === 'on' || $request->health_certificate === 1)?1:0;
        $data['health_record'] = ($request->health_record === 'on' || $request->health_record === 1)?1:0;
        $data['health_warranty'] = ($request->health_warranty === 'on' || $request->health_warranty === 1)?1:0;
        
        if((Auth::user()->membership_id == 1 || Auth::user()->membership_id == 2 || Auth::user()->membership_id == 3) && Carbon::parse(Auth::user()->expiry_date)->format('Y-m-d') >= Carbon::now()->format('Y-m-d')){
            $data['is_featured'] = 1;
        }
        
        Products::create($data);
        Session::flash('success', 'Item added successfully');
        return redirect()->route('mylisting');
    }

    public function product_edit($id){
        $product = Products::find($id);
        $categories = ProductCategories::where('is_active',1)->OrderBy('title')->get()->groupBy('category_type');
        $states = States::where('country_id', '233')->orderBy('name', 'ASC')->pluck('name', 'id');
        $cities = Cities::where('state_id', $product->state_id)->pluck('name', 'id');
        return view('frontend.dashboardfl.edit_product', compact('product', 'categories', 'states', 'cities'));
    }

    public function product_update(Request $request){
        $product = Products::find($request->id);

        $request->validate([
            'title' => 'required',
            'category_id' => 'required',
            'location_id' => 'required',
            'cost_price' => 'required',
            'sell_price' => 'required',
            'gender' => 'required',
            'size' => 'required',
        ]);

        $data = $request->except('_token', 'gallery', 'existing_gallery', 'removed_gallery');

        /* Make Images Directory */
            $p_img = public_path().'/storage/photos/'.Auth::user()->id;
            File::isDirectory($p_img) or File::makeDirectory($p_img, 0777, true, true);
        /* Make Images Directory */

        if($product->image != $request->image){
            if ($request->hasFile('image')) {
                $file = $request->file('image');
                $filename = $file->getClientOriginalName();
                $filepath = $p_img.'/'.$filename;
    
                // create image manager with desired driver
                $manager = new ImageManager(new Driver());
                $image = $manager->read($request->file('image'));
                $image->save($filepath);
    
                $data['image'] = '/storage/photos/'.Auth::user()->id.'/'.$filename;
            }else{
                $data['image'] = $product->image;
            }
        }else{
            $data['image'] = $product->image;
        }

        // Handle gallery images
        $gallery = [];
        
        // Get existing gallery (if product has gallery)
        $existingGallery = [];
        if($product->gallery && is_array($product->gallery)) {
            $existingGallery = $product->gallery;
        }
        
        // Get removed gallery images
        $removedGallery = [];
        if($request->has('removed_gallery') && !empty($request->removed_gallery)) {
            $removedGallery = json_decode($request->removed_gallery, true);
            if(!is_array($removedGallery)) {
                $removedGallery = [];
            }
        }
        
        // Keep existing gallery images that were not removed
        foreach($existingGallery as $existingImage) {
            if(!in_array($existingImage, $removedGallery)) {
                $gallery[] = $existingImage;
            } else {
                // Delete removed image file from server
                $imagePath = public_path($existingImage);
                if(File::exists($imagePath)) {
                    File::delete($imagePath);
                }
            }
        }
        
        // Handle new gallery images
        if($request->hasFile('gallery') && count($request->file('gallery'))) {
            foreach($request->file('gallery') as $file) {
                $filename = time() . '_' . $file->getClientOriginalName();
                $filepath = $p_img.'/'.$filename;
                
                // create image manager with desired driver
                $manager = new ImageManager(new Driver());
                $image = $manager->read($file);
                $image->save($filepath);
                
                $gallery[] = '/storage/photos/'.Auth::user()->id.'/'.$filename;
            }
        }
        
        $data['gallery'] = $gallery;

        $data['slug'] = Str::slug($request->title, '-');
        $data['is_active'] = 1;
        $data['created_by'] = Auth::user()->id;
        $data['user_id'] = Auth::user()->id;
        $data['health_warranty'] = ($request->health_warranty === 'on' || $request->health_warranty === 'yes' || $request->health_warranty === 1)?1:0;
        
        if((Auth::user()->membership_id == 1 || Auth::user()->membership_id == 2 || Auth::user()->membership_id == 3) && Carbon::parse(Auth::user()->expiry_date)->format('Y-m-d') >= Carbon::now()->format('Y-m-d')){
            $data['is_featured'] = 1;
        }

        if ($request->has('seo_meta') && is_array($request->input('seo_meta'))) {
            $existingSeo = is_array($product->seo_meta) ? $product->seo_meta : [];
            $data['seo_meta'] = array_merge($existingSeo, $request->input('seo_meta'));
        }

        Products::find($request->id)->update($data);
        Session::flash('success', 'Item updated successfully');
        return redirect()->route('mylisting');
    }

    public function bloglisting(){

        $blogs = Blogs::where('user_id',Auth::user()->id)
                    ->get();

        return view('frontend.dashboardfl.blog', compact('blogs'));
    }

    public function blog_create(){

        $categories = BlogCategories::where('is_active', 1)->OrderBy('title')->get();
        $sort_order = Blogs::max('sort_order')+1;

        return view('frontend.dashboardfl.add_blog',compact('sort_order','categories'));
    }

    public function blog_store(Request $request){

        $data = $request->except('_token');
        $data['is_active'] = 0;
        $data['user_id'] = auth()->user()->id;
        $data['slug'] = Str::slug($request->title, '-');

        /* Make Images Directory */
            $p_img = public_path().'/storage/photos/'.Auth::user()->id;
            File::isDirectory($p_img) or File::makeDirectory($p_img, 0777, true, true);
        /* Make Images Directory */

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = $file->getClientOriginalName();
            $filepath = $p_img.'/'.$filename;

            // create image manager with desired driver
            $manager = new ImageManager(new Driver());
            $image = $manager->read($request->file('image'));
            $image->save($filepath);

            $data['image'] = '/storage/photos/'.Auth::user()->id.'/'.$filename;
        }

        if ($request->hasFile('seo_meta.og.image')) {

            $file = $request->file('seo_meta.og.image');
            $filename = $file->getClientOriginalName();
            $filepath = $p_img.'/'.$filename;

            // create image manager with desired driver
            $manager = new ImageManager(new Driver());
            $image = $manager->read($request->file('image'));
            $image->save($filepath);

            $data['seo_meta']['og']['image'] = '/storage/photos/'.Auth::user()->id.'/'.$filename;

        }

        if ($request->hasFile('seo_meta.twitter.image')) {

            $file = $request->file('seo_meta.twitter.image');
            $filename = $file->getClientOriginalName();
            $filepath = $p_img.'/'.$filename;

            // create image manager with desired driver
            $manager = new ImageManager(new Driver());
            $image = $manager->read($request->file('image'));
            $image->save($filepath);

            $data['seo_meta']['twitter']['image'] = '/storage/photos/'.Auth::user()->id.'/'.$filename;

        }

        $item = Blogs::create($data);
        if($request->has('categories') && !empty($request->categories)) {
            foreach($request->categories as $cat) {
                BlogCategoryRelation::create([
                    'blog_id'=>$item['id'],
                    'category_id'=>$cat,
                ]);
            }
        }
        Session::flash('success', 'Item added successfully');
        return redirect()->route('frontblogs');
    }

    public function blog_edit($id){

        $categories = BlogCategories::where('is_active', 1)->OrderBy('title')->get();
        $blog = Blogs::find($id);
        $current_cats = BlogCategoryRelation::where('blog_id', $id)->pluck('category_id')->toArray();

        return view('frontend.dashboardfl.edit_blog',compact('blog','categories','current_cats'));
    }

    public function blog_update($id, Request $request){

        $data = $request->except('_token');
        $data['is_active'] = 0;
        $data['user_id'] = auth()->user()->id;
        $data['slug'] = Str::slug($request->title, '-');

        /* Make Images Directory */
            $p_img = public_path().'/storage/photos/'.Auth::user()->id;
            File::isDirectory($p_img) or File::makeDirectory($p_img, 0777, true, true);
        /* Make Images Directory */

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = $file->getClientOriginalName();
            $filepath = $p_img.'/'.$filename;

            // create image manager with desired driver
            $manager = new ImageManager(new Driver());
            $image = $manager->read($request->file('image'));
            $image->save($filepath);

            $data['image'] = '/storage/photos/'.Auth::user()->id.'/'.$filename;
        }

        if ($request->hasFile('seo_meta.og.image')) {

            $file = $request->file('seo_meta.og.image');
            $filename = $file->getClientOriginalName();
            $filepath = $p_img.'/'.$filename;

            // create image manager with desired driver
            $manager = new ImageManager(new Driver());
            $image = $manager->read($request->file('image'));
            $image->save($filepath);

            $data['seo_meta']['og']['image'] = '/storage/photos/'.Auth::user()->id.'/'.$filename;

        }

        if ($request->hasFile('seo_meta.twitter.image')) {

            $file = $request->file('seo_meta.twitter.image');
            $filename = $file->getClientOriginalName();
            $filepath = $p_img.'/'.$filename;

            // create image manager with desired driver
            $manager = new ImageManager(new Driver());
            $image = $manager->read($request->file('image'));
            $image->save($filepath);

            $data['seo_meta']['twitter']['image'] = '/storage/photos/'.Auth::user()->id.'/'.$filename;

        }

        $item = Blogs::find($id)->update($data);
        BlogCategoryRelation::where('blog_id', $id)->delete();
        if($request->has('categories') && !empty($request->categories)) {
            foreach($request->categories as $cat) {
                BlogCategoryRelation::create([
                    'blog_id'=>$id,
                    'category_id'=>$cat,
                ]);
            }
        }
        Session::flash('success', 'Item update successfully');
        return redirect()->route('frontblogs');
    }

    public function blog_delete($id){

        $blog = Blogs::find($id)->delete();

        BlogCategoryRelation::where('blog_id', $id)->delete();

        return response()->json(['message'=>'Successfully Deleted']);

    }
}
