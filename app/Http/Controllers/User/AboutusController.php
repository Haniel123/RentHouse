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
use App\Models\PhonThueModel;
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
use Illuminate\Auth\Events\PasswordReset;

class AboutusController extends Controller
{
    public function showNoiDung()
    {
        $baiviet = new BaiVietModel();
        $gioithieu = $baiviet->where('type', 'gioi-thieu')->first();

        return view('templates.layouts.vechungtoi', compact('gioithieu'));
    }
    public function showTinTuc()
    {
        $baiviet = new BaiVietModel();
        $news = $baiviet->where('type', 'tin-tuc')->get();
        return view('templates.layouts.news', compact('news'));
    }
    public function showTinTucChiTiet(Request $req)
    {
        $baiviet = new BaiVietModel();
        $news = $baiviet::find($req->id);
        return view('templates.layouts.newsdetails', compact('news'));
    }
    public function showLienHe()
    { 
        return view('templates.layouts.contact');
    }
}
