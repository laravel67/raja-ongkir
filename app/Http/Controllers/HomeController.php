<?php

namespace App\Http\Controllers;

use App\Models\Kota;
use App\Models\Kurir;
use App\Models\Provinsi;
use Illuminate\Http\Request;
use Kavist\RajaOngkir\Facades\RajaOngkir;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $provinces=$this->getProvince();
        $couriers=$this->getCourier();
        return view('home', compact('provinces', 'couriers'));
    }

    public function getProvince(){
        return Provinsi::pluck('title', 'code');
    }

    public function getCities($id){
        return Kota::where('province_code', $id)->pluck('title', 'code');
    }

    public function getSearchCities(Request $request)
    {
            $search = $request->search;
            if (empty($search)) {
                $cities = Kota::orderBy('title', 'asc')->select('id', 'title')->limit(5)->get();
            } else {
                $cities = Kota::orderBy('title', 'asc')->where('title', 'like', '%' . $search . '%')->select('id', 'title')->limit(5)->get();
            }
            $response = [];
            foreach ($cities as $city) {
                $response[] = [
                    'id' => $city->id,
                    'text' => $city->title,
                ];
            }
            return response()->json($response);
    }

    public function getCourier(){
        return Kurir::all();
    }

    public function store(Request $request){

        $courier=$request->input('courier');

        if ($courier) {
            $result=[];
            $data=[
                'origin'=> $this->getCity($request->city_origin),
                'destination'=> $this->getCity($request->city_destination),
                'weight'=> 1300,
                'result'=>[]
            ];
            foreach($courier as $row){
                $ongkir=RajaOngkir::ongkosKirim([
                    'origin'=>$request->city_origin,
                    'destination'=>$request->city_destination,
                    'weight'=>$data['weight'],
                    'courier'=>$row
                ])->get();
             $data['result'][]=$ongkir;
            }
            return view('costs')->with($data);
        }else{
            return redirect()->back();
        }
    }

    public function getCity($code){
        return Kota::where('code', $code)->first();
    }

}