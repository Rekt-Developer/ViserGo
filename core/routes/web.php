<?php

use Illuminate\Support\Facades\Route;

Route::get('/clear', function () {
    \Illuminate\Support\Facades\Artisan::call('optimize:clear');
});

Route::get('cron', 'CronController@cron')->name('cron');

// User Support Ticket
Route::controller('TicketController')->prefix('ticket')->name('ticket.')->group(function () {
    Route::get('/', 'supportTicket')->name('index');
    Route::get('new', 'openSupportTicket')->name('open');
    Route::post('create', 'storeSupportTicket')->name('store');
    Route::get('view/{ticket}', 'viewTicket')->name('view');
    Route::post('reply/{id}', 'replyTicket')->name('reply');
    Route::post('close/{id}', 'closeTicket')->name('close');
    Route::get('download/{attachment_id}', 'ticketDownload')->name('download');
});

Route::controller('SiteController')->group(function () {
    Route::get('/contact', 'contact')->name('contact');
    Route::post('/contact', 'contactSubmit');

    Route::get('winners', 'winners')->name('winners');

    Route::get('/change/{lang?}', 'changeLanguage')->name('lang');

    Route::get('cookie-policy', 'cookiePolicy')->name('cookie.policy');

    Route::get('/cookie/accept', 'cookieAccept')->name('cookie.accept');

    Route::get('blog', 'blog')->name('blog');
    Route::get('blog/{slug}', 'blogDetails')->name('blog.details');

    Route::get('policy/{slug}', 'policyPages')->name('policy.pages');

    Route::get('placeholder-image/{size}', 'placeholderImage')->withoutMiddleware('maintenance')->name('placeholder.image');
    Route::get('maintenance-mode', 'maintenance')->withoutMiddleware('maintenance')->name('maintenance');

    Route::get('/{slug}', 'pages')->name('pages');
    Route::get('/', 'index')->name('home');

    Route::get('competion/{slug}', 'competionTypeLotteries')->name('competiontype.lotteries');
    Route::get('competion/raffle/{id}/{slug}', 'lotteryDetails')->name('lottery.details');

    Route::post('raffle/book/any', 'lotteryBookAny')->name('lottery.book.any');
    Route::post('raffle/book/segmentwise', 'lotteryBookSegmentwise')->name('lottery.book.segmentwise');
    Route::post('raffle/book/single/{ticket}', 'lotteryBookSingle')->name('lottery.book.single');

    Route::get('/cart/details', 'cartView')->name('cart');
    Route::get('/cart/items/count', 'getCartCount')->name('cart.count');
    Route::get('/cart/item/delete', 'cartItemDelete')->name('cart.item.delete');
});
