<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ProductController;
Route::get('/', function () {
    return view('welcome');
});

Route::get('/info', function () {
    $info = [
        'name' => 'Trieu Bao Chuong',
        'email' => 'chuongtbpk01@gmail.com',
        'phone' => '098765434',
    ];

    return view('info', ['info' => $info]);
});

Route::get('/', function () {
    $info = [
        'name' => 'Trieu Bao Chuong',
        'email' => 'chuongtbpk01@gmail.com',
        'phone' => '098765434',
        'profile' => 'Web Developer',
        'about' => 'Tôi là Triệu Bảo Chương, một lập trình viên web với niềm đam mê xây dựng và phát triển các ứng dụng web tối ưu,
        tôi đang tập trung vào việc cải thiện khả năng giao tiếp tiếng Anh để mở rộng cơ hội làm việc và hợp tác quốc tế.',
    ];

    return view('welcome', ['info' => $info]);
});

Route::resource('/products', ProductController::class);
Route::delete('/products/{id}', [ProductController::class, 'destroy'])->name('products.delete');

