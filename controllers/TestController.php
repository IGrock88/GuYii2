<?php

namespace app\controllers;

use app\models\Product;
use Yii;
use yii\db\Query;
use yii\filters\AccessControl;
use yii\helpers\VarDumper;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;

class TestController extends Controller
{

    /**
     * Displays test homepage.
     *
     * @return string
     */
    public function actionIndex()
    {

        //$product = (new Product())->getSingleProduct();
        return $this->render('index', ['test' => \Yii::$app->test->getTestProperty()]);
    }

    public function actionInsert()
    {
        Yii::$app->db->createCommand()->insert('users', [
            'username' => 'Jack1',
            'name' => 'Jack',
            'password_hash' => 'dsaasgasdasdf',
        ])->execute();
        Yii::$app->db->createCommand()->insert('users', [
            'username' => 'Mike',
            'name' => 'Mike',
            'password_hash' => 'dsaasgasdasdf',
        ])->execute();
        Yii::$app->db->createCommand()->insert('users', [
            'username' => 'Alex',
            'name' => 'Alex',
            'password_hash' => 'dsaasgasdasdf',
        ])->execute();
        $events = [
            ['test1', '2018-06-19 00:00:00', 1],
            ['test2', '2018-06-20 00:00:00', 1],
            ['test3', '2018-06-21 00:00:00', 1]
        ];
        Yii::$app->db->createCommand()->batchInsert('event', ['text', 'dt', 'creator_id'], $events)->execute();
        return $this->render('index', ['test' => 'null']);
    }

    public function actionSelect()
    {
        $userId = 1;
        $data = (new Query())->select(['id', 'name'])->from('users')->where(['=', 'id', $userId]);
        VarDumper::dump($data->all());
        echo '<br>';
        $data = (new Query())->select(['id', 'name'])->orderBy('name')->from('users')->where(['>', 'id', $userId]);
        VarDumper::dump($data->all());
        echo '<br>';
        $data = (new Query())->from('users')->count();
        VarDumper::dump($data);
        echo '<br>';
        $data = (new Query())->select(['text', 'users.name'])->from('event')->leftJoin('users', 'event.creator_id = users.id');
        VarDumper::dump($data->all());

        //return $this->render('index', ['test' => 'null']);
    }


}
