<?php

namespace App\Http\Controllers\Admin;

use App\Models\CustomerModel;
use App\Models\PhongThueModel;
use App\Models\RoomsModel;

class Functions
{
    public static function initpagination($link, $page, $perpage, $totallist, $currentlist)
    {
        $data = '';
        if (count($totallist)) {
            $data .= '<nav class="d-flex justify-items-center justify-content-between">
        <div
            class="d-flex flex-wrap flex-sm-fill d-sm-flex align-items-sm-center justify-content-sm-center text-center">
            <div class="w-100">
                <p class="small text-muted">
                    Hiển thị
                    <span class="fw-semibold">' . (($page - 1) * $perpage) + 1 . '</span>
                    tới
                    <span class="fw-semibold">' . (count($currentlist) ? ((($page - 1) * $perpage) + count($currentlist)) : count($totallist)) . '</span>
                    của
                    <span class="fw-semibold">' . count($totallist) . '</span>
                    kết quả
                </p>
            </div> 

            <div>
                <ul class="pagination">';
            // {{-- Previous Page Link --}}
            if ($page == '1') {
                $data .= '<li class="page-item disabled" aria-disabled="true">
                            <span class="page-link" aria-hidden="true">&lsaquo;</span>
                        </li>';
            } else {
                $data .= '<li class="page-item">
                            <a class="page-link" href="' . $link . '?page=' . $page - 1 . '" rel="prev">
                                &lsaquo;</a>
                        </li>';
            }
            if ($page > 3) {
                $data .= '<li class="page-item">
                    <a class="page-link" href="' . $link . '?page=1">1</a>
                </li>
                <li class="page-item disabled" aria-disabled="true">
                <a class="page-link tree-dot">...</a>
                </li>';
            }

            for ($i = 1; $i <= ((count($totallist) % 10) == 0 ? ((float)count($totallist) / 10) : (count($totallist) / 10) + 1); $i++) {
                if (($page + 3) > $i && ($page - 3) < $i) {
                    if ($page == $i) {
                        $data .= '<li class="page-item active" aria-current="page"><span
                                        class="page-link">' . $i . '</span></li>';
                    } else {
                        $data .= '<li class="page-item"><a class="page-link"
                                        href="' . $link . '?page=' . $i . '">' . $i . '</a></li>';
                    }
                }
            }

            if ($page < (((float)count($totallist) % 10 > 0 ? (floor((float)count($totallist) / 10) + 1) : floor((float)count($totallist) / 10)) - 2)) {
                $data .= '<li class="page-item disabled" aria-disabled="true">
                <a class="page-link tree-dot">...</a>
                </li>
                <li class="page-item">
                    <a class="page-link" href="' . $link . '?page=' . ((float)count($totallist) % 10 > 0 ? (floor((float)count($totallist) / 10) + 1) : floor((float)count($totallist) / 10)) . '">' .  ((float)count($totallist) % 10 > 0 ? (floor((float)count($totallist) / 10) + 1) : floor((float)count($totallist) / 10)) . '</a>
                </li>';
            }

            // {{-- Next Page Link --}}
            if ($page != ((count($totallist) % 10) == 0 ? (round((float)count($totallist) / 10)) : (round((float)count($totallist) / 10) + 1)) && count($totallist) > 10) {
                $data .= '<li class="page-item">
                            <a class="page-link" href="' . $link . '?page=' . $page + 1 . '" rel="next">&rsaquo;</a>
                        </li>';
            } else {
                $data .= '<li class="page-item disabled" aria-disabled="true">
                            <span class="page-link" aria-hidden="true">&rsaquo;</span>
                        </li>';
            }
            $data .= '</ul>
            </div>
        </div>
    </nav>';
        }
        return $data;
    }
    static public function formatMoney($price = 0, $unit = ' VNĐ', $html = false)
    {
        $str = '';

        if ($price) {
            $str .= number_format($price, 0, ',', '.');
            if ($unit != '') {
                if ($html) {
                    $str .= '<span>' . $unit . '</span>';
                } else {
                    $str .= $unit;
                }
            }
        }
        return $str;
    }
    static public function getUserInfo($id)
    {
        $userroom = PhongThueModel::where([['id_phong', $id], ['status', '1']])->first();
        if ($userroom != null) {
            $user = CustomerModel::find($userroom['id_khachhang']);
            return $user->name;
        }
        return '';
    }
    static public function getRoomName($id)
    {
        $room = RoomsModel::find($id);
        if ($room != null) {
            return $room->name;
        }
    }
    static public function getCustomerName($id)
    {
        $user = CustomerModel::find($id);
        if ($user != null) {
            return $user->name;
        }
    }
}
