<?php

namespace app\models;

use Yii;
use yii\base\Model;

/**
 * Product is the model behind the product.
 */
class Product extends Model
{
    public $id;
    public $title;
    public $category;
    public $body;
    public $price;

    /**
     * @return array customized attribute labels
     */
    public function attributeLabels()
    {
        return [
            'verifyCode' => 'Verification Code',
        ];
    }

    /**
     *
     * get info about product
     * @return $this
     *
     */

    public function getSingleProduct()
    {
        $this->id = 1;
        $this->title = 'Test Product';
        $this->category = 'test cat';
        $this->body = 'test description';
        $this->price = 100;
        return $this;
    }


}
