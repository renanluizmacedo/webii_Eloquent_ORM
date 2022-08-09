<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Eixo;

class EixoController extends Controller
{

    public function index()
    {

        $data = Eixo::orderBy('nome')->get();
        return view('eixos.index', compact(['data']));
    }

    public function create()
    {
        return view('eixos.create');
    }

    public function validation(Request $request)
    {
        $rules = [
            'nome' => 'required|max:50|min:10',
        ];
        $msgs = [
            "required" => "O preenchimento do campo [:attribute] é obrigatório!",
            "max" => "O campo [:attribute] possui tamanho máximo de [:max] caracteres!",
            "min" => "O campo [:attribute] possui tamanho mínimo de [:min] caracteres!",
        ];

        $request->validate($rules, $msgs);
    }

    public function store(Request $request)
    {

        self::validation($request);

        Eixo::create(['nome' =>  mb_strtoupper($request->nome, 'UTF-8')]);

        return redirect()->route('eixos.index');
    }

    public function show($id)
    {
    }

    public function edit($id)
    {

        $data = Eixo::find($id);

        if (isset($data)) {
            return view('eixos.edit', compact(['data']));
        }
    }

    public function update(Request $request, $id)
    {

        self::validation($request);

        $obj = Eixo::find($id);
        if (isset($obj)) {
            $obj->nome = mb_strtoupper($request->nome, 'UTF-8');
            $obj->save();
        }

        return redirect()->route('eixos.index');
    }

    public function destroy($id)
    {

        $obj = Eixo::find($id);

        if (isset($obj)) {
            $obj->delete();
        }

        return redirect()->route('eixos.index');
    }
}
