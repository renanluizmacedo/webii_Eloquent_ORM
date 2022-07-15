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

        // return json_encode($data);
        return view('docencias.index', compact(['profs', 'disciplinas', 'cursos']));
    }

    public function create(Request $request)
    {
    }

    public function store(Request $request)
    {


        $ids_prof = $request->PROFESSOR_ID_SELECTED;
        $disciplina = $request->DISCIPLINA;

        $doc = new Docencia();

        for($i = 0;$i<count($ids_prof);$i++){
            $doc->professor_id = $ids_prof[$i];
            $doc->disciplina_id = $disciplina[$i];
            $doc->ano = '';
            $doc->save();
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
        //
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
