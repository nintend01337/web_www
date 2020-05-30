<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Links';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-links">
    <h1><?= Html::encode($this->title) ?></h1>



    <?php $form = ActiveForm::begin([
        'id' => 'link-form',
        'layout' => 'horizontal',
        'fieldConfig' => [
            'labelOptions' => ['class' => 'col-lg-1 control-label'],
        ],
    ]); ?>

    <?= $form->field($model, 'origin')->textInput(['autofocus' => true]) ?>

    <?= $form->field($model, 'short')->textInput() ?>

    <div class="form-group">
        <div class="col-lg-offset-1 col-lg-11">
            <?= Html::submitButton('Submit', ['class' => 'btn btn-submit', 'name' => 'confirm-button']) ?>
        </div>
    </div>

    <?php ActiveForm::end(); ?>

    <script>
        $("linkform-origin").change(function(){
            alert("Hello");
        });

    </script>

</div>