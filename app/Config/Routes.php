<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (file_exists(SYSTEMPATH . 'Config/Routes.php'))
{
	require SYSTEMPATH . 'Config/Routes.php';
}

/**
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
$routes->setAutoRoute(true);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('/', 'Home::index');

$routes->group('auth', function ($routes) {
	$routes->get('login', 'Auth::login');
	$routes->get('register', 'Auth::register');
});

$routes->group('dashboard', ['filter' => 'admin_auth'], function ($routes) {
	$routes->get('hotels/add', 'Dashboard::addHotel');
	$routes->post('hotels/add/save', 'Dashboard::newHotel');
	$routes->get('hotels/edit', 'Dashboard::editHotelGet');
	$routes->post('hotels/edit', 'Dashboard::editHotelPost');
	$routes->post('hotels/edit/save', 'Dashboard::updateHotel');
	$routes->get('hotels', 'Dashboard::hotelList');
	$routes->delete('hotels/delete/(:num)', 'Dashboard::deleteHotel/$1');
	$routes->addRedirect('hotels/add(:any)', 'dashboard/hotels/add');
	$routes->addRedirect('hotels(:any)', 'dashboard/hotels');
});

$routes->group('user', ['filter' => 'user_auth'], function ($routes) {
	$routes->get('profile/edit', 'User::edit');
	$routes->get('profile/change-password', 'User::password');
	$routes->get('profile', 'User::profile');
	$routes->get('booking-details/(:num)', 'User::bookings/$1');
	$routes->addRedirect('booking-details(:any)', 'user/profile');
	$routes->addRedirect('profile(:any)', 'user/profile');
});

$routes->group('hotels', function ($routes) {
	$routes->get('booking', 'Hotels::bookingGet', ['filter' => 'user_auth']);
	$routes->post('booking', 'Hotels::bookingPost', ['filter' => 'user_auth']);
	$routes->get('detail/(:num)', 'Hotels::detail/$1');
});

/*
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need it to be able to override any defaults in this file. Environment
 * based routes is one such time. require() additional route files here
 * to make that happen.
 *
 * You will have access to the $routes object within that file without
 * needing to reload it.
 */
if (file_exists(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php'))
{
	require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
