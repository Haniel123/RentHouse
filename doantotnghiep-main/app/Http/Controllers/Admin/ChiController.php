<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Admin\Functions;
use App\Http\Requests\SubmitRequest;
use App\Models\ChiModel;
use App\Models\TermsModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;


class ChiController extends Controller
{

    private function layChiHtml($list)
    {
        $data = '';
        if (count($list)) {
            foreach ($list as $k => $v) {
                $data .= '<tr data-id="' . $v['id'] . '">
                <td style="text-align: center;">' . $v['ordinal'] . '</td>
                <td>' . $v['name'] . '</td>
                <td>' . Functions::formatMoney($v['price']) . '</td>
                <td style="text-wrap: balance;"><div class="text-split" style="-webkit-line-clamp:1">' . $v['content'] . '</div></td>
                <td class="white-space">
            <button class="btn btn-success update-chi" data-bs-toggle="tooltip"
                data-bs-placement="top" data-bs-custom-class="custom-tooltip"
                data-bs-title="Sửa"><i class="fa-solid fa-pen-field"></i></button>
            <button class="btn btn-danger delete-chi" data-bs-toggle="tooltip"
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
    private function layMotChiHTML($chi)
    {
        $data = '
        <td style="text-align: center;">' . $chi['ordinal'] . '</td>
        <td>' . $chi['name'] . '</td>
        <td>' . Functions::formatMoney($chi['price'])  . '</td>
        <td style="text-wrap: balance;"><div class="text-split" style="-webkit-line-clamp:1">' . $chi['content'] . '</div></td>
        <td class="white-space">
    <button class="btn btn-success update-chi" data-bs-toggle="tooltip"
        data-bs-placement="top" data-bs-custom-class="custom-tooltip"
        data-bs-title="Sửa"><i class="fa-solid fa-pen-field"></i></button>
    <button class="btn btn-danger delete-chi" data-bs-toggle="tooltip"
        data-bs-placement="top" data-bs-custom-class="custom-tooltip"
        data-bs-title="Xóa"><i class="fa-regular fa-trash"></i></button>
        </td>';
        return $data;
    }

    public function layChi(Request $rq)
    {
        $chislist = ChiModel::get()->sortBy('ordinal', SORT_REGULAR, true)->skip(($rq->page - 1) * 10)->take(10);
        return view('admin.chi.chi', compact('chislist'));
    }

    public function layChiTheoId(Request $rq)
    {
        $chi = ChiModel::find($rq->id);
        echo $chi;
    }

    public function pagination(Request $rq)
    {
        $chis = ChiModel::get();
        $chislist = ChiModel::get()->sortBy('ordinal', SORT_REGULAR, true)->skip(($rq->page - 1) * 10)->take(10);
        $data = Functions::initpagination('chi', $rq->page, 10, $chis, $chislist);
        echo $data;
    }

    public function themChi(Request $rq)
    {
        $lastitem = ChiModel::get()->sortBy('ordinal')->last();
        if ($lastitem != null) {
            $lastnumb = $lastitem->ordinal + 1;
        } else {
            $lastnumb = 0;
        }
        $chi = new ChiModel;
        $chi->ordinal = $lastnumb;
        $chi->name = $rq->name;
        $chi->price = $rq->price;
        $chi->content = $rq->content;
        if ($chi->save()) {
            $chislist = ChiModel::get()->sortBy('ordinal', SORT_REGULAR, true)->skip(($rq->page - 1) * 10)->take(10);
            echo $this->layChiHtml($chislist);
        }
    }
    public function suaChi(Request $rq)
    {
        $chi = ChiModel::where('id', $rq->id)->get()->first();
        $chi->name = $rq->name;
        $chi->price = $rq->price;
        $chi->content = $rq->content;

        if ($chi->save()) {
            echo $this->layMotChiHTML($chi);
        }
    }
    public function xoaChi(Request $rq)
    {
        $chi = ChiModel::where('id', $rq->id)->first();
        if ($chi != null) {
            $chi->delete();
        }
        $chislist = ChiModel::get()->sortBy('ordinal', SORT_REGULAR, true)->skip(($rq->page - 1) * 10)->take(10);
        echo $this->layChiHtml($chislist);
    }
}
