
<?php
use yii\bootstrap\ActiveForm;
use yii\helpers\Html;

$this->title = 'Регистрация';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-signup">
    <h1><?= Html::encode($this->title) ?></h1>

<?php $form = ActiveForm::begin([
    'id' => 'login-form',
    'layout' => 'horizontal',
    'fieldConfig' => [
        'template' => "{label}\n<div class=\"col-lg-3\">{input}</div>\n<div class=\"col-lg-8\">{error}</div>",
        'labelOptions' => ['class' => 'col-lg-1 control-label'],
    ],
]); ?>

<?=  $form ->field($model,'username')->textInput(['autofocus'=>true])->label('Имя пользователя')?>
<?=  $form ->field($model,'password')->passwordInput()->label('Пароль')?>
    <button type="submit" class="btn btn-success">Отправить</button>
<?php ActiveForm::end()?>

</div>