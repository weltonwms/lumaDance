<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\TeacherPayment;

class PaymentsController extends Controller {

    public function __construct()
    {
        $this->middleware('adm');
    }

    public function index(Request $request)
    {

        $payments = TeacherPayment::getQuery($request);

        return view("teachers.payments", compact('payments'))->with('teachers', \App\Teacher::pluck('nome', 'id'));
    }

    public function quitar(Request $request)
    {
        $dados = $this->validateRequest($request);
        if ($dados):
            TeacherPayment::quitar($request->all()['quit']);
            \Session::flash('mensagem', ['type' => 'success', 'conteudo' => 'Pagamento Registrado ao Professor']);
        endif;


        return redirect()->route('payments.index');
    }

    public function desquitar(Request $request)
    {
        $dados = $this->validateRequest($request);
        if ($dados):
            TeacherPayment::desquitar($dados);
            \Session::flash('mensagem', ['type' => 'success', 'conteudo' => 'Desquitamento realizado com sucesso!']);
        endif;

        return redirect()->route('payments.index', ['st' => '1']);
    }

    private function validateRequest($request)
    {
        $listPayments = isset($request->all()['quit']) ? $request->all()['quit'] : array();
        if (!$listPayments):
            \Session::flash('mensagem', ['type' => 'danger', 'conteudo' => 'Nenhum Valor Selecionado!']);
        endif;
        return $listPayments;
        
    }

}
