<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\RelatorioVenda;
use App\RelatorioContrato;
use App\RelatorioGeral;
use App\RelatorioMensalidade;

class RelatoriosController extends Controller {

    public function venda(Request $request)
    {
        $relatorio = new RelatorioVenda();
        $result = $request->isMethod('post') ? $relatorio->getRelatorio() : $relatorio;
        $dados = [
            'produtos' => \App\Produto::pluck('descricao', 'id'),
            'relatorio' => $result,
        ];
        return view("relatorios.venda", $dados);
    }

    public function contrato(Request $request)
    {
        $relatorio = new RelatorioContrato();
        $result = $request->isMethod('post') ? $relatorio->getRelatorio() : $relatorio;
        $dados = [
            'alunos' => \App\Aluno::pluck('nome', 'id'),
            'teachers' => \App\Teacher::pluck('nome', 'id'),
            'turmas' => \App\Turma::pluck('descricao', 'id'),
            'relatorio' => $result,
        ];
        return view("relatorios.contrato", $dados);
    }

    public function mensalidade(Request $request)
    {
        $relatorio = new RelatorioMensalidade();
        $result = $request->isMethod('post') ? $relatorio->getRelatorio() : $relatorio;
        $dados = [
            'alunos' => \App\Aluno::pluck('nome', 'id'),
            'teachers' => \App\Teacher::pluck('nome', 'id'),
            'turmas' => \App\Turma::pluck('descricao', 'id'),
            'relatorio' => $result,
        ];
        return view("relatorios.mensalidade", $dados);
    }

    public function geral(Request $request)
    {
        $relatorio = new RelatorioGeral();
        $result = $request->isMethod('post') ? $relatorio->getRelatorio() : $relatorio;
        $dados = [
            'relatorio' => $result,
        ];
        return view("relatorios.geral", $dados);
    }

}
