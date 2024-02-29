<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AdminModel;
use App\Models\UserModel;
use App\Http\Controllers\Admin\Functions;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;

class AccountsController extends Controller
{
    private function layKhachHangHTML($list)
    {
        $data = '';
        if (count($list)) {
            foreach ($list as $k => $v) {
                $data .= '<tr data-id="' . $v['id'] . '">
                <td style="text-align: center;">' . $v['ordinal'] . '</td>
                <td>';
                if ($v['avatar'] != null) {
                    $data .= '<div class="pic m-auto" style="max-width: 50%"><img style="width:100%;aspect-ratio: 1/1;object-fit: cover;" src="../public/uploads/users/customers/' . $v['id'] . '/' . $v['avatar'] . '" alt=""></div>';
                } else {
                    $data .= '<div class="pic m-auto" style="max-width: 50%"><img style="width:100%;aspect-ratio: 1/1;object-fit: cover;"
                                                            src="../public/assets/images/noimage.png" alt=""></div>';
                }
                $data .= '</td>
                <td style="width: 10%;">' . $v['username'] . '</td>
                <td>' . $v['name'] . '</td>
                <td>' . $v['email'] . '</td>
                <td style="width: 9%;">' . $v['phone'] . '</td>
                <td>
                <div class="v-center change-status" ';
                $data .= $v['status'] == '0' || $v['status'] == null ? 'style=color:red' : ($v['status'] == '1' ? 'style=color:#39e339' : 'style=color:#193a97');
                $data .= '>
                        <div class="status-name">';
                $data .= $v['status'] == '0' || $v['status'] == null ? 'Chưa hoạt động' : ($v['status'] == '1' ? 'Đang hoạt động' : 'Khóa');
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
                    $data .= '<div class="value" style="color: #193a97" data-value="2">Khóa
                                        </div>';
                }
                $data .= '</div>
                            </div>
                        </td>
                <td class="white-space">
            <button class="btn btn-success update-customer" data-bs-toggle="tooltip"
                data-bs-placement="top" data-bs-custom-class="custom-tooltip"
                data-bs-title="Sửa"><i class="fa-solid fa-pen-field"></i></button>
            <button class="btn btn-danger delete-customer" data-bs-toggle="tooltip"
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

    private function layMotKhachHangHTML($customer)
    {
        $data = '
        <td style="text-align: center;">' . $customer['ordinal'] . '</td>
        <td>';
        if ($customer['avatar'] != null && $customer['avatar'] != '') {
            $data .= '<div class="pic m-auto" style="max-width: 50%"><img style="width:100%;aspect-ratio: 1/1;object-fit: cover;" src="../public/uploads/users/customers/' . $customer['id'] . '/' . $customer['avatar'] . '" alt=""></div>';
        } else {
            $data .= '<div class="pic m-auto" style="max-width: 50%"><img style="width:100%;aspect-ratio: 1/1;object-fit: cover;"
                                                    src="../public/assets/images/noimage.png" alt=""></div>';
        }
        $data .= '</td>
        <td>' . $customer['username'] . '</td>
        <td>' . $customer['name'] . '</td>
        <td>' . $customer['email'] . '</td>
        <td style="width: 9%;">' . $customer['phone'] . '</td>
        <td>
        <div class="v-center change-status" ';
        $data .= $customer['status'] == '0' || $customer['status'] == null ? 'style=color:red' : ($customer['status'] == '1' ? 'style=color:#39e339' : 'style=color:#193a97');
        $data .= '>
                        <div class="status-name">';
        $data .= $customer['status'] == '0' || $customer['status'] == null ? 'Chưa hoạt động' : ($customer['status'] == '1' ? 'Đang hoạt động' : 'Khóa');
        $data .= '<div class="arrow">
            <svg width="14" height="7" viewBox="0 0 22 11" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path
                    d="M1.04991 1L1 1.04544L10.8361 9.99999L20.6721 1.04544L20.6222 1L10.8361 9.90911L1.04991 1Z"
                    fill="white" stroke="black" />
            </svg>
        </div>
        </div>
                        <div class="status-r">';
        if ($customer['status'] != 0) {
            $data .= '<div class="value" style="color: red" data-value="0">Chưa hoạt động
                                </div>';
        }
        if ($customer['status'] != 1) {
            $data .= '<div class="value" style="color: #39e339" data-value="1">Đang hoạt
                                    động
                                </div>';
        }
        if ($customer['status'] != 2) {
            $data .= '<div class="value" style="color: #193a97" data-value="2">Khóa
                                </div>';
        }
        $data .= '</div>
                    </div>
                </td>
        <td class="white-space">
    <button class="btn btn-success update-customer" data-bs-toggle="tooltip"
        data-bs-placement="top" data-bs-custom-class="custom-tooltip"
        data-bs-title="Sửa"><i class="fa-solid fa-pen-field"></i></button>
    <button class="btn btn-danger delete-customer" data-bs-toggle="tooltip"
        data-bs-placement="top" data-bs-custom-class="custom-tooltip"
        data-bs-title="Xóa"><i class="fa-regular fa-trash"></i></button>
        </td>';
        return $data;
    }
    public function layTrangThaiKhachHangHTML($customer)
    {
        $data = '
            <div class="v-center change-status" ';
        $data .= $customer['status'] == '0' || $customer['status'] == null ? 'style=color:red' : ($customer['status'] == '1' ? 'style=color:#39e339' : 'style=color:#193a97');
        $data .= '>
                <div class="status-name">';
        $data .= $customer['status'] == '0' || $customer['status'] == null ? 'Chưa hoạt động' : ($customer['status'] == '1' ? 'Đang hoạt động' : 'Khóa');
        $data .= '<div class="arrow">
                <svg width="14" height="7" viewBox="0 0 22 11" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path
                        d="M1.04991 1L1 1.04544L10.8361 9.99999L20.6721 1.04544L20.6222 1L10.8361 9.90911L1.04991 1Z"
                        fill="white" stroke="black" />
                </svg>
            </div>
        </div>
                <div class="status-r">';
        if ($customer['status'] != 0) {
            $data .= '<div class="value" style="color: red" data-value="0">Chưa hoạt động
                        </div>';
        }
        if ($customer['status'] != 1) {
            $data .= '<div class="value" style="color: #39e339" data-value="1">Đang hoạt
                            động
                        </div>';
        }
        if ($customer['status'] != 2) {
            $data .= '<div class="value" style="color: #193a97" data-value="2">Khóa
                        </div>';
        }
        $data .= '</div>
            </div>';
        echo $data;
    }

    public function khachHangPagination(Request $rq)
    {
        $customers = UserModel::get();
        $customerslist = UserModel::get()->sortBy('ordinal', SORT_REGULAR, true)->skip(($rq->page - 1) * 10)->take(10);
        $data = Functions::initpagination('khach-hang', $rq->page, 10, $customers, $customerslist);
        echo $data;
    }

    public function layKhachHang(Request $rq)
    {
        $customerslist = UserModel::get()->sortBy('ordinal', SORT_REGULAR, true)->skip(($rq->page - 1) * 10)->take(10);
        return view('admin.accounts.customer', compact('customerslist'));
    }

    public function layKhachHangTheoId(Request $rq)
    {
        $customer = UserModel::find($rq->id);
        echo $customer;
    }

    public function themKhachHang(Request $rq)
    {
        $lastitem = UserModel::get()->sortBy('ordinal')->last();
        if ($lastitem != null) {
            $lastnumb = $lastitem->ordinal + 1;
        } else {

            $lastnumb = 0;
        }
        $newcustomer = new UserModel;
        $newcustomer->ordinal = $lastnumb;
        $newcustomer->name = $rq->name;
        $newcustomer->avatar = $rq->avatar;
        $newcustomer->username = $rq->username;
        $newcustomer->email = $rq->email;
        $newcustomer->phone = $rq->phone;
        $newcustomer->birthday = $rq->birthday;
        $newcustomer->address = $rq->address;
        $newcustomer->status = $rq->status;
        if (UserModel::whereRaw('LOWER(`username`) LIKE ? ', [trim(strtolower($rq->username)) . '%'])->get()->toArray() == null) {
            if (UserModel::where('email', '=', $rq->email)->get()->toArray() == null) {
                if ($rq->password == $rq->repassword) {
                    $newcustomer->password = Hash::make($rq->password);
                    if ($newcustomer->save()) {
                        if ($rq->hasFile('photo')) {
                            $date = getdate();
                            $stringdate = $date['hours'] . $date['minutes'] . $date['seconds'] . $date['mday'] . $date['mon'] . $date['year'];
                            $file = $rq->file('photo');
                            $name = $file->getClientOriginalName();

                            $suffix = explode('.', $name);
                            $explain =  $stringdate . "." . $suffix[1];
                            $file->move(public_path('uploads') . '/users/customers/' . $newcustomer->id . '/', $explain);
                            $newcustomer->avatar = $explain;
                        }
                        $newcustomer->save();
                        $customerslist = UserModel::get()->sortBy('ordinal', SORT_REGULAR, true)->skip(($rq->page - 1) * 10)->take(10);
                        echo $this->layKhachHangHTML($customerslist);
                    }
                } else {
                    echo 3;
                }
            } else {
                echo 2;
            }
        } else {
            echo 1;
        }
    }

    public function suaKhachHang(Request $rq)
    {
        $customer = UserModel::where('id', $rq->id)->get()->first();
        $customer->name = $rq->name;
        $customer->username = $rq->username;
        $customer->email = $rq->email;
        $customer->phone = $rq->phone;
        $customer->birthday = $rq->birthday;
        $customer->address = $rq->address;
        $customer->status = $rq->status;
        if ($rq->hasFile('photo')) {
            if ($customer->avatar != '') {
                unlink(public_path('uploads' . "\\users\\customers\\" . $customer->id . "\\" . $customer->avatar));
            }
            $date = getdate();
            $stringdate = $date['hours'] . $date['minutes'] . $date['seconds'] . $date['mday'] . $date['mon'] . $date['year'];
            $file = $rq->file('photo');
            $name = $file->getClientOriginalName();

            $suffix = explode('.', $name);
            $explain =  $stringdate . "." . $suffix[1];
            $file->move(public_path('uploads') . '/users/customers/' . $customer->id . '/', $explain);
            $customer->avatar = $explain;
        }
        if (UserModel::where('id', '!=', $customer->id)->whereRaw('LOWER(`username`) LIKE ? ', [trim(strtolower($rq->username)) . '%'])->get()->toArray() == null) {
            if (UserModel::where([['email', '=', $rq->email], ['id', '!=', $rq->id]])->get()->toArray() == null) {
                if ($rq->password == $rq->repassword) {
                    $customer->password = Hash::make($rq->password);
                    if ($customer->save()) {
                        echo $this->layMotKhachHangHTML($customer);
                    }
                } else {
                    echo 3;
                }
            } else {
                echo 2;
            }
        } else {
            echo 1;
        }
    }

    public function doiTrangThaiKhachHang(Request $rq)
    {
        $customer = UserModel::where('id', $rq->id)->first();
        $customer->status = $rq->status;
        if ($customer->save()) {
            echo $this->layTrangThaiKhachHangHTML($customer);
        }
    }

    public function xoaHinhKhachHangTheoID(Request $rq)
    {
    }

    public function xoaKhachHang(Request $rq)
    {
        $customer = UserModel::where('id', $rq->id)->first();
        if ($customer != null) {
            if ($customer->photo != '') {
                File::deleteDirectory(public_path('uploads' . "\\customer\\" . $rq->id));
            }
            $customer->delete();
        }
        $customerslist = UserModel::get()->sortBy('ordinal', SORT_REGULAR, true)->skip(($rq->page - 1) * 10)->take(10);
        echo $this->layKhachHangHTML($customerslist);
    }
























    private function layQuanTriHTML($list)
    {
        $data = '';
        if (count($list)) {
            foreach ($list as $k => $v) {
                $data .= '<tr data-id="' . $v['id'] . '">
                <td style="text-align: center;">' . $v['ordinal'] . '</td>
                <td>';
                if ($v['avatar'] != null) {
                    $data .= '<div class="pic m-auto" style="max-width: 50%"><img style="width:100%;aspect-ratio: 1/1;object-fit: cover;" src="../public/uploads/users/admins/' . $v['id'] . '/' . $v['avatar'] . '" alt=""></div>';
                } else {
                    $data .= '<div class="pic m-auto" style="max-width: 50%"><img style="width:100%;aspect-ratio: 1/1;object-fit: cover;"
                                                            src="../public/assets/images/noimage.png" alt=""></div>';
                }
                $data .= '</td>
                <td style="width: 10%;">' . $v['username'] . '</td>
                <td>' . $v['name'] . '</td>
                <td>' . $v['email'] . '</td>
                <td style="width: 9%;">' . $v['phone'] . '</td>
                <td>
        <div class="v-center change-status" ';
                $data .= $v['status'] == '0' || $v['status'] == null ? 'style=color:red' : ($v['status'] == '1' ? 'style=color:#39e339' : 'style=color:#193a97');
                $data .= '>
                        <div class="status-name">';
                $data .= $v['status'] == '0' || $v['status'] == null ? 'Chưa hoạt động' : ($v['status'] == '1' ? 'Đang hoạt động' : 'Khóa');
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
                    $data .= '<div class="value" style="color: #193a97" data-value="2">Khóa
                                </div>';
                }
                $data .= '</div>
                    </div>
                </td>
                <td class="white-space">
                <button class="btn btn-success update-admin" data-bs-toggle="tooltip"
                data-bs-placement="top" data-bs-custom-class="custom-tooltip"
                data-bs-title="Sửa"><i class="fa-solid fa-pen-field"></i></button>';
                if ($v['id'] != Auth::guard('admin')->user()->id) {
                    $data .= '<button class="btn btn-danger delete-admin" data-bs-toggle="tooltip"
                data-bs-placement="top" data-bs-custom-class="custom-tooltip"
                data-bs-title="Xóa"><i class="fa-regular fa-trash"></i></button>
                </td>
                </tr>';
                }
            }
        } else {
            $data .= '<tr>
                        <td colspan="11" class="text-center">Không có dữ liệu</td>
                      </tr>';
        }
        return $data;
    }

    private function layMotQuanTriHTML($admin)
    {
        $data = '
        <td style="text-align: center;">' . $admin['ordinal'] . '</td>
        <td>';
        if ($admin['avatar'] != null) {
            $data .= '<div class="pic m-auto" style="max-width: 50%"><img style="width:100%;aspect-ratio: 1/1;object-fit: cover;" src="../public/uploads/users/admins/' . $admin['id'] . '/' . $admin['avatar'] . '" alt=""></div>';
        } else {
            $data .= '<div class="pic m-auto" style="max-width: 50%"><img style="width:100%;aspect-ratio: 1/1;object-fit: cover;"
                                                    src="../public/assets/images/noimage.png" alt=""></div>';
        }
        $data .= '</td>
        <td>' . $admin['username'] . '</td>
        <td>' . $admin['name'] . '</td>
        <td>' . $admin['email'] . '</td>
        <td style="width: 9%;">' . $admin['phone'] . '</td>
        <td>';
        if ($admin['status'] != '-1') {
            $data .= '<div class="v-center change-status" ';
            $data .= $admin['status'] == '0' || $admin['status'] == null ? 'style=color:red' : ($admin['status'] == '1' ? 'style=color:#39e339' : 'style=color:#193a97');
            $data .= '>
                        <div class="status-name">';
            $data .= $admin['status'] == '0' || $admin['status'] == null ? 'Chưa hoạt động' : ($admin['status'] == '1' ? 'Đang hoạt động' : 'Khóa');
            $data .= '<div class="arrow">
            <svg width="14" height="7" viewBox="0 0 22 11" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path
                    d="M1.04991 1L1 1.04544L10.8361 9.99999L20.6721 1.04544L20.6222 1L10.8361 9.90911L1.04991 1Z"
                    fill="white" stroke="black" />
            </svg>
        </div>
        </div>
                        <div class="status-r">';
            if ($admin['status'] != 0) {
                $data .= '<div class="value" style="color: red" data-value="0">Chưa hoạt động
                                </div>';
            }
            if ($admin['status'] != 1) {
                $data .= '<div class="value" style="color: #39e339" data-value="1">Đang hoạt
                                    động
                                </div>';
            }
            if ($admin['status'] != 2) {
                $data .= '<div class="value" style="color: #193a97" data-value="2">Khóa
                                </div>';
            }
            $data .= '</div>
                    </div>
                ';
        }
        $data .= '</td><td class="white-space">
    <button class="btn btn-success update-admin" data-bs-toggle="tooltip"
        data-bs-placement="top" data-bs-custom-class="custom-tooltip"
        data-bs-title="Sửa"><i class="fa-solid fa-pen-field"></i></button>';
        if ($admin['id'] != Auth::guard('admin')->user()->id) {
            $data .= '
            <button class="btn btn-danger delete-admin" data-bs-toggle="tooltip"
                data-bs-placement="top" data-bs-custom-class="custom-tooltip"
                data-bs-title="Xóa"><i class="fa-regular fa-trash"></i></button>
                </td>';
        }
        return $data;
    }
    public function layTrangThaiQuanTriHTML($admin)
    {
        $data = '
            <div class="v-center change-status" ';
        $data .= $admin['status'] == '0' || $admin['status'] == null ? 'style=color:red' : ($admin['status'] == '1' ? 'style=color:#39e339' : 'style=color:#193a97');
        $data .= '>
                <div class="status-name">';
        $data .= $admin['status'] == '0' || $admin['status'] == null ? 'Chưa hoạt động' : ($admin['status'] == '1' ? 'Đang hoạt động' : 'Khóa');
        $data .= '<div class="arrow">
                <svg width="14" height="7" viewBox="0 0 22 11" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path
                        d="M1.04991 1L1 1.04544L10.8361 9.99999L20.6721 1.04544L20.6222 1L10.8361 9.90911L1.04991 1Z"
                        fill="white" stroke="black" />
                </svg>
            </div>
        </div>
                <div class="status-r">';
        if ($admin['status'] != 0) {
            $data .= '<div class="value" style="color: red" data-value="0">Chưa hoạt động
                        </div>';
        }
        if ($admin['status'] != 1) {
            $data .= '<div class="value" style="color: #39e339" data-value="1">Đang hoạt
                            động
                        </div>';
        }
        if ($admin['status'] != 2) {
            $data .= '<div class="value" style="color: #193a97" data-value="2">Khóa
                        </div>';
        }
        $data .= '</div>
            </div>';
        echo $data;
    }

    public function quanTriPagination(Request $rq)
    {
        $admins = AdminModel::where('status', '!=', '-1')->get();
        $adminslist = AdminModel::where('status', '!=', '-1')->get()->sortBy('ordinal', SORT_REGULAR, true)->skip(($rq->page - 1) * 10)->take(10);
        if (Auth::guard('admin')->check()) {
            if (Auth::guard('admin')->user()->status == '-1') {
                $adminslist = AdminModel::get()->sortBy('ordinal', SORT_REGULAR, true)->skip(($rq->page - 1) * 10)->take(10);
            }
        }
        $data = Functions::initpagination('quan-tri', $rq->page, 10, $admins, $adminslist);
        echo $data;
    }

    public function layQuanTri(Request $rq)
    {
        $adminslist = AdminModel::where('status', '!=', '-1')->get()->sortBy('ordinal', SORT_REGULAR, true)->skip(($rq->page - 1) * 10)->take(10);
        if (Auth::guard('admin')->check()) {
            if (Auth::guard('admin')->user()->status == '-1') {
                $adminslist = AdminModel::get()->sortBy('ordinal', SORT_REGULAR, true)->skip(($rq->page - 1) * 10)->take(10);
            }
        }
        return view('admin.accounts.admin', compact('adminslist'));
    }

    public function layQuanTriTheoId(Request $rq)
    {
        $admin = AdminModel::find($rq->id);
        $admin->desc = htmlspecialchars_decode($admin->desc);
        $admin->content = htmlspecialchars_decode($admin->content);
        echo $admin;
    }

    public function themQuanTri(Request $rq)
    {
        $lastitem = AdminModel::where('status', '!=', '-1')->get()->sortBy('ordinal')->last();
        if ($lastitem != null) {
            $lastnumb = $lastitem->ordinal + 1;
        } else {
            $lastnumb = 0;
        }
        $newAdmin = new AdminModel;
        $newAdmin->ordinal = $lastnumb;
        $newAdmin->name = $rq->name;
        $newAdmin->avatar = $rq->avatar;
        $newAdmin->username = $rq->username;
        $newAdmin->email = $rq->email;
        $newAdmin->phone = $rq->phone;
        $newAdmin->birthday = $rq->birthday;
        $newAdmin->address = $rq->address;
        $newAdmin->status = $rq->status;
        $newAdmin->permission = '1';
        if (AdminModel::whereRaw('LOWER(`username`) LIKE ? ', [trim(strtolower($rq->username)) . '%'])->get()->toArray() == null) {
            if (AdminModel::where('email', '=', $rq->email)->get()->toArray() == null) {
                if ($rq->password == $rq->repassword) {
                    $newAdmin->password = Hash::make($rq->password);
                    if ($newAdmin->save()) {
                        if ($rq->hasFile('photo')) {
                            $date = getdate();
                            $stringdate = $date['hours'] . $date['minutes'] . $date['seconds'] . $date['mday'] . $date['mon'] . $date['year'];
                            $file = $rq->file('photo');
                            $name = $file->getClientOriginalName();

                            $suffix = explode('.', $name);
                            $explain =  $stringdate . "." . $suffix[1];
                            $file->move(public_path('uploads') . '/users/admins/' . $newAdmin->id . '/', $explain);
                            $newAdmin->avatar = $explain;
                        }
                        $newAdmin->save();
                        $adminlist = AdminModel::where('status', '!=', '-1')->get()->sortBy('ordinal', SORT_REGULAR, true)->skip(($rq->page - 1) * 10)->take(10);
                        if (Auth::guard('admin')->check()) {
                            if (Auth::guard('admin')->user()->status == '-1') {
                                $adminlist = AdminModel::get()->sortBy('ordinal', SORT_REGULAR, true)->skip(($rq->page - 1) * 10)->take(10);
                            }
                        }
                        echo $this->layQuanTriHTML($adminlist);
                    }
                } else {
                    echo 3;
                }
            } else {
                echo 2;
            }
        } else {
            echo 1;
        }
    }

    public function suaQuanTri(Request $rq)
    {
        $admin = AdminModel::where('id', $rq->id)->get()->first();
        $admin->name = $rq->name;
        $admin->username = $rq->username;
        $admin->email = $rq->email;
        $admin->phone = $rq->phone;
        $admin->birthday = $rq->birthday;
        $admin->address = $rq->address;
        if ($admin->status != '-1') {
            $admin->status = $rq->status;
        }
        if ($rq->hasFile('photo')) {
            if ($admin->avatar != '') {
                unlink(public_path('uploads' . "\\users\\admins\\" . $admin->id . "\\" . $admin->avatar));
            }
            $date = getdate();
            $stringdate = $date['hours'] . $date['minutes'] . $date['seconds'] . $date['mday'] . $date['mon'] . $date['year'];
            $file = $rq->file('photo');
            $name = $file->getClientOriginalName();

            $suffix = explode('.', $name);
            $explain =  $stringdate . "." . $suffix[1];
            $file->move(public_path('uploads') . '/users/admins/' . $admin->id . '/', $explain);
            $admin->avatar = $explain;
        }
        if (AdminModel::where('id', '!=', $rq->id)->whereRaw('LOWER(`username`) LIKE ? ', [trim(strtolower($rq->username)) . '%'])->get()->toArray() == null) {
            if (AdminModel::where([['email', '=', $rq->email], ['id', '!=', $rq->id]])->get()->toArray() == null) {
                if ($rq->password == $rq->repassword) {
                    $admin->password = Hash::make($rq->password);
                    if ($admin->save()) {
                        echo $this->layMotQuanTriHTML($admin);
                    }
                } else {
                    echo 3;
                }
            } else {
                echo 2;
            }
        } else {
            echo 1;
        }
    }

    public function doiTrangThaiQuanTri(Request $rq)
    {
        $admin = AdminModel::where('id', $rq->id)->first();
        $admin->status = $rq->status;
        if ($admin->save()) {
            echo $this->layTrangThaiQuanTriHTML($admin);
        }
    }

    public function xoaHinhQuanTriTheoID(Request $rq)
    {
    }

    public function xoaQuanTri(Request $rq)
    {
        $admin = AdminModel::where('id', $rq->id)->first();
        if ($admin != null) {
            if ($admin->photo != '') {
                File::deleteDirectory(public_path('uploads' . "\\admin\\" . $rq->id));
            }
            $admin->delete();
        }
        $adminslist = AdminModel::where('status', '!=', '-1')->get()->sortBy('ordinal', SORT_REGULAR, true)->skip(($rq->page - 1) * 10)->take(10);
        echo $this->layQuanTriHTML($adminslist);
    }
}
