<?php

/**
*   Direct Setup
*   Direct::[get, post, put, patch, delete, debug](url, [controller@method, controller, callable])
*   Example:
*   Direct::get('/', 'MainController@index')
*   Direct::get('/profole', 'MainController@profole')->auth()
*
*   url = /test/{var}/{optional?}
*   add a ? at the end of a variable to make it optional like {var?}
*
*   if you do not set a method, it will try to call the route as a method instead
*   Direct::get("/home", 'MainController');
*   this will try to call the home method in the MainController
*
*   Aditional you can do:
*   for GET, POST, PATCH, PUT, DELETE at the same time (does not include ERROR)
*   Direct::all(url, callable);
*   Or if you want more then one method but not all
*   Direct::on([GET, POST, PATCH, PUT, DELETE, ERROR], url, callable);
*
*   Filters:
*   ->cache(callable*) //if callable return true page will be cached or if callable = null
*   ->auth()
*   ->mod()
*   ->admin()
*   ->http_code(int) Will set the the http status code for the page
*   ->before(callable($request))
*   ->after(callable($request))
*/

// Direct::get('/test', function(){
//     return '<h1>This is supposed to be cached</h1>';
// })->Cache();


// Frontpage
Direct::get("/", 'MainController@index');

// login logout
Direct::post("/login", 'LoginController@login_action');
Direct::get("/logout", 'LoginController@logout');

// Menu ajax fetch
Direct::get('/menu', 'LoginController');

//Items
Direct::get('/items', 'ItemController@index');
Direct::get('/item/{id?}', 'ItemController@item');
Direct::delete('/item', 'ItemController@delete');
Direct::get('/item/edit/{id}', 'ItemController@edit');
Direct::put('/item/create', 'ItemController@put');
Direct::get('/item/create', 'ItemController@create');
Direct::patch('/item/edit', 'ItemController@patch');
Direct::patch('/item/taken', 'ItemController@taken');

// Regiser user
Direct::get('/register', 'LoginController@register');
Direct::put('/register', 'LoginController@save');

// Categories
Direct::get('/category/{cat?}', 'ItemController@categories');

// Profile
Direct::get('/profile/{username?}', 'ProfileController@index');
Direct::get('/profile/edit', 'ProfileController@edit');
Direct::patch('/profile/edit', 'ProfileController@store');

// Messages
Direct::get('/messages', 'MessageController@index');
Direct::get('/messages/outbox', 'MessageController@outbox');
Direct::get('/messages/inbox', 'MessageController@inbox');
Direct::get('/messages/new', 'MessageController@new');
Direct::put('/messages/new', 'MessageController@store');

// admin
Direct::get('/admin', 'AdminController@index');
Direct::delete('/admin/cats', 'AdminController@delete_cat');
Direct::put('/admin/cats', 'AdminController@put_cat');
Direct::delete('/admin/user', 'AdminController@delete_user');

// Debug routes, will only work when config::$debug_mode = true
Direct::debug('/migrate', 'MainController');


