<?php

namespace App\Http\Controllers;

use App\Models\Curso;
use Illuminate\Http\Request;
use App\Models\Professor;
use App\Models\Disciplina;
use App\Models\Docencia;


class DocenciaController extends Controller
{

    public function index()
    {

        $cursos  = Curso::with(['eixo']);

        $disciplinas = Disciplina::with(['curso'])
            ->orderBy('curso_id')->orderBy('id')->get();

        $profs = Professor::orderBy('id')->get();

        return view('docencias.index', compact(['profs', 'disciplinas', 'cursos']));
    }

    public function create(Request $request)
    {
    }

    public function store(Request $request)
    {

        $rules = [
            'PROFESSOR_ID_SELECTED' => 'required',
        ];
        $msgs = [
            "required" => "O preenchimento do campo [:attribute] é obrigatório!",
            "max" => "O campo [:attribute] possui tamanho máximo de [:max] caracteres!",
            "min" => "O campo [:attribute] possui tamanho mínimo de [:min] caracteres!",
        ];

        $request->validate($rules, $msgs);

        $ids_prof = $request->PROFESSOR_ID_SELECTED;
        $disciplina = $request->DISCIPLINA;


        for ($i = 0; $i < count($request->DISCIPLINA); $i++) {

            $disciplina = Disciplina::find($disciplina[$i]);
            $professor = Professor::find($ids_prof[$i]);


            if (isset($disciplina) && isset($professor)) {

                $vinculo = Docencia::where('disciplina_id', $disciplina->id)->where('professor_id', $professor->id)->get();

                if (isset($vinculo)) {
                    Docencia::destroy($disciplina->id,$professor->id);
                }
                
                $doc = new Docencia();

                $doc->disciplina()->associate($disciplina);
                $doc->professor()->associate($professor);
                $doc->save();
            }
        }

        return redirect()->route('disciplinas.index');
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
