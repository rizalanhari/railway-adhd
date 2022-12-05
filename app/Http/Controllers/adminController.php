<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class adminController extends Controller
{
    public function index()
    {
        return view('admin.home');
        // return view('login.main');
    }
    public function data()
    {
        $dataTrain = Http::get('http://127.0.0.1:5000/datatrain');
        $dataTrain = json_decode($dataTrain, true);
        $dataTest = Http::get('http://127.0.0.1:5000/datatest');
        $dataTest = json_decode($dataTest, true);
        return view('admin.data')->with('dataTrain', $dataTrain)->with('dataTest', $dataTest);
    }
    public function predict()
    {
        return view('admin.predict');
    }
    public function storepredict(Request $request)
    {
        $response = Http::get('http://127.0.0.1:5000/predictA', [
            'train' => $request->input('train'),
            'test' => $request->input('test'),
            'lrate' => $request->input('lrate'),
            'neuronh' => $request->input('neuronh'),
        ]);
        $response = json_decode($response, true);
        // dd($response);
        return view('admin.result')->with('result', $response);
    }
}
