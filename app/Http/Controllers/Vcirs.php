<?php

namespace App\Http\Controllers;

use App\Models\Gejala;
use App\Models\Narasumber;
use App\Models\Penyakit;
use App\Models\PilihanNarasumber;
use App\Models\Rule;

class Vcirs extends Controller
{
    public $id = 1;
    public $modelRule;
    public $modelGejala;
    public $rule;
    public $vur = [];
    public $nur = 0;
    public $rur = 0;
    public $nilaiCf = [];
    public $result = [];
    public $txt = [];

    public static function proses($id)
    {
        $proses = new self();
        $proses->id = $id;
        $proses->prepare();
        $proses->rulePenyakit();
        $proses->vur();
        $proses->nur();
        $proses->rur();
        $proses->cf();
        $proses->conclusion();

        return $proses;
    }

    public function prepare()
    {
        $this->modelRule = Rule::join('penyakit', 'penyakit.id', 'rule.penyakit_id')
            ->join('gejala', 'gejala.id', 'rule.gejala_id')
            ->select('rule.*', 'penyakit.kode as kode_penyakit', 'gejala.kode as kode_gejala')
            ->get();

        $this->modelGejala = Gejala::get();
    }

    public function rulePenyakit()
    {
        $this->rule = [];
        foreach ($this->modelGejala ?? [] as $key => $gejala) {
            $rules = $this->modelRule->where('gejala_id', $gejala->id);
            $non = $rules->count();
            $use = $rules->implode('kode_penyakit', ', ');
            $order = $key + 1;

            $this->rule[] = [
                'variabel' => $gejala->nama,
                'num_of_node' => $non,
                'node_digunakan' => $use,
                'urutan' => $order,
                'gejala_id' => $gejala->id,
            ];
        }
    }

    public function vur()
    {
        $rules = collect($this->rule);
        foreach ($this->modelGejala ?? [] as $gejala) {
            $rule = $rules->where('gejala_id', $gejala->id)->first();
            $non = $rule['num_of_node'] ?? 0;
            $urutan = $rule['urutan'] ?? 0;
            $sum = $this->modelGejala->count() ?? 0;

            $vur = $non * ($non * ($urutan / $sum));

            $this->vur[] = [
                'gejala_id' => $gejala->id,
                'nama' => $gejala->nama,
                'kode' => $gejala->kode,
                'vur' => $vur,
            ];
        }
    }

    public function nur()
    {
        $vur = collect($this->vur);

        $totalVur = $vur->sum('vur');

        $totalGejala = $this->modelGejala->count();

        $this->nur = $totalVur / $totalGejala;
    }

    public function rur()
    {
        $totalGejala = $this->modelGejala->count();

        $this->rur = $this->nur / $totalGejala;
    }

    public function cf()
    {
        $modelNilai = PilihanNarasumber::where('narasumber_id', $this->id)->get();

        foreach ($this->modelGejala ?? [] as $key => $gejala) {
            $nilai = $modelNilai->where('gejala_id', $gejala->id)->first();

            $cf = 0;
            if ($nilai) {
                $cf = $nilai->nilai_user * $nilai->nilai_pakar * $this->rur;
            }

            $this->nilaiCf[] = [
                'gejala_id' => $gejala->id,
                'nama' => $gejala->nama,
                'cf' => $cf,
            ];
        }
        // dd($this->nilaiCf);
    }

    public function conclusion()
    {
        $nilaiCf = collect($this->nilaiCf);
        $this->modelRule->groupBy('penyakit_id')->map(function ($models, $penyakitId) use ($nilaiCf) {
            $penjumlah = 0;
            $nilai = 0;
            foreach ($models as $model) {
                $cf = $nilaiCf->where('gejala_id', $model->gejala_id)->first();
                $hasilCf = $cf['cf'] ?? 0;
                $nilai = $penjumlah + ($hasilCf * (1 - $penjumlah));
                $penjumlah = $nilai;
            }

            $nilai = round($nilai, 8);

            $this->result[] = [
                'penyakit_id' => $penyakitId,
                'kode' => $models->first()->kode_penyakit,
                'nilai' => $nilai,
                'persen' => $nilai * 100,
            ];
        });

        $penyakit = collect($this->result)->sortByDesc('nilai')->first();
        $modelPenyakit = Penyakit::where('id', $penyakit['penyakit_id'])->first();

        $this->txt = [
            'nama' => $modelPenyakit->nama,
            'nilai' => round($penyakit['persen'] ?? 0, 2),
        ];

        $modelNarasumber = Narasumber::where('id', $this->id)->first();
        if ($modelNarasumber) {
            $modelNarasumber->penyakit_id = $modelPenyakit->id ?? null;
            $modelNarasumber->save();
        }
    }
}
