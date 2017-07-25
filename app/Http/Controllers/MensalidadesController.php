<?php

namespace App\Http\Controllers;

use App\Mensalidade;
use Illuminate\Http\Request;

class MensalidadesController extends Controller {

    public function store(Request $request)
    {

        $mensalidade = new Mensalidade();
        $mensalidade->valor = $request->valor;
        $mensalidade->vencimento = $request->vencimento;
        $mensalidade->contrato_id = $request->contrato_id;
        $mensalidade->save();

        return redirect("contratos/" . $request->input('contrato_id') . '/edit')->withInput();
    }

    public function update(Request $request, $id)
    {
        $mensalidade = Mensalidade::find($id);
        $mensalidade->valor = $request->valor;
        $mensalidade->vencimento = $request->vencimento;
        $mensalidade->VerifyAndSave();
        return redirect("contratos/" . $request->input('contrato_id') . '/edit')->withInput();
    }

    public function quitar(Request $request)
    {
        
        $mensalidade = $request->id_mensalidade ? Mensalidade::find($request->id_mensalidade) : new Mensalidade;
        $mensalidade->valor = $request->valor;
        $mensalidade->vencimento = $request->vencimento;
        $mensalidade->id = $request->id_mensalidade;
        $mensalidade->contrato_id = $request->contrato_id;
        $mensalidade->pago_em = $request->pago_em;
        $retorno = $mensalidade->quitar();
        if ($retorno):
            \Session::flash('mensagem', ['type' => 'success', 'conteudo' => trans('messages.actionQuitar')]);
        else:
            \Session::flash('mensagem', ['type' => 'danger', 'conteudo' => trans('messages.error')]);
        endif;

        return redirect("contratos/" . $request->input('contrato_id') . '/edit')->withInput();
    }
    
    public function desquitar(Request $request,  Mensalidade $mensalidade)
    {
        $retorno=$mensalidade->desquitar();
         if ($retorno):
            \Session::flash('mensagem', ['type' => 'success', 'conteudo' => "Ação realizada com sucesso!"]);
        else:
            \Session::flash('mensagem', ['type' => 'danger', 'conteudo' => trans('messages.error')]);
        endif;
       
        return redirect()->back();
    }

    public function destroy(Mensalidade $mensalidade)
    {

        $contrato_id = $mensalidade->contrato_id;
        $retorno=$mensalidade->verifyAndDelete();
         if ($retorno):
            \Session::flash('mensagem', ['type' => 'success', 'conteudo' => trans('messages.actionDelete')]);
        else:
            \Session::flash('mensagem', ['type' => 'danger', 'conteudo' => trans('messages.error')]);
        endif;
       
        return redirect("contratos/" . $contrato_id . '/edit')->withInput();
    }
    
    private function validateTipoContrato($mensalidade)
    {
        
        if($mensalidade->contrato->ativo!=1):
            
             \Session::flash('mensagem', ['type' => 'danger', 'conteudo' => 'Contrato Inativo']);
            return redirect()->back();
        endif;
    }

}
