<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use app\models\Task;

class SiteController extends Controller {

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        $model = new Task();
        $tasks = $model->getAllTasks();

        return $this->render('index', ['tasks' => $tasks]);
    }

    public function actionCreate() {
        $data = Yii::$app->request->post();

        $model = new Task();
        date_default_timezone_set('America/Fortaleza');
        $model->setId(date('Y-m-d_H:i:s')); //Usa data e hora do servidor como id do arquivo
        $model->setTitulo($data["titulo"]);
        $model->setDescricao($data["descricao"]);
        $model->setStatus($data["status"]);

        if($model->newTask()) {
            return $this->redirect(Yii::$app->homeUrl);
        }

        return false;
    }

    public function actionUpdate() {
        $data = Yii::$app->request->post();

        $model = new Task();
        $model->setId($data["id"]);
        $model->setTitulo($data["titulo"]);
        $model->setDescricao($data["descricao"]);
        $model->setStatus($data["status"]);
        if($model->editTask()) {
            return $this->redirect(Yii::$app->homeUrl);
        }
        return false;
    }

    public function actionDelete() {
        $data = Yii::$app->request->post();

        $model = new Task();
        $model->setId($data["id"]);
        if($model->deleteTask()) {
            return $this->redirect(Yii::$app->homeUrl);
        }
        return false;
    }

    public function actionView() {
        $data = Yii::$app->request->post();

        $model = new Task();
        $model->setId($data["id"]);
        return $model->viewTask();
    }


}
