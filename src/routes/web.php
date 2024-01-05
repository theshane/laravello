<?php


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Models\Status;

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/login', function () {
    return view('auth/login');
});


Route::get('/dashboard', function () {
    $user = Auth::user();
    return view('pages.dashboard', ["user" => $user, "boards" => $user->boards()->get()]);
});

Route::post('/card', function () {
    $user = Auth::user();
    error_log(print_r($_POST, true));
    $card = $user->assigned_cards()->find($_POST["card_id"]);
    $card->update(['status'=> $_POST['status_id']]);
    return response('', 200);
});     

Route::post("/board/{id}/card", function ($id) {
    $user = Auth::user();
    $board = $user->boards()->find($id);
    $statuses = Status::all();
    $data = [
        "title" => $_POST["title"],
        "board_id" => 1,
        "status" => $statuses->first()->id,
        "order" => 0,
    ];

    error_log(print_r($data, true));
    
    try {
        $user->assigned_cards()->create([
            "title" => $_POST["title"],
            "board_id" => 1,
            "status" => $statuses->first()->id,
            "order" => 0,
        ]);
        return view("fragments.board", ["board"=> $board, "statuses"=> $statuses, "add_card" => false]);
    } catch (\Exception $e) {
        error_log($e->getMessage());
        abort(500);
    }
   
});

Route::get("/fragments/board/{id}", function ($id) {
    $user = Auth::user();
    $board = $user->boards()->find($id);
    $statuses = Status::all();
    $add_card = $_GET["add_card"] ?? false;
    return view("fragments.board", ["board"=> $board, "statuses"=> $statuses, "add_card" => $add_card]);
});

Route::get('/fragments/dashboard', function () {
    $user = Auth::user();
    return view("fragments.dashboard", ["user" => $user, "boards" => $user->boards()->get()]);
});

Route::post('/login', [AuthController::class, 'login']);
