<?php

namespace App\Http\Controllers;
use App\Aluno;

use App\Http\Requests\AlunoRequest;

class AlunosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $alunos=Aluno::all();
       return view("alunos.index",compact('alunos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('alunos.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AlunoRequest $request)
    {
        
        Aluno::create($request->all() );
        \Session::flash('mensagem', ['type' => 'success', 'conteudo' => trans('messages.actionCreate')]);
        return redirect('alunos');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return "show";
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Aluno $aluno)
    {
        
        return view('alunos.edit',compact('aluno'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Aluno  $aluno
     * @return \Illuminate\Http\Response
     */
    public function update(AlunoRequest $request, Aluno $aluno)
    {
       
        
        $aluno->update($request->all());
        \Session::flash('mensagem', ['type' => 'success', 'conteudo' => trans('messages.actionUpdate')]);
        return redirect()->route('alunos.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Aluno $aluno)
    {
        
        $aluno->delete();
        \Session::flash('mensagem', ['type' => 'success', 'conteudo' => trans('messages.actionDelete')]);
        return redirect()->route('alunos.index');
    }
    
   
}
