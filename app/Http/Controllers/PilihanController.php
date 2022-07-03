<?php

namespace App\Http\Controllers;

use App\Models\Pilihan;
use Illuminate\Http\Request;

class PilihanController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function list(Request $request)
    {
        $search = $request->search;
        $models = Pilihan::orderBy('id');

        if ($search) {
            $models = $models->where('nama', 'LIKE', "%$search%");
        }

        $models = $models->get();

        return view('pilihan.list', compact('models', 'search'));
    }

    public function add()
    {
        return view('pilihan.add');
    }

    public function store(Request $request)
    {
        $model = new Pilihan();
        $model->fill($request->all());
        $model->save();

        return redirect()->route('pilihanList');
    }

    public function view($id)
    {
        $model = Pilihan::where('id', $id)->first();

        return view('pilihan.view', compact('model'));
    }

    public function edit(Request $request)
    {
        $model = Pilihan::where('id', $request->id)->first();
        $model->fill($request->all());
        $model->save();

        return redirect()->route('pilihanList');
    }

    public function delete($id)
    {
        $model = Pilihan::where('id', $id)->first();
        $model->delete();

        return redirect()->route('pilihanList');
    }
}
