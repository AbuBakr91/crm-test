<?php

namespace backend\controllers;

use common\models\Translator;
use yii\data\ActiveDataProvider;
use yii\web\Controller;

class TranslatorController extends Controller
{
    public function actionIndex($day = null): ActiveDataProvider
    {
        if ($day === null) {
            $day = date('l');
        }

        $day = ucfirst(strtolower($day));

        $query = Translator::find()
            ->where(['like', 'working_days', $day])
            ->orderBy(['task_count' => SORT_ASC]);

        return new ActiveDataProvider([
            'query' => $query,
        ]);
    }
}