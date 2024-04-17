<?php

use App\Http\Controllers\Api\tasksController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
/*the following routes are api route for tasks crud for creating task,
reading a task, updating a task and deleteng tasks
the tasks contains the task id,the title, description and the status. 
*/


Route::get('tasks',[tasksController::class,'index'])->name('tasks.index');
Route::post('tasks',[tasksController::class,'store'])->name('tasks.store');
Route::get('tasks/{id}',[tasksController::class,'show'])->name('tasks.show');
Route::get('tasks/{id}/edit',[tasksController::class,'edit'])->name('tasks.edit');
Route::put('tasks/{id}/edit',[tasksController::class,'update'])->name('tasks.update');
Route::put('tasks/{id}/delete',[tasksController::class,'destroy'])->name('tasks.destroy');
