<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Admin\Functions;
use App\Http\Requests\SubmitRequest;
use App\Models\ContractsModel;
use App\Models\TermsModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;


class ContractsController extends Controller
{

    private function layHopDongHtml($list)
    {
        $data = '';
        if (count($list)) {
            foreach ($list as $k => $v) {
                $data .= '<tr data-id="' . $v['id'] . '">
                <td style="text-align: center;">' . $v['ordinal'] . '</td>
                <td>' . $v['name'] . '</td>
                <td><span class="text-split" style="-webkit-line-clamp:1">' . htmlspecialchars_decode($v['content']) . '</span></td>
                <td class="white-space">
            <button class="btn btn-success update-contract" data-bs-toggle="tooltip"
                data-bs-placement="top" data-bs-custom-class="custom-tooltip"
                data-bs-title="Sửa"><i class="fa-solid fa-pen-field"></i></button>
            <button class="btn btn-danger delete-contract" data-bs-toggle="tooltip"
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
    private function layMotHopDongHTML($term)
    {
        $data = '
        <td style="text-align: center;">' . $term['ordinal'] . '</td>
        <td>' . $term['name'] . '</td>
        <td><span class="text-split" style="-webkit-line-clamp:1">' . htmlspecialchars_decode($term['content']) . '</span></td>
        <td class="white-space">
    <button class="btn btn-success update-contract" data-bs-toggle="tooltip"
        data-bs-placement="top" data-bs-custom-class="custom-tooltip"
        data-bs-title="Sửa"><i class="fa-solid fa-pen-field"></i></button>
    <button class="btn btn-danger delete-contract" data-bs-toggle="tooltip"
        data-bs-placement="top" data-bs-custom-class="custom-tooltip"
        data-bs-title="Xóa"><i class="fa-regular fa-trash"></i></button>
        </td>';
        return $data;
    }

    public function layHopDong(Request $rq)
    {
        $contractslist = ContractsModel::get()->sortBy('ordinal', SORT_REGULAR, true)->skip(($rq->page - 1) * 10)->take(10);
        $terms = TermsModel::all();
        return view('admin.contracts.contract', compact('contractslist', 'terms'));
    }

    public function layHopDongTheoId(Request $rq)
    {
        $contract = ContractsModel::find($rq->id);
        $contract->content = htmlspecialchars_decode($contract->content);
        $contractcon = ContractsModel::find($rq->id)->terms->pluck('id')->toArray();
        $contract->id_dieukhoan = $contractcon;
        echo $contract;
    }

    public function pagination(Request $rq)
    {
        $contracts = ContractsModel::get();
        $contractslist = ContractsModel::get()->sortBy('ordinal', SORT_REGULAR, true)->skip(($rq->page - 1) * 10)->take(10);
        $data = Functions::initpagination('hop-dong', $rq->page, 10, $contracts, $contractslist);
        echo $data;
    }

    public function themHopDong(Request $rq)
    {
        $lastitem = ContractsModel::get()->sortBy('ordinal')->last();
        if ($lastitem != null) {
            $lastnumb = $lastitem->ordinal + 1;
        } else {
            $lastnumb = 0;
        }
        $contract = new ContractsModel;
        $contract->ordinal = $lastnumb;
        $contract->name = $rq->name;
        if ($rq->ckecontent != null) {
            $contract->content = htmlspecialchars($rq->ckecontent);
        } else {
            $contract->content = $rq->content;
        }
        if ($contract->save()) {
            $contract->terms()->sync($rq->dieukhoan);
            $contractlist = ContractsModel::get()->sortBy('ordinal', SORT_REGULAR, true)->skip(($rq->page - 1) * 10)->take(10);
            echo $this->layHopDongHtml($contractlist);
        }
    }
    public function suaHopDong(Request $rq)
    {
        $contract = ContractsModel::where('id', $rq->id)->get()->first();
        $contract->name = $rq->name;
        $contract->terms()->sync($rq->dieukhoan);
        if ($rq->ckecontent != null) {
            $contract->content = htmlspecialchars($rq->ckecontent);
        } else {
            $contract->content = $rq->content;
        }

        if ($contract->save()) {
            echo $this->layMotHopDongHTML($contract);
        }
    }
    public function xoaHopDong(Request $rq)
    {
        $contract = ContractsModel::where('id', $rq->id)->first();
        if ($contract != null) {
            $contract->delete();
        }
        $contractslist = ContractsModel::get()->sortBy('ordinal', SORT_REGULAR, true)->skip(($rq->page - 1) * 10)->take(10);
        echo $this->layHopDongHtml($contractslist);
    }
}
