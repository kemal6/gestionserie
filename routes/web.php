<?php

use App\Models\article;

use App\Models\articles;
use App\Models\num_series;
use App\Models\plans;
use App\Models\User;
use App\Models\users;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/','App\Http\Controllers\NumSeriesController@afget')->name('index')->middleware('auth');
// Route::post('/','App\Http\Controllers\NumSeriesController@afpost')->name('indexA');//


Route::post('/getUsers', 'App\Http\Controllers\CreateUsersController@getUsers')->name('getUsers');
//Route::post('/getArticles', 'App\Http\Controllers\CreateUsersController@getArticles')->name('/getArticles');
Route::post('/getArticles','App\Http\Controllers\CreateUsersController@getArticles')->name('getArticles'); 
Route::post('/getPlans','App\Http\Controllers\CreateUsersController@getPlans')->name('getPlans'); 



    Route::get('/creatu', function () {

    //users::query()->delete();
    User::create(
    
            [
            'name' => 'John',    
            'email' => 'joh@gmail.com',
            'password' => Hash::make('5623'),
           ]
         )  ;
        return 'ok';
    })->name('creatu');

// affiche ts les num ser V
Route::get('/affu', function () {
    return User::all();
})->name('affu');

// Exporter Les Nums dans un excl
Route::get('/exp','App\Http\Controllers\mainController@index')->name('index')->middleware('auth'); 
Route::post('/exp','App\Http\Controllers\mainController@export')->name('export')->middleware('auth');


// Imorter Les Nums dans un excl
Route::get('/imp','App\Http\Controllers\mainController@fimport')->name('fimport')->middleware('auth'); 
Route::post('/imp','App\Http\Controllers\mainController@import')->name('import')->middleware('auth');

// login
Route::get('/login','App\Http\Controllers\AuthController@login')->name('auth.login'); // guest vrf si non connectd avt daler a
Route::post('/login','App\Http\Controllers\AuthController@dologin')->name('auth.dologin'); 
Route::delete('/logout','App\Http\Controllers\AuthController@logout')->middleware('auth')->name('auth.logout'); 

// Rregister
Route::get('/regs','App\Http\Controllers\CreateUsersController@fregister')->name('fregister'); // guest vrf si non connectd avt daler a
Route::post('/regs','App\Http\Controllers\CreateUsersController@register')->name('register'); 




//  Dachboard 
Route::get('/dasb','App\Http\Controllers\dasbController@dasb')->name('dasb')->middleware('auth'); 



// Generation de num serie V
Route::get('/new','App\Http\Controllers\mainController@create')->name('create')->middleware('auth'); //route vers le ctrlr nomme create numserie :: form
Route::post('/new','App\Http\Controllers\mainController@store')->name('store'); //route vers le ctrlr nomme create :: forrm soumis


// Generation de num serie V
Route::get('/','App\Http\Controllers\NumSeriesController@create')->name('createns')->middleware('auth'); //route vers le ctrlr nomme create numserie :: form
Route::post('/','App\Http\Controllers\NumSeriesController@store')->name('storens'); //route vers le ctrlr nomme create :: forrm soumis

// Generation de num serie V
Route::get('/afs','App\Http\Controllers\NumSeriesController@afget')->name('afget')->middleware('auth'); //route vers le ctrlr nomme create numserie :: form
Route::post('/afs','App\Http\Controllers\NumSeriesController@afpost')->name('afpost')->middleware('auth');; //route vers le ctrlr nomme create :: forrm soumis




// creation d'article V
// Route::get('/newA','App\Http\Controllers\mainController@createA')->name('createA')->middleware('auth'); 
// Route::post('/newA','App\Http\Controllers\mainController@storeA')->name('storeA'); 
Route::get('/newA','App\Http\Controllers\ArticlesController@create')->name('createA')->middleware('auth'); 
Route::post('/newA','App\Http\Controllers\ArticlesController@store')->name('storeA'); 
Route::post('/modifA','App\Http\Controllers\ArticlesController@update')->name('updateA'); 



//creation de plan
Route::get('/newP','App\Http\Controllers\PlansController@create')->name('createP')->middleware('auth'); 
Route::post('/newP','App\Http\Controllers\PlansController@store')->name('storeP'); 


Route::get('/listns','App\Http\Controllers\mainController@listns')->name('listns')->middleware('auth');//afficher form ns

// affiche ts les num ser V
Route::get('affns/', function () {
    //return num_series::all();
})->name('affns');

//Route::post('/affns','App\Http\Controllers\mainController@indexA')->name('indexA')->middleware('auth');


Route::get('affus/', function () {
    return users::all();
})->name('affus');

// affiche ts les art V
Route::get('/affA','App\Http\Controllers\ArticlesController@afaget')->name('afaget')->middleware('auth');//afficher form ns
Route::post('/affA','App\Http\Controllers\ArticlesController@afapost')->name('afapost');//afficher form ns


// affiche ts les art V
Route::get('affp/', function () {
    return plans::all();
})->name('affp');


Route::get('/numserie', function () {
    $num_series = num_series:: create(
        ['numS' => 'stylo-x230002',
         'user_id' => 1,
         ' article_id' => 2,
         '']
    );
});

Route::get('/articles', function () {
    return articles::with("num_serie")->paginate(5);
});

Route::get('/users', function () {

    // $users = new users();
    // $users->email = "root@gmail.com";
    // $users->password = "5623";
    // $users->name = "root";
    // $users->save();
    // return $users;
    // // id = 1

    // $articles = new articles();
    // $articles->designation = "stylo bic";
    // $articles->user_id = "1";

    // $articles->save();
    // return $articles;
    // id = 1



    $num_series = new num_series();
    $num_series->numS = "stylo_bic230010";
    $num_series->user_id = "1";
    $num_series->article_id = "1";
    //id = 3 .. 1 deja cree et 2 error

    $num_series->save();
    return $num_series;

    // $num_series = num_series:: create(
    //     ['numS' => 'stylo_bic230003',
    //      'user_id' => '1',
    //      ' article_id' => '1']
    // );

});




