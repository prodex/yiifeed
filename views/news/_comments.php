<?php
/* @var $comments app\models\Comment[] */
/* @var $form yii\widgets\ActiveForm */
/* @var $commentForm app\models\Comment */
?>

<?php
use app\widgets\Avatar;
use yii\widgets\ActiveForm;
use yii\helpers\Html;
?>

<h2>Comments</h2>

<ol class="comments">
<?php foreach ($comments as $comment): ?>
    <li id="c<?= $comment->id ?>" class="row">
        <div class="col-xs-1 author">
            <?= Html::a(Avatar::widget(['user' => $comment->user]) . ' ' . Html::encode($comment->user->username), ['user/view', 'id' => $comment->user->id]) ?>
        </div>
        <div class="col-xs-8 text well">
            <?= \yii\helpers\Markdown::process($comment->text) ?>
        </div>
        <div class="col-xs-3">
            <a href="#c<?= $comment->id ?>">#<?= $comment->id ?></a>
            <span class="date"><?=Yii::$app->formatter->format($comment->created_at, 'datetime')?></span>
        </div>
    </li>
<?php endforeach ?>
</ol>

<?php if (!Yii::$app->user->isGuest): ?>
    <?php $form = ActiveForm::begin(); ?>
        <?= $form->field($commentForm, 'text')->label('Add new comment')->textarea() ?>

        <div class="form-group">
            <?= Html::submitButton(Yii::t('news', 'Comment'), ['class' => 'btn btn-primary']) ?>
        </div>
    <?php ActiveForm::end(); ?>
<?php else: ?>
    <p>Signup in order to comment.</p>
<?php endif ?>
