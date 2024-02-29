<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use App\Models\UserModel;
use App\Models\RoomsModel;
use App\Models\PhongThueModel;
use App\Models\PasswordResetModel;
use App\Models\PhongDichVuModel;
use App\Models\ContractsModel;
use App\Models\ReportModel;
use App\Models\ServicesModel;
use App\Models\Book;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendMail;
use App\Mail\ThongBaoThanhToan;
use App\Mail\Confirmccount;
use App\Models\BaivietModel;
use App\Models\PhongHopDongModel;
use Illuminate\Auth\Events\PasswordReset;

class UserController extends Controller
{
    function login(Request $request)
    {
        if ($request->getMethod() == 'GET') {
            if (!Auth::guard('user')->check()) {
                return view('templates.layouts.login');
            } else {
                return redirect()->route('trang-chu');
            }
        }
        if (Auth::guard('user')->attempt($request->only(['username', 'password']))) {

            if (Auth::guard('user')->user()->status == 0) {

                Auth::guard('user')->logout();
                session()->flash('fail', 'Tài khoản chưa được xác thực email');
                return redirect()->route('user.login')->withInput();
            } else if (Auth::guard('user')->user()->status == 1) {
                session()->flash('success', 'Đăng nhập thành công');
                return redirect()->route('trang-chu');
            }
        } else {
            session()->flash('fail', 'Sai tên đăng nhập hoặc mật khẩu');
            return redirect()->route('user.login')->withInput();
        }
    }

    function loadIndex(Request $request)
    {
        $allRooms = $this->layTatCaPhong();
        $gioithieu = BaivietModel::where('type', 'gioi-thieu')->first();
        return view('templates.index.index', compact('allRooms', 'gioithieu'));
    }

    public function logout(Request $request): RedirectResponse
    {
        if (Auth::guard('user')->check()) // this means that the admin was logged in.
        {
            Auth::guard('user')->logout();
            return redirect()->route('index');
        }
        return redirect()->route('index');
    }

    function register(Request $request)
    {
        if (!Auth::guard('user')->check()) {
            if ($request->getMethod() == 'GET') {
                return view('templates.layouts.register');
            } else if ($request->getMethod() == 'POST') {
                $validator = Validator::make(
                    $request->all(),
                    [
                        'username' => 'required|max:255|unique:table_khachhang',
                        'password' => 'required|confirmed',
                        'phone' => 'numeric|unique:table_khachhang',
                        'email' => 'email|unique:table_khachhang',
                        'password_confirmation' => 'required',
                    ],
                    [
                        'username.required' => 'Vui lòng nhập đầy đủ username',
                        'username.min' => 'Tên người dùng phải có :min ký tự',
                        'username.max' => 'Tên người dùng phải có :max ký tự',
                        'password.required' => 'Vui lòng nhập đầy đủ mật khẩu',
                        'password.confirmed' => 'Mật khẩu chưa trùng khớp',
                        'email.email' => 'Email chưa đúng định dạng',


                    ]
                );
                if ($validator->fails()) {
                    return redirect('user/dang-ky')
                        ->withErrors($validator)
                        ->withInput();
                }
                $lastnumb = null;
                $lastitem = UserModel::get()->sortBy('ordinal')->last();
                if ($lastitem != null) {
                    $lastnumb = (int)$lastitem->ordinal + 1;
                } else {
                    $lastnumb = 0;
                }
                $user = new UserModel;
                $user->username = $request->username;
                $user->password = Hash::make($request->password);
                $user->name = $request->name;
                $user->email = $request->email;
                $user->phone = $request->phone;
                $user->address = $request->address;
                $user->ordinal = $lastnumb;
                $user->status = 0;
                $user->save();
                $mailData = [
                    'title' => 'Xin chào ' . $request->name,
                    'body' => 'Xin chào, vui lòng nhấn đường dẫn bên dưới đê tiến hành xác nhận tài khoản của bạn .',
                    'id' => $user->id,
                    'email' => $request->email
                ];
                Mail::to($request->email)->send(new Confirmccount($mailData));
                session()->flash('success', 'Vui lòng kiểm tra email của bạn để xác nhận tài khoản !');
                return view('templates.layouts.login');
            }
        } else {
            return redirect()->route('trang-chu');
        }
    }

    public function confirmAccount(Request $request)
    {
        $userid = $request->id;
        $user = new UserModel;
        $userinfo = $user::find($userid);
        if ($userinfo->status == 0) {
            $userinfo->status = 1;
            $userinfo->save();
            session()->flash('success', 'Xác nhận tài khoản thành công !');
            return view('templates.layouts.login');
        } else {
            session()->flash('fail', 'Tài khoản dã được xác nhận !');
            return view('templates.layouts.login');
        }
    }

    public function changePassword(Request $request)
    {
        if ($request->getMethod() == 'GET') {
            $user = new UserModel;
            $changepass = new PasswordResetModel;
            $validator = Validator::make($request->all(), [
                'email' => 'required|email|exists:table_khachhang',
            ]);
            if ($validator->fails()) {
                session()->flash('fail', 'Email không tồn tại !');
                return redirect('user/dang-nhap')->withInput();
            }
            $token = str::random(64);
            $changepass::insert([
                'email' => $request->email,
                'token' => $token,
                'created_at' => Carbon::now()
            ]);
            $userinfo = $user::where('email', '=', $request->email)->first();
            if (isset($userinfo)) {
                $mailData = [
                    'title' => 'Xin chào ' . $userinfo->name,
                    'body' => 'Chúng tôi nhận được yêu cầu đổi mật khẩu từ bạn, vui lòng nhấn đường dẫn bên dưới đê tiến hành đổi mật khẩu.',
                    'token' => $token,
                    'email' => $request->email
                ];
                Mail::to($request->email)->send(new SendMail($mailData));
            }
            session()->flash('success', 'Chúng tôi đã gửi thư thay đổi mật khẩu đến email của bạn !');
            return redirect()->back();
        }
        if ($request->getMethod() == 'POST') {
        }
    }



    public function changePasswordUserGet(Request $request)
    {
        $id = $request->id;
        return view('templates.layouts.changepass', compact('id'));
    }

    public function changePasswordUserPost(Request $request)
    {
        $id = $request->id;
        $validator = Validator::make($request->all(), [

            'password' => 'required|confirmed',
            'password_confirmation' => 'required',
        ]);
        if ($validator->fails()) {
            return redirect()->route('user.doi-mat-khau', ['id' => $id])
                ->withErrors($validator)
                ->withInput();
        }
        $user = new UserModel;
        $password = $request->password;
        $password_comfirmation = $request->password_comfirmation;
        $user::where('id', '=', $id)->update(['password' => Hash::make($password)]);
        // $infotoken::withTrashed()->where('email', $email)->forceDelete();
        session()->flash('success', 'Đổi mật khẩu thành công');
        return redirect()->route('trang-chu');
    }
    public function newsPasswordGet(Request $request)
    {
        $email = $request->email;
        $token = $request->token;
        return view('templates.layouts.new-password', compact('email', 'token'));
    }

    public function newsPasswordPost(Request $request)
    {
        $changepass = new PasswordResetModel;
        $user = new UserModel;
        $email = $request->email;
        $token = $request->newspwtoken;
        $password = $request->password;
        $password_comfirmation = $request->password_comfirmation;
        $infotoken = $changepass::where([['email', '=', $email], ['token', '=', $token]])->first();

        if (!$infotoken) {
            session()->flash('fail', 'Lỗi đường dẫn đã hết hạn hoặc không còn tồn tại !');
            return redirect()->route('user.login');
        }

        $user::where('email', '=', $email)->update(['password' => Hash::make($password)]);
        $infotoken = DB::table('password_reset_tokens')->where('email', $email)->delete();
        // $infotoken::withTrashed()->where('email', $email)->forceDelete();
        session()->flash('success', 'Đổi mật khẩu thành công');
        return redirect()->route('user.login');
    }

    function layTatCaPhong()
    {
        $allRoom = DB::table('table_phong')->where('status', '=', 1)->get();
        return $allRoom;
    }
    public function layChiTietPhong(Request $request)
    {
        $user = new RoomsModel;
        $contracts = new ServicesModel();
        $phonghd = new PhongDichVuModel;
        $roomcontracts = $phonghd::where('id_phong', '=', $request->id)->get();
        $listphonguser = [];
        foreach ($roomcontracts as $k => $v) {
            array_push($listphonguser, $v->id_dichvu);
        }
        $listservice = $contracts::whereIn('id', $listphonguser)->get();
        // $contractsinfo=$contracts::find($roomcontracts->id);
        $roomDetails = $user::find($request->id);
        return view('templates.room.room_details', compact('roomDetails', 'listservice'));
    }
    public function layChiTietPhongUser(Request $request)
    {
        $user = new RoomsModel;
        $contracts = new ContractsModel;
        $phonghd = new PhongThueModel;
        $service = new ServicesModel;
        $phongdv = new PhongDichVuModel;
        $phonghopdong = new PhongHopDongModel();
        $contractsinfo = '';
        $roomcontracts = $phonghd::where('id_phong', '=', $request->id)->get();
        $roomcontracts2 = $phongdv::where('id_phong', '=', $request->id)->get();
        $listphonguser = [];
        foreach ($roomcontracts2 as $k => $v) {
            array_push($listphonguser, $v->id_dichvu);
        }
        $listservice = $service::whereIn('id', $listphonguser)->get();
        $roomcontracts = $phonghd::where('id_phong', '=', $request->id)->first();

        $roomDetails = $user::find($request->id);
        $idhd = $phonghopdong::where('id_phong', '=', $roomDetails->id)->first();
        if (isset($idhd)) {
            $contractsinfo = $contracts::find($idhd->id_hopdong);
        }

        return view('templates.room.list-room-user', compact('roomDetails', 'contractsinfo', 'listservice', 'roomcontracts'));
    }
    public function thueNgay(Request $request)
    {
        $user = new RoomsModel;
        $contracts = new ContractsModel;
        $roomcontracts = $contracts::where([]);
        $roomDetails = $user::find($request->id);
        return view('templates.room.room_details', compact('roomDetails'));
    }

    public function vnPayPayment(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'max:255',
            'phone' => 'numeric',
            'email' => 'email',
        ]);
        if ($validator->fails()) {
            session()->flash('faile', 'Đặt phòng thất bại, vui lòng kiểm tra lại dữ liệu');
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $maDonVnPay = Str::random(30);
        $frstPrice = $request->giadatnhanh;
        $name = $request->name;
        $email = $request->email;
        $id = $request->id;
        $typepay = $request->typepay;
        $idusder = $request->iduser;
        $sdt = $request->sdt;
        error_reporting(E_ALL & ~E_NOTICE & ~E_DEPRECATED);
        date_default_timezone_set('Asia/Ho_Chi_Minh');
        $vnp_Url = "https://sandbox.vnpayment.vn/paymentv2/vpcpay.html";
        $vnp_Returnurl = "http://localhost/doantotnghiep/thanh-toan-dat-truoc" . '/' . $idusder  . '/' . $sdt . '/' . $name . '/' . $id . '/' . $email . '/' . $typepay;
        $vnp_TmnCode = '71N4PK0R';
        $vnp_HashSecret = "HEUYZNTLBYHRITTUPSLQHLSRMAUEDIGJ";
        $vnp_TxnRef = $maDonVnPay;
        $vnp_OrderInfo = 'Thanh toan dat coc cho phong ' . $name;
        $vnp_OrderType = 'billpayment';
        $vnp_Amount =  $frstPrice * 100;
        $vnp_Locale = 'vn';
        $vnp_BankCode = 'NCB';
        $vnp_IpAddr = $_SERVER['REMOTE_ADDR'];
        $vnp_Bill_Mobile = $sdt;
        $vnp_Inv_Phone = $sdt;
        $vnp_Inv_Customer = $name;
        $inputData = array(
            "vnp_Version" => "2.1.0",
            "vnp_TmnCode" => $vnp_TmnCode,
            "vnp_Amount" => $vnp_Amount,
            "vnp_Command" => "pay",
            "vnp_CreateDate" => date('YmdHis'),
            "vnp_CurrCode" => "VND",
            "vnp_IpAddr" => $vnp_IpAddr,
            "vnp_Locale" => $vnp_Locale,
            "vnp_OrderInfo" => $vnp_OrderInfo,
            "vnp_OrderType" => $vnp_OrderType,
            "vnp_ReturnUrl" => $vnp_Returnurl,
            "vnp_TxnRef" => $vnp_TxnRef,
            "vnp_Bill_Mobile" => $vnp_Bill_Mobile,
            "vnp_Inv_Phone" => $vnp_Inv_Phone,
            "vnp_Inv_Customer" => $vnp_Inv_Customer,
        );

        if (isset($vnp_BankCode) && $vnp_BankCode != "") {
            $inputData['vnp_BankCode'] = $vnp_BankCode;
        }
        if (isset($vnp_Bill_State) && $vnp_Bill_State != "") {
            $inputData['vnp_Bill_State'] = $vnp_Bill_State;
        }
        ksort($inputData);
        $query = "";
        $i = 0;
        $hashdata = "";
        foreach ($inputData as $key => $value) {
            if ($i == 1) {
                $hashdata .= '&' . urlencode($key) . "=" . urlencode($value);
            } else {
                $hashdata .= urlencode($key) . "=" . urlencode($value);
                $i = 1;
            }
            $query .= urlencode($key) . "=" . urlencode($value) . '&';
        }

        $vnp_Url = $vnp_Url . "?" . $query;
        if (isset($vnp_HashSecret)) {
            $vnpSecureHash =   hash_hmac('sha512', $hashdata, $vnp_HashSecret); //  
            $vnp_Url .= 'vnp_SecureHash=' . $vnpSecureHash;
        }
        $returnData = array(
            'code' => '00', 'message' => 'success', 'data' => $vnp_Url
        );
        if (isset($_POST['redirect'])) {
            header('Location: ' . $vnp_Url);
            die();
        } else {
            echo json_encode($returnData);
        }
    }

    public function returnVnPay(Request $request)
    {

        $rooms = new RoomsModel;
        $news = new UserModel;
        $phonghd = new PhongThueModel;
        $userid = '';
        $userid = $request->userid;
        $userinfo = $news::find($userid);
        $matrangthai = $request->vnp_ResponseCode;

        $sdt = $request->phone;
        $email = $request->email;
        $gia = $request->vnp_Amount;
        $code = $request->vnp_TxnRef;
        $noidung = $request->vnp_OrderInfo;
        $username = $request->name;
        if ($matrangthai == 0) {
            if (isset($request->typepay) && $request->typepay == 'thanh-toan') {
                $notify = 'Đặt phòng thành công';
                $lastnumbhd = 0;
                $lastitemhd = $phonghd::get()->sortBy('ordinal')->last();
                if ($lastitemhd != null) {
                    $lastnumbhd = (int)$lastitemhd->ordinal + 1;
                }
                $lastnumb = 0;
                $lastitem = Book::get()->sortBy('ordinal')->last();
                if ($lastitem != null) {
                    $lastnumb = (int)$lastitem->ordinal + 1;
                }
                $roominfo = $rooms->find($request->idphong);
                if (isset($roominfo)) {
                    $roominfo->status = 2;
                    $roominfo->save();
                }
                // Sửa trạng thái đơn đặt trước
                $pastBook = Book::where([['status', '=', 1], ['id_phong', '=', $roominfo->id]])->first();
                $phdBook = PhongThueModel::where([['status', '=', 1], ['id_phong', '=', $roominfo->id]])->first();
                if (!empty($pastBook)) {
                    $notify = 'Gia hạn phòng thành công';
                    $phdBook->status = 0;
                    $phdBook->save();
                    $phdBook->delete();
                    $pastBook->status = 0;
                    $pastBook->save();
                    $pastBook->delete();
                }
                // Lưu thông tin thanh toán vnpay
                $book = new Book;
                $book->namebook = $username;
                $book->phone = $sdt;
                $book->price = $gia;
                $book->email = $email;
                $book->content = $noidung;
                $book->ordinal = $lastnumb;
                $book->code = $code;
                $book->status = 1;
                $book->id_phong = $roominfo->id;
                $book->id_khachhang = $userid;
                $book->save();
                // Lưu hợp đồng
                $addphonghd = new PhongThueModel;
                $addphonghd->id_khachhang = $userid;
                $addphonghd->id_phong = $roominfo->id;
                $addphonghd->status = 1;
                $addphonghd->rental_start_date = Carbon::now();
                // $addphonghd->payday = Carbon::now();
                // $addphonghd->ordinal = $lastnumbhd;
                $addphonghd->save();
                if (isset($book)) {
                    $mailData = [
                        'title' => 'Xin chào' . $username,
                        'body' => 'Bạn đã thanh toán ' . $gia . ' cho phòng ' . $roominfo->name,
                        'email' => $email
                    ];
                    Mail::to($email)->send(new ThongBaoThanhToan($mailData));
                }
                session()->flash('success', $notify);
                return redirect()->route('index');
            } else {
                // Phòng đặt trước cho khách
                $notify = 'Đặt trước thành công';
                $lastnumb = 0;
                $lastitem = Book::get()->sortBy('ordinal')->last();
                if ($lastitem != null) {
                    $lastnumb = (int)$lastitem->ordinal + 1;
                }
                $roominfo = $rooms->find($request->idphong);
                if (isset($roominfo)) {
                    $roominfo->status = 4;
                    $roominfo->save();
                }
                // Lưu thông tin thanh toán vnpay
                $book = new Book;
                $book->namebook = $username;
                $book->id_khachhang = $userid;
                $book->phone = $sdt;
                $book->price = $gia / 100;
                $book->content = $noidung;
                $book->ordinal = $lastnumb;
                $book->email = $email;
                $book->code = $code;
                $book->status = 0;
                $book->id_phong = $roominfo->id;
                $book->id_khachhang = $userid;
                $book->save();
                if (isset($book)) {
                    $mailData = [
                        'title' => 'Xin chào ' . $username,
                        'body' => 'Bạn đã thanh toán ' . $gia . ' cho phòng ' . $roominfo->name,
                        'email' => $email
                    ];
                    Mail::to($request->email)->send(new ThongBaoThanhToan($mailData));
                }
                session()->flash('success', $notify);
                return redirect()->route('index');
            }
        } else {
            session()->flash('fail', 'Đặt trước thất bại');
            return redirect()->route('index');
        }
    }


    public function xoaPhongThue(Request $req)
    {
    }
}
