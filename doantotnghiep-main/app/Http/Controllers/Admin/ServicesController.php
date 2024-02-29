<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ServicesModel;
use Illuminate\Http\Request;

class ServicesController extends Controller
{
    private function layDichVuHtml($list)
    {
        $data = '';
        if (count($list)) {
            foreach ($list as $k => $v) {
                $data .= '<tr data-id="' . $v['id'] . '">
                <td style="text-align: center;">' . $v['ordinal'] . '</td>
                <td>' . $v['name'] . '</td>
                <td>' . Functions::formatMoney($v['price']) . '</td>
                <td class="white-space">
            <button class="btn btn-success update-service" data-bs-toggle="tooltip"
                data-bs-placement="top" data-bs-custom-class="custom-tooltip"
                data-bs-title="Sửa"><i class="fa-solid fa-pen-field"></i></button>
            <button class="btn btn-danger delete-service" data-bs-toggle="tooltip"
                data-bs-placement="top" data-bs-custom-class="custom-tooltip"
                data-bs-title="Xóa"><i class="fa-regular fa-trash"></i></button>
                </td>
            </tr>';
            }
        } else {
            $data .= '<tr>
                        <td colspan="11" class="text-center">Không có dữ liệu</td>
                      </tr>';
        }
        return $data;
    }
    private function layMotDichVuHTML($term)
    {
        $data = '
        <td style="text-align: center;">' . $term['ordinal'] . '</td>
        <td>' . $term['name'] . '</td>
        <td>' . Functions::formatMoney($term['price']) . '</td>
        <td class="white-space">
    <button class="btn btn-success update-service" data-bs-toggle="tooltip"
        data-bs-placement="top" data-bs-custom-class="custom-tooltip"
        data-bs-title="Sửa"><i class="fa-solid fa-pen-field"></i></button>
    <button class="btn btn-danger delete-service" data-bs-toggle="tooltip"
        data-bs-placement="top" data-bs-custom-class="custom-tooltip"
        data-bs-title="Xóa"><i class="fa-regular fa-trash"></i></button>
        </td>';
        return $data;
    }

    public function layDichVu(Request $rq)
    {
        $serviceslist = ServicesModel::get()->sortBy('ordinal', SORT_REGULAR, true)->skip(($rq->page - 1) * 10)->take(10);
        return view('admin.services.service', compact('serviceslist'));
    }

    public function layDichVuTheoId(Request $rq)
    {
        $service = ServicesModel::find($rq->id);
        echo $service;
    }

    public function pagination(Request $rq)
    {
        $services = ServicesModel::get();
        $serviceslist = ServicesModel::get()->sortBy('ordinal', SORT_REGULAR, true)->skip(($rq->page - 1) * 10)->take(10);
        $data = Functions::initpagination('dich-vu', $rq->page, 10, $services, $serviceslist);
        echo $data;
    }

    public function themDichVu(Request $rq)
    {
        $lastitem = ServicesModel::get()->sortBy('ordinal')->last();
        if ($lastitem != null) {
            $lastnumb = $lastitem->ordinal + 1;
        } else {
            $lastnumb = 0;
        }
        $service = new ServicesModel;
        $service->ordinal = $lastnumb;
        $service->name = $rq->name;
        $service->price = $rq->price;
        if ($service->save()) {
            $servicelist = ServicesModel::get()->sortBy('ordinal', SORT_REGULAR, true)->skip(($rq->page - 1) * 10)->take(10);
            echo $this->layDichVuHtml($servicelist);
        }
    }
    public function suaDichVu(Request $rq)
    {
        $service = ServicesModel::where('id', $rq->id)->get()->first();
        $service->name = $rq->name;
        $service->price = $rq->price;
        if ($service->save()) {
            echo $this->layMotDichVuHTML($service);
        }
    }
    public function xoaDichVu(Request $rq)
    {
        $service = ServicesModel::where('id', $rq->id)->first();
        if ($service != null) {
            $service->delete();
        }
        $serviceslist = ServicesModel::get()->sortBy('ordinal', SORT_REGULAR, true)->skip(($rq->page - 1) * 10)->take(10);
        echo $this->layDichVuHtml($serviceslist);
    }
}
