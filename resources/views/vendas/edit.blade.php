     
        {!! Form::model($venda,['route'=>['vendas.update',$venda->id],'method'=>'PUT','id'=>'form-venda'])!!}
        @include('vendas.form')


        {!! Form::close() !!}


    

