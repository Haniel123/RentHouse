<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UserModel;
use App\Models\RoomsModel;
use App\Models\PhongThueModel;
use App\Models\PhongHopDongModel;
use App\Models\PhongDichVuModel;
use App\Models\Book;
use App\Models\HopDongDieuKhoanModel;
use App\Models\DieuKhoanModel;
use App\Models\ServicesModel;
use Carbon\Carbon;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function formatMoney($price = 0, $unit = 'đ', $html = false)
    {
        $str = '';
        if ($price) {
            $str .= number_format($price, 0, ',', '.');
            if ($unit != '') {
                if ($html) {
                    $str .= '<span>' . $unit . '</span>';
                } else {
                    $str .= $unit;
                }
            }
        }
        return $str;
    }
    public function formatLinkRoom($id = '', $imgName = '')
    {
        $url = 'public/uploads/room/';
        $url .= $id;
        $url .= '/' . $imgName;
        return $url;
    }
    public function formatLinkNews($id = '', $imgName = '')
    {
        $url = 'public/uploads/news/tintuc/';
        $url .= $id;
        $url .= '/' . $imgName;
        return $url;
    }


    public function formatDate($date = '')
    {
        $newdate = Carbon::parse($date)->format('d-m-Y');
        return $newdate;
    }

    public function formatStatusRoom($id = '')
    {
        switch ($id) {
            case 0:
                return 'Trễ hạn';
                break;
            case 1:
                return 'Còn trống';
                break;
            case 2:
                return 'Đang thuê';
                break;
            case 3:
                return 'Bảo trì';
                break;
            case 4:
                return 'Đặt trước';
                break;
        }
    }

    public function layThongTinHopDongTheoIdPhong($id = '')
    {
        $phonghd = new PhongThueModel;
        $phonghdinfo = $phonghd::where('id_phong', '=', $id)->first();
        return $phonghdinfo;
    }
    public function layThongTinPhong($id = '')
    {
        $phonghd = new RoomsModel;
        $phonghdinfo = $phonghd::find($id);
        return $phonghdinfo;
    }
    public function layThongTinUser($id = '')
    {
        $phonghd = new UserModel;
        $phonghdinfo = $phonghd::find($id);
        return $phonghdinfo;
    }
    public function layHDDieuKhoan($id = '')
    {
        $phonghd = new HopDongDieuKhoanModel();
        $phonghdinfo = $phonghd::where('id_hopdong', '=', $id)->get();
       
        return $phonghdinfo;
    }
    public function layDieuKhoan($id = '')
    {
        $phonghda = new DieuKhoanModel();
        $phonghdinfo = $phonghda::find($id);
      
        return $phonghdinfo;
    }
    public function layThongTinDatTruoc($id = '', $iduser = '')
    {
        $phonghd = new Book;
        $phonghdinfo = $phonghd::where([['id_phong', '=', $id], ['id_khachhang', '=', $iduser]])->first();
        return $phonghdinfo;
    }

    public function tinhNgayThanhToanTiepTheo($idroom = '', $iduser = '')
    {
        $carbon = Carbon::now();
        $arrNgayThanhToan = [];
        $phonghd = new PhongThueModel;
        $roominfo =  RoomsModel::find($idroom);
        $payday = $roominfo->payday;

        $phonghdinfo = $phonghd::where([['id_phong', '=', $idroom], ['id_khachhang', '=', $iduser]])->orderBy('rental_start_date', 'desc')->first();
        if (isset($phonghdinfo)) {
            $ngayThanhToanGan = Carbon::parse($phonghdinfo->rental_start_date);
            $addThang = $ngayThanhToanGan->addMonth();
            $thangThanhToanTiepTheo = $addThang->month;

            $namThanhToanTiepTheo = $addThang->year;
            $ngayThanhToanTiepTheoParse = $carbon->create($namThanhToanTiepTheo, $thangThanhToanTiepTheo, $payday)->format('d-m-Y');
            $ngayThanhToanHienTai = $phonghdinfo->rental_start_date;
            $soNgayConLai = Carbon::now()->diffInDays($carbon->create($namThanhToanTiepTheo, $thangThanhToanTiepTheo, $payday), false);
            $arrNgayThanhToan['songayconlai'] =   $soNgayConLai;
            $arrNgayThanhToan['ngaythanhtoangannhat'] =  $ngayThanhToanHienTai;
            $arrNgayThanhToan['ngaythanhtoantieptheo'] = $ngayThanhToanTiepTheoParse;
            return $arrNgayThanhToan;
        } else {
            return null;
        }
    }
    public function tongTienthanhToanLanDau($idroom = '')
    {

        $room =  new RoomsModel;
        $phongDv = new PhongDichVuModel;
        $service =  new ServicesModel;
        $allPrice = 0;
        $listService = $phongDv->where('id_phong', $idroom)->get();
        if ($idroom != '') {
            $getRoom = $room->find($idroom);
            if (isset($getRoom->price)) {
                $allPrice = $getRoom->price;
                if (count($listService)) {
                    foreach ($listService as $ser) {
                        $serviceInfo = $service::find($ser->id_dichvu);
                        $allPrice += $serviceInfo->price;
                    }
                }
                if ($getRoom->deposittime != null) {
                    $allPrice  = $allPrice;
                }
            }
        }
        return $allPrice;
    }

    public function tongTienthanhToan($idroom = '')
    {
        $room =  new RoomsModel;
        $phongDv = new PhongDichVuModel;
        $service =  new ServicesModel;
        $allPrice = 0;
        $listService = $phongDv->where('id_phong', $idroom)->get();
        if ($idroom != null) {
            $getRoom = $room->find($idroom);
            $allPrice = $getRoom->price;
            if (count($listService)) {
                foreach ($listService as $ser) {
                    $serviceInfo = $service::find($ser->id_dichvu);
                    $allPrice += $serviceInfo->price;
                }
            }
        }
        return $allPrice;
    }
}
