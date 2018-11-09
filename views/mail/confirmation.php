<?php

/*
 * This file is part of the Dektrium project.
 *
 * (c) Dektrium project <http://github.com/dektrium>
 *
 * For the full copyright and license information, please view the LICENSE.md
 * file that was distributed with this source code.
 */

use yii\helpers\Html;

/**
 * @var dektrium\user\models\User  $user
 * @var dektrium\user\models\Token $token
 */
?>
<p style="font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif; font-size: 14px; line-height: 1.6; font-weight: normal; margin: 0 0 10px; padding: 0;">
    <?= Yii::t('user', 'Hello') ?>,
</p>
<p style="font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif; font-size: 14px; line-height: 1.6; font-weight: normal; margin: 0 0 10px; padding: 0;">
    <?= Yii::t('user', 'Thank you for signing up on {0}', Yii::$app->name) ?>.
    <?= Yii::t('user', 'In order to complete your registration, please click the link below') ?>.
</p>
<p style="font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif; font-size: 14px; line-height: 1.6; font-weight: normal; margin: 0 0 10px; padding: 0;">
    <?= Html::a(Html::encode($token->url), $token->url); ?>
</p>
<p style="font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif; font-size: 14px; line-height: 1.6; font-weight: normal; margin: 0 0 10px; padding: 0;">
    <?= Yii::t('user', 'If you cannot click the link, please try pasting the text into your browser') ?>.
</p>
<p style="font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif; font-size: 14px; line-height: 1.6; font-weight: normal; margin: 0 0 10px; padding: 0;">
    <?= Yii::t('user', 'If you did not make this request you can ignore this email') ?>.
</p>


<?= Yii::t('user','</br></br></br>') ?>.

<p style='color:#F89821; font-size:20px'>

	<?= Yii::t('user','World Culture Forum') ?>.

</p>
<p style='font-style:italic'>
	<?= Yii::t('user','Ministry of Education and Culture Republic of Indonesia') ?>.
</p>


<p style='font-style:italic'>
	<?= Yii::t('user','Building E 6th Floor, Jl. Jenderal Sudirman, Senayan - Jakarta 10270') ?>.
</p>
<p>

	<?= Yii::t('user','<span style="color:#F89821">p: </span>+62 21 572 5532') ?>.
</p>
<p>
	<?= Yii::t('user','<span style="color:#F89821">f: </span>+62 21 572 5532') ?>.
</p>
<p>
	<?= Yii::t('user','<span style="color:#F89821">w: </span>www.worldcultureforum-bali.org
	<span style="color:#F89821; margin-left:5px">e: </span>secretariat@worldcultureforum-bali.org')?>.
</p>
