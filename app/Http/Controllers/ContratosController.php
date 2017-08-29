<?php

namespace App\Http\Controllers;

use App\Contrato;
use Illuminate\Http\Request;
use App\Http\Requests\ContratoRequest;

class ContratosController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $st = \Request::get('st');

        if ($st == null):
            $st = 1;
        endif;
        $contratos = Contrato::where('ativo', $st)->get();
        return view("contratos.index", compact('contratos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $dados = [

            'alunos' => \App\Aluno::pluck('nome', 'id'),
            'turmas' => \App\Turma::pluck('descricao', 'id'),
        ];
        return view('contratos.create', $dados);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ContratoRequest $request)
    {
        $requisicao = $request->all();
        $requisicao['ativo'] = 1;
        $contrato = Contrato::create($requisicao);

        \Session::flash('mensagem', ['type' => 'success', 'conteudo' => trans('messages.actionCreate')]);
        if ($request->input('fechar') == 1):
            return redirect()->route('contratos.index');
        endif;
        return redirect("contratos/$contrato->id/edit");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Contrato  $contrato
     * @return \Illuminate\Http\Response
     */
    public function show(Contrato $contrato)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Contrato  $contrato
     * @return \Illuminate\Http\Response
     */
    public function edit(Contrato $contrato)
    {
        //dd($contrato->getMensalidades());

        $dados = [
            'contrato' => $contrato,
            'alunos' => \App\Aluno::pluck('nome', 'id'),
            'turmas' => \App\Turma::pluck('descricao', 'id'),
        ];
        return view('contratos.edit', $dados);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Contrato  $contrato
     * @return \Illuminate\Http\Response
     */
    public function update(ContratoRequest $request, Contrato $contrato)
    {

        $contrato->update($request->all());
        \Session::flash('mensagem', ['type' => 'success', 'conteudo' => trans('messages.actionUpdate')]);
        if ($request->input('fechar') == 1):
            return redirect()->route('contratos.index');
        endif;
        return back()->withInput();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Contrato  $contrato
     * @return \Illuminate\Http\Response
     */
    public function destroy(Contrato $contrato)
    {
        $retorno = $contrato->verifyAndDelete();
        if ($retorno):
            \Session::flash('mensagem', ['type' => 'success', 'conteudo' => trans('messages.actionDelete')]);
        endif;
        return redirect('contratos');
    }

    public function desativar(Request $request, Contrato $contrato)
    {
        $retorno = $contrato->desativar($request->all());
        if ($retorno):
            \Session::flash('mensagem', ['type' => 'success', 'conteudo' => trans('messages.actionDesativar')]);
        else:
            \Session::flash('mensagem', ['type' => 'danger', 'conteudo' => 'Não foi possível desativar']);
        endif;
        return redirect('contratos');
    }

}
