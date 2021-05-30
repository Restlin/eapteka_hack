<?php

namespace app\controllers;

use app\models\Item;
use app\models\User;
use app\models\UserStore;
use app\models\UserStoreSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
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
        $searchModel->user_id = \Yii::$app->user->id;
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'items' => Item::getList(),
            'users' => User::getList(),
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
        $model = new UserStore();
        $model->user_id = \Yii::$app->user->id;
        $model->target_id = $target_id;

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
            'users' => User::getList(),
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
        $model = $this->findModel($id);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
            'items' => Item::getList(),
            'users' => User::getList(),
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
