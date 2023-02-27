<?php

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
Auth::routes();

Route::middleware(['auth','admin_panel_access'])->group(function () {
	Route::get('/dashboard', 'HomeController@index')->name('dashboard');
	Route::resource('products','ProductController');
	Route::resource('orders','OrderController');
	Route::resource('categories','CategoryController');
	Route::resource('subcategories','SubCategoryController');
	Route::resource('brands','BrandController');
	Route::resource('colors','ColorController');
	Route::resource('sizes','SizeController');
	Route::resource('customers','CustomerController');
	Route::resource('posts','PostController');         
	Route::resource('messages','ContactController');
	Route::resource('users','UserController');
	Route::resource('reviews','ReviewController');
	Route::resource('comments','CommentController');
	Route::resource('countries','CountryController');
	Route::resource('states','StateController');
	Route::resource('cities','CityController');

	// Products delete routes
	Route::get('deleted_products','ProductController@get_deleted_products')->name('products.deleted');
	Route::get('products_restore_single/{id}','ProductController@restore_single')->name('products.restoreSingle');
	Route::get('products_restore_all','ProductController@restore_all')->name('products.restoreAll');
	Route::post('products_bulk_delete','ProductController@bulk_delete')->name('products.bulkDelete');
	Route::post('products_all_delete_forever','ProductController@force_delete_all')->name('products.forceDeleteAll');
	Route::delete('products_single_delete_forever/{id}','ProductController@force_delete_single')->name('products.forceDeleteSingle');
	Route::post('get_more_product_details','ProductController@get_more_product_details');


	// Posts delete routes
	Route::get('deleted_posts','PostController@get_deleted_posts')->name('posts.deleted');
	Route::get('posts_restore_single/{id}','PostController@restore_single')->name('posts.restoreSingle');
	Route::get('posts_restore_all','PostController@restore_all')->name('posts.restoreAll');
	Route::post('posts_bulk_delete','PostController@bulk_delete')->name('posts.bulkDelete');
	Route::post('posts_all_delete_forever','PostController@force_delete_all')->name('posts.forceDeleteAll');
	Route::delete('posts_single_delete_forever/{id}','PostController@force_delete_single')->name('posts.forceDeleteSingle');

	// Reviews delete routes
	Route::get('deleted_reviews','ReviewController@get_deleted_reviews')->name('reviews.deleted');
	Route::get('reviews_restore_single/{id}','ReviewController@restore_single')->name('reviews.restoreSingle');
	Route::get('reviews_restore_all','ReviewController@restore_all')->name('reviews.restoreAll');
	Route::post('reviews_bulk_delete','ReviewController@bulk_delete')->name('reviews.bulkDelete');
	Route::post('reviews_all_delete_forever','ReviewController@force_delete_all')->name('reviews.forceDeleteAll');
	Route::delete('reviews_single_delete_forever/{id}','ReviewController@force_delete_single')->name('reviews.forceDeleteSingle');

	// Comments delete routes
	Route::get('deleted_comments','CommentController@get_deleted_comments')->name('comments.deleted');
	Route::get('comments_restore_single/{id}','CommentController@restore_single')->name('comments.restoreSingle');
	Route::get('comments_restore_all','CommentController@restore_all')->name('comments.restoreAll');
	Route::post('comments_bulk_delete','CommentController@bulk_delete')->name('comments.bulkDelete');
	Route::post('comments_all_delete_forever','CommentController@force_delete_all')->name('comments.forceDeleteAll');
	Route::delete('comments_single_delete_forever/{id}','CommentController@force_delete_single')->name('comments.forceDeleteSingle');

	// Messages delete routes
	Route::get('deleted_messages','ContactController@get_deleted_messages')->name('messages.deleted');
	Route::get('messages_restore_single/{id}','ContactController@restore_single')->name('messages.restoreSingle');
	Route::get('messages_restore_all','ContactController@restore_all')->name('messages.restoreAll');
	Route::post('messages_bulk_delete','ContactController@bulk_delete')->name('messages.bulkDelete');
	Route::post('messages_all_delete_forever','ContactController@force_delete_all')->name('messages.forceDeleteAll');
	Route::delete('messages_single_delete_forever/{id}','ContactController@force_delete_single')->name('messages.forceDeleteSingle');

	// Categories delete routes
	Route::get('deleted_categories','CategoryController@get_deleted_categories')->name('categories.deleted');
	Route::get('categories_restore_single/{id}','CategoryController@restore_single')->name('categories.restoreSingle');
	Route::get('categories_restore_all','CategoryController@restore_all')->name('categories.restoreAll');
	Route::post('categories_bulk_delete','CategoryController@bulk_delete')->name('categories.bulkDelete');
	Route::post('categories_all_delete_forever','CategoryController@force_delete_all')->name('categories.forceDeleteAll');
	Route::delete('categories_single_delete_forever/{id}','CategoryController@force_delete_single')->name('categories.forceDeleteSingle');

	// SubCategories delete routes
	Route::get('deleted_subcategories','SubCategoryController@get_deleted_subcategories')->name('subcategories.deleted');
	Route::get('subcategories_restore_single/{id}','SubCategoryController@restore_single')->name('subcategories.restoreSingle');
	Route::get('subcategories_restore_all','SubCategoryController@restore_all')->name('subcategories.restoreAll');
	Route::post('subcategories_bulk_delete','SubCategoryController@bulk_delete')->name('subcategories.bulkDelete');
	Route::post('subcategories_all_delete_forever','SubCategoryController@force_delete_all')->name('subcategories.forceDeleteAll');
	Route::delete('subcategories_single_delete_forever/{id}','SubCategoryController@force_delete_single')->name('subcategories.forceDeleteSingle');

	// Brands delete routes
	Route::get('deleted_brands','BrandController@get_deleted_brands')->name('brands.deleted');
	Route::get('brands_restore_single/{id}','BrandController@restore_single')->name('brands.restoreSingle');
	Route::get('brands_restore_all','BrandController@restore_all')->name('brands.restoreAll');
	Route::post('brands_bulk_delete','BrandController@bulk_delete')->name('brands.bulkDelete');
	Route::post('brands_all_delete_forever','BrandController@force_delete_all')->name('brands.forceDeleteAll');
	Route::delete('brands_single_delete_forever/{id}','BrandController@force_delete_single')->name('brands.forceDeleteSingle');

	// Sizes delete routes
	Route::get('deleted_sizes','SizeController@get_deleted_sizes')->name('sizes.deleted');
	Route::get('sizes_restore_single/{id}','SizeController@restore_single')->name('sizes.restoreSingle');
	Route::get('sizes_restore_all','SizeController@restore_all')->name('sizes.restoreAll');
	Route::post('sizes_bulk_delete','SizeController@bulk_delete')->name('sizes.bulkDelete');
	Route::post('sizes_all_delete_forever','SizeController@force_delete_all')->name('sizes.forceDeleteAll');
	Route::delete('sizes_single_delete_forever/{id}','SizeController@force_delete_single')->name('sizes.forceDeleteSingle');

	// Colors delete routes
	Route::get('deleted_colors','ColorController@get_deleted_colors')->name('colors.deleted');
	Route::get('colors_restore_single/{id}','ColorController@restore_single')->name('colors.restoreSingle');
	Route::get('colors_restore_all','ColorController@restore_all')->name('colors.restoreAll');
	Route::post('colors_bulk_delete','ColorController@bulk_delete')->name('colors.bulkDelete');
	Route::post('colors_all_delete_forever','ColorController@force_delete_all')->name('colors.forceDeleteAll');
	Route::delete('colors_single_delete_forever/{id}','ColorController@force_delete_single')->name('colors.forceDeleteSingle');

	// Users delete routes
	Route::get('deleted_users','UserController@get_deleted_users')->name('users.deleted');
	Route::get('users_restore_single/{id}','UserController@restore_single')->name('users.restoreSingle');
	Route::get('users_restore_all','UserController@restore_all')->name('users.restoreAll');
	Route::post('users_bulk_delete','UserController@bulk_delete')->name('users.bulkDelete');
	Route::post('users_all_delete_forever','UserController@force_delete_all')->name('users.forceDeleteAll');
	Route::delete('users_single_delete_forever/{id}','UserController@force_delete_single')->name('users.forceDeleteSingle');

	// Countries delete routes
	Route::get('deleted_countries','CountryController@get_deleted_countries')->name('countries.deleted');
	Route::get('countries_restore_single/{id}','CountryController@restore_single')->name('countries.restoreSingle');
	Route::get('countries_restore_all','CountryController@restore_all')->name('countries.restoreAll');
	Route::post('countries_bulk_delete','CountryController@bulk_delete')->name('countries.bulkDelete');
	Route::post('countries_all_delete_forever','CountryController@force_delete_all')->name('countries.forceDeleteAll');
	Route::delete('countries_single_delete_forever/{id}','CountryController@force_delete_single')->name('countries.forceDeleteSingle');

	// States delete routes
	Route::get('deleted_states','StateController@get_deleted_states')->name('states.deleted');
	Route::get('states_restore_single/{id}','StateController@restore_single')->name('states.restoreSingle');
	Route::get('states_restore_all','StateController@restore_all')->name('states.restoreAll');
	Route::post('states_bulk_delete','StateController@bulk_delete')->name('states.bulkDelete');
	Route::post('states_all_delete_forever','StateController@force_delete_all')->name('states.forceDeleteAll');
	Route::delete('states_single_delete_forever/{id}','StateController@force_delete_single')->name('states.forceDeleteSingle');

	// City delete routes
	Route::get('deleted_cities','CityController@get_deleted_cities')->name('cities.deleted');
	Route::get('cities_restore_single/{id}','CityController@restore_single')->name('cities.restoreSingle');
	Route::get('cities_restore_all','CityController@restore_all')->name('cities.restoreAll');
	Route::post('cities_bulk_delete','CityController@bulk_delete')->name('cities.bulkDelete');
	Route::post('cities_all_delete_forever','CityController@force_delete_all')->name('cities.forceDeleteAll');
	Route::delete('cities_single_delete_forever/{id}','CityController@force_delete_single')->name('cities.forceDeleteSingle');

	// Allow Disallow review
	Route::get('allow_disallow_review/{id}','ReviewController@allow_disallow')->name('reviews.allow_disallow');
	// Send Invoice
	Route::get('send_invoice/{invoice}', 'OrderController@sendInvoice')->name('orders.sendInvoice');
	// Delete Image from database
	Route::get('img_delete/{id}', 'ImageController@delete_image')->name('image.delete');
	// Settings
	Route::get('settings', 'HomeController@settings')->name('dashboard.settings');
	// Assign Roles to user
	Route::post('change_role/{id}','UserController@assign_role')->name('users.changeRole');
	// Assign Permissions to user
	Route::post('give_permissions/{id}','UserController@assign_permissions')->name('users.givePermissions');
	// Notification routes
	Route::get('notifications','NotificationController@notifications')->name('notifications');
	Route::get('notifications_count','NotificationController@unread_notification_count')->name('notifications.Unreadcount');
});

// customer after login routes

Route::middleware(['auth'])->group(function () {
	//customer account routes
	Route::get('/my-account/dashboard', 'FrontController@customer_dashboard');
	Route::get('/my-account/orders', 'FrontController@customer_orders');
	Route::get('/my-account/settings', 'FrontController@customer_setting');
	Route::get('/my-account/invoice/{invoice_no}', 'FrontController@customer_invoice');

	// wishlist routes
	Route::get('/my-account/wishlist', 'WishlistController@index');
	Route::get('remove_from_wishlist/{slug}','WishlistController@remove_item');
	Route::post('addToWishlist', 'WishlistController@add_to_wishlist');

	//checkout route
	Route::get('/checkout','FrontController@checkout');

	// BaseController routes
	Route::post('bs_state_cites','BaseController@state_cities');
	Route::post('order','BaseController@order_store')->name('order.store');
	Route::post('review/{id}','BaseController@review_store')->name('review.store');
	Route::post('comment/{id}','BaseController@comment_store')->name('comment.store');
	Route::post('changepswd','BaseController@change_pswd')->name('change.pass');
	Route::match(['put', 'patch'], '/account/update/{id}','BaseController@update_account')->name('update.account');
});

// cart routes
Route::get('/cart','CartController@index');
Route::get('removeCartItem','CartController@remove');
Route::get('removeCart','CartController@destroy');
Route::post('addToCart','CartController@store');
Route::post('updateItem','CartController@update');
Route::post('show_topCart','CartController@top_cart');

// compare routes
Route::get('/compare','CompareController@index');
Route::get('remove_from_compare_list/{slug}','CompareController@remove_item');
Route::post('addToCompare','CompareController@add_to_compare');



// view pages routes
Route::get('/','FrontController@index');
Route::get('/shop/{slug}','FrontController@products');
Route::get('/blog','FrontController@blog');
Route::get('/contact','FrontController@contact');
Route::get('/help','FrontController@help');
Route::get('/sitemap','FrontController@sitemap');
Route::get('/{slug}','FrontController@show_product');
Route::get('/post/{slug}','FrontController@post');
Route::post('contact','BaseController@contact_store')->name('contact.store');

// Api Routes

Route::get('gmail/redirect', 'SocialAuthGoogleController@redirect');
Route::get('gmail/callback', 'SocialAuthGoogleController@callback');

Route::get('/fb/redirect', 'SocialAuthFacebookController@redirect');
Route::get('/fb/callback', 'SocialAuthFacebookController@callback');

// Change Email
Route::get('verify_changed_email/{user}/{email}','Auth\EmailChangeController@verify')->name('verify.changed-email');
Route::post('change_email','Auth\EmailChangeController@change')->name('change_user_email');