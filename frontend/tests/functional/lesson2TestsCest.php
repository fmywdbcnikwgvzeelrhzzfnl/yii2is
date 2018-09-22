<?php

namespace frontend\tests\functional;

use frontend\tests\FunctionalTester;

class lesson2TestsCest
{
    public function _before(FunctionalTester $I)
    {
        $data=null;
    }

    public function _after(FunctionalTester $I)
    {
    }

    /**
     * @example(url="/", text="Congratulations")
     * @example(url="/test", text="Hello")
     */
    public function tryToTest1(FunctionalTester $I, \Codeception\Example $example)
    {
        $I->amOnPage($example['url']);
        $I->see($example['text']);
    }

    /**
     * @dataProvider pageProvider
     */
    public function tryToTest2(FunctionalTester $I, \Codeception\Example $data)
    {
        $I->amOnPage($data['url']);
        $I->see($data['text']);
    }

    /**
     * @return array
     */
    protected function pageProvider()
    {
        return [
            ['url' => '/', 'text' => 'Congratulations'],
            ['url' => '/test', 'text' => 'Hello'],
        ];
    }
}
