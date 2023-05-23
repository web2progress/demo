<?php

use App\Http\Controllers\Admin\NewConnectionController as AdminNewConnectionController;
use App\Http\Controllers\Admin\TarrifPlanController;
use App\Http\Controllers\AlbumController;
use App\Http\Controllers\AlbumGalleryController;
use App\Http\Controllers\Blogs\BlogCategoryController;
use App\Http\Controllers\Blogs\BlogController;
use App\Http\Controllers\Blogs\BlogPostController;
use App\Http\Controllers\Blogs\BlogTagController;
use App\Http\Controllers\BookingDetailController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\HomePageController;
use App\Http\Controllers\MailController;
use App\Http\Controllers\MediaIconController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\NewConnectionController;
use App\Http\Controllers\NewsLatterController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\PlansController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SliderController;
use App\Http\Controllers\StoreEnquiryController;
use App\Http\Controllers\CustomerController;

use App\Http\Controllers\UpgradeConnectionController;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use UniSharp\LaravelFilemanager\Lfm;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
// command
Route::get('/solvefilemanagerError', function () {
    // delete directory
    if (file_exists(public_path('storage'))) {
        // $delete = File::deleteDirectory(public_path('storage'));
        return ('storage file already created manualy delete Storage folder first');
    } else {
        // create directory
        Artisan::call('storage:link');
        return "New Storage Creted Successfully..! Error Solved ";
    }
});

Route::get('/', [HomePageController::class, 'index']);
Route::get('product/{slug}', [HomePageController::class, 'getProductBySlug']);
Route::get('product-category/{catSlug}', [HomePageController::class, 'productCategoryWise']);
// search
Route::get('autocomplete', [HomePageController::class, 'autocomplete'])->name('autocomplete');
// page
Route::get('page/{slug}', [PageController::class, 'index']);
Route::Post('/enquiry', [MailController::class, 'SendEnquiry'])->name('business-enquiry');
Route::view('/contact-us', 'frontend.contact-us');
Route::view('/about-us', 'frontend.about-us');
Route::view('/manufacturing', 'frontend.manufacturing');
Route::view('/plans', 'frontend.plans');
Route::view('/customers', 'admin/plans/customers');
Route::get('/customerprofile/{id}', [CustomerController::class, 'profiledata']);




// customers process
Route::Post('/CustomerAdd', [CustomerController::class, 'saveCustomer']);
Route::get('/userlogin', [CustomerController::class, 'login']);
Route::post('/userloginverify', [CustomerController::class, 'loginverify']);
Route::post('/updateCustomer', [CustomerController::class, 'updateCustomer'])->name('/updateCustomer');
Route::post('customer/ImageUpload', [CustomerController::class, 'ImageUpload'])->name('/customer/ImageUpload');
Route::post('customer/profileUpload', [CustomerController::class, 'profileUpload'])->name('/customer/profileUpload');
Route::get('number_exists/{id}', [CustomerController::class, 'NumberCheck']);






// blog
Route::get('/blogs', [BlogController::class, 'index']);
Route::get('/post/{postSlug}', [BlogController::class, 'getpost']);
Route::get('categories/{catURL}', [BlogController::class, 'getCategory'])->name('category');
Route::post('/comment', [BlogController::class, 'postComment']);
// page
Route::get('page/{slug}', [PageController::class, 'index']);
//Gallery
// Route::get('/gallery', [AlbumGalleryController::class, 'gallery']);
// Route::get('/gallery/{url}', [AlbumGalleryController::class, 'viewGallery']);
//product
Route::get('/products', [HomePageController::class, 'packagesIndex']);
Route::get('product/{slug}', [HomePageController::class, 'getProductBySlug']);
Route::get('product-category/{catSlug}', [HomePageController::class, 'productCategoryWise']);
// book now send mail and store data
Route::post('/bookNow', [MailController::class, 'bookNow']);
// enquiry
Route::view('/business-enquiry', 'business-enquiry');
Route::get('/clear-cache-all', function () {
    Artisan::call('cache:clear');
    return ("All Cache Cleared ");
});

// Mail Rout
Route::Post('/SendBusinessEnqiry', [MailController::class, 'SendBusinessEnqiry'])->name('business-enquiry');

// NewsLatter
Route::Post('/sendNewsLatter', [NewsLatterController::class, 'sendNewsLatter'])->name('sendNewsLatter');

Auth::routes([
    'register' => true,

]);

Route::get('plansview/{id}', [PlansController::class, 'plansview']);
Route::post('updatePlan', [PlansController::class, 'updatePlan']);
Route::get('delete-plan/{id}', [PlansController::class, 'Delete']);
Route::get('delete-enquiry/{id}', [StoreEnquiryController::class, 'Delete']);

Route::get('/home', [HomeController::class, 'index'])->name('home');


Route::group(['prefix' => 'admin', 'middleware' => ['role:admin']], function () {
    Route::view('dashboard', 'admin.index');
    // Blog
    // category manage
    Route::resource('blog-category', BlogCategoryController::class);
    Route::post('deleteCat', [BlogCategoryController::class, 'deleteCat'])->name('deleteCat');
    Route::post('updateCategory/', [BlogCategoryController::class, 'update'])->name('updateCategory');

    // comments
    Route::get('blog-comments', [BlogController::class, 'comments'])->name('blog-post.comments');
    Route::post('delComment', [BlogController::class, 'delComment'])->name('delComment');
    Route::post('commentAprove', [BlogController::class, 'commentAprove'])->name('commentAprove');
    Route::post('reply-comment', [BlogController::class, 'commentReply'])->name('post.comment.reply');

    // blog-tag manage
    Route::resource('blog-tag', BlogTagController::class);
    Route::post('deleteTag', [BlogTagController::class, 'deleteTag'])->name('deleteTag');
    Route::post('updateTag/', [BlogTagController::class, 'update'])->name('updateTag');

    // post
    Route::resource('blog-post', BlogPostController::class);

    Route::get('/search/post', [BlogPostController::class, 'searchPost'])->name('post.data');
    Route::get('/search/draft', [BlogPostController::class, 'searchDraft'])->name('draft.data');
    Route::post('updatePost/', [BlogPostController::class, 'updatePost'])->name('updatePost');
    Route::post('rePublishPost/', [BlogPostController::class, 'rePublishPost'])->name('rePublishPost');
    Route::post('deletePost/', [BlogPostController::class, 'deletePost'])->name('deletePost');
    Route::post('restorePost/', [BlogPostController::class, 'restorePost'])->name('restorePost');
    //   draftPost
    Route::get('blog-draft', [BlogPostController::class, 'draft'])->name('blog-post.draft');
    Route::post('draftPost', [BlogPostController::class, 'draftPost'])->name('draftPost');
    //   RecycleBinPost
    Route::get('blog-recycler-bin', [BlogPostController::class, 'RecycleBin'])->name('blog-post.recycler-bin');
    Route::post('RecycleBinPost', [BlogPostController::class, 'RecycleBinPost'])->name('RecycleBinPost');
    // PostMultiCategory
    Route::post('PostMultiCategory', [BlogPostController::class, 'PostMultiCategory'])->name('PostMultiCategory');
    //   PostMultiTag
    Route::post('PostMultiTag', [BlogPostController::class, 'PostMultiTag'])->name('PostMultiTag');

    Route::post('ckeditor/image_upload', [BlogPostController::class, 'ImgUpload'])->name('ckeditor.image_upload');

    // modals
    // Route::resource('blog-modals', ModalController::class);

    // page
    Route::get('create-page', [PageController::class, 'page'])->name('create-page');
    Route::post('updatepage', [PageController::class, 'updatepage'])->name('page.updatepage');


    Route::post('publish-page', [PageController::class, 'rePublishPage'])->name('rePublishPage');
    Route::get('/data', [PageController::class, 'searchPage'])->name('page.data');
    Route::post('/createPageTitle', [PageController::class, 'createTitle'])->name('createPageTitle');
    Route::get('editPage/{id}', [PageController::class, 'editPage']);
    Route::post('deletePagePost', [PageController::class, 'deletePagePost'])->name('deletePagePost');


    //add Slider
    Route::resource('manage-slider', SliderController::class);
    Route::post('/deleteSlider', [SliderController::class, 'destroy']);
    Route::post('/activeSlide', [SliderController::class, 'activeSlide']);
    Route::post('/slider-text-update', [SliderController::class, 'silderTextUpdate']);
    // Menu management
    Route::get('manage-menu', [menuController::class, 'index'])->name('home');
    Route::get('manage-menus/{id?}', [menuController::class, 'index']);
    Route::post('create-menu', [menuController::class, 'store']);
    Route::get('add-categories-to-menu', [menuController::class, 'addCatToMenu']);
    Route::get('add-post-to-menu', [menuController::class, 'addPostToMenu']);
    Route::get('add-page-to-menu', [menuController::class, 'addPageToMenu']);
    Route::get('add-custom-link', [menuController::class, 'addCustomLink']);
    Route::get('update-menu', [menuController::class, 'updateMenu']);
    Route::post('update-menuitem/{id}', [menuController::class, 'updateMenuItem']);
    Route::get('delete-menuitem/{id}/{key}/{in?}', [menuController::class, 'deleteMenuItem']);
    Route::get('delete-menu/{id}', [menuController::class, 'destroy']);

    // media-&-icons
    Route::get('media-&-icons', [MediaIconController::class, 'index']);
    Route::post('/activeIcon', [MediaIconController::class, 'activeIcon']);
    Route::post('/updateIcon', [MediaIconController::class, 'updateIcon']);
    Route::post('/uloadLogo', [MediaIconController::class, 'uloadLogo']);
    //add Slider
    Route::resource('manage-slider', SliderController::class);
    Route::post('/deleteSlider', [SliderController::class, 'destroy']);
    Route::post('/activeSlide', [SliderController::class, 'activeSlide']);


    // create-album manage
    Route::get('create-album', [AlbumController::class, 'album']);
    Route::post('/addAlbum', [AlbumController::class, 'addAlbum']);
    Route::post('updateAlbum/', [AlbumController::class, 'updateAlbum']);
    Route::post('deleteAlbum', [AlbumController::class, 'deleteAlbum']);
    Route::post('/add-images/add-images', [AlbumController::class, 'deleteAlbum']);
    // add gallery
    Route::get('/add-images/{id}', [AlbumGalleryController::class, 'addImages']);
    Route::post('ImageUpload/', [AlbumGalleryController::class, 'ImageUpload']);
    Route::get('/manage-gallery', [AlbumGalleryController::class, 'manageGallery']);
    Route::post('fetchGallery/', [AlbumGalleryController::class, 'fetchGallery']);
    Route::post('deleteGallery', [AlbumGalleryController::class, 'deleteGallery']);
    // newslatter
    Route::get('news-latter', [NewsLatterController::class, 'index']);
    Route::post('deleteNewsLatter', [NewsLatterController::class, 'deleteNewsLatter']);
    Route::get('/search/newslatter', [NewsLatterController::class, 'SearchNewslatter'])->name('get.newslatter');
    Route::get('/export_excel/excel', [NewsLatterController::class, 'excel'])->name('export_excel.excel');
    // booking details
    Route::get('booking-details', [BookingDetailController::class, 'bookingDtails']);
    Route::post('/deleteBookingDetails', [BookingDetailController::class, 'deleteBookingDetails']);
    Route::post('/updateBookinStatus', [BookingDetailController::class, 'updateBookinStatus']);

    // enquiry details
    Route::get('enquiry-details', [StoreEnquiryController::class, 'enquiryDtails']);
    Route::post('/deleteDetails', [StoreEnquiryController::class, 'deleteDetails']);
    //  clear-cache
    Route::get('clear-cache-all', function () {
        Artisan::call('cache:clear');
        return ("All Cache Cleared ");
    });

    //connection////////////
    // new connection
    Route::resource('new-connection', AdminNewConnectionController::class);
    Route::post('/new-connection-status', [LeadControlller::class, 'status'])->name('new-connection.status');

    //tarrif plans
    Route::resource('tarrif-plans',TarrifPlanController::class);
    Route::post('/tarrif-plans-status', [TarrifPlanController::class, 'status'])->name('tarrif-plans.status');


    Route::resource('plans',PlansController::class);
});

Route::group(['prefix' => 'user', 'middleware' => ['role:user']], function () {
    Route::view('dashboard', 'user.index');
    Route::view('profile', 'user.profile');
    Route::view('change-password', 'user.change-password');
    Route::post('profileUpload', [ProfileController::class, 'uploadCropImage'])->name('user.profileUpload');
    Route::view('current-plan', 'user.current-plan');
    // upgradePlan
    Route::view('upgrade-connection', 'user.upgrade-connection');
    Route::post('upgrade-plan', [UpgradeConnectionController::class, 'upgradePlan'])->name('upgradePlan');

    //new connection
    Route::view('new-connection', 'user.new-connection');
    Route::post('new-connection-registration', [NewConnectionController::class, 'newConnection']);


    Route::post('profile-address', [ProfileController::class, 'getAddress'])->name('user.address');
    Route::post('update-profile-details', [ProfileController::class, 'updateProfileDetails'])->name('update-profile-details');
    Route::post('password-update', [ProfileController::class, 'passwordUpdate'])->name('password.update');
});

Route::group(['prefix' => 'laravel-filemanager', 'middleware' => ['web', 'auth']], function () {
    Lfm::routes();
});

