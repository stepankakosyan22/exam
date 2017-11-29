<?php

namespace frontend\controllers;

use Yii;
use frontend\models\User;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\web\UploadedFile;
/**
 * UserController implements the CRUD actions for User model.
 */
class UserController extends Controller
{
    public $password;
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['user', 'admins'],
                        'allow' => true,
                    ],
                    [
                        'actions' => ['user', 'students'],
                        'allow' => true,
                    ],
                    [
                        'actions' => ['user', 'teachers'],
                        'allow' => true,
                    ],
                    [
                        'actions' => ['user', 'studentdelete'],
                        'allow' => true,
                    ],
                    [
                        'actions' => ['user', 'admindelete'],
                        'allow' => true,
                    ],
                    [
                        'actions' => ['user', 'teacherdelete'],
                        'allow' => true,
                    ],
                    [
                        'actions' => ['user', 'createstudent'],
                        'allow' => true,
                    ],
                    [
                        'actions' => ['user', 'changepassword'],
                        'allow' => true,
                    ],
                    [
                        'actions' => ['user', 'createteacher'],
                        'allow' => true,
                    ],
                    [
                        'actions' => ['user', 'editstudent'],
                        'allow' => true,
                    ],
                    [
                        'actions' => ['user', 'editteacher'],
                        'allow' => true,
                    ],
                    [
                        'actions' => ['user', 'index'],
                        'allow' => true,
                    ],
                    [
                        'actions' => ['user', 'create'],
                        'allow' => true,
                    ],
                ]
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all User models.
     * @return mixed
     */
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => User::find(),
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }
    public function actionStudents()
    {
        $students = User::find()->where(['role' => 'Student'])->all();
        return $this->render('students', [
            'students' => $students
        ]);
    }

    public function actionTeachers()
    {
        $teachers = User::find()->where(['role' => 'Teacher'])->all();
        return $this->render('teachers', [
            'teachers' => $teachers
        ]);
    }
    public function actionCreatestudent()
    {
        $model = new User();
        $model->scenario="create_student";
        if ($model->load(Yii::$app->request->post())) {
            $imageName = $model->name . $model->surname;
            $model->passport_scan = UploadedFile::getInstance($model, 'passport_scan');
            if (!empty($model->passport_scan)) {
                $model->passport_scan->saveAs('images/scans/' . $imageName . '.' . $model->passport_scan->extension);
                $model->passport_scan = 'images/scans/' . $imageName . '.' . $model->passport_scan->extension;
            }

            $user = $model->creatingUser();

            return $this->redirect(['createstudent']);
        } else {
            return $this->render('createstudent', [
                'model' => $model,
            ]);
        }
    }

    public function actionCreateteacher()
    {
        $model = new User();
        $model->scenario = "create";
        if ($model->load(Yii::$app->request->post())) {
            $user = $model->creatingUser();
            return $this->redirect(['/user/teachers']);
        } else {
            $teachers = User::find()->where(['role' => 'Teacher'])->all();
            return $this->render('createteacher', [
                'model' => $model,
                'teachers' => $teachers
            ]);
        }
    }
    public function actionEditstudent($id)
    {
        $model = $this->findModel($id);
        $model->scenario="edit_student";
        if ($model->load(Yii::$app->request->post())) {
            $imageName = $model->name . $model->surname;
            $model->passport_scan = UploadedFile::getInstance($model, 'passport_scan');
            if (!empty($model->passport_scan)) {
                $model->passport_scan->saveAs('images/scans/' . $imageName . '.' . $model->passport_scan->extension);
                $model->passport_scan = 'images/scans/' . $imageName . '.' . $model->passport_scan->extension;
            }
            $model->password_hash =Yii::$app->security->generatePasswordHash($model->password);
            $model->save();
            return $this->redirect('/user/students');
        } else {
            return $this->render('editstudent', [
                'model' => $model,
            ]);
        }
    }

    public function actionChangepassword(){
        if (\Yii::$app->request->isAjax) {
            $data = \Yii::$app->request->post();
            $new_password=$data['new_pass'];
            $current_user=Yii::$app->user->identity->id;
            $user= User::findOne(['id'=>$current_user]);
            $user->password_hash=Yii::$app->security->generatePasswordHash($new_password);
//            $user->password_hash='ssssssssssssss';
            $user->activated=1;
            \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
            if($user->validate()){
                $user->save();
            }
            return $this->redirect(['/']);
        }
        return $this->render('/');
    }

    public function actionEditteacher($id)
    {
        $model = $this->findModel($id);
        $model->scenario = "edit";
        if ($model->load(Yii::$app->request->post())) {
            $model->password_hash =Yii::$app->security->generatePasswordHash($model->password);
            $model->save();
            return $this->redirect(['editteacher', 'id' => $model->id]);
        } else {
            return $this->render('editteacher', [
                'model' => $model,
            ]);
        }
    }
    /**
     * Displays a single User model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
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

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing User model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing User model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    public function actionAdmindelete($id)
    {
        $this->findModel($id)->delete();
        return $this->redirect(['admins']);
    }

    public function actionStudentdelete($id)
    {
        $this->findModel($id)->delete();
        return $this->redirect(['students']);
    }

    public function actionTeacherdelete($id)
    {
        $this->findModel($id)->delete();
        return $this->redirect(['teachers']);
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
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
