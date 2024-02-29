<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Admin\Functions;
use App\Http\Requests\SubmitRequest;
use App\Models\ContractsModel;
use App\Models\PhongThueModel;
use App\Models\RoomsModel;
use App\Models\ServicesModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Carbon\Carbon;


class RoomsController extends Controller
{
    private function layPhongHTML($list)
    {
        $data = '';
        if (count($list)) {
            foreach ($list as $k => $v) {
                $data .= '<tr data-id="' . $v['id'] . '">
                <td style="text-align: center;">' . $v['ordinal'] . '</td>
                <td>' . $v['name'] . '</td>
                <td>' . Functions::formatMoney($v['price']) . '</td>
                <td>' . $v['deposittime'] . '</td>
                <td>' . Functions::formatMoney($v['electricity_price']) . '</td>
                <td>' . Functions::formatMoney($v['water_price']) . '</td>
                <td>' . $v['payday'] . '</td>
                <td>' . $v['floor'] . '</td>
                <td>' . Functions::getUserInfo($v['id']) . '</td>
                <td>
                <div class="v-center change-status" ';
                $data .= $v['status'] == '0' || $v['status'] == null ? 'style=color:red' : ($v['status'] == '1' ? 'style=color:#39e339' : ($v['status'] == '2' ? 'style=color:#193a97' : ($v['status'] == 3 ? 'style=color:#e59010' : 'style=color:#e495b0')));
                $data .= '>
                        <div class="status-name">';
                $data .= $v['status'] == '0' || $v['status'] == null ? 'Chưa hoạt động' : ($v['status'] == '1' ? 'Đang hoạt động' : ($v['status'] == '2' ? 'Đang thuê' : ($v['status'] == 3 ? 'Đang bảo trì' : 'Đang đặt')));
                $data .= '<div class="arrow">
                        <svg width="14" height="7" viewBox="0 0 22 11" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M1.04991 1L1 1.04544L10.8361 9.99999L20.6721 1.04544L20.6222 1L10.8361 9.90911L1.04991 1Z"
                                fill="white" stroke="black" />
                        </svg>
                    </div>
                </div>
                        <div class="status-r">';
                if ($v['status'] != 0) {
                    $data .= '<div class="value" style="color: red" data-value="0">Chưa hoạt động
                                </div>';
                }
                if ($v['status'] != 1) {
                    $data .= '<div class="value" style="color: #39e339" data-value="1">Đang hoạt
                                    động
                                </div>';
                }
                if ($v['status'] != 2) {
                    $data .= '<div class="value" style="color: #193a97" data-value="2">Đang thuê
                                </div>';
                }
                if ($v['status'] != 3) {
                    $data .= '<div class="value" style="color: #e59010" data-value="3">Đang bảo
                                    trì</div>';
                }
                $data .= '</div>
                    </div>
                </td>
                <td class="white-space">
            <button class="btn btn-success update-room" data-bs-toggle="tooltip"
                data-bs-placement="top" data-bs-custom-class="custom-tooltip"
                data-bs-title="Sửa"><i class="fa-solid fa-pen-field"></i></button>
            <button class="btn btn-danger delete-room" data-bs-toggle="tooltip"
                data-bs-placement="top" data-bs-custom-class="custom-tooltip"
                data-bs-title="Xóa"><i class="fa-regular fa-trash"></i></button>';
                if ($v['status'] == 2) {
                    $data .= ' <button class="btn btn-danger huy-room" data-bs-toggle="tooltip"
                            data-bs-placement="top" data-bs-custom-class="custom-tooltip"
                            data-bs-title="Hủy hợp đồng"><i class="fa-solid fa-xmark"></i></button>';
                }
                $data .= '</td>
            </tr>';
            }
        } else {
            $data .= '<tr>
                        <td colspan="11" class="text-center">Không có dữ liệu</td>
                      </tr>';
        }
        return $data;
    }

    private function layMotPhongHTML($room)
    {
        $data = '
        <td style="text-align: center;">' . $room['ordinal'] . '</td>
        <td>' . $room['name'] . '</td>
        <td>' . Functions::formatMoney($room['price']) . '</td>
        <td>' . $room['deposittime'] . '</td>
        <td>' . Functions::formatMoney($room['electricity_price']) . '</td>
        <td>' . Functions::formatMoney($room['water_price']) . '</td>
        <td>' . $room['payday'] . '</td>
        <td>' . $room['floor'] . '</td>
        <td>' . Functions::getUserInfo($room['id']) . '</td>
        <td>
        <div class="v-center change-status" ';
        $data .= $room['status'] == '0' || $room['status'] == null ? 'style=color:red' : ($room['status'] == '1' ? 'style=color:#39e339' : ($room['status'] == '2' ? 'style=color:#193a97' : ($room['status'] == 3 ? 'style=color:#e59010' : 'style=color:#e495b0')));
        $data .= '>
                        <div class="status-name">';
        $data .= $room['status'] == '0' || $room['status'] == null ? 'Chưa hoạt động' : ($room['status'] == '1' ? 'Đang hoạt động' : ($room['status'] == '2' ? 'Đang thuê' : ($room['status'] == 3 ? 'Đang bảo trì' : 'Đang đặt')));
        $data .= '<div class="arrow">
            <svg width="14" height="7" viewBox="0 0 22 11" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path
                    d="M1.04991 1L1 1.04544L10.8361 9.99999L20.6721 1.04544L20.6222 1L10.8361 9.90911L1.04991 1Z"
                    fill="white" stroke="black" />
            </svg>
        </div>
        </div>
                        <div class="status-r">';
        if ($room['status'] != 0) {
            $data .= '<div class="value" style="color: red" data-value="0">Chưa hoạt động
                                </div>';
        }
        if ($room['status'] != 1) {
            $data .= '<div class="value" style="color: #39e339" data-value="1">Đang hoạt
                                    động
                                </div>';
        }
        if ($room['status'] != 2) {
            $data .= '<div class="value" style="color: #193a97" data-value="2">Đang thuê
                                </div>';
        }
        if ($room['status'] != 3) {
            $data .= '<div class="value" style="color: #e59010" data-value="3">Đang bảo
                                    trì</div>';
        }
        if ($room['status'] != 4) {
            $data .= '<div class="value" style="color: #e495b0" data-value="4">Đang đặt</div>';
        }
        $data .= '</div>
                    </div>
                </td>
        <td class="white-space">
    <button class="btn btn-success update-room" data-bs-toggle="tooltip"
        data-bs-placement="top" data-bs-custom-class="custom-tooltip"
        data-bs-title="Sửa"><i class="fa-solid fa-pen-field"></i></button>
    <button class="btn btn-danger delete-room" data-bs-toggle="tooltip"
        data-bs-placement="top" data-bs-custom-class="custom-tooltip"
        data-bs-title="Xóa"><i class="fa-regular fa-trash"></i></button>';
        if ($room['status'] == 2) {
            $data .= ' <button class="btn btn-danger huy-room" data-bs-toggle="tooltip"
                    data-bs-placement="top" data-bs-custom-class="custom-tooltip"
                    data-bs-title="Hủy hợp đồng"><i class="fa-solid fa-xmark"></i></button>';
        }
        $data .= '</td>';
        return $data;
    }
    public function layTrangThaiPhongHTML($room)
    {
        $data = '<div class="v-center change-status" ';
        $data .= $room['status'] == '0' || $room['status'] == null ? 'style=color:red' : ($room['status'] == '1' ? 'style=color:#39e339' : ($room['status'] == '2' ? 'style=color:#193a97' : ($room['status'] == 3 ? 'style=color:#e59010' : 'style=color:#e495b0')));
        $data .= '>
                <div class="status-name">';
        $data .= $room['status'] == '0' || $room['status'] == null ? 'Chưa hoạt động' : ($room['status'] == '1' ? 'Đang hoạt động' : ($room['status'] == '2' ? 'Đang thuê' : ($room['status'] == 3 ? 'Đang bảo trì' : 'Đang đặt')));
        $data .= '<div class="arrow">
                <svg width="14" height="7" viewBox="0 0 22 11" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path
                        d="M1.04991 1L1 1.04544L10.8361 9.99999L20.6721 1.04544L20.6222 1L10.8361 9.90911L1.04991 1Z"
                        fill="white" stroke="black" />
                </svg>
            </div>
        </div>
                <div class="status-r">';
        if ($room['status'] != 0) {
            $data .= '<div class="value" style="color: red" data-value="0">Chưa hoạt động
                        </div>';
        }
        if ($room['status'] != 1) {
            $data .= '<div class="value" style="color: #39e339" data-value="1">Đang hoạt
                            động
                        </div>';
        }
        if ($room['status'] != 2) {
            $data .= '<div class="value" style="color: #193a97" data-value="2">Đang thuê
                        </div>';
        }
        if ($room['status'] != 3) {
            $data .= '<div class="value" style="color: #e59010" data-value="3">Đang bảo
                            trì</div>';
        }
        if ($room['status'] != 4) {
            $data .= '<div class="value" style="color: #e495b0" data-value="4">Đang đặt</div>';
        }
        $data .= '</div>
            </div>';
        echo $data;
    }

    public function pagination(Request $rq)
    {
        $rooms = RoomsModel::get();
        $roomslist = RoomsModel::get()->sortBy('ordinal', SORT_REGULAR, true)->skip(($rq->page - 1) * 10)->take(10);
        $data = Functions::initpagination('phong-tro', $rq->page, 10, $rooms, $roomslist);
        echo $data;
    }

    public function layPhong(Request $rq)
    {
        if ($rq->page == null)
            $page = 1;
        else
            $page = $rq->page;
        $roomslist = RoomsModel::get()->sortBy('ordinal', SORT_REGULAR, true)->skip(($page - 1) * 10)->take(10);
        $contracts = ContractsModel::all();
        $services = ServicesModel::all();
        return view('admin.rooms.rooms', compact('roomslist', 'contracts', 'services'));
    }

    public function layPhongtheoid(Request $rq)
    {
        $room = RoomsModel::find($rq->id);
        $roomcon = RoomsModel::find($rq->id)->contracts->pluck('id')->toArray();
        $roomser = RoomsModel::find($rq->id)->services->pluck('id')->toArray();
        $room->desc = htmlspecialchars_decode($room->desc);
        $room->content = htmlspecialchars_decode($room->content);
        $room->id_dichvu = $roomser;
        $room->id_hopdong = $roomcon;
        echo $room;
    }

    public function themPhong(Request $rq)
    {
        $lastitem = RoomsModel::get()->sortBy('ordinal')->last();
        if ($lastitem != null) {
            $lastnumb = $lastitem->ordinal + 1;
        } else {

            $lastnumb = 0;
        }
        $newroom = new RoomsModel;
        $newroom->ordinal = $lastnumb;
        $newroom->name = $rq->name;
        if ($rq->ckedesc != null) {
            $newroom->desc = htmlspecialchars($rq->ckedesc);
        } else {
            $newroom->desc = $rq->desc;
        }
        if ($rq->ckecontent != null) {
            $newroom->content = htmlspecialchars($rq->ckecontent);
        } else {
            $newroom->content = $rq->content;
        }
        $newroom->price = $rq->price;
        $newroom->deposittime = $rq->deposittime;
        $newroom->electricity_price = $rq->electricity_price;
        $newroom->water_price = $rq->water_price;
        $newroom->area = $rq->area;
        $newroom->payday = $rq->payday;
        $newroom->floor = $rq->floor;
        $newroom->status = $rq->status;
        $newroom->options = $rq->options;
        if ($rq->hopdong == '') {
            echo 1;
        } else if ($rq->dichvu == '') {
            echo 2;
        } else {
            if ($newroom->save()) {
                $newroom->contracts()->attach($rq->hopdong);
                $newroom->services()->sync($rq->dichvu);
                $images = [];
                $id = $newroom->id;
                for ($i = 0; $i < $rq->imagesLength; $i++) {
                    if ($rq->hasFile('files' . $i)) {
                        $date = getdate();
                        $stringdate = $date['hours'] . $date['minutes'] . $date['seconds'] . $date['mday'] . $date['mon'] . $date['year'];
                        $file = $rq->file('files' . $i);
                        $name = $file->getClientOriginalName();

                        $suffix = explode('.', $name);
                        $explain =  $stringdate . "-" . $i . "." . $suffix[1];
                        $file->move(public_path('uploads') . '/room/' . $id, $explain);
                        array_push($images, $explain);
                    }
                }
                if (count($images) != 0) {
                    $newroom->picture = implode(",", $images);
                    $newroom->save();
                }
                $roomslist = RoomsModel::get()->sortBy('ordinal', SORT_REGULAR, true)->skip(($rq->page - 1) * 10)->take(10);
                echo $this->layPhongHTML($roomslist);
            }
        }
    }

    public function huyHopdongPhong(Request $rq)
    {
        $room = RoomsModel::find($rq->id);
        if ($room != null) {
            $hopdongphong = PhongThueModel::where('id_phong', $rq->id)->first();
            if ($hopdongphong != null) {
                $hopdongphong->rental_end_date = Carbon::now();
                $hopdongphong->save();
                if ($hopdongphong->delete()) {
                    $room->status = '0';
                    if ($room->save()) {
                        echo $this->layMotPhongHTML($room);
                    }
                }
            } else {
                $room->status = '0';
                if ($room->save()) {
                    echo $this->layMotPhongHTML($room);
                }
            }
        }
    }

    public function suaPhong(Request $rq)
    {
        $room = RoomsModel::where('id', $rq->id)->get()->first();
        $room->name = $rq->name;
        if ($rq->ckedesc != null) {
            $room->desc = htmlspecialchars($rq->ckedesc);
        } else {
            $room->desc = $rq->desc;
        }
        if ($rq->ckecontent != null) {
            $room->content = htmlspecialchars($rq->ckecontent);
        } else {
            $room->content = $rq->content;
        }
        $room->price = $rq->price;
        $room->deposittime = $rq->deposittime;
        $room->electricity_price = $rq->electricity_price;
        $room->water_price = $rq->water_price;
        $room->area = $rq->area;
        $room->payday = $rq->payday;
        $room->floor = $rq->floor;
        $room->status = $rq->status;
        $room->options = $rq->options;
        $room->contracts()->attach($rq->hopdong);
        $room->services()->sync($rq->dichvu);
        $images = [];
        for ($i = 0; $i < $rq->imagesLength; $i++) {
            if ($rq->hasFile('files' . $i)) {
                $date = getdate();
                $stringdate = $date['hours'] . $date['minutes'] . $date['seconds'] . $date['mday'] . $date['mon'] . $date['year'];
                $file = $rq->file('files' . $i);
                $name = $file->getClientOriginalName();

                $suffix = explode('.', $name);
                $explain =  $stringdate . "-" . $i . "." . $suffix[1];
                $file->move(public_path('uploads') . '/room/' . $rq->id, $explain);
                array_push($images, $explain);
            }
        }
        if (count($images) != 0) {
            if ($room->picture != null) {
                $room->picture .= ',' . implode(",", $images);
            } else {
                $room->picture .= implode(",", $images);
            }
        }
        if ($rq->hopdong == '') {
            echo 1;
        } else if ($rq->dichvu == '') {
            echo 2;
        } else {
            if ($room->save()) {
                echo $this->layMotPhongHTML($room);
            }
        }
    }

    public function doiTrangThaiPhong(Request $rq)
    {
        $room = RoomsModel::where('id', $rq->id)->first();
        $room->status = $rq->status;
        if ($room->save()) {
            echo $this->layTrangThaiPhongHTML($room);
        }
    }

    public function xoahinhtheoID(Request $rq)
    {
        $listimages = [];
        $room = RoomsModel::where('id', $rq->id)->first();
        $listimages = explode(",", $room->picture);
        unlink(public_path('uploads' . "\\room\\" . $rq->id . "\\" . $listimages[$rq->stt]));
        array_splice($listimages, $rq->stt, 1);
        if (count($listimages) == 0) {
            $room->picture = null;
        } else {
            $listimages = implode(",", $listimages);
            $room->picture = $listimages;
        }
        if ($room->save()) {
            $data['success'] = true;
            $data['list'] = $room->picture;
            echo json_encode($data);
        }
    }

    public function xoaPhong(Request $rq)
    {
        $room = RoomsModel::where('id', $rq->id)->first();
        if ($room != null) {
            File::deleteDirectory(public_path('uploads' . "\\room\\" . $rq->id));
            $room->delete();
        }
        $roomslist = RoomsModel::get()->sortBy('ordinal', SORT_REGULAR, true)->skip(($rq->page - 1) * 10)->take(10);
        echo $this->layPhongHTML($roomslist);
    }
}
