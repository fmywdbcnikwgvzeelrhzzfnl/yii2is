<?php
/**
 * Created by PhpStorm.
 * User: Миша_2
 * Date: 21.08.2018
 * Time: 22:52
 */

namespace console\controllers;

use yii\console\Controller;

/**
 * Test console application
 */
class TestController extends Controller
{
    /**
     * print ("Hello, world")
     */
    public function actionIndex()
    {
        echo "Hello, world" . PHP_EOL;
    }
}