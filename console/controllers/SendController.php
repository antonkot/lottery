<?php
/**
 * Console command for sending money gifts
 */

namespace console\controllers;

use common\models\Gift;

class SendController extends \yii\console\Controller
{
    public function actionIndex($batchSize = 10)
    {
        if (!is_integer($batchSize)) {
            throw new \Exception("Batch size is not an integer");
        }

        // Find gifts, which not sent yet
        $gifts = Gift::find()
            ->where([
                'type' => Gift::GIFT_MONEY,
                'sent' => 0,
            ])
            ->with('user')
            ->limit($batchSize)
            ->all();

        // If any, send them all to user's credit card via API
        if ($gifts) {
            foreach ($gifts as $gift) {
                $this->sendToBankAPI($gift->user->cc_number, $gift->amount, $gift->id);
            }
        }

        /** TODO:
         *  Then we need some callback function wich will recieve the response
         *  from bank and update the status of a gift if the transfer succeeded.
         *  Probably, we should use some Queue server for that purpose.
         */
    }

    // Proto function for sending to API
    protected function sendToBankAPI($cc_number, $amount, $id)
    {
        throw new \Exception("Bank API not implemented");
    }
}
