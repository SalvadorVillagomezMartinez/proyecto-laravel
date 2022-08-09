<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;


use App\Models\Image;

Route::get('/', function () {
   /*
  //Obtenemos todos los registros de la tabla de images 
  $images = Image::all();

   foreach ($images as $image) {
      echo $image->image_path . '<br/>';
      echo $image->description . '<br/>';
      echo $image->user->name . ' ' .$image->user->surname .'<br/>';
      echo 'Likes: '.count($image->likes).'<br/>';
      echo '<strong>Comentarios</strong>';
      echo '<ul>';
      foreach($image->comments as $comment){
         echo '<li>' . $comment->user->name. ': '.$comment->content . '</li>';
      }
      echo '</ul>';
   

      
   }
   die();
   */

   return view('welcome');
});
Auth::routes();
Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/configuracion', [App\Http\Controllers\UserController::class, 'config'])->name('config');
Route::post('/user/update', [App\Http\Controllers\UserController::class, 'update'])->name('user.update');
Route::get('/user/avatar/{filename}', [App\Http\Controllers\UserController::class, 'getImagen'])->name('user.avatar');
Route::get('/subir-imagen', [App\Http\Controllers\ImageController::class, 'create'])->name('image.create');
Route::post('/image/save', [App\Http\Controllers\ImageController::class, 'save'])->name('image.save');
Route::get('/image/get/{filename}', [App\Http\Controllers\ImageController::class, 'getImage'])->name('image.get');
Route::get('/image/{id}', [App\Http\Controllers\ImageController::class, 'detail'])->name('image.detail');
Route::post('/comment/save', [App\Http\Controllers\ControllerComment::class, 'save'])->name('comment.save');
Route::get('/comment/delete/{id}', [App\Http\Controllers\ControllerComment::class, 'delete'])->name('comment.delete');
Route::get('/like/{image_id}', [App\Http\Controllers\LikeController::class, 'like'])->name('like.save');
Route::get('/dislike/{image_id}', [App\Http\Controllers\LikeController::class, 'dislike'])->name('like.delete');
