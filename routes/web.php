<?php
use App\Http\Controllers\{
    UserController
};
use App\Http\Controllers\Admin\CommentController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Aqui é onde você pode registrar rotas da web para sua aplicação (app). Essas
| rotas são carregadas pelo RouteServiceProvider dentro de um grupo que
| contém o grupo de middleware "web". Agora, que tal criar algo grande!
|
*/
Route::get('/users.{id}/comments/create', [CommentController::class, 'create'])->name('comments.create');

Route::post('/users.{id}/comments', [CommentController::class, 'store'])->name('comments.store');

Route::get('/users.{user}/comments/{id}', [CommentController::class, 'edit'])->name('comments.edit');

Route::put('/comments/{id}', [CommentController::class, 'update'])->name('comments.update');

Route::get('/users.{id}/comments', [CommentController::class, 'index'])->name('comments.index');

Route::delete('/users.{id}', [UserController::class, 'destroy'])->name('users.destroy');

Route::put('/users/{id}', [UserController::class, 'update'])->name('users.update');

Route::get('/users/{id}/edit', [UserController::class, 'edit'])->name('users.edit');

Route::get('/users', [UserController::class, 'index'])->name('users.index');

Route::get('/users/create', [UserController::class, 'create'])->name('users.create');

Route::post('/users', [UserController::class, 'store'])->name('users.store');
/* Estas rotas: "Route::get('/users/create', [UserController::class, 'create'])->name('users.create');" tem que ser criada antes da que pega o {id} como parametro */

Route::get('/users/{id}', [UserController::class, 'show'])->name('users.show');


Route::get('/', function () {
    return view('welcome');
});
