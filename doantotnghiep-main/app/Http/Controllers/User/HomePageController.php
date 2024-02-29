<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use App\Models\UserModel;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Models\RoomsModel;
use Illuminate\Support\Facades\DB;

class HomepageController extends Controller
{
   public function timkiem(Request $rq)
   {
      $searchTerm = $rq->search;
      $allRooms = DB::table('table_phong')->where([['name', 'LIKE', "%{$searchTerm}%"],['status','=',1]])->get();
      return view('templates.layouts.search', compact('allRooms'));
   }

   public function locPhong(Request $rq)
   {
      (int)$searchTerm = $rq->rp;
      $searchType = $rq->type;
      $searchDau = $rq->dau;
      if($searchType == 'gia'&& $searchDau=='duoi')
      {
         $allRooms = DB::table('table_phong')->where([['price', '<=', $searchTerm],['status','=',1]])->get();
      }
      if($searchType == 'gia'&& $searchDau=='tren')
      {
         $allRooms = DB::table('table_phong')->where([['price', '>=', $searchTerm],['status','=',1]])->get();
      }
      if($searchType == 'dien-tich'&& $searchDau=='tren')
      {
         $allRooms = DB::table('table_phong')->where([['area', '>=', (int)$searchTerm],['status','=',1]])->get();
      }
      if($searchType == 'dien-tich'&& $searchDau=='duoi')
      {
         $allRooms = DB::table('table_phong')->where([['area', '<=', (int)$searchTerm],['status','=',1]])->get();
      }
     
      return view('templates.layouts.search', compact('allRooms'));
   }
}
