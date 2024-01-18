<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Desert;
use Illuminate\Support\Facades\Http;

class CofeeController extends Controller
{
    public function index($kategori){

        if($kategori == 'hot' ||  'iced'){

            $cofee = Http::get('https://api.sampleapis.com/coffee/'.$kategori);

            return json_decode($cofee);
        }

        return "Kategori Tidak ada";
    }

    public function allMenu(){


            $ice = json_decode(Http::get('https://api.sampleapis.com/coffee/iced'));
            $hot = json_decode(Http::get('https://api.sampleapis.com/coffee/hot'));
            $dessert =Desert::get();

            $data =[
                'Dessert'=>$dessert,
                'Ice Cofee'=>$ice,
                'Hot Cofee'=>$hot,
            ];

            return $data;
    }
}
