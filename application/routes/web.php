<?php


Route::group('admin', ['namespace'=>'backend'],function(){
    Route::get('/login','Login@index')->name('login.home');
    Route::post('/login','Login@login')->name('login.login');
});



Route::group('admin', ['namespace'=>'backend'],function(){
    Route::get('/','Home@index')->name('home');
    Route::get('/logout','Home@logout')->name('home.logout');
    Route::get('/trendyol','Trendyol@index')->name('trendyol.home');
    Route::get('/trendyol/delete/{id}','Trendyol@delete_account')->name('trendyol.delete');
    Route::post('/trendyol/generate','Trendyol@generateAccount')->name('trendyol.generate');
    Route::post('/trendyol/saveCollection','Trendyol@saveCollection')->name('trendyol.saveCollection');
    Route::post('/trendyol/followSeller','Trendyol@followSeller')->name('trendyol.followSeller');
    Route::get('/trendyol/araclar','Trendyol@araclar')->name('trendyol.araclar');
    Route::post('/trendyol/araclar/ucak_modu','Trendyol@ucak_guncelle')->name('trendyol.ucak_guncelle');

});


Route::set('404_override', function(){
        redirect(route('anasayfa'));
});

Route::set('translate_uri_dashes',FALSE);