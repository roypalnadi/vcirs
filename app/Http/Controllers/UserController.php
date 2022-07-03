<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
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
    public function index()
    {
        return view('home');
    }

    public function list(Request $request)
    {
        $search = $request->search;
        $models = User::orderBy('id');

        if ($search) {
            $models = $models->where('name', 'LIKE', "%$search%");
        }

        $models = $models->get();

        return view('user', compact('models', 'search'));
    }

    public function add()
    {
        return view('add');
    }

    public function store(Request $request)
    {
        $model = new User();
        $model->fill($request->all());
        $model->password = Hash::make($request->password);
        $model->save();

        return redirect()->route('userList');
    }

    public function view($id)
    {
        $model = User::where('id', $id)->first();

        return view('view', compact('model'));
    }

    public function edit(Request $request)
    {
        $model = User::where('id', $request->id)->first();
        $model->fill($request->all());
        $model->password = Hash::make($request->password);
        $model->save();

        return redirect()->route('userList');
    }

    public function delete($id)
    {
        $model = User::where('id', $id)->first();
        $model->delete();

        return redirect()->route('userList');
    }
}
