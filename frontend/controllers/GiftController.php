<?php

namespace frontend\controllers;

use Yii;
use common\models\Lottery;
use common\models\Gift;

class GiftController extends \yii\web\Controller
{
    public function actionIndex()
    {
        // Find current lottery
        $currentLottery = Lottery::find()
            ->where([
                'and',
                ['<=', 'date_start', time()],
                ['>=', 'date_end', time()],
            ])
            ->with('things')
            ->one();

        // Render info page if there is no active lotteries
        if ($currentLottery == null) {
            return $this->render('nolotteries');
        }

        // Get the gitf if any
        $gift = Gift::find()
            ->where([
                'user_id' => Yii::$app->user->id,
                'lottery_id' => $currentLottery->id
            ])
            ->one();

        // Render lottery page if user has no gift yet
        if ($gift == null) {
            return $this->render('index', [
                'lottery' => $currentLottery
            ]);
        }

        // Render info page if user got his gift already
        return $this->render('gift', compact("gift"));
    }
}
