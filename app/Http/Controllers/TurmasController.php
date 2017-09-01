<?php

namespace App\Http\Controllers;

use App\Turma;
use App\Http\Requests\TurmaRequest;

class TurmasController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $turmas = Turma::all();
        return view("turmas.index", compact('turmas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $dados = [
             'teachers' => \App\Teacher::pluck('nome', 'id')
        ];
        return view('turmas.create',$dados);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TurmaRequest $request)
    {
        Turma::create($request->all());
        \Session::flash('mensagem', ['type' => 'success', 'conteudo' => trans('messages.actionCreate')]);
        return redirect('turmas');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Turma  $turma
     * @return \Illuminate\Http\Response
     */
    public function show(Turma $turma)
    {
        //
    }
    
    public function showGrade()
    {
        $dados['grade']=Turma::grade();
        return view('turmas.grade',$dados);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Turma  $turma
     * @return \Illuminate\Http\Response
     */
    public function edit(Turma $turma)
    {
        $dados = [
            'turma' => $turma,
            'teachers' => \App\Teacher::pluck('nome', 'id')
        ];

        return view('turmas.edit', $dados);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Turma  $turma
     * @return \Illuminate\Http\Response
     */
    public function update(TurmaRequest $request, Turma $turma)
    {
        $turma->update($request->all());
        \Session::flash('mensagem', ['type' => 'success', 'conteudo' => trans('messages.actionUpdate')]);
        return redirect()->route('turmas.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Turma  $turma
     * @return \Illuminate\Http\Response
     */
    public function destroy(Turma $turma)
    {
        $retorno = $turma->verifyAndDelete();
        if ($retorno):
            \Session::flash('mensagem', ['type' => 'success', 'conteudo' => trans('messages.actionDelete')]);
        endif;
        return redirect()->route('turmas.index');
    }

}
