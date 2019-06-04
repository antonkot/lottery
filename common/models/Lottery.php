<?php

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "lottery".
 *
 * @property int $id
 * @property int $date_start
 * @property int $date_end
 * @property int $money_left
 * @property int $created_at
 * @property int $updated_at
 *
 * @property Gift[] $gifts
 * @property Thing[] $things
 */
class Lottery extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'lottery';
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
            [['date_start', 'date_end', 'money_left'], 'required'],
            [['date_start', 'date_end', 'money_left', 'created_at', 'updated_at'], 'integer'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'date_start' => Yii::t('app', 'Date Start'),
            'date_end' => Yii::t('app', 'Date End'),
            'money_left' => Yii::t('app', 'Money Left'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGifts()
    {
        return $this->hasMany(Gift::className(), ['lottery_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getThings()
    {
        return $this->hasMany(Thing::className(), ['lottery_id' => 'id']);
    }
}
