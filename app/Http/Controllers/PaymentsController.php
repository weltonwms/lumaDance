<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\TeacherPayment;

class PaymentsController extends Controller
{
    public function index(Request $request)
    {
        
        $payments=  TeacherPayment::getQuery($request);
        return view("teachers.payments",compact('payments'))->with('teachers',  \App\Teacher::pluck('nome', 'id'));
    }
    
     public function quitar(Request $request, TeacherPayment $teacherPayment)
    {
         if($teacherPayment->pago==0):
             $teacherPayment->pago=1;
             $teacherPayment->save();
             \Session::flash('mensagem', ['type' => 'success', 'conteudo' => 'Pagamento Registrado ao Professor']);
         else:
             \Session::flash('mensagem', ['type' => 'danger', 'conteudo' => trans('messages.error')]);
         endif;
         return redirect()->route('payments.index');
     
    }
}
