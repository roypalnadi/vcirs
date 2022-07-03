<?php

namespace App\Http\Controllers;

use App\Models\Penyakit;
use Illuminate\Http\Request;

class PenyakitController extends Controller
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
        $models = Penyakit::orderBy('id');

        if ($search) {
            $models = $models->where('nama', 'LIKE', "%$search%");
        }

        $models = $models->get();

        return view('penyakit.list', compact('models', 'search'));
    }

    public function add()
    {
        return view('penyakit.add');
    }

    public function store(Request $request)
    {
        $model = new Penyakit();
        $model->fill($request->all());
        $model->save();

        return redirect()->route('penyakitList');
    }

    public function view($id)
    {
        $model = Penyakit::where('id', $id)->first();

        return view('penyakit.view', compact('model'));
    }

    public function edit(Request $request)
    {
        $model = Penyakit::where('id', $request->id)->first();
        $model->fill($request->all());
        $model->save();

        return redirect()->route('penyakitList');
    }

    public function delete($id)
    {
        $model = Penyakit::where('id', $id)->first();
        $model->delete();

        return redirect()->route('penyakitList');
    }
}
