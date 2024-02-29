<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Admin\Functions;
use App\Http\Requests\SubmitRequest;
use App\Models\ThuModel;
use App\Models\TermsModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;


class ThuController extends Controller
{

    private function layThuHtml($list)
    {
        $data = '';
        if (count($list)) {
            foreach ($list as $k => $v) {
                $data .= '<tr data-id="' . $v['id'] . '">
                <td style="text-align: center;">' . $v['ordinal'] . '</td>
                <td>' . $v['name'] . '</td>
                <td>' . $v['namebook'] . '</td>
                <td>' . Functions::formatMoney($v['price']) . '</td>
                <td>' . $v['phone'] . '</td>
                <td>' . $v['email'] . '</td>
                <td>' . $v['code'] . '</td>
                <td style="text-wrap: balance;"><div class="text-split" style="-webkit-line-clamp:1">' . html_entity_decode($v['content']) . '</div></td>
                <td class="white-space">
            <button class="btn btn-success update-thu" data-bs-toggle="tooltip"
                data-bs-placement="top" data-bs-custom-class="custom-tooltip"
                data-bs-title="Sửa"><i class="fa-solid fa-pen-field"></i></button>
            <button class="btn btn-danger delete-thu" data-bs-toggle="tooltip"
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
    private function layMotThuHtml($thu)
    {
        $data = '
        <td style="text-align: center;">' . $thu['ordinal'] . '</td>
        <td>' . $thu['name'] . '</td>
        <td>' . $thu['namebook'] . '</td>
        <td>' . Functions::formatMoney($thu['price']) . '</td>
        <td>' . $thu['phone'] . '</td>
        <td>' . $thu['email'] . '</td>
        <td>' . $thu['code'] . '</td>
        <td style="text-wrap: balance;"><span class="text-split" style="-webkit-line-clamp:1">' . html_entity_decode($thu['content']) . '</span></td>
        <td class="white-space">
    <button class="btn btn-success update-thu" data-bs-toggle="tooltip"
        data-bs-placement="top" data-bs-custom-class="custom-tooltip"
        data-bs-title="Sửa"><i class="fa-solid fa-pen-field"></i></button>
    <button class="btn btn-danger delete-thu" data-bs-toggle="tooltip"
        data-bs-placement="top" data-bs-custom-class="custom-tooltip"
        data-bs-title="Xóa"><i class="fa-regular fa-trash"></i></button>
        </td>';
        return $data;
    }

    public function layThu(Request $rq)
    {
        $thuslist = ThuModel::get()->sortBy('ordinal', SORT_REGULAR, true)->skip(($rq->page - 1) * 10)->take(10);
        return view('admin.thu.thu', compact('thuslist'));
    }

    public function layThuTheoId(Request $rq)
    {
        $thu = ThuModel::find($rq->id);
        echo $thu;
    }

    public function thuPagination(Request $rq)
    {
        $thus = ThuModel::get();
        $thuslist = ThuModel::get()->sortBy('ordinal', SORT_REGULAR, true)->skip(($rq->page - 1) * 10)->take(10);
        $data = Functions::initpagination('thu', $rq->page, 10, $thus, $thuslist);
        echo $data;
    }

    public function themThu(Request $rq)
    {
        $lastitem = ThuModel::get()->sortBy('ordinal')->last();
        if ($lastitem != null) {
            $lastnumb = $lastitem->ordinal + 1;
        } else {
            $lastnumb = 0;
        }
        $thu = new ThuModel;
        $thu->ordinal = $lastnumb;
        $thu->name = $rq->name;
        $thu->price = $rq->price;
        $thu->content = $rq->content;
        if ($thu->save()) {
            $thulist = ThuModel::get()->sortBy('ordinal', SORT_REGULAR, true)->skip(($rq->page - 1) * 10)->take(10);
            echo $this->layThuHtml($thulist);
        }
    }
    public function suaThu(Request $rq)
    {
        $thu = ThuModel::where('id', $rq->id)->get()->first();
        $thu->name = $rq->name;
        $thu->price = $rq->price;
        $thu->content = $rq->content;

        if ($thu->save()) {
            echo $this->layMotThuHtml($thu);
        }
    }
    public function xoaHopDong(Request $rq)
    {
        $thu = ThuModel::where('id', $rq->id)->first();
        if ($thu != null) {
            $thu->delete();
        }
        $thuslist = ThuModel::get()->sortBy('ordinal', SORT_REGULAR, true)->skip(($rq->page - 1) * 10)->take(10);
        echo $this->layThuHtml($thuslist);
    }
}
