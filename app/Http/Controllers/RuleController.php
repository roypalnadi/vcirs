<?php

namespace App\Http\Controllers;

use App\Models\Gejala;
use App\Models\Penyakit;
use App\Models\Rule;
use Illuminate\Http\Request;

class RuleController extends Controller
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
        $models = Rule::orderBy('id')
            ->join('penyakit', 'rule.penyakit_id', 'penyakit.id')
            ->join('gejala', 'rule.gejala_id', 'gejala.id')
            ->orderBy('id')
            ->select('rule.id', 'penyakit.nama as nama_penyakit', 'gejala.deskripsi as deskripsi_gejala');

        if ($search) {
            $models = $models->where('penyakit.nama', 'LIKE', "%$search%")
                ->orWhere('gejala.deskripsi', 'LIKE', "%$search%");
        }

        $models = $models->get();

        return view('rule.list', compact('models', 'search'));
    }

    public function add()
    {
        $modelPenyakit = Penyakit::all();
        $modelGejala = Gejala::all();

        return view('rule.add', compact('modelPenyakit', 'modelGejala'));
    }

    public function store(Request $request)
    {
        $model = new Rule();
        $model->fill($request->all());
        $model->save();

        return redirect()->route('ruleList');
    }

    public function view($id)
    {
        $model = Rule::where('id', $id)->first();
        $modelPenyakit = Penyakit::all();
        $modelGejala = Gejala::all();

        return view('rule.view', compact('model', 'modelGejala', 'modelPenyakit'));
    }

    public function edit(Request $request)
    {
        $model = Rule::where('id', $request->id)->first();
        $model->fill($request->all());
        $model->save();

        return redirect()->route('ruleList');
    }

    public function delete($id)
    {
        $model = Rule::where('id', $id)->first();
        $model->delete();

        return redirect()->route('ruleList');
    }
}
