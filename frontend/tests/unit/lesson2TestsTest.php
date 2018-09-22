<?php
namespace frontend\tests;

use common\models\TaskModel;
use frontend\models\ContactForm;

class lesson2TestsTest extends \Codeception\Test\Unit
{
    /**
     * @var \frontend\tests\UnitTester
     */
    protected $tester;
    
    protected function _before()
    {
    }

    protected function _after()
    {
    }

    // tests
    public function testSomeFeature()
    {
        $model=new TaskModel();
        $this->assertTrue(TaskModel::tableName()=='task');
        $this->assertEquals('task',TaskModel::tableName());
        $this->assertLessThan(12,count($model->attributes()));
        $this->assertArrayHasKey(0,$model->attributes());

        $model=new ContactForm();
        $model->name='hello';
        $this->assertAttributeEquals('hello','name',$model);
    }
}