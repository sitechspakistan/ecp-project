<?php
use App\Models\Clients;
use App\Models\News;
use App\Models\Blogs;
use App\Models\Testimonials;
use App\Models\Menu;
use App\Models\MenuItems;
use App\Models\Membership;
use App\Models\Services;
use App\Models\Albums;
use App\Models\Configurations;
use App\Models\GroupModules;
use App\Models\Pages;
use App\Models\User;
use App\Models\Countries;
use App\Models\ProductCategories;
use App\Models\ProductReviews;
use App\Models\OrderDetail;
use App\Models\Products;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Str;

function getClients() {
    return Clients::where('is_active', 1)->OrderBy('sort_order')->get();
}

function getTestimonials() {
    return Testimonials::where('is_active', 1)->OrderBy('sort_order')->get();
}

function getNews($limit=null) {
    if($limit!=null) {
        return News::where('is_active', 1)->OrderBy('id', 'DESC')->limit($limit)->get();
    } else {
        return News::where('is_active', 1)->OrderBy('id', 'DESC')->get();
    }
}

function getBlogs($limit=null) {
    if($limit!=null) {
        return Blogs::with('categories')->where('is_active', 1)->OrderBy('id', 'DESC')->limit($limit)->get();
    } else {
        return Blogs::with('categories')->where('is_active', 1)->OrderBy('id', 'DESC')->get();
    }
}

function getAlbums($limit=null) {
    if($limit!=null) {
        return Albums::where('is_active', 1)->OrderBy('id', 'DESC')->limit($limit)->get();
    } else {
        return Albums::where('is_active', 1)->OrderBy('id', 'DESC')->get();
    }
}

function getMenus() {
    return Menu::OrderBy('title')->get();
}

function primaryMenu() {
    $menu_id = Menu::where('is_primary', 1)->value('id');
    return MenuItems::where('menu_id', $menu_id)->whereNull('parent')->OrderBy('sort_order')->get();
}

function getMenuByID($id) {
    return Menu::find($id);
}

function parentServices() {
    return Services::where('is_active', 1)->whereNull('parent_id')->OrderBy('sort_order')->get();
}

function getConfigurations() {
    return Configurations::find(1);
}

function pageChildrens($parent_id){
	return Pages::where('is_active',1)->where('parent_id', $parent_id)->get();
}

function relatedPage($page_id){
	$page = Pages::find($page_id);
    if(!empty($page)) {
        if($page->parent_id==null){
            return Pages::where('is_active',1)->where('parent_id', null)->where('id', '!=',$page->id)->get();
        }else{
            return Pages::where('is_active',1)->where('parent_id', $page->parent_id)->where('id', '!=',$page->id)->get();
        }
    }
    return [];
}

function siteModules() {
    return ['pages', 'services', 'news', 'blogs', 'events', 'albums', 'clients', 'testimonials', 'users', 'redirections', 'menu', 'configuration', 'inbox', 'subscribers'];
}

function check_access($user_id,$module,$access) {
	if(Auth::check()){
		$user = User::find($user_id);
		if($user['user_type']=='admin' && empty($user['group_id'])) { return true; }
		elseif($user['user_type']=='admin' && !empty($user['group_id'])) {
			$module = GroupModules::where('group_id',$user['group_id'])->where('module',$module)->first();
			if(!empty($module)) {
				return ($module[$access]==1)?true:false;
			} else { return false; }
		} else {
			return false;
		}
	}
}

function getCountries() {
    return Countries::pluck('id', 'name');
}

function GetProductCategory($cat_type = null, $limit = null){
    $category = ProductCategories::with('products')->where('is_active',1)->orderBy('sort_order','DESC');

    if($cat_type !== null){
        $category = $category->where('category_type', $cat_type);
    }

    if($limit === null){
        $category = $category->get();
    }else{
        $category = $category->take($limit)->get();
    }

    return $category;
}

function getProducts($featured, $category_type = [], $limit = null, $latest = 0){

    // if(count($category_type) > 0){
    //     $category = ProductCategories::whereIn('category_type',$category_type)->pluck('id')->toArray();
    // }

    // $product = Products::with('location')
    //                     ->where('is_active',1);

    // if(count($category_type) > 0){
    //     $product->whereIn('category_id',$category);
    // }

    // if($featured === 1){
    //     $product->where('is_featured', $featured);
    // }

    // if($latest === 1){
    //     $product->orderBy('created_at','DESC');
    // }else{
    //     $product->orderBy('sort_order','DESC');
    // }

    // if($limit === null){
    //     $product = $product->get();
    // }else{
    //     $product = $product->take($limit)->get();
    // }

    // return $product;

    $category = [];

    if(count($category_type) > 0){
        $category = ProductCategories::whereIn('category_type', $category_type)
                                    ->pluck('id')
                                    ->toArray();
    }

    $product = Products::with(['location', 'user', 'category']) // Make sure user relationship is defined
                    ->where('products.is_active', 1)
                    ->join('users', 'products.user_id', '=', 'users.id') // Join users table
                    ->select('products.*'); // Select only products columns

    if(count($category_type) > 0){
        $product->whereIn('category_id', $category);
    }

    if($featured === 1){
        $product->where('is_featured', $featured);
    }

    // First sort by user membership_id: 0, 1, 2, 3, then null
    $product->orderByRaw('CASE 
        WHEN users.membership_id = 2 THEN 1
        WHEN users.membership_id = 3 THEN 2
        WHEN users.membership_id = 1 THEN 3
        WHEN users.membership_id = 0 THEN 4
        ELSE 5
    END ASC');
    
    // Then sort by sort_order or created_at based on latest parameter
    if($latest === 1){
        $product->orderBy('products.created_at', 'DESC');
    } else {
        $product->orderBy('products.sort_order', 'DESC');
    }

    // Apply limit if specified
    if($limit === null){
        $product = $product->get();
    } else {
        $product = $product->take($limit)->get();
    }

    return $product;
}

function featuredSellerMembershipCodes() {
    $defaultCodes = [1, 2, 3];

    try {
        $codes = Membership::where('user_type', 'seller')
            ->where('is_active', 1)
            ->where('is_featured_eligible', 1)
            ->orderBy('code')
            ->pluck('code')
            ->map(function ($code) {
                return (int) $code;
            })
            ->toArray();

        return count($codes) > 0 ? $codes : $defaultCodes;
    } catch (\Throwable $e) {
        return $defaultCodes;
    }
}

function productDetailUrl($product){
    if (!empty($product->category) && !empty($product->category->slug)) {
        return route('productDetail', [
            'category_slug' => $product->category->slug,
            'slug' => $product->slug,
        ]);
    }

    return route('productDetail.legacy', $product->slug);
}

function generateUniqueProductSlug($title, $ignoreId = null){
    $baseSlug = Str::slug((string) $title, '-');
    if ($baseSlug === '') {
        $baseSlug = 'product';
    }

    $slug = $baseSlug;
    $counter = 1;

    while (true) {
        $query = Products::where('slug', $slug);

        if (!empty($ignoreId)) {
            $query->where('id', '!=', $ignoreId);
        }

        if (!$query->exists()) {
            return $slug;
        }

        $slug = $baseSlug.'-'.$counter;
        $counter++;
    }
}

function productTitleWithCategory($product){
    $title = $product->title ?? '';
    $categoryTitle = $product->category->title ?? null;

    if (!empty($categoryTitle)) {
        return $title.' ('.$categoryTitle.')';
    }

    return $title;
}

/**
 * Display 0/1 (or legacy text) for vaccination / health fields on the product page.
 */
function productYesNoLabel($value)
{
    if ($value === null || $value === '') {
        return '-';
    }
    if (is_numeric($value) && (int) $value === 1) {
        return 'Yes';
    }
    if (is_numeric($value) && (int) $value === 0) {
        return 'No';
    }

    return (string) $value;
}

function getProductPage($cat_id, $sort_by = 'DESC', $sort_column = 'sort_order', $page = 1, $no_of_record = 6, array $filters = []){

    $products = Products::with('location','category','reviews','bookmarks')
                        ->where('is_active',1);

    if (isset($cat_id) && $cat_id !== '' && $cat_id !== null) {
        $products = $products->where('category_id', $cat_id);
    }

    $search = trim((string) ($filters['q'] ?? ''));
    if ($search !== '') {
        $products = $products->where(function ($q) use ($search) {
            $q->where('title', 'LIKE', "%{$search}%")
                ->orWhere('sell_price', 'LIKE', "%{$search}%")
                ->orWhereHas('category', function ($categoryQuery) use ($search) {
                    $categoryQuery->where('title', 'LIKE', "%{$search}%");
                });
        });
    }

    $priceMin = $filters['price_min'] ?? null;
    if ($priceMin !== null && $priceMin !== '' && is_numeric($priceMin)) {
        $products = $products->where('sell_price', '>=', (float) $priceMin);
    }
    $priceMax = $filters['price_max'] ?? null;
    if ($priceMax !== null && $priceMax !== '' && is_numeric($priceMax)) {
        $products = $products->where('sell_price', '<=', (float) $priceMax);
    }

    $availability = $filters['availability'] ?? 'all';
    if ($availability === 'available') {
        $products = $products->where('quantity', '>', 0);
    } elseif ($availability === 'unavailable') {
        $products = $products->where(function ($q) {
            $q->where('quantity', '<=', 0)->orWhereNull('quantity');
        });
    }

    $sortable = ['sort_order', 'created_at', 'sell_price', 'title', 'id'];
    if (!in_array($sort_column, $sortable, true)) {
        $sort_column = 'created_at';
    }
    $sortDir = strtoupper((string) $sort_by) === 'ASC' ? 'asc' : 'desc';
    $products = $products->orderBy($sort_column, $sortDir);

    return $products->paginate($no_of_record)->withQueryString();
}

function showReviews($product_id){

    $reviews = ProductReviews::where('product_id',$product_id)->pluck('rating')->toArray();

    if (empty($reviews)) {
        // Return a default value or handle the case where there are no reviews
        return 0.0; // or any other appropriate value, e.g., 0
    }

    // Count frequencies
    $ratingCounts = array_count_values($reviews);
    $maxFrequency = max($ratingCounts);

    // Get all ratings with the maximum frequency
    $commonRatings = array_keys(array_filter($ratingCounts, fn($count) => $count === $maxFrequency));

    // Get the largest rating among the common ones
    $largestCommonRating = max($commonRatings);

    return $largestCommonRating;
}

function getRating($product_id, $star){

    $reviews = ProductReviews::where('product_id',$product_id)
                            ->whereRaw('ROUND(rating, 0) >= ?', [$star])
                            ->whereRaw('ROUND(rating, 0) <= ?', [$star])
                            ->get()
                            ->count();

    return $reviews;
}

function getCart() {
	$data = [];
	try{
		if(Cookie::has('products') && !empty(Cookie::get('products'))) {
			$data = unserialize(Cookie::get('products'));
			if(is_array($data)){
				return $data;
			}else{return [];}
		}
	}catch(Exception $e){
		return $data;
	}
	return $data;
}

function getProduct($id){

    $product = Products::find($id);
    return $product;

}

function cartTotal() {
    if(!empty(Cookie::get('products'))) {
        $arr = unserialize(Cookie::get('products'));
        $price = [];
        foreach($arr as $value) { $price[] = $value['total']; }
        return array_sum($price);
    }
}

function getFeaturedProducts($featured, $category_type = [], $limit = null, $latest = 0){
    
    if(count($category_type) > 0){
        $category = ProductCategories::whereIn('category_type', $category_type)->pluck('id')->toArray();
    }
    
    $product = Products::with('location','category','reviews','bookmarks')
                    ->where('is_active', 1)
                    ->whereHas('user', function ($query) {
                        $query->whereIn('membership_id', featuredSellerMembershipCodes())
                              ->whereDate('expiry_date', '>', now());
                    });
                    
    if(count($category_type) > 0){
        $product->whereIn('category_id', $category);
    }
    
    if($featured === 1){
        $product->where('is_featured', $featured);
    }
    
    if($latest === 1){
        $product->orderBy('created_at', 'DESC');
    } else {
        $product->orderBy('sort_order', 'DESC');
    }
    
    $product = $limit === null ? $product->get() : $product->take($limit)->get();
    
    return $product;
}

function getProductOrder($product_id){
    return OrderDetail::where('product_id',$product_id)
                    ->whereHas('orderMaster', function ($query) {
                        $query->where('order_status', '!=', 'pending');
                    })
                    ->count();
}

function getCartProduct($product_id){
    if(!empty(Cookie::get('products'))) {
        $products = Cookie::get('products');
        $p_array = unserialize($products);
        $arr_column = array_column($p_array, 'product');
        $k = array_search($product_id, $arr_column);
        $in_array = in_array($product_id, $arr_column);
        $pro = Products::find($product_id);
        if($in_array) {
            if(($p_array[$k]['qty']+1) > $pro->quantity){
                return true;
            }
        }
    }

    return false;
}