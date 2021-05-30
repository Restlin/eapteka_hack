<?php

namespace app\controllers;

use app\models\Item;
use app\models\User;
use app\models\UserStore;
use app\models\UserStoreSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;

/**
 * Class UserStoreController
 * @package app\controllers
 * @author Dmitrii N <https://github.com/johnny-silverhand>
 */
class UserStoreController extends Controller
{
    /**
     * @inheritDoc
     */
    public function behaviors()
    {
        return array_merge(
            parent::behaviors(),
            [
                'access' => [
                    'class' => AccessControl::class,
                    'rules' => [
                        [
                            'allow' => true,
                            'roles' => ['@'],
                        ],
                    ],
                ],
                'verbs' => [
                    'class' => VerbFilter::class,
                    'actions' => [
                        'delete' => ['POST'],
                    ],
                ],
            ]
        );
    }

    /**
     * Lists all UserStore models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new UserStoreSearch();

        $user = \Yii::$app->user->identity->getUser();
        /*@var $user \app\models\User */
        $users = $user->getFamilyUsers();

        $searchModel->user_id = $user->id;
        $dataProvider = $searchModel->search($this->request->queryParams);
        $dataProvider->query->andFilterWhere(['mode' => 1]);
        $dataProvider2 = $searchModel->search($this->request->queryParams);
        $dataProvider2->query->andFilterWhere(['mode' => 2]);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'dataProvider2' => $dataProvider2,
            'items' => Item::getList(),
            'users' => $users,
            'modes' => UserStore::getStoreModeList(),
        ]);
    }

    /**
     * Displays a single UserStore model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
            'dayModes' => Item::getPerDayModeList(),
            'foodModes' => Item::getFoodModeList(),
        ]);
    }

    /**
     * Creates a new UserStore model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($substance_id = null, $target_id = null)
    {
        $user = \Yii::$app->user->identity->getUser();
        /*@var $user \app\models\User */
        $users = $user->getFamilyUsers();

        $model = new UserStore();
        $model->user_id = $user->id;
        $model->target_id = key_exists($target_id, $users) ? $target_id : null;

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
            'items' => Item::getList($substance_id),
            'users' => $users,
            'modes' => UserStore::getStoreModeList(),
        ]);
    }

    /**
     * Updates an existing UserStore model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $user = \Yii::$app->user->identity->getUser();
        /*@var $user \app\models\User */
        $users = $user->getFamilyUsers();

        $model = $this->findModel($id);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
            'items' => Item::getList(),
            'users' => $users,
            'modes' => UserStore::getStoreModeList(),
        ]);
    }

    /**
     * Deletes an existing UserStore model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the UserStore model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return UserStore the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = UserStore::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
