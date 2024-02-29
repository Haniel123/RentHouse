<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\TermsModel;
use Illuminate\Http\Request;

class TermsController extends Controller
{
    private function layDieuKhoanHtml($list)
    {
        $data = '';
        if (count($list)) {
            foreach ($list as $k => $v) {
                $data .= '<tr data-id="' . $v['id'] . '">
                <td style="text-align: center;">' . $v['ordinal'] . '</td>
                <td>' . $v['name'] . '</td>
                <td><span class="text-split" style="-webkit-line-clamp:1">' . html_entity_decode($v['content']) . '</span></td>
                <td class="white-space">
            <button class="btn btn-success update-term" data-bs-toggle="tooltip"
                data-bs-placement="top" data-bs-custom-class="custom-tooltip"
                data-bs-title="Sửa"><i class="fa-solid fa-pen-field"></i></button>
            <button class="btn btn-danger delete-term" data-bs-toggle="tooltip"
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
    private function layMotDieuKhoanHTML($term)
    {
        $data = '
        <td style="text-align: center;">' . $term['ordinal'] . '</td>
        <td>' . $term['name'] . '</td>
        <td><span class="text-split" style="-webkit-line-clamp:1">' . html_entity_decode($term['content']) . '</span></td>
        <td class="white-space">
    <button class="btn btn-success update-term" data-bs-toggle="tooltip"
        data-bs-placement="top" data-bs-custom-class="custom-tooltip"
        data-bs-title="Sửa"><i class="fa-solid fa-pen-field"></i></button>
    <button class="btn btn-danger delete-term" data-bs-toggle="tooltip"
        data-bs-placement="top" data-bs-custom-class="custom-tooltip"
        data-bs-title="Xóa"><i class="fa-regular fa-trash"></i></button>
        </td>';
        return $data;
    }

    public function layDieuKhoan(Request $rq)
    {
        $termslist = TermsModel::get()->sortBy('ordinal', SORT_REGULAR, true)->skip(($rq->page - 1) * 10)->take(10);
        return view('admin.terms.term', compact('termslist'));
    }

    public function layDieuKhoanTheoId(Request $rq)
    {
        $term = TermsModel::find($rq->id);
        $term->content = htmlspecialchars_decode($term->content);
        echo $term;
    }

    public function pagination(Request $rq)
    {
        $terms = TermsModel::get();
        $termslist = TermsModel::get()->sortBy('ordinal', SORT_REGULAR, true)->skip(($rq->page - 1) * 10)->take(10);
        $data = Functions::initpagination('dieu-khoan', $rq->page, 10, $terms, $termslist);
        echo $data;
    }

    public function themDieuKhoan(Request $rq)
    {
        $lastitem = TermsModel::get()->sortBy('ordinal')->last();
        if ($lastitem != null) {
            $lastnumb = $lastitem->ordinal + 1;
        } else {
            $lastnumb = 0;
        }
        $term = new TermsModel;
        $term->ordinal = $lastnumb;
        $term->name = $rq->name;
        if ($rq->ckecontent != null) {
            $term->content = htmlspecialchars_decode($rq->ckecontent);
        } else {
            $term->content = $rq->content;
        }
        if ($term->save()) {
            $termlist = TermsModel::get()->sortBy('ordinal', SORT_REGULAR, true)->skip(($rq->page - 1) * 10)->take(10);
            echo $this->layDieuKhoanHtml($termlist);
        }
    }
    public function suaDieuKhoan(Request $rq)
    {
        $term = TermsModel::where('id', $rq->id)->get()->first();
        $term->name = $rq->name;
        if ($rq->ckecontent != null) {
            $term->content = htmlspecialchars_decode($rq->ckecontent);
        } else {
            $term->content = $rq->content;
        }

        if ($term->save()) {
            echo $this->layMotDieuKhoanHTML($term);
        }
    }
    public function xoaDieuKhoan(Request $rq)
    {
        $term = TermsModel::where('id', $rq->id)->first();
        if ($term != null) {
            $term->delete();
        }
        $termslist = TermsModel::get()->sortBy('ordinal', SORT_REGULAR, true)->skip(($rq->page - 1) * 10)->take(10);
        echo $this->layDieuKhoanHtml($termslist);
    }
}
