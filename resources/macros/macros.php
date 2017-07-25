<?php

/*
 * Para utilizar esses macros é necessário possuir o laravelHtmlCollective
 */

\Html::macro('formGroup', function ($field, $label, $errors, $classes = '') {
    $class_erro = $errors->has($field) ? 'has-error' : '';
    $classes.= " form-control";
    $string = "<div class=\"form-group $class_erro \">";
    $string .= \Form::label($field, $label, ['class' => 'control-label']);
    $string .= \Form::text($field, null, ['class' => $classes]);
    if ($class_erro):
        $string .= "<span class='help-block'><strong>{$errors->first($field)}</strong></span>";
    endif;

    $string .= "</div>";

    return $string;
});

\Html::macro('formGroupNumber', function ($field, $label, $errors, $classes = '') {
    $class_erro = $errors->has($field) ? 'has-error' : '';
    $classes.= " form-control";
    $string = "<div class=\"form-group $class_erro \">";
    $string .= \Form::label($field, $label, ['class' => 'control-label']);
    $string .= \Form::number($field, null, ['class' => $classes,'placeholder'=>$label]);
    if ($class_erro):
        $string .= "<span class='help-block'><strong>{$errors->first($field)}</strong></span>";
    endif;

    $string .= "</div>";

    return $string;
});

\Html::macro('formGroupDate', function ($field, $label, $errors, $classes = '') {
    $class_erro = $errors->has($field) ? 'has-error' : '';
    $classes.= " date form-control";
    $string = "<div class=\"form-group $class_erro \">";
    $string .= \Form::label($field, $label, ['class' => 'control-label']);
    $string .= \Form::text($field, null, ['class' => $classes]);
    if ($class_erro):
        $string .= "<span class='help-block'><strong>{$errors->first($field)}</strong></span>";
    endif;

    $string .= "</div>";

    return $string;
});

\Html::macro('formGroupSelect', function ($field, $array,$label, $errors, $classes = '') {
    $class_erro = $errors->has($field) ? 'has-error' : '';
    $classes.= " form-control";
    $string = "<div class=\"form-group $class_erro \">";
    $string .= \Form::label($field, $label, ['class' => 'control-label']);
    $string .= \Form::select($field, $array,null, ['class' => $classes,'data-placeholder'=>"-Selecione-",'placeholder' => '--Selecione--']);
    if ($class_erro):
        $string .= "<span class='help-block'><strong>{$errors->first($field)}</strong></span>";
    endif;

    $string .= "</div>";

    return $string;
});

\Html::macro('formGroupFlex', function ($options=array()) {
    $field=isset($options['field'])?$options['field']:'';
    $label=isset($options['label'])?$options['label']:'';
    $atributos=isset($options['atributos'])?$options['atributos']:'';
    $errors=isset($options['errors'])?$options['errors']:'';
    $type=isset($options['type'])?$options['type']:'text';
    $value=isset($options['value'])?$options['value']:null;
    $class_erro = $errors->has($field) ? 'has-error' : '';
    if(isset($atributos['class'])):
        $atributos['class'].=' form-control';
     
    else:
        $atributos['class']=' form-control';
    endif;
    
    $string = "<div class=\"form-group $class_erro \">";
    $string .= \Form::label($field, $label, ['class' => 'control-label']);
    $string .= \Form::$type($field, $value, $atributos);
   
    if ($class_erro):
        $string .= "<span class='help-block'><strong>{$errors->first($field)}</strong></span>";
    endif;

    $string .= "</div>";

    return $string;
});

