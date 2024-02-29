<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BaivietModel;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    public function layGioithieu(Request $rq)
    {
        $gioithieu = BaivietModel::where('type', 'gioi-thieu')->first();
        if ($gioithieu == null) {
            $gioithieu = new BaivietModel();
            return view('admin.intro.intro', compact('gioithieu'));
        } else {
            $gioithieu->get();
            return view('admin.intro.intro', compact('gioithieu'));
        }
    }
    public function suaGioithieu(Request $rq)
    {
        $gioithieu = BaivietModel::where('type', 'gioi-thieu')->first();
        if ($gioithieu == null) {
            $gt = new BaivietModel();
            $gt->ordinal = 0;
            $gt->name = $rq->name;
            $gt->desc = htmlspecialchars($rq->ckedesc);
            $gt->content = htmlspecialchars($rq->ckecontent);
            $gt->type = 'gioi-thieu';
            if ($rq->hasFile('photo')) {
                $date = getdate();
                $stringdate = $date['hours'] . $date['minutes'] . $date['seconds'] . $date['mday'] . $date['mon'] . $date['year'];
                $file = $rq->file('photo');
                $name = $file->getClientOriginalName();

                $suffix = explode('.', $name);
                $explain =  $stringdate . "." . $suffix[1];
                $file->move(public_path('uploads') . '/news/gioithieu/', $explain);
                $gt->photo = $explain;
            }
        } else {
            $gt = $gioithieu;
            $gt->name = $rq->name;
            $gt->desc = htmlspecialchars($rq->ckedesc);
            $gt->content = htmlspecialchars($rq->ckecontent);
            if ($gioithieu->photo != '' && $gioithieu->photo != null) {
                if ($rq->hasFile('photo')) {
                    unlink(public_path('uploads' . "\\news\\gioithieu\\" . $gt->photo));
                    $date = getdate();
                    $stringdate = $date['hours'] . $date['minutes'] . $date['seconds'] . $date['mday'] . $date['mon'] . $date['year'];
                    $file = $rq->file('photo');
                    $name = $file->getClientOriginalName();

                    $suffix = explode('.', $name);
                    $explain =  $stringdate . "." . $suffix[1];
                    $file->move(public_path('uploads') . '/news/gioithieu/', $explain);
                    $gt->photo = $explain;
                }
            } else {
                $date = getdate();
                $stringdate = $date['hours'] . $date['minutes'] . $date['seconds'] . $date['mday'] . $date['mon'] . $date['year'];
                $file = $rq->file('photo');
                $name = $file->getClientOriginalName();

                $suffix = explode('.', $name);
                $explain =  $stringdate . "." . $suffix[1];
                $file->move(public_path('uploads') . '/news/gioithieu/', $explain);
                $gt->photo = $explain;
            }
        }
        if ($gt->save()) {
            echo 1;
        };
    }

    private function layTintucHtml($list)
    {
        $data = '';
        if (count($list)) {
            foreach ($list as $k => $v) {
                $data .= '<tr data-id="' . $v['id'] . '">
                <td style="text-align: center;">' . $v['ordinal'] . '</td>
                <td>';
                if ($v['photo'] != null && $v['photo'] != '') {
                    $data .= '<div class="pic m-auto" style="max-width: 50%"><img style="width:100%;aspect-ratio: 1/1;object-fit: cover;" src="../public/uploads/news/tintuc/' . $v['id'] . '/' . $v['photo'] . '" alt=""></div>';
                } else {
                    $data .= '<div class="pic m-auto" style="max-width: 50%"><img style="width:100%;aspect-ratio: 1/1;object-fit: cover;"
                                                            src="../public/assets/images/noimage.png" alt=""></div>';
                }
                $data .= '</td>
                <td> <span class="text-split">' . $v['name'] . '</span> </td>
                <td> <span class="text-split">' . htmlspecialchars_decode($v['desc']) . '</span> </td>
                <td> <span class="text-split">' . htmlspecialchars_decode($v['content']) . '</span> </td>
                <td class="white-space">
            <button class="btn btn-success update-news" data-bs-toggle="tooltip"
                data-bs-placement="top" data-bs-custom-class="custom-tooltip"
                data-bs-title="Sửa"><i class="fa-solid fa-pen-field"></i></button>
            <button class="btn btn-danger delete-news" data-bs-toggle="tooltip"
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
    private function layMotTintucHTML($baiviet)
    {
        $data = '
        <td style="text-align: center;">' . $baiviet['ordinal'] . '</td>
        <td>';
        if ($baiviet['photo'] != null && $baiviet['photo'] != '') {
            $data .= '<div class="pic m-auto" style="max-width: 50%"><img style="width:100%;aspect-ratio: 1/1;object-fit: cover;" src="../public/uploads/news/tintuc/' . $baiviet['id'] . '/' . $baiviet['photo'] . '" alt=""></div>';
        } else {
            $data .= '<div class="pic m-auto" style="max-width: 50%"><img style="width:100%;aspect-ratio: 1/1;object-fit: cover;"
                                                    src="../public/assets/images/noimage.png" alt=""></div>';
        }
        $data .= '</td>
        <td><span class="text-split">' . $baiviet['name'] . '</span></td>
        <td><span class="text-split">' . htmlspecialchars_decode($baiviet['desc']) . '</span></td>
        <td><span class="text-split">' . htmlspecialchars_decode($baiviet['content']) . '</span></td>
        <td class="white-space">
    <button class="btn btn-success update-news" data-bs-toggle="tooltip"
        data-bs-placement="top" data-bs-custom-class="custom-tooltip"
        data-bs-title="Sửa"><i class="fa-solid fa-pen-field"></i></button>
    <button class="btn btn-danger delete-news" data-bs-toggle="tooltip"
        data-bs-placement="top" data-bs-custom-class="custom-tooltip"
        data-bs-title="Xóa"><i class="fa-regular fa-trash"></i></button>
        </td>';
        return $data;
    }

    public function layTintuc(Request $rq)
    {
        $newslist = BaivietModel::where('type', 'tin-tuc')->skip(($rq->page - 1) * 10)->take(10)->latest()->get();
        return view('admin.news.news', compact('newslist'));
    }

    public function layTintucTheoId(Request $rq)
    {
        $tintuc = BaivietModel::find($rq->id);
        $tintuc->desc = htmlspecialchars_decode($tintuc->desc);
        $tintuc->content = htmlspecialchars_decode($tintuc->content);
        echo $tintuc;
    }

    public function tintucPagination(Request $rq)
    {
        $Baiviets = BaivietModel::where('type', 'tin-tuc')->get();
        $newslist = BaivietModel::where('type', 'tin-tuc')->skip(($rq->page - 1) * 10)->take(10)->latest()->get();
        $data = Functions::initpagination('tin-tuc', $rq->page, 10, $Baiviets, $newslist);
        echo $data;
    }

    public function themTintuc(Request $rq)
    {
        $lastitem = BaivietModel::where('type', 'tin-tuc')->get()->sortBy('ordinal')->last();
        if ($lastitem != null) {
            $lastnumb = $lastitem->ordinal + 1;
        } else {
            $lastnumb = 0;
        }
        $tintuc = new BaivietModel;
        $tintuc->ordinal = $lastnumb;
        $tintuc->name = $rq->name;
        if ($rq->ckedesc != null) {
            $tintuc->desc = htmlspecialchars($rq->ckedesc);
        } else {
            $tintuc->desc = $rq->desc;
        }
        if ($rq->ckecontent != null) {
            $tintuc->content = htmlspecialchars($rq->ckecontent);
        } else {
            $tintuc->content = $rq->content;
        }
        $tintuc->type = 'tin-tuc';
        if ($tintuc->save()) {
            if ($rq->hasFile('photo')) {
                $date = getdate();
                $stringdate = $date['hours'] . $date['minutes'] . $date['seconds'] . $date['mday'] . $date['mon'] . $date['year'];
                $file = $rq->file('photo');
                $name = $file->getClientOriginalName();

                $suffix = explode('.', $name);
                $explain =  $stringdate . "." . $suffix[1];
                $file->move(public_path('uploads') . '/news/tintuc/' . $tintuc->id . '/', $explain);
                $tintuc->photo = $explain;
                $tintuc->save();
            }
            $newslist = BaivietModel::where('type', 'tin-tuc')->skip(($rq->page - 1) * 10)->take(10)->latest()->get();
            echo $this->layTintucHtml($newslist);
        }
    }
    public function suaTintuc(Request $rq)
    {
        $tintuc = BaivietModel::where([['id', $rq->id], ['type', 'tin-tuc']])->get()->first();
        $tintuc->name = $rq->name;
        if ($rq->ckedesc != null) {
            $tintuc->desc = htmlspecialchars($rq->ckedesc);
        } else {
            $tintuc->desc = $rq->desc;
        }
        if ($rq->ckecontent != null) {
            $tintuc->content = htmlspecialchars($rq->ckecontent);
        } else {
            $tintuc->content = $rq->content;
        }
        if ($rq->hasFile('photo')) {
            if ($tintuc->photo != null && $tintuc->photo != '') {
                unlink(public_path('uploads' . "\\news\\tintuc\\" . $tintuc->id . '\\' . $tintuc->photo));
            }
            $date = getdate();
            $stringdate = $date['hours'] . $date['minutes'] . $date['seconds'] . $date['mday'] . $date['mon'] . $date['year'];
            $file = $rq->file('photo');
            $name = $file->getClientOriginalName();

            $suffix = explode('.', $name);
            $explain =  $stringdate . "." . $suffix[1];
            $file->move(public_path('uploads') . '/news/tintuc/' . $tintuc->id . '/', $explain);
            $tintuc->photo = $explain;
        }
        if ($tintuc->save()) {
            echo $this->layMotTintucHTML($tintuc);
        }
    }
    public function xoaTinTuc(Request $rq)
    {
        $tintuc = BaivietModel::where([['id', $rq->id], ['type', 'tin-tuc']])->first();
        if ($tintuc != null) {
            if ($tintuc->delete()) {
                if ($tintuc->photo != '') {
                    unlink(public_path('uploads' . "\\news\\tintuc\\" . $tintuc->id . '\\' . $tintuc->photo));
                }
            }
        }
        $newslist = BaivietModel::where('type', 'tin-tuc')->skip(($rq->page - 1) * 10)->take(10)->latest()->get();
        echo $this->layTintucHtml($newslist);
    }
}
