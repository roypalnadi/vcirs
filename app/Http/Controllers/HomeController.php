<?php

namespace App\Http\Controllers;

use App\Models\Gejala;
use App\Models\Narasumber;
use App\Models\Pilihan;
use App\Models\PilihanNarasumber;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $modelGejala = Gejala::orderBy('id')->get();
        $modelPilihan = Pilihan::all();

        return view('narasumber.index', compact('modelGejala', 'modelPilihan'));
    }

    public function save(Request $request)
    {
        $modelGejala = Gejala::orderBy('id')->get();
        $modelPilihan = Pilihan::all();

        $model = new Narasumber();
        $model->nama = $request->name ?? null;
        $model->save();

        foreach ($modelGejala as $key => $gejala) {
            $pilihan = $modelPilihan->where('id', $request->pilihan[$key])->first();

            $data = new PilihanNarasumber();
            $data->gejala_id = $gejala->id;
            $data->pilihan_id = $gejala->id;
            $data->nilai_user = $pilihan->nilai;
            $data->nilai_pakar = $gejala->nilai_pakar;
            $data->narasumber_id = $model->id;
            $data->save();
        }

        return redirect()->route('result', ['id' => $model->id]);
    }

    public function result(Request $request)
    {
        $result = $this->proses($request->id);

        return view('narasumber.result', compact('result'));
    }

    public function proses($id)
    {
        return Vcirs::proses($id);
    }
}
