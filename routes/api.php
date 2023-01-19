<?php

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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

//    - get: /user/name (login)
//    - post: /user (registratie - hashen)

//    - get: /chats (join -> alle nodige velden laten zien)
//    - post: /chats (nieuwe aanmaken)
//    - delete: /chats (truncate)
//    - delete: /chats/{id}

////////////////// USERS //////////////////////////////////////////////////////

Route::get('/users/{name}', function ($name) {
    
    if (!DB::table('users')->where('name', $name)->exists()) {
        return response()->json([
            'message' => 'User not found'
        ], 404);
    }
    // return DB::table('users')->where('name', $name)->first();
    // do the same but with plain sql
    return DB::select('select * from users where name = ?', [$name]);

});

Route::post('/users', function (Request $request) {
    $name = $request->input('name');
    $password = $request->input('password');
    $email = $request->input('email');

    if (DB::table('users')->where('name', $name)->exists()) {
        return response()->json([
            'message' => 'User already exists'
        ], 409);
    }

    DB::table('users')->insert([
        'name' => $name,
        'password' => Hash::make($password),
        'email' => $email
    ]);

    return response()->json([
        'message' => 'User created'
    ], 201);
});

////////////////// CHAT //////////////////////////////////////////////////////

//    - get: /chats (join -> alle nodige velden laten zien)
//    - post: /chats (nieuwe aanmaken)
//    - delete: /chats (truncate)

Route::get('/chats', function () {
     return DB::table('chats')
         ->join('users', 'chats.user_id', '=', 'users.id')
         ->select('chats.id', 'chats.message', 'users.name')
         ->get();

    return DB::select('select chats.id AS chatId, chats.message, users.name, users.id AS userId from chats join users on chats.user_id = users.id');
});

Route::post('/chats', function (Request $request) {
    $content = $request->input('content');
    $user_id = $request->input('user_id');
    // get current date
    $date = date('Y-m-d H:i:s');

    DB::table('chats')->insert([
        'content' => $content,
        'user_id' => $user_id,
        'date' => $date
    ]);

    return response()->json([
        'message' => 'Message created'
    ], 201);
});

Route::delete('/chats', function () {
    DB::table('chats')->truncate();

    return response()->json([
        'message' => 'All messages deleted'
    ], 200);
});