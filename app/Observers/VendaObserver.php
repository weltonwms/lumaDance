<?php

namespace App\Observers;

use App\Venda;

class VendaObserver {

    private static $vendaBeforeSave;

    public function created(Venda $venda)
    {
        $venda->produto->estoque-=$venda->qtd;
        $venda->produto->save();
    }

    public function creating(Venda $venda)
    {
        if ($venda->produto->estoque < $venda->qtd):
            \Session::flash('mensagem', ['type' => 'danger', 'conteudo' => 'Quantidade de Produto Indisponível no Estoque']);
            return false;
        endif;
        return true;
    }

    public function deleted(Venda $venda)
    {
        $venda->produto->estoque+=$venda->qtd;
        $venda->produto->save();
    }
    /**
     * Deixa a $vendaBeforesave disponível.útil para comparações antes e depois de salvar.
     * Realiza algumas validações referente a estoque disponível.
     * @param \App\Observers\venda $venda
     * @return boolean
     */
    public function updating(venda $venda)
    {
        self::$vendaBeforeSave = Venda::find($venda->id);
        if (self::$vendaBeforeSave->produto->id == $venda->produto->id && self::$vendaBeforeSave->qtd == $venda->qtd):
            //não houve mudança de produto e qtd, então não precisa fazer nada em estoque.
            return TRUE;
        endif;

        if (self::$vendaBeforeSave->produto->id != $venda->produto->id) {
            //houve mudança de produto, então independente da qtd tem que devolver o produto antigo e debitar o novo
            if ($venda->produto->estoque < $venda->qtd):
                \Session::flash('falha', 1);
                \Session::flash('mensagem', ['type' => 'danger', 'conteudo' => 'Quantidade de Produto Indisponível no Estoque']);
                return false;
            endif;
        }
        //mudança apenas de qtd
        $estoque = $venda->produto->estoque;
        $estoque-=$venda->qtd - self::$vendaBeforeSave->qtd;
        if ($estoque < 0):
            \Session::flash('falha', 1);
            \Session::flash('mensagem', ['type' => 'danger', 'conteudo' => 'Quantidade de Produto Indisponível no Estoque']);
            return false;
        endif;
    }
    
    /**
     * Atualiza o estoque de acordo com alterações em produto ou qtd. Existem 3 condições
     * aqui. 1 - não altera produto e nem qtd (não precisa fazer nada). 2 - Altera produto 
     * (independente de qtd tem que devolver produto anterior e debitar atual. 3 - Altera apenas qtd
     * (Atualiza estoque com base na qtd atual - qtd anterior
     * @param \App\Observers\venda $venda
     * @return boolean
     */
    public function updated(venda $venda)
    {
        if (self::$vendaBeforeSave->produto->id == $venda->produto->id && self::$vendaBeforeSave->qtd == $venda->qtd):
            //não houve mudança de produto e qtd, então não precisa fazer nada em estoque.
            return TRUE;
        endif;

        if (self::$vendaBeforeSave->produto->id != $venda->produto->id) {
            //houve mudança de produto, então independente da qtd tem que devolver o produto antigo e debitar o novo
            self::$vendaBeforeSave->produto->estoque+=self::$vendaBeforeSave->qtd;
            $venda->produto->estoque-=$venda->qtd;
            self::$vendaBeforeSave->produto->save();
            $venda->produto->save();
            return true;
        }
        //mudança apenas de qtd
        $venda->produto->estoque-=$venda->qtd - self::$vendaBeforeSave->qtd;
        $venda->produto->save();
        return true;
    }

}
