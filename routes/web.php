<?php

use App\Http\Controllers\Admin\DataUserController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});


// Route biasa
Route::get('/santri',function(){
    return('Haloo Namaku Aisya');
});


// Route Parameter
Route::get('/hallo/{nama}',function($nama){
    return 'Wilujeung Sumping' . $nama;
});

// Route Name
Route::get('/buah',function(){
    return 'Stoberry, Mangga, Apel';
})->name('fruit');

// Ini contoh rooute dengan view
// jika file html ny ada di dalam folder maka panggil dulu nama foldernya
// contoh : namaFolder.namaFile
// tetapi jika nama file html nya langsung menyentuh foldder view maka langsung saja panggil nama filenya
// tanda / ini buat manggil URL nya
// kalo tanda . buat manggil folder nya
Route::get('/landing-page',function(){
    return view('landingpage');
});

// Route untuk Admin
Route::prefix('admin')->middleware(['auth','admin'])->group(function(){
    Route::get('/dashboardAdmin',function(){
        return view('admin.dashboardAdmin');
    });
    Route::controller(DataUserController::class)->group(function(){
        // ini route untuk nampilin table data user
        Route::get('/data-user','index')->name('index.data-user');
        // ini route untuk menampilkan form data user
        Route::get('/form-data-user','formDataUser')->name('form.dataUser');
        // ini route untuk proses create/tambah data user
        Route::post('/create-data-user','createDataUser')->name('create.dataUser');
        // ini route untuk menampilkan form edit data
        Route::get('edit-data-user/{id}','editDataUser')->name('edit.dataUser');
        // ini route untuk proses update data user
        Route::put('update-data-user/{id}','updateDataUser')->name('update.dataUser');
        Route::delete('delete-data-user/{id}','deleteDataUser')->name('delete.dataUser');
    });
});

// Route untuk User
Route::prefix('user')->middleware(['auth','user'])->group(function(){
    Route::get('/dashboardUser',function(){
        return view('user.dashboardUser');
    });
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
