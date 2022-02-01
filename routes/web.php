<?php
use App\Http\Controllers\PostController; 
use Illuminate\Support\Facades\Route;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/posts', [PostController::class, 'index'])->name('posts.index');
Route::get('/posts/create',[PostController::class, 'create'])->name('posts.create')->middleware(['auth']);
Route::get('/posts/{post}', [PostController::class, 'show'])->name('posts.show');
Route::post('/posts',[PostController::class, 'store'])->name('posts.store')->middleware(['auth']);
Route::get('/posts/{post}/edit',[PostController::class, 'edit'])->name('posts.edit')->middleware(['auth']);
Route::put('/posts/{post}',[PostController::class, 'update'])->name('posts.update')->middleware(['auth']);
Route::delete('/posts/{post}/delete',[PostController::class, 'destroy'])->name('posts.destroy')->middleware(['auth']);

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/auth/redirect', function () {
    return Socialite::driver('github')->redirect();
})->name('auth.github');

Route::get('/auth/callback', function () {
    $githubUser = Socialite::driver('github')->user();
    // dd($githubUser);
    $user = User::where('github_id', $githubUser->id)->first();

    if ($user) {
        $user->update([
            'github_token' => $githubUser->token,
            'github_refresh_token' => $githubUser->refreshToken,
        ]);
    } else {
        $user = User::create([
            'name' => $githubUser->nickname,
            'email' => $githubUser->email,
            'password' => $githubUser->nickname,
            'github_id' => $githubUser->id,
            'github_token' => $githubUser->token,
            'github_refresh_token' => $githubUser->refreshToken,
        ]);
    }

    Auth::login($user);

    return redirect('/posts');
});


// google login
Route::get('/auth-google/redirect', function () {
    return Socialite::driver('google')->redirect();
})->name('auth.google');

Route::get('/auth-google/callback', function () {
    $googleUser = Socialite::driver('google')->user();
    dd($googleUser);
    // $user = User::where('github_id', $githubUser->id)->first();

    // if ($user) {
    //     $user->update([
    //         'github_token' => $githubUser->token,
    //         'github_refresh_token' => $githubUser->refreshToken,
    //     ]);
    // } else {
    //     $user = User::create([
    //         'name' => $githubUser->nickname,
    //         'email' => $githubUser->email,
    //         'password' => $githubUser->nickname,
    //         'github_id' => $githubUser->id,
    //         'github_token' => $githubUser->token,
    //         'github_refresh_token' => $githubUser->refreshToken,
    //     ]);
    // }

    // Auth::login($user);

    return redirect('/dashboard');
});