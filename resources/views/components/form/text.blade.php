<?php
$class_input='form-control ';
if(isset($attributes['class'])):
    $class_input.=$attributes['class'];
    unset($attributes['class']);
endif;
        

?>
<div class="form-group">
    {{ Form::label($name, null, ['class' => 'control-label']) }}
    {{ Form::text($name, $value, array_merge(['class' => $class_input], $attributes)) }}
</div>