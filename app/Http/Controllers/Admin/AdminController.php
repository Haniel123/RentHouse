<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Admin\Functions;
use App\Http\Controllers\Controller;
use App\Models\ChiModel;
use App\Models\RoomsModel;
use App\Models\ThuModel;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function index()
    {
        if (Auth::guard('admin')->check()) {
            $array['room'] = count(RoomsModel::get());
            $array['hoatdong'] = count(RoomsModel::where('status', '1')->get());
            $array['dathue'] = count(RoomsModel::where('status', '2')->get());
            $array['dangthue'] = count(RoomsModel::where('status', '3')->get());
            $array['baotri'] = count(RoomsModel::where('status', '4')->get());
            $array['dattruoc'] = count(RoomsModel::where('status', '5')->get());
            $array['thu'] = ThuModel::whereYear('created_at', date('Y'))->whereMonth('created_at', date('m'))->sum('price');
            $array['chi'] = ChiModel::whereYear('created_at', date('Y'))->whereMonth('created_at', date('m'))->sum('price');


            $array['thuprev'] = ThuModel::whereYear('created_at', date('Y'))->whereMonth('created_at', (date('m') - 1))->sum('price');
            $array['chiprev'] = ChiModel::whereYear('created_at', date('Y'))->whereMonth('created_at', (date('m') - 1))->sum('price');
            if ($array['chiprev'] != 0) {
                $array['chiper'] = round(($array['chi'] - $array['chiprev']) / $array['chiprev'] * 100, 0);
            } else if ($array['chi'] != 0) {
                $array['chiper'] = 100;
            } else {
                $array['chiper'] = 0;
            }

            if ($array['thuprev'] != 0) {
                $array['thuper'] = round(($array['thu'] - $array['thuprev']) / $array['thuprev'] * 100, 0);
            } else if ($array['thu'] != 0) {
                $array['thuper'] = 100;
            } else {
                $array['thuper'] = 0;
            }

            $array['doanhthu'] = $array['thu'] - $array['chi'];
            $array['doanhthuprev'] = $array['thuprev'] - $array['chiprev'];
            if ($array['doanhthuprev'] != 0) {
                $array['doanhthuper'] = round(($array['doanhthu'] - $array['doanhthuprev']) / $array['doanhthuprev'] * 100, 0);
            } else if ($array['doanhthu'] != 0) {
                $array['doanhthuper'] = 100;
            } else {
                $array['doanhthuper'] = 0;
            }

            $array['doanhthu'] = Functions::formatMoney($array['doanhthu']);
            $array['doanhthuprev'] = Functions::formatMoney($array['doanhthuprev']);
            $array['thu'] = Functions::formatMoney($array['thu']);
            $array['chi'] = Functions::formatMoney($array['chi']);
            $array['thuprev'] = Functions::formatMoney($array['thuprev']);
            $array['chiprev'] = Functions::formatMoney($array['chiprev']);
            $thongkethu = [];
            $thongkechi = [];
            $thongkedoanhthu = [];
            for ($i = 0; $i < date('m'); $i++) {
                array_push($thongkethu, (int)ThuModel::whereYear('created_at', date('Y'))->whereMonth('created_at', $i + 1)->sum('price'));
                array_push($thongkechi, (int)ChiModel::whereYear('created_at', date('Y'))->whereMonth('created_at', $i + 1)->sum('price'));
                array_push($thongkedoanhthu, ((int)ThuModel::whereYear('created_at', date('Y'))->whereMonth('created_at', $i + 1)->sum('price') - (int)ChiModel::whereYear('created_at', date('Y'))->whereMonth('created_at', $i + 1)->sum('price')));
            }
            $array['thongkethu'] = json_encode(array_values($thongkethu));
            $array['thongkechi'] = json_encode(array_values($thongkechi));
            $array['thongkedoanhthu'] = json_encode(array_values($thongkedoanhthu));
            return view('admin.index.index', compact('array'));
        }
    }
    public function login(Request $request)
    {
        if ($request->getMethod() == 'GET') {
            if (!Auth::guard('admin')->check()) {
                return view('admin.auth.login');
            } else {
                return redirect()->route('admin.index');
            }
        }
        if (Auth::guard('admin')->attempt($request->only(['username', 'password']))) {
            return redirect()->route('admin.index');
        } else {
            return redirect()->back()->withInput();
        }
    }
    public function logout(Request $request): RedirectResponse
    {
        if (Auth::guard('admin')->check()) // this means that the admin was logged in.
        {
            Auth::guard('admin')->logout();
            return redirect()->route('admin.login');
        }
        return redirect()->route('admin');
    }
}
