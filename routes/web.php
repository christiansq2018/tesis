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

use App\Notifications\MonthRevisions;

Route::get('notifications/markallread', function(){
  auth()->user()->unreadNotifications()->update(['read_at' => now() ]);
  return response()->json(['data'=>'success']);
});

Route::get('notificar', function(){
  $count = App\Mantenimiento::whereBetween('fecha_vencimiento', [now()->startOfMonth(), now()->endOfMonth()])->count();
  $users = App\User::where('role_id', 1)->get();
  Notification::send($users, new MonthRevisions( $count ));
});

Route::group(['middleware' => ['guest']], function () {
  Route::get('/', 'Auth\LoginController@showLoginForm');
  Route::post('/login', 'Auth\LoginController@login')->name('login');
});


Route::group(['middleware' => ['auth']], function () {
  Route::post('/logout', 'Auth\LoginController@logout')->name('logout');
  Route::get('/home', 'HomeController@index');

  Route::resource('mantenimiento', 'MantenimientoController', ['except'=>['edit', 'show']]);
  
  Route::group(['middleware' => ['Administrador']], function () {
    Route::resource('rol', 'RolController');
    Route::resource('user', 'UserController');
    Route::resource('clasificacion', 'ClasificacionController');
    Route::resource('proveedor', 'ProveedorController');
    Route::resource('equipo', 'EquipoController');
    Route::get('/listarEquipoPdf', 'EquipoController@listarPdf')->name('equipos_pdf');
    Route::get('/pdfCompra/{id}', 'CompraController@pdf')->name('compra_pdf');
    Route::get('/pdfVenta/{id}', 'VentaController@pdf')->name('venta_pdf');
    Route::post('aplicaciones/store', 'AplicacionController@store')->name('aplicaciones.store');
    Route::get('aplicaciones/{aplicacion}/downloadPDF', 'AplicacionController@downloadPDF')->name('aplicaciones.pdf');
  });
});
