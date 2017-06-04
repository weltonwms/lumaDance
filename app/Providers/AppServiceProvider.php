<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        \Html::macro('formGroup', function ($field, $label, $errors,$classes='') {
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
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
