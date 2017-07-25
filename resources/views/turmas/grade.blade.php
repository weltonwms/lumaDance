@extends('layouts.app_interno')
@section('content_interno')


<h3>Grade</h3>


<?php


$lista_dias = ['0' => 'domingo', '1' => 'segunda', '2' => 'terça', '3' => 'quarta', 'quinta', 'sexta', 'sábado'];

$dados["08:00"][1] = array("A","B");
$dados["08:00"][3] = array("A","B");
$dados["08:00"][0] = array("A","B");
$dados["09:00"][4] = array("X","S");
$dados["10:00"][4] = array("X");
$dados["12:00"][2] = array("A","B");
$dados["17:00"][1] = array("A","B");
$dados["17:00"][3] = array("A","B");
$dados["17:00"][6] = array("X","S");


//echo "<pre>"; print_r($grade); echo "</pre>";
?>

<table class="table table-bordered">
    <thead>
    <tr class="info">
        <th>Horario</th>
        @foreach($lista_dias as $key=>$dia)
        <th>{{$dia}}</th>
        @endforeach
    </tr>
    </thead>
    
    
    <tbody>
     @foreach($grade as $horario=>$dia_semana)
    <tr>
        <td><b>{{$horario}}</b></td>
        @for($i=0;$i<7;$i++)
        <td>
            @if(isset($dia_semana[$i]))
            
            
               @foreach($dia_semana[$i] as $obj)
               
               T{{$obj->id}} <span style="font-size:10px">({{$obj->horario_inicio}} as{{$obj->horario_termino}})</span> <span style="font-size:10px">({{$obj->descricao}})</span><br>
               
               
               @endforeach
              
            @endif
        </td>

        @endfor
     
    </tr>
    @endforeach
    </tbody>
    
    
</table>

@endsection

