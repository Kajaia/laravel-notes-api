<?php

use App\Http\Controllers\LabelController;
use App\Http\Controllers\NoteController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::apiResources([
    'labels' => LabelController::class,
    'notes' => NoteController::class
]);

Route::get('trash', [NoteController::class, 'trash']);
Route::get('archive', [NoteController::class, 'archivedNotes']);
Route::post('notes/{id}/restore', [NoteController::class, 'restore'])->whereNumber('id');
Route::post('archive/{id}', [NoteController::class, 'archive'])->whereNumber('id');
Route::post('pin/{id}', [NoteController::class, 'pin'])->whereNumber('id');