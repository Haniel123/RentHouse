<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Models\UserModel;
use App\Models\Book;
use App\Models\ReportModel;
use App\Models\RoomsModel;
use App\Models\PhongThueModel;
use App\Models\PhongHopDongModel;
use Illuminate\Support\Facades\DB;

class UserDetailController extends Controller
{
    public function userinfo(Request $request)
    {
        $phonghd = new PhongThueModel;
        $book = new  Book;
        $room = new  RoomsModel;
        $iduser = Auth::guard('user')->user()->id;
        $emailuser = Auth::guard('user')->user()->email;
        // Lấy danh sách phòng đặt trước
        $phongdt =  $book::where([['status', '=', 0],['id_khachhang', '=', $iduser]])->get();
    
        // Lấy danh sách phòng đang thuê
        $phonguser = $phonghd::where([['id_khachhang', '=', $iduser]])->get();
        $arridroom = array();
        $arridroomdt = array();
        $listphonguser = [];
        $listphonguserdt = [];
        foreach ($phonguser as $k => $v) {
            array_push($arridroom, $v->id_phong);
        }
        foreach ($phongdt as $k => $v) {
            array_push($arridroomdt, $v->id_phong);
        }
        $listphonguser = $room::whereIn('id', $arridroom)->get();
        $listphonguserdt = $room::whereIn('id', $arridroomdt)->get();
        return view('templates.user.user_info', compact('listphonguser', 'listphonguserdt'));
    }

    public function suaThongTinUser(Request $request)
    {
        $news = new UserModel;
        $user = $news::find($request->id);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->address = $request->address;
        $user->birthday = $request->birthday;
        $user->save();
        return redirect('user/thong-tin-nguoi-dung');
    }

    public function phanHoiPhong(Request $request)
    {
        $report = new ReportModel;
        $lastnumb = null;
        $lastitem = ReportModel::get()->sortBy('ordinal')->last();
        if ($lastitem != null) {
            $lastnumb = (int)$lastitem->ordinal + 1;
        } else {
            $lastnumb = 0;
        }
        $report->ordinal = $lastnumb;
        $report->id_phong = $request->idphongreportt;
        $report->id_khachhang = $request->iduserreport;
        $report->content = $request->noidungreport;
        $report->type = 'phan-hoi';
        $report->status = 0;
        $report->save();
        session()->flash('success', 'Phản hồi thành công !');
        return redirect()->back();
    }
    public function phanHuyPhong (Request $request)
    {
        $report = new ReportModel;
        $lastnumb = null;
        $lastitem = ReportModel::get()->sortBy('ordinal')->last();
        if ($lastitem != null) {
            $lastnumb = (int)$lastitem->ordinal + 1;
        } else {
            $lastnumb = 0;
        }
        $report->ordinal = $lastnumb;
        $report->id_phong = $request->idphongreportt;
        $report->id_khachhang = $request->iduserreport;
        $report->content = 'Yêu cầu huỷ phòng';
        $report->status = 0;
        $report->type = 'huy-phong';
        $report->save();
        session()->flash('success', 'Gửi yêu cầu huỷ thành công !');
        return redirect()->back();
    }
    
}
