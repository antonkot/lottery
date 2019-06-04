<?php
/* @var $this yii\web\View */

use \yii\helpers\Url;
use \yii\helpers\Html;

?>
<h1>
    <?php echo Yii::t('app', 'Lottery') ?> #<?php echo $lottery->id ?>
</h1>

<p>
    <?php echo $lottery->money_left . Yii::t('app', ' money left') ?>
</p>
<p>
    <?php echo Yii::t('app', 'Loyalty points unlimited') ?>
</p>

<?php if ($lottery->things): ?>
    <p>
        <b>Things left:</b>
    </p>
    <?php foreach ($lottery->things as $thing): ?>
        <p>
            <?php echo Html::encode($thing->title) ?> -
            <?php echo $thing->amount; ?>
        </p>
    <?php endforeach; ?>
<?php endif; ?>

<a
    href="<?php echo Url::to(['gift/spin', 'lottery_id' => $lottery->id]) ?>"
    class="btn btn-success btn-lg"
>
    <?php echo Yii::t('app', 'Spin The Wheel!') ?>
</a>
