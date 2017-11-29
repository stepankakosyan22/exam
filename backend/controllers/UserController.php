<?php

namespace backend\controllers;

use backend\models\Groups;
use Yii;
use backend\models\User;
use backend\models\UserSearch;
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
    private $password;
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
                        'actions' => ['user', 'createadmin'],
                        'allow' => true,
                    ],
                    [
                        'actions' => ['user', 'createstudent'],
                        'allow' => true,
                    ],
                    [
                        'actions' => ['user', 'createteacher'],
                        'allow' => true,
                    ],
                    [
                        'actions' => ['user', 'editadmin'],
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
                    [
                        'actions' => ['user', 'view'],
                        'allow' => true,
                    ],
                ]
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ]];
    }

    /**
     * Lists all User models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new UserSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionAdmins()
    {
        $admins = User::find()->where(['role' => 'Admin'])->all();
        return $this->render('admins', [
            'admins' => $admins
        ]);
    }

    public function actionStudents()
    {
        $students = User::find()->where(['role' => 'Student'])->all();
        $groups=Groups::find()->all();
        return $this->render('students', [
            'students' => $students,
            'groups' => $groups
        ]);
    }

    public function actionTeachers()
    {
        $teachers = User::find()->where(['role' => 'Teacher'])->all();

        return $this->render('teachers', [
            'teachers' => $teachers
        ]);
    }

    public function actionCreateadmin()
    {
        $model = new User();
        $model->scenario = "create";
        if ($model->load(Yii::$app->request->post())) {
            $user = $model->creatingUser();
            return $this->redirect(['/user/admins']);
        } else {
            $admins = User::find()->where(['role' => 'Admin'])->all();
            return $this->render('createadmin', [
                'model' => $model,
                'admins' => $admins
            ]);
        }
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

    public function actionEditadmin($id)
    {
        $model = $this->findModel($id);
        $model->scenario = "edit";
        if ($model->load(Yii::$app->request->post())) {
            $model->password_hash =Yii::$app->security->generatePasswordHash($model->password);
            $model->save();
            return $this->redirect('/user/admins');
        } else {
            return $this->render('editadmin', [
                'model' => $model,
            ]);
        }
    }

    public function actionEditstudent($id)
    {
        $model = $this->findModel($id);
        $model->scenario="edit_student";
        $existing_scan=$model['passport_scan'];
        if ($model->load(Yii::$app->request->post())) {
            $model->password_hash =Yii::$app->security->generatePasswordHash($model->password);
            $student=Yii::$app->request->post();
            if (!empty($student['User']['passport_scan'])){
                $imageName = $model->name . $model->surname;;
                $model->passport_scan = UploadedFile::getInstance($model, 'passport_scan');
                if (!empty($model->passport_scan)) {
                    $model->passport_scan->saveAs('images/scans/' . $imageName . '.' . $model->passport_scan->extension);
                    $model->passport_scan = 'images/scans/' . $imageName . '.' . $model->passport_scan->extension;
                }
            } else{
                $model->passport_scan = $existing_scan;
            }

            $model->save();
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('editstudent', [
                'model' => $model,
            ]);
        }
    }

    public function actionEditteacher($id)
    {
        $model = $this->findModel($id);
        $model->scenario = "edit";
        if ($model->load(Yii::$app->request->post())) {
            $model->password_hash =Yii::$app->security->generatePasswordHash($model->password);
            $model->save();
            return $this->redirect(['teachers']);
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
        $groups=Groups::find()->all();
        return $this->render('view', [
            'model' => $this->findModel($id),
            'groups' => $groups,
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
        $model->scenario = "create";

        if ($model->load(Yii::$app->request->post())) {
            $user = $model->creatingUser();
            return $this->redirect(['/user/create']);
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
