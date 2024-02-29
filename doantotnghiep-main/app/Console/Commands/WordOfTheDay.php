<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Http\Controllers\HomeController;
use App\Models\UserModel;
use App\Models\RoomsModel;
use App\Models\PhonThueModel;
use App\Models\PasswordResetModel;
use App\Models\PhongDichVuModel;
use App\Models\ContractsModel;
use App\Models\ReportModel;
use App\Models\ServicesModel;
use App\Models\Book;
use App\Mail\thongBaoThuTien;
use Illuminate\Support\Facades\Mail;

class WordOfTheDay extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'word:day';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send a Daily email to all users with a word and its meaning';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $func = new HomeController;
        $alluser =   new UserModel;
        $allroom =   new RoomsModel;
        $getAllUser = $alluser->get();
        $getAllRoom = $allroom->get();
        foreach ($getAllUser as $num => $user) {
            foreach ($getAllRoom as $numr => $room) {
                $allDate = $func->tinhNgayThanhToanTiepTheo($room->id, $user->id);
                if ($allDate != null) {
                    if ($allDate['songayconlai'] <= 5) {
                        if ($allDate['songayconlai'] < 0) {
                            $room->status = 0;
                        }
                        if ($allDate['songayconlai'] < -5) {
                            $room->status = 1;
                        }
                        $room->save();
                        $mailData = [
                            'title' => 'Xin chào' . $user->name,
                            'body' => 'Bạn có phòng hiện tại cần thanh toán với số tiền ' . $room->price . ' cho phòng ' . $room->name,
                            'email' => $user->email
                        ];
                        Mail::to($user->email)->send(new thongBaoThuTien($mailData));
                    }
                }
            }
        }
    }
}
