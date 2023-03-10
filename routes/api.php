<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\Story;
use OpenAI\Laravel\Facades\OpenAI;
use App\Http\Resources\StoryResource;
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
  return response()->json(new StoryResource($story));
});

Route::get('/story/all', function (Request $request) {
  $stories = Story::all();
  return response()->json(StoryResource::collection($stories));
});

Route::get('/story/{story}', function (Request $request, Story $story) {
  return response()->json(new StoryResource($story));
});
Route::get('/get-key', function() {
  return response()->json([
    'token' => env('GPT_KEY')
  ]);
});

Route::post('/generate-story', function (Request $request) {
  $result = OpenAI::completions()->create([
    'model' => 'text-davinci-003',
    'prompt' => 'generate a 1 paragraph children story with a title . Return a well formatted JSON object with a title property that contains the title, a text property that contains the story and ssml property that contains an well formatted SSML document generated from the story serialized as a string.',
    'temperature' => 1,
    'max_tokens' => 2048
 ]);
 $story = Story::Create([
   'story_data' => $result['choices'][0]['text']
 ]);
 return response()->json(new StoryResource($story));
});
