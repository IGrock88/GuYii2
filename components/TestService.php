<?php
/**
 * User: IGrock
 * Date: 12.06.2018
 * Time: 13:05
 */

namespace app\components;


use yii\base\Component;

class TestService extends Component
{
    public $testProperty = 'TEST';

    public function getTestProperty()
    {
        return $this->testProperty;
    }

}