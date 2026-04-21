<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\PagesController;
use App\Http\Controllers\ClientsController;
use App\Http\Controllers\ServicesController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\NewsCategoryController;
use App\Http\Controllers\BlogsController;
use App\Http\Controllers\BlogCategoryController;
use App\Http\Controllers\EventsController;
use App\Http\Controllers\EventsCategoryController;
use App\Http\Controllers\AlbumsController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\TestimonialsController;
use App\Http\Controllers\ConfigurationsController;
use App\Http\Controllers\UserGroupController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RedirectionsController;
use App\Http\Controllers\InboxController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductCategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\MembershipController;
use App\Http\Middleware\AllowForAdmin;
use App\Http\Middleware\CheckLoginRequired;
use App\Http\Middleware\FrontAuth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/get-states/{countryId}', [HomeController::class, 'getStates']);
Route::get('/get-cities/{stateId}', [HomeController::class, 'getCities']);
Route::get('/fetch-cities', [HomeController::class, 'fetchCities']);

Route::get('/create-storage-link', function () {
    Artisan::call('storage:link');
    return 'Storage link created!';
});

Route::get('/artisan/{cmd}', function ($cmd) {
    switch ($cmd) {
        case 'clear':
            $exitCode = Artisan::call('view:clear');
            $exitCode = Artisan::call('route:clear');
            $exitCode = Artisan::call('config:clear');
            $exitCode = Artisan::call('cache:clear');
            break;

        case 'cached':
            $exitCode = Artisan::call('config:cache');
            break;

        default:
            abort(404);
            break;
    }
    return $exitCode;
});

Route::middleware(['auth', AllowForAdmin::class])->prefix('admin')->group(function () {
    Route::get('/', [AdminController::class, 'index'])->name('dashboard');
    Route::get('/profile', [AdminController::class, 'profile'])->name('profilePage');
    Route::post('/profile', [AdminController::class, 'update_profile'])->name('updateProfile');

    /* Pages Routes */
    Route::get('/pages', [PagesController::class, 'index'])->name('pages.index');
    Route::get('/pages/create', [PagesController::class, 'create'])->name('pages.create');
    Route::post('/pages/store', [PagesController::class, 'store'])->name('pages.store');
    Route::get('/pages/{id}/edit', [PagesController::class, 'edit'])->name('pages.edit');
    Route::get('/pages/{id}/status', [PagesController::class, 'status'])->name('pages.status');
    Route::get('/pages/{id}/delete', [PagesController::class, 'delete'])->name('pages.delete');
    Route::post('/pages/get-components', [PagesController::class, 'getComponent'])->name('ajaxGetComps');
    Route::post('/pages/{id}/update', [PagesController::class, 'update'])->name('pages.update');

    /* Product Categories Routes */
    Route::get('/products-categories', [ProductCategoryController::class, 'index'])->name('products-categories.index');
    Route::get('/products-categories/create', [ProductCategoryController::class, 'create'])->name('products-categories.create');
    Route::post('/products-categories/store', [ProductCategoryController::class, 'store'])->name('products-categories.store');
    Route::get('/products-categories/{id}/edit', [ProductCategoryController::class, 'edit'])->name('products-categories.edit');
    Route::post('/products-categories/{id}/update', [ProductCategoryController::class, 'update'])->name('products-categories.update');
    Route::get('/products-categories/{id}/status', [ProductCategoryController::class, 'status'])->name('products-categories.status');
    Route::post('/products-categories/delete-all', [ProductCategoryController::class, 'delete'])->name('products-categories.delete');

    /* Products Routes */
    Route::get('/products', [ProductController::class, 'index'])->name('products.index');
    Route::get('/products/create', [ProductController::class, 'create'])->name('products.create');
    Route::post('/products/store', [ProductController::class, 'store'])->name('products.store');
    Route::get('/products/{id}/edit', [ProductController::class, 'edit'])->name('products.edit');
    Route::post('/products/{id}/update', [ProductController::class, 'update'])->name('products.update');
    Route::get('/products/{id}/status', [ProductController::class, 'status'])->name('products.status');
    Route::post('/products/delete-all', [ProductController::class, 'delete_all'])->name('products.delete_all');
Route::get('/products/delete/{id}', [ProductController::class, 'delete'])->name('products.delete');

    /* Clients */
    Route::get('/clients', [ClientsController::class, 'index'])->name('clients.index');
    Route::post('/clients/store', [ClientsController::class, 'store'])->name('clients.store');
    Route::post('/clients/{id}/update', [ClientsController::class, 'update'])->name('clients.update');
    Route::get('/clients/{id}/status', [ClientsController::class, 'status'])->name('clients.status');
    Route::post('/clients/delete-all', [ClientsController::class, 'delete'])->name('clients.delete');

    /* Testimonials */
    Route::get('/testimonials', [TestimonialsController::class, 'index'])->name('testimonials.index');
    Route::post('/testimonials/store', [TestimonialsController::class, 'store'])->name('testimonials.store');
    Route::post('/testimonials/{id}/update', [TestimonialsController::class, 'update'])->name('testimonials.update');
    Route::get('/testimonials/{id}/status', [TestimonialsController::class, 'status'])->name('testimonials.status');
    Route::post('/testimonials/delete-all', [TestimonialsController::class, 'delete'])->name('testimonials.delete');

    /* Services Routes */
    Route::get('/services', [ServicesController::class, 'index'])->name('services.index');
    Route::get('/services/create', [ServicesController::class, 'create'])->name('services.create');
    Route::post('/services/store', [ServicesController::class, 'store'])->name('services.store');
    Route::get('/services/{id}/edit', [ServicesController::class, 'edit'])->name('services.edit');
    Route::post('/services/{id}/update', [ServicesController::class, 'update'])->name('services.update');
    Route::get('/services/{id}/status', [ServicesController::class, 'status'])->name('services.status');
    Route::post('/services/delete-all', [ServicesController::class, 'delete'])->name('services.delete');

    /* News Routes */
    Route::get('/news', [NewsController::class, 'index'])->name('news.index');
    Route::get('/news/create', [NewsController::class, 'create'])->name('news.create');
    Route::post('/news/store', [NewsController::class, 'store'])->name('news.store');
    Route::get('/news/{id}/edit', [NewsController::class, 'edit'])->name('news.edit');
    Route::post('/news/{id}/update', [NewsController::class, 'update'])->name('news.update');
    Route::get('/news/{id}/status', [NewsController::class, 'status'])->name('news.status');
    Route::post('/news/delete-all', [NewsController::class, 'delete'])->name('news.delete');
    Route::post('/news/update-seo', [NewsController::class, 'seo'])->name('news.seo');

    Route::get('/news-categories', [NewsCategoryController::class, 'index'])->name('news-categories.index');
    Route::post('/news-categories/store', [NewsCategoryController::class, 'store'])->name('news-categories.store');
    Route::post('/news-categories/{id}/update', [NewsCategoryController::class, 'update'])->name('news-categories.update');
    Route::get('/news-categories/{id}/status', [NewsCategoryController::class, 'status'])->name('news-categories.status');
    Route::post('/news-categories/delete-all', [NewsCategoryController::class, 'delete'])->name('news-categories.delete');

    /* Blogs Routes */
    Route::get('/blogs', [BlogsController::class, 'index'])->name('blogs.index');
    Route::get('/blogs/create', [BlogsController::class, 'create'])->name('blogs.create');
    Route::post('/blogs/store', [BlogsController::class, 'store'])->name('blogs.store');
    Route::get('/blogs/{id}/edit', [BlogsController::class, 'edit'])->name('blogs.edit');
    Route::post('/blogs/{id}/update', [BlogsController::class, 'update'])->name('blogs.update');
    Route::get('/blogs/{id}/status', [BlogsController::class, 'status'])->name('blogs.status');
    Route::post('/blogs/delete-all', [BlogsController::class, 'delete'])->name('blogs.delete');
    Route::post('/blogs/update-seo', [BlogsController::class, 'seo'])->name('blogs.seo');

    Route::get('/blogs-categories', [BlogCategoryController::class, 'index'])->name('blogs-categories.index');
    Route::post('/blogs-categories/store', [BlogCategoryController::class, 'store'])->name('blogs-categories.store');
    Route::post('/blogs-categories/{id}/update', [BlogCategoryController::class, 'update'])->name('blogs-categories.update');
    Route::get('/blogs-categories/{id}/status', [BlogCategoryController::class, 'status'])->name('blogs-categories.status');
    Route::post('/blogs-categories/delete-all', [BlogCategoryController::class, 'delete'])->name('blogs-categories.delete');

    /* Events Routes */
    Route::get('/events', [EventsController::class, 'index'])->name('events.index');
    Route::get('/events/create', [EventsController::class, 'create'])->name('events.create');
    Route::post('/events/store', [EventsController::class, 'store'])->name('events.store');
    Route::get('/events/{id}/edit', [EventsController::class, 'edit'])->name('events.edit');
    Route::post('/events/{id}/update', [EventsController::class, 'update'])->name('events.update');
    Route::get('/events/{id}/status', [EventsController::class, 'status'])->name('events.status');
    Route::post('/events/delete-all', [EventsController::class, 'delete'])->name('events.delete');
    Route::post('/events/update-seo', [EventsController::class, 'seo'])->name('events.seo');

    Route::get('/events-categories', [EventsCategoryController::class, 'index'])->name('events-categories.index');
    Route::post('/events-categories/store', [EventsCategoryController::class, 'store'])->name('events-categories.store');
    Route::post('/events-categories/{id}/update', [EventsCategoryController::class, 'update'])->name('events-categories.update');
    Route::get('/events-categories/{id}/status', [EventsCategoryController::class, 'status'])->name('events-categories.status');
    Route::post('/events-categories/delete-all', [EventsCategoryController::class, 'delete'])->name('events-categories.delete');

    /* Albums Routes */
    Route::get('/albums', [AlbumsController::class, 'index'])->name('albums.index');
    Route::get('/albums/create', [AlbumsController::class, 'create'])->name('albums.create');
    Route::post('/albums/store', [AlbumsController::class, 'store'])->name('albums.store');
    Route::get('/albums/{id}/edit', [AlbumsController::class, 'edit'])->name('albums.edit');
    Route::post('/albums/{id}/update', [AlbumsController::class, 'update'])->name('albums.update');
    Route::get('/albums/{id}/status', [AlbumsController::class, 'status'])->name('albums.status');
    Route::post('/albums/delete-all', [AlbumsController::class, 'delete'])->name('albums.delete');

    /* Orders Routes */
    Route::get('/orders', [OrderController::class, 'index'])->name('orders.index');
    // Route::get('/orders/create', [OrderController::class, 'create'])->name('orders.create');
    // Route::post('/orders/store', [OrderController::class, 'store'])->name('orders.store');
    // Route::get('/orders/{id}/edit', [OrderController::class, 'edit'])->name('orders.edit');
    // Route::post('/orders/{id}/update', [OrderController::class, 'update'])->name('orders.update');
    // Route::get('/orders/{id}/status', [OrderController::class, 'status'])->name('orders.status');
    // Route::post('/orders/delete-all', [OrderController::class, 'delete'])->name('orders.delete');

    /* Users Routes */
    Route::get('/users', [UserController::class, 'index'])->name('users.index');
    Route::post('/users/store', [UserController::class, 'store'])->name('users.store');
    Route::post('/users/{id}/update', [UserController::class, 'update'])->name('users.update');
    Route::get('/users/{id}/status', [UserController::class, 'status'])->name('users.status');
    Route::post('/users/delete-all', [UserController::class, 'delete'])->name('users.delete');

    Route::get('/sellers', [UserController::class, 'sellers'])->name('users.seller');
    Route::get('/sellers/{id}/status', [UserController::class, 'seller_status'])->name('users.seller.status');
    Route::post('/sellers/{id}/password', [UserController::class, 'seller_password_update'])->name('users.seller.password');
    Route::post('/sellers/{id}/membership-expiry', [UserController::class, 'seller_membership_expiry_update'])->name('users.seller.membership.expiry');
    Route::post('/sellers/delete-all', [UserController::class, 'delete_sellers'])->name('users.seller.delete');

    /* Memberships Routes */
    Route::get('/memberships', [MembershipController::class, 'index'])->name('memberships.index');
    Route::get('/memberships/create', [MembershipController::class, 'create'])->name('memberships.create');
    Route::post('/memberships/store', [MembershipController::class, 'store'])->name('memberships.store');
    Route::get('/memberships/{id}/edit', [MembershipController::class, 'edit'])->name('memberships.edit');
    Route::post('/memberships/{id}/update', [MembershipController::class, 'update'])->name('memberships.update');
    Route::get('/memberships/{id}/status', [MembershipController::class, 'status'])->name('memberships.status');
    Route::post('/memberships/delete-all', [MembershipController::class, 'delete'])->name('memberships.delete');

    Route::get('/activity-logs', [UserController::class, 'logs'])->name('logsPage');

    /* User Groups Routes */
    Route::get('/user-groups', [UserGroupController::class, 'index'])->name('usergroups.index');
    Route::get('/user-groups/create', [UserGroupController::class, 'create'])->name('usergroups.create');
    Route::post('/user-groups/store', [UserGroupController::class, 'store'])->name('usergroups.store');
    Route::get('/user-groups/{id}/edit', [UserGroupController::class, 'edit'])->name('usergroups.edit');
    Route::post('/user-groups/{id}/update', [UserGroupController::class, 'update'])->name('usergroups.update');
    Route::get('/user-groups/{id}/status', [UserGroupController::class, 'status'])->name('usergroups.status');
    Route::post('/user-groups/delete-all', [UserGroupController::class, 'delete'])->name('usergroups.delete');

    /* ================================ Menus ========================*/
    Route::get('/menus',[MenuController::class, 'index'])->name('menuEditor');
    Route::get('/menus/{id}/edit',[MenuController::class, 'edit'])->name('editMenu');
    Route::post('/menus/store',[MenuController::class, 'store'])->name('storeMenu');
    Route::post('/menus/{id}/update',[MenuController::class, 'update'])->name('updateMenu');
    Route::post('/menus/{id}/delete',[MenuController::class, 'delete'])->name('deleteMenu');
    Route::post('/menus/add-item',[MenuController::class, 'add_item'])->name('addMenuItem');

    /* Redirections */
    Route::get('/redirections', [RedirectionsController::class, 'index'])->name('redirections.index');
    Route::post('/redirections/store', [RedirectionsController::class, 'store'])->name('redirections.store');
    Route::post('/redirections/{id}/update', [RedirectionsController::class, 'update'])->name('redirections.update');
    Route::get('/redirections/{id}/status', [RedirectionsController::class, 'status'])->name('redirections.status');
    Route::post('/redirections/delete-all', [RedirectionsController::class, 'delete'])->name('redirections.delete');

    /* ================================ Additional ========================*/
    Route::get('/configurations',[ConfigurationsController::class, 'index'])->name('configurationPage');
    Route::post('/configurations/update',[ConfigurationsController::class, 'update'])->name('updateConfiguration');

    Route::get('/inbox',[InboxController::class, 'index'])->name('inboxPage');
    Route::post('/inbox/delete-all',[InboxController::class, 'delete_inbox'])->name('deleteInbox');
    Route::get('/subscribers',[InboxController::class, 'subscribers'])->name('subscribersPage');
    Route::post('/subscribers/delete-all',[InboxController::class, 'delete_subscribers'])->name('deleteSubscribers');
});

Route::middleware([FrontAuth::class])->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::group(['prefix' => 'laravel-filemanager', 'middleware' => ['web', 'auth']], function () {
    \UniSharp\LaravelFilemanager\Lfm::routes();
});

require __DIR__.'/auth.php';


Route::get('/blogs', [HomeController::class, 'blogs'])->name('blogsPage');
Route::get('/blogs/{slug}', [HomeController::class, 'blog_detail'])->name('blogDetail');
Route::post('/blog/review/{id}/store', [HomeController::class, 'blog_review_store'])->name('blogReview.store');
Route::get('/products/{slug}', [HomeController::class, 'product_detail_legacy'])->name('productDetail.legacy');
Route::post('/product/review/{id}/store', [HomeController::class, 'product_review_store'])->name('productReview.store');

Route::get('/category/{slug}', [HomeController::class, 'product_cat_detail'])->name('proCatDetail');
Route::get('/album/{slug}', [HomeController::class, 'album_detail'])->name('albumDetail');
Route::get('/news', [HomeController::class, 'news'])->name('newsPage');
Route::get('/news/{slug}', [HomeController::class, 'news_detail'])->name('newsDetail');
Route::get('/events', [HomeController::class, 'events'])->name('eventsPage');
Route::get('/events/{slug}', [HomeController::class, 'events_detail'])->name('eventsDetail');
Route::post('/send-message', [HomeController::class, 'contact_mail'])->name('contactMail');
Route::post('/save-subscriber', [HomeController::class, 'subscribe'])->name('saveSubscriber');
Route::get('/cart', [CartController::class, 'index'])->name('cartPage');

Route::middleware([FrontAuth::class])->group(function () {
    Route::get('/dashboard', [HomeController::class, 'dashboard'])->name('front.dashbaord');
    Route::get('/my-listing', [HomeController::class, 'mylisting'])->name('mylisting');
    Route::get('/askquestion', [HomeController::class, 'askquestion'])->name('askquestion');
    Route::get('/offers', [HomeController::class, 'offers'])->name('offers');
    Route::post('/listing/{id}/delete', [HomeController::class, 'listingdelete'])->name('listing.delete');
    Route::get('/reviews', [HomeController::class, 'reviews'])->name('reviews');
    Route::get('/product/{id}/bookmark', [HomeController::class, 'product_bookmark_store'])->name('product.bookmark');
    Route::get('/bookmark-listing', [HomeController::class, 'bookmark_listing'])->name('listing.bookmark');
    Route::post('/addtocart', [CartController::class, 'addToCart'])->name('addToCart');
    Route::post('/delete-cart-item', [CartController::class, 'deleteCartItem'])->name('deleteCartItem');
    Route::post('/checkout', [CartController::class, 'proceed_checkout'])->name('proceed_order');
    Route::get('/checkout', [CartController::class, 'checkout_page'])->name('checkoutPage');
    Route::get('/stripe-payment-proceeded', [CartController::class, 'stripe_success'])->name('stripeSuccess');
    Route::get('/stripe-payment-failed', [CartController::class, 'stripe_fail'])->name('stripeFail');
    Route::get('/accept_offer/{id}', [HomeController::class, 'accept_offer'])->name('accept_offer');
    Route::get('/add_product', [HomeController::class, 'add_product'])->name('add_product');
    Route::get('/product/{id}/edit', [HomeController::class, 'product_edit'])->name('product.edit');
    Route::post('/frontproducts/store', [HomeController::class, 'store'])->name('frontproducts.store');
    Route::post('/frontproducts/update/{id}', [HomeController::class, 'product_update'])->name('frontproducts.update');

    /* Blog */
    Route::get('/blog_listing', [HomeController::class, 'bloglisting'])->name('frontblogs');
    Route::get('/blog_listing/add', [HomeController::class, 'blog_create'])->name('frontblog.create');
    Route::post('/blog_listing/save', [HomeController::class, 'blog_store'])->name('frontblog.store');
    Route::get('/blog_listing/{id}/edit', [HomeController::class, 'blog_edit'])->name('frontblog.edit');
    Route::post('/blog_listing/{id}/update', [HomeController::class, 'blog_update'])->name('frontblog.update');
    Route::post('/blog_listing/{id}/delete', [HomeController::class, 'blog_delete'])->name('frontblog.delete');

    // Route::get('/reject_offer/{id}', [HomeController::class, 'reject_offer'])->name('reject_offer');

    Route::post('/ask_question', [HomeController::class, 'ask_question'])->name('ask_question');
    Route::post('/make_offer', [HomeController::class, 'make_offer'])->name('make_offer');
    Route::post('/purchase_membership', [CartController::class, 'purchase_membership'])->name('purchase_membership');

});


Route::middleware([CheckLoginRequired::class])->group(function () {
    Route::get('/', [HomeController::class, 'index'])->name('home');
    Route::get('/{category_slug}/{slug}', [HomeController::class, 'product_detail'])->name('productDetail');
    Route::get('/{slug}', [HomeController::class, 'page'])->name('dynamicPage');
});
// Route::get('/{slug}/{sub?}/', [HomeController::class, 'page'])->name('dynamicPage');
