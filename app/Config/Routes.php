<?php

namespace Config;

use App\Controllers\Admin\DashboardController;
use App\Controllers\Admin\GajiController;
use App\Controllers\Admin\KaryawanController;
use App\Controllers\Admin\KepalaSekolahController;
use App\Controllers\Admin\LaporanController;
use App\Controllers\AuthController;
use App\Controllers\Karyawan\DashboardController as KaryawanDashboardController;
use App\Controllers\Karyawan\GajiController as KaryawanGajiController;
use App\Controllers\Kepsek\DashboardController as KepsekDashboardController;
use App\Controllers\Kepsek\LaporanController as KepsekLaporanController;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

/*
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
// The Auto Routing (Legacy) is very dangerous. It is easy to create vulnerable apps
// where controller filters or CSRF protection are bypassed.
// If you don't want to define all routes, please use the Auto Routing (Improved).
// Set `$autoRoutesImproved` to true in `app/Config/Feature.php` and set the following to true.
// $routes->setAutoRoute(false);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('/', [AuthController::class, 'login']);
$routes->post('/auth', [AuthController::class, 'auth']);

$routes->get('/logout', [AuthController::class, 'logout']);

// Admin Router
// $routes->group
$routes->group('admin', static function ($routes) {
    $routes->get('dashboard', [DashboardController::class, 'index']);

    $routes->group('karyawan', static function ($routes) {
        $routes->get('/', [KaryawanController::class, 'index']);
        $routes->post('get-karyawan-json', [KaryawanController::class, 'getKaryawanJSON']);
        $routes->get('add', [KaryawanController::class, 'add']);
        $routes->post('store', [KaryawanController::class, 'store']);
        $routes->get('edit/(:alphanum)', [[KaryawanController::class, 'edit'], '$1']);
        $routes->post('update/(:alphanum)', [[KaryawanController::class, 'update'], '$1']);
        $routes->get('delete/(:alphanum)', [[KaryawanController::class, 'destroy'], '$1']);
    });
    
    $routes->group('kepala_sekolah', static function ($routes) {
        $routes->get('/', [KepalaSekolahController::class, 'index']);
        $routes->get('edit', [KepalaSekolahController::class, 'edit']);
        $routes->post('update', [KepalaSekolahController::class, 'update']);
    });
    
    $routes->group('gaji', static function ($routes) {
        $routes->get('/', [GajiController::class, 'index']);
        $routes->post('get-gaji-json', [GajiController::class, 'getGajiJSON']);
        $routes->get('input-gaji', [GajiController::class, 'input']);
        $routes->post('store-gaji', [GajiController::class, 'store']);
        $routes->get('edit/(:alphanum)', [[GajiController::class, 'edit'], '$1']);
        $routes->post('update', [[GajiController::class, 'update'], '$1']);
        $routes->get('delete/(:alphanum)', [[GajiController::class, 'destroy'], '$1']);
    });

    $routes->group('laporan', static function ($routes) {
        $routes->get('/', [LaporanController::class, 'index']);
        $routes->post('cetak', [LaporanController::class, 'cetak']);
    });
});

$routes->group('kepsek', static function ($routes) {
    $routes->get('dashboard', [KepsekDashboardController::class, 'index']);

    $routes->group('laporan', static function ($routes) {
        $routes->get('/', [KepsekLaporanController::class, 'index']);
        $routes->post('cetak', [KepsekLaporanController::class, 'cetak']);
    });
});

$routes->group('karyawan', static function ($routes) {
    $routes->get('dashboard', [KaryawanDashboardController::class, 'index']);

    $routes->group('gaji', static function ($routes){
        $routes->get('/', [KaryawanGajiController::class, 'index']);
        $routes->post('get-gaji-json', [KaryawanGajiController::class, 'getGajiJSON']);
        $routes->get('cetak-slip/(:alphanum)', [[KaryawanGajiController::class, 'cetak_slip'], '$1']);
    });
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
if (is_file(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
