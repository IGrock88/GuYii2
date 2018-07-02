<?php

namespace app\controllers;

use app\models\Event;
use app\models\User;
use Yii;
use app\models\Access;
use app\models\search\SearchAccess;
use yii\filters\AccessControl;
use Yii\helpers\Url;
use yii\web\Controller;
use yii\web\ForbiddenHttpException;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * AccessController implements the CRUD actions for Access model.
 */
class AccessController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'only' => ['create', 'update', 'delete'],
                'rules' => [
                    [
                        'actions' => ['create', 'update', 'delete'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                    'unshare-all' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Access models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new SearchAccess();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Access model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Access model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($eventId)
    {
        $eventModel = Event::findOne($eventId);
        $currentUser = Yii::$app->user->id;

        if(!$eventModel || $eventModel->creator_id !== $currentUser){
            throw new ForbiddenHttpException('access denied');
        }

        $users = User::find()->acceptedUsers($currentUser);

        $model = new Access(['event_id' => $eventId]);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->session->setFlash('info', 'Доступ пользователю расшарен');
            return $this->redirect(['event/shared']);
        }

        return $this->render('create', [
            'users' => $users,
            'model' => $model,
        ]);
    }


    /**
     * unshare event.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionDeleteAll($eventId)
    {
        $eventModel = Event::findOne($eventId);
        $currentUser = Yii::$app->user->id;

        if(!$eventModel || $eventModel->creator_id !== $currentUser){
            throw new ForbiddenHttpException('access denied');
        }

        $eventModel->unlinkAll(Event::RELATION_ACCESSES_USERS, true);
        Yii::$app->session->setFlash('success', 'Доступы удалены');

        return $this->redirect(['event/shared']);
    }

    /**
     * Updates an existing Access model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Access model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($accessId)
    {
        $accessModel = $this->findModel($accessId);
        if($accessModel->event->creator_id == Yii::$app->user->id){
            Yii::$app->session->setFlash('success', 'Доступ пользователю удален');
            $accessModel->delete();
        }


        return $this->redirect(['event/view', 'id' => $accessModel->event_id]);
    }

    /**
     * Finds the Access model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Access the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Access::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
