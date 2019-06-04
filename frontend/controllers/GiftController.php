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

    public function actionSpin($lottery_id)
    {
        // Find current lottery
        $lottery = Lottery::findOne($lottery_id);

        if ($lottery == null) {
            throw new \Exception("Wrong lottery ID");
        }

        // Get the gitf if any
        $gift = Gift::find()
            ->where([
                'user_id' => Yii::$app->user->id,
                'lottery_id' => $lottery->id
            ])
            ->one();

        // If user has a gift already - redirect
        if ($gift != null) {
            return $this->redirect(['index']);
        }

        $gift = false;

        // Calculate the gift
        if (rand(0, 100) <= Yii::$app->params['probability']['win']) {

            // "Roll" new dice
            $dice = rand(0, 100);

            if ($dice <= Yii::$app->params['probability']['money']) {
                $gift = $this->makeMoneyGift($lottery);
            } elseif (
                $dice <= Yii::$app->params['probability']['money'] +
                Yii::$app->params['probability']['thing']
            ) {
                $gift = $this->makeThingGift($lottery);
            } else {
                #loyalty
                $gift = $this->makeLoyaltyGift($lottery);
            }
        }

        if ($gift) {
            // Won the gift, redirect
            return $this->redirect(['index']);
        } else {
            // Didnt win anything. Render info page
            return $this->render('loose');
        }
    }

    // Function for money gift
    protected function makeMoneyGift($lottery)
    {
        $amount = rand(
            Yii::$app->params['range']['money']['from'],
            Yii::$app->params['range']['money']['to']
        );

        // We have not enough money
        if ($amount > $lottery->money_left) {
            return false;
        }

        $gift = new Gift([
            'user_id' => Yii::$app->user->id,
            'sent' => 0,
            'type' => Gift::GIFT_MONEY,
            'amount' => $amount,
            'lottery_id' => $lottery->id
        ]);

        // Save the gift and update money count
        if ($gift->save()) {
            $lottery->updateCounters(['money_left' => $amount * (-1)]);
            return $gift;
        } else {
            return false;
        }
    }

    // Function for thing gift
    protected function makeThingGift($lottery)
    {
        // lazy-load things and get count
        $count = count($lottery->things);

        // We have no things
        if ($count == 0) {
            return false;
        }

        // get random thing
        $index = rand(0, $count - 1);
        $thing = $lottery->things[$index];

        // this thing is out of stock
        if ($thing->amount == 0) {
            return false;
        }

        $gift = new Gift([
            'user_id' => Yii::$app->user->id,
            'sent' => 0,
            'type' => Gift::GIFT_THING,
            'thing_id' => $thing->id,
            'lottery_id' => $lottery->id
        ]);

        // Save the gift and update thing amount
        if ($gift->save()) {
            $thing->updateCounters(['amount' => -1]);
            return $gift;
        } else {
            return false;
        }
    }

    // Function for thing gift
    protected function makeLoyaltyGift($lottery)
    {
        $amount = rand(
            Yii::$app->params['range']['loyalty_points']['from'],
            Yii::$app->params['range']['loyalty_points']['to']
        );

        $gift = new Gift([
            'user_id' => Yii::$app->user->id,
            'amount' => $amount,
            'sent' => 1,
            'type' => Gift::GIFT_LOYAL,
            'lottery_id' => $lottery->id
        ]);

        // Save the gift and update thing amount
        if ($gift->save()) {
            Yii::$app->user->identity->updateCounters(['loyalty_points' => $amount]);
            return $gift;
        } else {
            return false;
        }
    }
}
