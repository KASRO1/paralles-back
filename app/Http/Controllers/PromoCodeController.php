<?php

namespace App\Http\Controllers;

use App\Models\Promocode;
use Illuminate\Http\Request;
use App\Models\Promo;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;


class PromoCodeController extends Controller
{
    //

    public function indexAdmin(){
        $promos = Promo::all();
        return view("promocode", ["promos" => $promos]);
    }
    public function create(Request $request){
        $validator = Validator::make($request->all(), [
            'promocode' => 'required|unique:promos,promo',
            'worker_tg' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 401);
        }

        $promo = new Promo();
        $promo->promo = $request->promocode;
        $promo->worker_tg = $request->worker_tg;
        $promo->save();

        return response()->json(['message' => 'Promocode created successfully'], 201);
    }
    public function delete($promo){
        $promo = Promo::where("promo", $promo)->first();
        if($promo){
            $promo->delete();

        }
        return redirect()->route("admin.promocode");
    }
    public function auth($auth){

        if(env("auth_token") == $auth){

            session(['auth' => $auth]);
            redirect()->route("admin.promocode");
        }
    }

    public function checkPromo($promo)
    {
        $promo = Promo::where("promo", $promo)->first();
        if($promo){
            return response()->json(['message' => 'Promocode is valid', "exist" => true], 200);
        }
        return response()->json(['message' => 'Promocode is invalid', "exist" => false], 401);
    }
}
