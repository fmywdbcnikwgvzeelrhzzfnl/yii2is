<?php
/**
 * Created by PhpStorm.
 * User: Миша_2
 * Date: 12.09.2018
 * Time: 20:17
 */

namespace common\services;

use yii\base\Component;
use Yii;

/**
 * Class ProjectService
 * Сервис отправки почты
 * @package backend\services
 */
class EmailService extends Component
{
    public function send($to, $subject, $views, $data)
    {
        Yii::$app
            ->mailer
            ->compose($views, $data)
            ->setFrom([Yii::$app->params['supportEmail'] => Yii::$app->name . ' robot'])
            ->setTo($to)
            ->setSubject($subject)->send();
    }
}