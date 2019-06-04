<?php
/* @var $this yii\web\View */

use common\models\Gift;

?>
<h1>
    <?php echo Yii::t('app', 'Your gift') ?>
</h1>

<?php
    // Display gift stats depending on its type
    switch ($gift->type) {
        case Gift::GIFT_MONEY:
            echo Yii::t('app', 'You won {0} money', $gift->amount);
            break;
        case Gift::GIFT_LOYAL:
            echo Yii::t('app', 'You won {0} loyalty points', $gift->amount);
            break;
        case Gift::GIFT_THING:
            echo Yii::t('app', 'You won {0}', $gift->thing->title);
            break;

        default:
            throw new \Exception("Unknown gift type");
            break;
    }
?>

<?php // If gift was not sent yet, user can ask to send or refuse it?>
<?php if ($gift->sent == 0): ?>
    <hr>

    <a href="#" class="btn btn-success btn-lg">
        <?php echo Yii::t('app', 'Send it') ?>
    </a>

    <a href="#" class="btn btn-danger btn-lg">
        <?php echo Yii::t('app', 'Refuse') ?>
    </a>

    <?php // If user won money, he can convert it to loyalty points?>
    <?php if ($gift->type == Gift::GIFT_MONEY): ?>

        <a href="#" class="btn btn-info btn-lg">
            <?php echo Yii::t('app', 'Convert to loyalty') ?>
        </a>
    <?php endif; ?>
<?php endif; ?>
