<?php

namespace App\Http\Controllers;

use App\Models\Gejala;
use App\Models\Penyakit;
use App\Models\Rule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function listV2(Request $request)
    {
        $search = $request->search;
        $models = Penyakit::orderBy('rule.id')
            ->join('rule', 'rule.penyakit_id', 'penyakit.id')
            ->join('gejala', 'rule.gejala_id', 'gejala.id')
            ->groupBy('penyakit.id')
            ->select(DB::raw('penyakit.id as penyakit_id, MIN(penyakit.nama) as penyakit_nama, GROUP_CONCAT(gejala.kode) as gejala_kode'));

        if ($search) {
            $models = $models->where('penyakit.nama', 'LIKE', "%$search%");

            $rule = Rule::where('gejala.kode', 'LIKE', "%$search%")
                ->join('gejala', 'rule.gejala_id', 'gejala.id')->pluck('penyakit_id');

            if ($rule) {
                $models = $models->orWhereIn('penyakit.id', $rule);
            }
        }

        $models = $models->get();

        if ($request->error) {
            toastr()->error($request->error);
        }

        return view('rule.listV2', compact('models', 'search'));
    }

    public function add()
    {
        $modelPenyakit = Penyakit::all();
        $modelGejala = Gejala::all();

        return view('rule.add', compact('modelPenyakit', 'modelGejala'));
    }

    public function addV2()
    {
        $ids = Rule::groupBy('penyakit_id')->select('penyakit_id')->pluck('penyakit_id');

        $modelPenyakit = Penyakit::whereNotIn('id', $ids)->get();
        $modelGejala = Gejala::all();

        if (sizeof($modelPenyakit) == 0) {
            return redirect()->route('ruleList', [
                'error' => 'Data Penyakit Sudah Digunakan Semua',
            ]);
        }

        return view('rule.addV2', compact('modelPenyakit', 'modelGejala'));
    }

    public function store(Request $request)
    {
        $model = new Rule();
        $model->fill($request->all());
        $model->save();

        return redirect()->route('ruleList');
    }

    public function storeV2(Request $request)
    {
        if ($request->gejala) {
            foreach ($request->gejala as $gejala) {
                $model = new Rule();
                $model->fill($request->all());
                $model->gejala_id = $gejala;
                $model->save();
            }

            return redirect()->route('ruleList');
        }

        return redirect()->route('ruleList', ['error' => 'Gagal Menambahkan Data, Gejala Tidak Dipilih']);
    }

    public function view($id)
    {
        $model = Rule::where('id', $id)->first();
        $modelPenyakit = Penyakit::all();
        $modelGejala = Gejala::all();

        return view('rule.view', compact('model', 'modelGejala', 'modelPenyakit'));
    }

    public function viewV2($id)
    {
        $modelRule = Rule::where('penyakit_id', $id)->get();
        $modelPenyakit = Penyakit::all();
        $modelGejala = Gejala::all();

        $modelGejala->map(function ($model) use ($modelRule) {
            $check = $modelRule->where('gejala_id', $model->id)->first();
            $model['checked'] = $check ? true : false;
        });

        return view('rule.viewV2', compact('modelGejala', 'modelPenyakit', 'id'));
    }

    public function edit(Request $request)
    {
        $model = Rule::where('id', $request->id)->first();
        $model->fill($request->all());
        $model->save();

        return redirect()->route('ruleList');
    }

    public function editV2(Request $request)
    {
        if ($request->gejala) {
            $model = Rule::where('penyakit_id', $request->id)->delete();

            foreach ($request->gejala as $gejala) {
                $model = new Rule();
                $model->penyakit_id = $request->id;
                $model->gejala_id = $gejala;
                $model->save();
            }

            return redirect()->route('ruleList');
        }

        return redirect()->route('ruleList', ['error' => 'Terjadi Kesalahan, Gejala Tidak Dipilih']);
    }

    public function delete($id)
    {
        $model = Rule::where('id', $id)->first();
        $model->delete();

        return redirect()->route('ruleList');
    }

    public function deleteV2($id)
    {
        $model = Rule::where('penyakit_id', $id)->delete();

        return redirect()->route('ruleList');
    }
}
