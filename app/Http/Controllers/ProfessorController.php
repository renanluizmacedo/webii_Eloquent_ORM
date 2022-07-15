<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Professor;
use App\Models\Eixo;


class ProfessorController extends Controller {
    
    public function index() {
        
        $data = Professor::with(['eixo'])->orderBy('nome')->get();
        // return json_encode($data);
        return view('professores.index', compact(['data']));   
    }

    public function create() {

        $eixos = Eixo::orderBy('nome')->get();
        // return json_encode($data);
        return view('professores.create', compact(['eixos']));   
    }

    public function validation(Request $request, $type) {

        if($type == 0) {
            $rules = [
                'nome' => 'required|max:100|min:5',
                'email' => 'required|unique:professors',
                'siape' => 'required|max:7|min:7',
                'eixo' => 'required',
            ];
        }
        else {
            $rules = [
                'nome' => 'required|max:100|min:5',
                'email' => 'required',
                'siape' => 'required|max:7|min:7',
                'eixo' => 'required',
            ];
        }
        $msgs = [
            "required" => "O preenchimento do campo [:attribute] é obrigatório!",
            "max" => "O campo [:attribute] possui tamanho máximo de [:max] caracteres!",
            "min" => "O campo [:attribute] possui tamanho mínimo de [:min] caracteres!",
            "unique" => "O campo [:attribute] pode ter apenas um único registro!"
        ];

        $request->validate($rules, $msgs);
    }

    public function store(Request $request) {
        
        $total = Professor::where('nome', mb_strtoupper($request->nome, 'UTF-8'))
            ->where('siape', $request->siape)
            ->count();

        if($total > 0) {
            $msg = "Professor";
            $link = "professores.index";
            return view('erros.duplicado', compact(['msg', 'link']));
        }


        $eixo = Eixo::find($request->eixo);
        if(isset($eixo)) {

            $obj = new Professor();
            $obj->nome = mb_strtoupper($request->nome, 'UTF-8');   
            $obj->email = mb_strtolower($request->email, 'UTF-8');
            $obj->siape = $request->siape;
            $obj->ativo = $request->radio;


            $obj->eixo()->associate($eixo);
            $obj->save();
            return redirect()->route('professores.index');
        }

        $msg = "Eixo e/ou Tipo Usuário";
        $link = "professores.index";
        return view('erros.id', compact(['msg', 'link']));
    }

    public function show($id) { }

    public function edit($id) {
        
        $eixos = Eixo::orderBy('nome')->get();
        $data = Professor::with(['eixo'])->find($id);
        if(isset($data)) {
            return view('professores.edit', compact(['data', 'eixos']));
        }
        else {
            $msg = "Professor";
            $link = "professores.index";
            return view('erros.id', compact(['msg', 'link']));
        }
    }

    public function update(Request $request, $id) {
        
        $eixo = Eixo::find($request->eixo);
        $obj_prof = Professor::find($id);
        if(isset($eixo) && isset($obj_prof)) {


        $obj_prof->nome = mb_strtoupper($request->nome, 'UTF-8');   
        $obj_prof->email = mb_strtolower($request->email, 'UTF-8');
        $obj_prof->siape = $request->siape;

        $obj_prof->eixo()->associate($eixo);
        $obj_prof->save();
        return redirect()->route('professores.index');

        }
    }

    public function destroy($id) { }
}


/* Nível de acesso
    0 - Professor 
    1 - Técnico
    2 - Coordenador (Professor + Coordenador)
    3 - Admin/Diretor (Professor + Diretor)
*/    