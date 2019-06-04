<?php

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "gift".
 *
 * @property int $id
 * @property int $user_id
 * @property int $type
 * @property int $amount
 * @property int $sent
 * @property int $thing_id
 * @property int $lottery_id
 * @property int $created_at
 * @property int $updated_at
 *
 * @property Lottery $lottery
 * @property User $user
 */
class Gift extends \yii\db\ActiveRecord
{
    const GIFT_MONEY = 1;
    const GIFT_LOYAL = 2;
    const GIFT_THING = 3;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'gift';
    }

    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            TimestampBehavior::className(),
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'type', 'lottery_id'], 'required'],
            [['user_id', 'type', 'amount', 'sent', 'thing_id', 'lottery_id', 'created_at', 'updated_at'], 'integer'],
            [['lottery_id'], 'exist', 'skipOnError' => true, 'targetClass' => Lottery::className(), 'targetAttribute' => ['lottery_id' => 'id']],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'user_id' => Yii::t('app', 'User ID'),
            'type' => Yii::t('app', 'Type'),
            'amount' => Yii::t('app', 'Amount'),
            'sent' => Yii::t('app', 'Sent'),
            'thing_id' => Yii::t('app', 'Thing ID'),
            'lottery_id' => Yii::t('app', 'Lottery ID'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLottery()
    {
        return $this->hasOne(Lottery::className(), ['id' => 'lottery_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getThing()
    {
        return $this->hasOne(Thing::className(), ['id' => 'thing_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }
}
