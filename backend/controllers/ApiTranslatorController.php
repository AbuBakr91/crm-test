<?php

namespace backend\controllers;

use common\models\Translator;
use common\enums\DayOfWeek;
use yii\data\ActiveDataProvider;
use yii\rest\Controller;
use yii\web\BadRequestHttpException;

class ApiTranslatorController extends Controller
{
    /**
     * @throws BadRequestHttpException
     */
    public function actionIndex($day = null): array
    {
        if ($day === null) {
            $day = DayOfWeek::from(date('D')); // Используем текущий день (3 буквы)
        } else {
            // Проверяем, корректен ли указанный день
            try {
                $day = DayOfWeek::from(strtoupper($day)); // Приводим к верхнему регистру
            } catch (\ValueError $e) {
                throw new BadRequestHttpException('Неверный день недели.');
            }
        }

        $query = Translator::find()
            ->where(['like', 'working_days', $day->value])
            ->orderBy(['task_count' => SORT_ASC]);

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        return $dataProvider->getModels(); // Возвращаем массив моделей
    }
}
