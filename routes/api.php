<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\Story;
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

Route::post('/upload-story', function (Request $request) {
  $story = Story::Create([
    'story_data' => $request->data
  ]);
  return response()->json($story);
});

Route::get('/get-key', function() {
  return response()->json([
    'token' => env('GPT_KEY')
  ]);
});
