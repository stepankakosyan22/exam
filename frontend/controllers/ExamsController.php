<?php

namespace frontend\controllers;

use frontend\models\ExamQuestions;
use frontend\models\Questions;
use Yii;
use frontend\models\Exams;
use yii\data\ActiveDataProvider;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * ExamsController implements the CRUD actions for Exams model.
 */
class ExamsController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Exams models.
     * @return mixed
     */
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Exams::find(),
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider
        ]);
    }

    /**
     * Displays a single Exams model.
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
     * Creates a new Exams model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Exams();
        $quiz=new ExamQuestions();
        $question_ids = Yii::$app->request->post();
//        echo '<pre>';
//        print_r($question_ids);die;
        if ($model->load(Yii::$app->request->post())) {
            $model->teacher_id=\Yii::$app->user->id;
            $model->active=0;
            $model->save();
//            if (!empty($question_ids['Exams']['question_id'])) {
//                foreach ($question_ids['Exams']['id'] as $id_exam) {
//                    $workers = new ExamQuestions();
//                    $workers->question_id = $model->question_id;
//                    $workers->exam_id = $id_exam;
//                    $workers->save();
//                }
//            }
            return $this->redirect(['view', 'id' => $model->exam_id]);
        } else {
            return $this->render('create', [
                'model' => $model,
                'quiz' => $quiz,
            ]);
        }
    }

    /**
     * Updates an existing Exams model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->exam_id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Exams model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Exams model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Exams the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Exams::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
