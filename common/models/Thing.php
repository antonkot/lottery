<?php

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "thing".
 *
 * @property int $id
 * @property string $title
 * @property int $amount
 * @property int $lottery_id
 * @property int $created_at
 * @property int $updated_at
 *
 * @property Lottery $lottery
 */
class Thing extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'thing';
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
            [['title', 'amount', 'lottery_id'], 'required'],
            [['amount', 'lottery_id', 'created_at', 'updated_at'], 'integer'],
            [['title'], 'string', 'max' => 255],
            [['lottery_id'], 'exist', 'skipOnError' => true, 'targetClass' => Lottery::className(), 'targetAttribute' => ['lottery_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'title' => Yii::t('app', 'Title'),
            'amount' => Yii::t('app', 'Amount'),
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
}
