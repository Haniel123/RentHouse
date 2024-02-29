<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
// Admin Controller
use App\Http\Controllers\Admin\AccountsController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\ServicesController;
use App\Http\Controllers\Admin\ContractsController;
use App\Http\Controllers\Admin\NewsController;
use App\Http\Controllers\Admin\RoomsController;
use App\Http\Controllers\Admin\TermsController;
use App\Http\Controllers\Admin\ChiController;
use App\Http\Controllers\Admin\ReportController;
use App\Http\Controllers\Admin\ThuController;
// User + Homepage Controller
use App\Http\Controllers\User\AboutusController;
use App\Http\Controllers\User\UserController;
use App\Http\Controllers\User\UserDetailController;
use App\Http\Controllers\User\HomePageController;
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

Route::get('/', [UserController::class, 'loadIndex'])->name('index');
Route::get('/trang-chu', [UserController::class, 'loadIndex'])->name('trang-chu');
Route::post('/tim-kiem', [HomePageController::class, 'timkiem'])->name('tim-kiem');
Route::get('/loc-phong/{type}/{dau}/{rp}', [HomePageController::class, 'locPhong'])->name('loc-phong');
Route::get('/chi-tiet-phong/{id}', [UserController::class, 'layChiTietPhong'])->name('chi-tiet-phong');
Route::get('/gioi-thieu-noi-dung', [AboutusController::class, 'showNoiDung'])->name('gioi-thieu-noi-dung');
Route::get('/lien-he', [AboutusController::class, 'showLienHe'])->name('lien-he');
Route::get('/tin-tuc', [AboutusController::class, 'showTinTuc'])->name('tin-tuc');
Route::get('/chi-tiet-tin-tuc/{id}', [AboutusController::class, 'showTinTucChiTiet'])->name('chi-tiet-tin-tuc');
Route::post('/thanh-toan-vnpay', [UserController::class, 'vnPayPayment'])->name('thanhtoan');
Route::get('/thanh-toan-dat-truoc/{userid}/{phone}/{name}/{idphong}/{email}/{typepay}', [UserController::class, 'returnVnPay'])->name('trang-chu-vnpay');
Route::group(['prefix' => 'user', 'as' => 'user.', 'namespace' => 'User'], function () {
    Auth::routes();
    Route::match(['get', 'post'], '/dang-ky', [UserController::class, 'register'])->name('dang-ky');
    Route::get('/xac-nhan-tai-khoan/{id}', [UserController::class, 'confirmAccount'])->name('xac-nhan-tai-khoan');
    Route::match(['get', 'post'], '/dang-nhap', [UserController::class, 'login'])->name('login');
    Route::get('/quen-mat-khau', [UserController::class, 'changePassword'])->name('quen-mat-khau');
    Route::get('/doi-mat-khau/{id}', [UserController::class, 'changePasswordUserGet'])->name('doi-mat-khau');
    Route::post('/doi-mat-khau-p', [UserController::class, 'changePasswordUserPost'])->name('doi-mat-khau-post');
    Route::get('/mat-khau-moi-get/{email}/{token}', [UserController::class, 'newsPasswordGet'])->name('mat-khau-moi-get');
    Route::post('/mat-khau-moi-post', [UserController::class, 'newsPasswordPost'])->name('mat-khau-moi-post');
    Route::get('/logout', [UserController::class, 'logout'])->name('logout');
    Route::group(['middleware' => ['checkauth:user']], function () {
        Route::get('/thong-tin-nguoi-dung', [UserDetailController::class, 'userinfo'])->name('userinfo');
        Route::post('/sua-nguoi-dung', [UserDetailController::class, 'suaThongTinUser'])->name('sua-nguoi-dung');
        Route::get('/chi-tiet-phong-thue/{id}', [UserController::class, 'layChiTietPhongUser'])->name('chi-tiet-phong-user');
        Route::get('/phan-hoi-phong', [UserDetailController::class, 'phanHoiPhong'])->name('phan-hoi-phong');
        Route::get('/huy-phong', [UserDetailController::class, 'phanHuyPhong'])->name('huy-phong');
    });
});

// Trang quản trị
Route::group(['prefix' => 'admin', 'as' => 'admin.', 'namespace' => 'Quản Trị'], function () {
    Auth::routes();
    Route::match(['get', 'post'], '/login', [AdminController::class, 'login'])->name('login');
    Route::group(['middleware' => ['checkauth:admin']], function () {
        Route::get('/', [AdminController::class, 'index'])->name('index');
        Route::get('/logout', [AdminController::class, 'logout'])->name('logout');
        //Phòng trọ
        Route::group(['prefix' => 'phong-tro', 'namespace' => 'Phòng Trọ'], function () {
            Route::get('/', [RoomsController::class, 'layPhong'])->name('phong-tro');
            Route::post('them-phong', [RoomsController::class, 'themPhong'])->name('them-phong');
            Route::post('sua-phong', [RoomsController::class, 'suaPhong'])->name('sua-phong');
            Route::get('xoa-phong', [RoomsController::class, 'xoaPhong'])->name('xoa-phong');
            Route::get('lay-phong', [RoomsController::class, 'layPhongTheoID'])->name('lay-phong');
            Route::get('xoa-hinh', [RoomsController::class, 'xoahinhtheoID'])->name('xoa-hinh-phong');
            Route::get('doi-status-phong', [RoomsController::class, 'doiTrangThaiPhong'])->name('doi-status-phong');
            Route::get('huy-hopdong-phong', [RoomsController::class, 'huyHopdongPhong'])->name('huy-hopdong-phong');
            Route::get('pagination', [RoomsController::class, 'pagination'])->name('paginations');
        });
        //Hợp đồng
        Route::group(['prefix' => 'hop-dong', 'namespace' => 'Hợp Đồng'], function () {
            Route::get('/', [ContractsController::class, 'layHopDong'])->name('hop-dong');
            Route::post('them-hopdong', [ContractsController::class, 'themHopDong'])->name('them-hopdong');
            Route::post('sua-hopdong', [ContractsController::class, 'suaHopDong'])->name('sua-hopdong');
            Route::get('lay-hopdong', [ContractsController::class, 'layHopDongTheoID'])->name('lay-hopdong');
            Route::get('xoa-hopdong', [ContractsController::class, 'xoaHopDong'])->name('xoa-hopdong');
            Route::get('pagination', [ContractsController::class, 'pagination'])->name('paginations');
        });

        //Điều khoản
        Route::group(['prefix' => 'dieu-khoan', 'namespace' => 'Điều Khoản'], function () {
            Route::get('/', [TermsController::class, 'layDieuKhoan'])->name('dieu-khoan');
            Route::post('them-dieukhoan', [TermsController::class, 'themDieuKhoan'])->name('them-dieukhoan');
            Route::post('sua-dieukhoan', [TermsController::class, 'suaDieuKhoan'])->name('sua-dieukhoan');
            Route::get('lay-dieukhoan', [TermsController::class, 'layDieuKhoanTheoID'])->name('lay-dieukhoan');
            Route::get('xoa-dieukhoan', [TermsController::class, 'xoaDieuKhoan'])->name('xoa-dieukhoan');
            Route::get('pagination', [TermsController::class, 'pagination'])->name('paginations');
        });
        //Dịch vụ
        Route::group(['prefix' => 'dich-vu', 'namespace' => 'Dịch vụ'], function () {
            Route::get('/', [ServicesController::class, 'layDichVu'])->name('dich-vu');
            Route::post('them-dichvu', [ServicesController::class, 'themDichVu'])->name('them-dichvu');
            Route::post('sua-dichvu', [ServicesController::class, 'suaDichVu'])->name('sua-dichvu');
            Route::get('lay-dichvu', [ServicesController::class, 'layDichVuTheoID'])->name('lay-dichvu');
            Route::get('xoa-dichvu', [ServicesController::class, 'xoaDichVu'])->name('xoa-dichvu');
            Route::get('pagination', [ServicesController::class, 'pagination'])->name('paginations');
        });

        //Tin tức
        Route::group(['prefix' => 'tin-tuc', 'namespace' => 'Tin tức'], function () {
            Route::get('/', [NewsController::class, 'layTinTuc'])->name('tin-tuc');
            Route::post('them-tintuc', [NewsController::class, 'themTinTuc'])->name('them-tintuc');
            Route::post('sua-tintuc', [NewsController::class, 'suaTinTuc'])->name('sua-tintuc');
            Route::get('lay-tintuc', [NewsController::class, 'layTinTucTheoID'])->name('lay-tintuc');
            Route::get('xoa-tintuc', [NewsController::class, 'xoaTinTuc'])->name('xoa-tintuc');
            Route::get('pagination', [NewsController::class, 'tintucPagination'])->name('paginations');
        });

        //Tin tức
        Route::group(['prefix' => 'gioi-thieu', 'namespace' => 'Giới thiệu'], function () {
            Route::get('/', [NewsController::class, 'layGioithieu'])->name('gioi-thieu');
            Route::post('sua-gioithieu', [NewsController::class, 'suaGioithieu'])->name('sua-gioithieu');
        });

        //Thu
        Route::group(['prefix' => 'thu', 'namespace' => 'Thu'], function () {
            Route::get('/', [ThuController::class, 'layThu'])->name('thu');
            Route::post('them-thu', [ThuController::class, 'themThu'])->name('them-thu');
            Route::post('sua-thu', [ThuController::class, 'suaThu'])->name('sua-thu');
            Route::get('lay-thu', [ThuController::class, 'layThuTheoID'])->name('lay-thu');
            Route::get('xoa-thu', [ThuController::class, 'xoaThu'])->name('xoa-thu');
            Route::get('pagination', [ThuController::class, 'thuPagination'])->name('paginations');
        });

        //Khách hàng
        Route::group(['prefix' => 'chi', 'namespace' => 'Chi'], function () {
            Route::get('/', [ChiController::class, 'layChi'])->name('chi');
            Route::post('them-chi', [ChiController::class, 'themChi'])->name('them-chi');
            Route::post('sua-chi', [ChiController::class, 'suaChi'])->name('sua-chi');
            Route::get('lay-chi', [ChiController::class, 'layChiTheoID'])->name('lay-chi');
            Route::get('xoa-chi', [ChiController::class, 'xoaChi'])->name('xoa-chi');
            Route::get('pagination', [ChiController::class, 'pagination'])->name('paginations');
        });

        //Phản hồi
        Route::group(['prefix' => 'phan-hoi', 'namespace' => 'Phản hồi'], function () {
            Route::get('/', [ReportController::class, 'layPhanHoi'])->name('phan-hoi');
            Route::post('them-phanhoi', [ReportController::class, 'themPhanHoi'])->name('them-phanhoi');
            Route::post('sua-phanhoi', [ReportController::class, 'suaPhanHoi'])->name('sua-phanhoi');
            Route::get('lay-phanhoi', [ReportController::class, 'layPhanHoiTheoID'])->name('lay-phanhoi');
            Route::get('xoa-phanhoi', [ReportController::class, 'xoaPhanHoi'])->name('xoa-phanhoi');
            Route::get('doi-status-phanhoi', [ReportController::class, 'doiTrangThaiPhanHoi'])->name('doi-status-phanhoi');
            Route::get('pagination', [ReportController::class, 'pagination'])->name('paginations');
        });

        //Khách hàng
        Route::group(['prefix' => 'khach-hang', 'namespace' => 'Tài khoản khách hàng'], function () {
            Route::get('/', [AccountsController::class, 'layKhachHang'])->name('khach-hang');
            Route::post('them-khachhang', [AccountsController::class, 'themKhachHang'])->name('them-khachhang');
            Route::post('sua-khachhang', [AccountsController::class, 'suaKhachHang'])->name('sua-khachhang');
            Route::get('lay-khachhang', [AccountsController::class, 'layKhachHangTheoID'])->name('lay-khachhang');
            Route::get('xoa-khachhang', [AccountsController::class, 'xoaKhachHang'])->name('xoa-khachhang');
            Route::get('doi-status-khachhang', [AccountsController::class, 'doiTrangThaiKhachHang'])->name('doi-status-khachhang');
            Route::get('pagination', [AccountsController::class, 'khachHangPagination'])->name('paginations');
        });

        //Quản trị
        Route::group(['prefix' => 'quan-tri', 'namespace' => 'Tài khoản quản trị'], function () {
            Route::get('/', [AccountsController::class, 'layQuanTri'])->name('quan-tri');
            Route::post('them-quantri', [AccountsController::class, 'themQuanTri'])->name('them-quantri');
            Route::post('sua-quantri', [AccountsController::class, 'suaQuanTri'])->name('sua-quantri');
            Route::get('lay-quantri', [AccountsController::class, 'layQuanTriTheoID'])->name('lay-quantri');
            Route::get('xoa-quantri', [AccountsController::class, 'xoaQuanTri'])->name('xoa-quantri');
            Route::get('doi-status-quantri', [AccountsController::class, 'doiTrangThaiQuanTri'])->name('doi-status-quantri');
            Route::get('pagination', [AccountsController::class, 'quanTriPagination'])->name('paginations');
        });

        // Route::get('/setting', [AdminAuthController::class, 'logout'])->name('setting');
    });
});
