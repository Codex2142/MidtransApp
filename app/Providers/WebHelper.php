<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class WebHelper extends ServiceProvider
{
    // mendapatkan model, header, fillable, label, rule, message error
    public static function getModelInformation($model){
        $modelName = 'App\\Models\\' . $model;
            $data = [
            'model' => $modelName,
            'header' => (new $modelName)->tableHead,
            'fillable' => (new $modelName)->getFillable(),
            'label'    => $modelName::labelling(),
            'rule'    => $modelName::rules(),
            'message'  => $modelName::message(),
        ];

        return $data;
    }
}
