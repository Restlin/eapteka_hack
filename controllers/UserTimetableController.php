<?php

namespace app\controllers;

use app\models\UserTimetable;
use app\models\UserTimetableSearch;
use DateTimeImmutable;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\Response;

/**
 * UserTimetableController implements the CRUD actions for UserTimetable model.
 */
class UserTimetableController extends Controller
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
     * Lists all UserTimetable models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new UserTimetableSearch();
        
        $user = \Yii::$app->user->identity->getUser();        
        /*@var $user \app\models\User */        
        $users = $user->getFamilyUsers();
        
        $searchModel->user_id = array_keys($users);
        
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'types' => UserTimetable::getTypeList()
        ]);
    }

    public function beforeAction($action)
    {
        if (in_array($action->id, ['list', 'skip', 'complete'])) {
            \Yii::$app->response->format = Response::FORMAT_JSON;
        }
        return parent::beforeAction($action); // TODO: Change the autogenerated stub
    }

    public function actionList(string $date)
    {
        $datetime = DateTimeImmutable::createFromFormat('d.m.Y', $date);
        if (!$datetime) {
            throw new BadRequestHttpException("?????????????? ???? ???????????? ???????????? ????????!");
        }
        $list = UserTimetableSearch::find()
            ->andWhere(['user_id' => \Yii::$app->user->id])
            ->joinWith(['item'])
            ->andWhere(['between', 'date', $datetime->format('d.m.Y 00:00:00'), $datetime->format('d.m.Y 23:59:59')])
            ->asArray()
            ->orderBy(['date' => SORT_ASC, 'id' => SORT_DESC])
            ->all();
        foreach ($list as $key => $element) {
            ArrayHelper::setValue($element, 'item.image', '');
            $list[$key] = $element;
        }
        $list['length'] = count($list);
        return $list;
    }

    public function actionComplete(int $id)
    {
        $model = $this->findModel($id);
        $model->complete = true;
        $userStore = \app\models\UserStore::findOne(['target_id' => $model->user_id, 'item_id' => $model->item_id]);
        $userStore->amount--;
        return $model->save(true, ['complete']) && $userStore->save(true, ['amount']);
    }

    public function actionSkip(int $id)
    {
        $model = $this->findModel($id);
        $model->complete = true;
        return $model->save();
    }

    /**
     * Displays a single UserTimetable model.
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
     * Creates a new UserTimetable model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new UserTimetable();

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing UserTimetable model.
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
        ]);
    }

    /**
     * Deletes an existing UserTimetable model.
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
     * Finds the UserTimetable model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return UserTimetable the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = UserTimetable::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
