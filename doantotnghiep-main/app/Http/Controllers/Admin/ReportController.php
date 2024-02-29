<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ReportModel;
use App\Http\Controllers\Admin\Functions;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    private function layPhanHoiHTML($list)
    {
        $data = '';
        if (count($list)) {
            foreach ($list as $k => $v) {
                $data .= '<tr data-id="' . $v['id'] . '">
                <td style="text-align: center;">' . $v['ordinal'] . '</td>
                <td>' . Functions::getRoomName($v['id_phong']) . '</td>
                <td>' . Functions::getCustomerName($v['id_khachhang']) . '</td>
                <td>';
                if ($v['type'] == 'huy-phong') {
                    $data .= 'Hủy phòng';
                } elseif ($v['type'] == 'phan-hoi') {
                    $data .= 'Phản hồi';
                }
                $data .= '</td>
                <td>' . $v['content'] . '</td>
                <td>
                <div class="v-center change-status" ';
                $data .= $v['status'] == '0' || $v['status'] == null ? 'style=color:red' : ($v['status'] == '1' ? 'style=color:#39e339' : 'style=color:#193a97');
                $data .= '>
                        <div class="status-name">';
                $data .= $v['status'] == '0' || $v['status'] == null ? 'Chưa xem' : ($v['status'] == '1' ? 'Đã xem' : 'Đã xử lý');
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
                    $data .= '<div class="value" style="color: red" data-value="0">Chưa xem
                                        </div>';
                }
                if ($v['status'] != 1) {
                    $data .= '<div class="value" style="color: #39e339" data-value="1">Đang hoạt
                                            động
                                        </div>';
                }
                if ($v['status'] != 2) {
                    $data .= '<div class="value" style="color: #193a97" data-value="2">Đã xử lý
                                        </div>';
                }
                $data .= '</div>
                            </div>
                        </td>
                <td class="white-space">
            <button class="btn btn-danger delete-report" data-bs-toggle="tooltip"
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

    private function layMotPhanHoiHTML($report)
    {
        $data = '
        <td style="text-align: center;">' . $report['ordinal'] . '</td>
        <td>' . Functions::getRoomName($report['id_phong']) . '</td>
        <td>' . Functions::getCustomerName($report['id_khachhang']) . '</td>
        <td>';
        if ($report['type'] == 'huy-phong') {
            $data .= 'Hủy phòng';
        } elseif ($report['type'] == 'phan-hoi') {
            $data .= 'Phản hồi';
        }
        $data .= '</td>
        <td>' . $report['content'] . '</td>
        <td>
        <div class="v-center change-status" ';
        $data .= $report['status'] == '0' || $report['status'] == null ? 'style=color:red' : ($report['status'] == '1' ? 'style=color:#39e339' : 'style=color:#193a97');
        $data .= '>
                        <div class="status-name">';
        $data .= $report['status'] == '0' || $report['status'] == null ? 'Chưa xem' : ($report['status'] == '1' ? 'Đã xem' : 'Đã xử lý');
        $data .= '<div class="arrow">
            <svg width="14" height="7" viewBox="0 0 22 11" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path
                    d="M1.04991 1L1 1.04544L10.8361 9.99999L20.6721 1.04544L20.6222 1L10.8361 9.90911L1.04991 1Z"
                    fill="white" stroke="black" />
            </svg>
        </div>
        </div>
                        <div class="status-r">';
        if ($report['status'] != 0) {
            $data .= '<div class="value" style="color: red" data-value="0">Chưa xem
                                </div>';
        }
        if ($report['status'] != 1) {
            $data .= '<div class="value" style="color: #39e339" data-value="1">Đã xem</div>';
        }
        if ($report['status'] != 2) {
            $data .= '<div class="value" style="color: #193a97" data-value="2">Đã xử lý</div>';
        }
        $data .= '</div>
                    </div>
                </td>
        <td class="white-space">
    <button class="btn btn-danger delete-report" data-bs-toggle="tooltip"
        data-bs-placement="top" data-bs-custom-class="custom-tooltip"
        data-bs-title="Xóa"><i class="fa-regular fa-trash"></i></button>
        </td>';
        return $data;
    }
    public function layTrangThaiPhanHoiHTML($report)
    {
        $data = '
            <div class="v-center change-status" ';
        $data .= $report['status'] == '0' || $report['status'] == null ? 'style=color:red' : ($report['status'] == '1' ? 'style=color:#39e339' : 'style=color:#193a97');
        $data .= '>
                <div class="status-name">';
        $data .= $report['status'] == '0' || $report['status'] == null ? 'Chưa xem' : ($report['status'] == '1' ? 'Đã xem' : 'Đã xử lý');
        $data .= '<div class="arrow">
                <svg width="14" height="7" viewBox="0 0 22 11" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path
                        d="M1.04991 1L1 1.04544L10.8361 9.99999L20.6721 1.04544L20.6222 1L10.8361 9.90911L1.04991 1Z"
                        fill="white" stroke="black" />
                </svg>
            </div>
        </div>
                <div class="status-r">';
        if ($report['status'] != 0) {
            $data .= '<div class="value" style="color: red" data-value="0">Chưa xem
                        </div>';
        }
        if ($report['status'] != 1) {
            $data .= '<div class="value" style="color: #39e339" data-value="1">Đã xem</div>';
        }
        if ($report['status'] != 2) {
            $data .= '<div class="value" style="color: #193a97" data-value="2">Đã xử lý</div>';
        }
        $data .= '</div>
            </div>';
        echo $data;
    }

    public function pagination(Request $rq)
    {
        $reports = ReportModel::get();
        $reportslist = ReportModel::get()->sortBy('ordinal', SORT_REGULAR, true)->skip(($rq->page - 1) * 10)->take(10);
        $data = Functions::initpagination('khach-hang', $rq->page, 10, $reports, $reportslist);
        echo $data;
    }

    public function layPhanHoi(Request $rq)
    {
        $reportslist = ReportModel::get()->sortBy('ordinal', SORT_REGULAR, true)->skip(($rq->page - 1) * 10)->take(10);
        return view('admin.reports.report', compact('reportslist'));
    }

    public function layPhanHoiTheoId(Request $rq)
    {
        $report = ReportModel::find($rq->id);
        $report->id_phong = Functions::getRoomName($report['id_phong']);
        $report->id_khachhang = Functions::getCustomerName($report['id_khachhang']);
        if ($report['type'] == 'huy-phong') {
            $report->type = 'Hủy phòng';
        } elseif ($report['type'] == 'phan-hoi') {
            $report->type = 'Phản hồi';
        }
        echo $report;
    }

    public function themPhanHoi(Request $rq)
    {
        $lastitem = ReportModel::get()->sortBy('ordinal')->last();
        if ($lastitem != null) {
            $lastnumb = $lastitem->ordinal + 1;
        } else {

            $lastnumb = 0;
        }
        $newreport = new ReportModel;
        $newreport->ordinal = $lastnumb;
        $newreport->name = $rq->name;
        $newreport->avatar = $rq->avatar;
        $newreport->username = $rq->username;
        $newreport->email = $rq->email;
        $newreport->phone = $rq->phone;
        $newreport->birthday = $rq->birthday;
        $newreport->address = $rq->address;
        $newreport->status = $rq->status;
        $reportslist = ReportModel::get()->sortBy('ordinal', SORT_REGULAR, true)->skip(($rq->page - 1) * 10)->take(10);
        echo $this->layPhanHoiHTML($reportslist);
    }

    public function suaPhanHoi(Request $rq)
    {
        $report = ReportModel::where('id', $rq->id)->get()->first();
        $report->name = $rq->name;
        $report->username = $rq->username;
        $report->email = $rq->email;
        $report->phone = $rq->phone;
        $report->birthday = $rq->birthday;
        $report->address = $rq->address;
        $report->status = $rq->status;
        echo $this->layMotPhanHoiHTML($report);
    }

    public function doiTrangThaiPhanHoi(Request $rq)
    {
        $report = ReportModel::where('id', $rq->id)->first();
        $report->status = $rq->status;
        if ($report->save()) {
            echo $this->layTrangThaiPhanHoiHTML($report);
        }
    }

    public function xoaPhanHoi(Request $rq)
    {
        $report = ReportModel::where('id', $rq->id)->first();
        if ($report != null) {
            $report->delete();
        }
        $reportslist = ReportModel::get()->sortBy('ordinal', SORT_REGULAR, true)->skip(($rq->page - 1) * 10)->take(10);
        echo $this->layPhanHoiHTML($reportslist);
    }
}
