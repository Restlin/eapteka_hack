<?php

namespace app\controllers;

use app\models\User;
use app\models\UserSearch;
use app\models\UserDiagnosisSearch;
use app\models\UserFamily;
use app\models\UserFamilySearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

/**
 * UserController implements the CRUD actions for User model.
 */
class UserController extends Controller
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
     * Lists all User models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new UserSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single User model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        $user = $this->findModel($id);
        return $this->render('view', [
            'model' => $user,
            'familyIndex' => $this->renderFamily($user),
            'diagnosisIndex' => $this->renderDiagnosis($user)
        ]);
    }
    public function renderDiagnosis(User $user) {
        $searchModel = new UserDiagnosisSearch();
        $searchModel->user_id = $user->id;
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->renderPartial('/user-diagnosis/index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function renderFamily(User $user)
    {
        $searchModel = new UserFamilySearch();
        $searchModel->user_id1 = $user->id;
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->renderPartial('/user-family/index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'roles' => UserFamily::getRoleList(),
        ]);
    }

    /**
     * Creates a new User model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new User();

        if ($this->request->isPost) {
            if ($model->load($this->request->post())) {
                $image = UploadedFile::getInstance($model, 'image');
                if ($image) {
                    $model->image=file_get_contents($image->tempName);
                }
                if ($model->save()) {
                    return $this->redirect(['view', 'id' => $model->id]);
                }
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing User model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $stream = $model->image ? stream_get_contents($model->image) : false;
        if ($this->request->isPost && $model->load($this->request->post())) {
            $image = UploadedFile::getInstance($model, 'image');
            if ($image) {
                $model->image=file_get_contents($image->tempName);
            } elseif ($stream) {
                $model->image = $stream;
            }
            if ($model->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
            }
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing User model.
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
     * Finds the User model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return User the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = User::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
