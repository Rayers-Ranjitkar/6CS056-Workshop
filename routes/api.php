<?php //Registering the created api using Route::apiResource('name, which controller to call') 

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\StudentController;
use App\Http\Controllers\Api\CourseController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::apiResource('students', StudentController::class); // Regsitering -> Route::apiResource('learners', StudentController::class);  = api/learners/... call huda , call StudentController to handle this req


//Registering inbuilt laravel routes for courses
Route::apiResource('courses', CourseController::class); // this equals now --> install api ley /api now this has done /api/courses/GET/.... huda courseController should handle 