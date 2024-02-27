<?php
    // dd(11);
    # Login Routes
    Route::get('login','AdminController@showLoginForm')->name('login');
    Route::post('login','AdminController@login');
    Route::post('logout','AdminController@logout')->name('logout');

    Route::group(['middleware' => 'auth:admin'],function (){
        Route::get('/admin-index', 'DashboardCotroller@adminIndex')->name('admin-index');
        Route::get('/blog','DashboardCotroller@blog')->name('blog');
        Route::get('/blog-details', 'DashboardCotroller@blogDetails')->name('blog-details');
        Route::get('/shop-grid', 'DashboardCotroller@shopGrid')->name('shop-grid');
        Route::get('/shop-details','DashboardCotroller@shopDetails')->name('shop-details');
        Route::get('/shoping-cart', 'DashboardCotroller@shopingCart')->name('shoping-cart');
        Route::get('/checkout', 'DashboardCotroller@checkout')->name('checkout');
        Route::get('/contact', 'DashboardCotroller@contact')->name('contact');
        Route::get('/dashboard','DashboardCotroller@index')->name('dashboard');
    });

// category
    Route::get('/category-form','CategoryController@showForm')->name('category-form');
    Route::post('/category','CategoryController@categoryAdd')->name('category');
    Route::get('/category-list','CategoryController@categoryList')->name('category-list');
    Route::get('/category-edit/{id}','CategoryController@categoryEdit')->name('category-edit');
    Route::get('/status/{id}','CategoryController@activeInActive')->name('status');
    Route::post('/category-update','CategoryController@categoryUpdate')->name('category-update');
    Route::get('/category-delete/{id}','CategoryController@categoryDelete')->name('category-delete');

  // product   
    Route::get('/product-form','ProductController@showForm')->name('product_form'); 
    Route::post('/product-form-store','ProductController@productFormStore')->name('product_store'); 
    Route::get('/product-form-list','ProductController@productFormList')->name('product_list');
    Route::get('/product-edit/{id}','ProductController@productEdit')->name('product_edit');
    Route::post('/product-update','ProductController@productUpdate')->name('product_update');
    Route::get('/product-delete/{id}','ProductController@productDelete')->name('product_delete');
    Route::get('/product-status/{id}','ProductController@productStatus')->name('product_status'); 


?>
