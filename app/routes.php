<?php


Router::get( '/', 'OrderController@home' );
Router::get( '/contact-us', 'OrderController@contact' );
Router::get( '/order/show', 'OrderController@show' );

Router::get( '/ajax/get/orders', 'OrderController@get' );
Router::get( '/ajax/get/orders/by-date', 'OrderController@getByDate' );
Router::get( '/ajax/get/orders/by-receipt-id', 'OrderController@getByReceiptId' );
Router::post( '/ajax/store/orders', 'OrderController@store' );
