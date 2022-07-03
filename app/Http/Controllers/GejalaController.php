<?php

namespace App\Http\Controllers;

use App\Models\Gejala;
use Illuminate\Http\Request;

class GejalaController extends Controller
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
        $models = Gejala::orderBy('id');

        if ($search) {
            $models = $models->where('deskripsi', 'LIKE', "%$search%");
        }

        $models = $models->get();

        return view('gejala.list', compact('models', 'search'));
    }

    public function add()
    {
        return view('gejala.add');
    }

    public function store(Request $request)
    {
        $model = new Gejala();
        $model->fill($request->all());
        $model->save();

        return redirect()->route('gejalaList');
    }

    public function view($id)
    {
        $model = Gejala::where('id', $id)->first();

        return view('gejala.view', compact('model'));
    }

    public function edit(Request $request)
    {
        $model = Gejala::where('id', $request->id)->first();
        $model->fill($request->all());
        $model->save();

        return redirect()->route('gejalaList');
    }

    public function delete($id)
    {
        $model = Gejala::where('id', $id)->first();
        $model->delete();

        return redirect()->route('gejalaList');
    }
}
