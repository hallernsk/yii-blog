<?php

namespace app\modules\admin\controllers;

use app\models\Article;
use app\models\ArticleSearch;
use app\models\Category;
use app\models\ImageUpload;
use app\models\Tag;
use Codeception\Lib\Di;
use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;
use yii\web\UploadedFile;

/**
 * ArticleController implements the CRUD actions for Article model.
 */
class ArticleController extends Controller
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
                    'class' => VerbFilter::className(),
                    'actions' => [
                        'delete' => ['POST'],
                    ],
                ],
            ]
        );
    }

    /**
     * Lists all Article models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new ArticleSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Article model.
     * @param int $id ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Article model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new Article();

        $model->load($this->request->post()); // true

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->saveArticle()) {
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
     * Updates an existing Article model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->saveArticle()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Article model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    public function actionSetImage($id)
    {
        $model = new ImageUpload();


        // if (Yii::$app->request->isPost) {
        if ($model->load(Yii::$app->request->post())) {

            $article = $this->findModel($id);
            $file = UploadedFile::getInstance($model, 'image');

            if ($article->saveImage($model->uploadFile($file, $article->image))) {
                return $this->redirect(['view', 'id' => $article->id]);
            }

        }
        return $this->render('image', ['model' => $model]);
    }

    public function actionSetCategory($id)
    {
        $article = $this->findModel($id);
        $selectedCategory = $article->category ? $article->category->id : null;
        $categories = ArrayHelper::map(Category::find()->all(), 'id', 'title');

        if (Yii::$app->request->isPost) {

            $category = Yii::$app->request->post('category');

            if ($article->saveCategory($category)) {
                return $this->redirect(['view', 'id' => $article->id]);
            }
        }
        return $this->render('category', [
            'article' => $article,
            'selectedCategory' => $selectedCategory,
            'categories' => $categories,
        ]);
    }

    public function actionSetTags($id)  // добавление тегов к статье
    {
        $article = $this->findModel($id);
        // $selectedTags = $article->getSelectedTags();
        $selectedTags = $article->getSelectedTags();
        // $tags = Tag::find()->all();
        $tags = ArrayHelper::map(Tag::find()->all(), 'id', 'title');

        // var_dump($tags); // array !
        // die();
        if (Yii::$app->request->isPost) {

            $tags = Yii::$app->request->post('tags');
            // var_dump($tags);
            // die();

            if ($article->saveTags($tags)) {
                // var_dump('saveTest:Ok');
                // die();
                return $this->redirect(['view', 'id' => $article->id]);
            }
        }


        return $this->render('tags', [
            'article' => $article,
            'selectedTags' => $selectedTags,
            'tags' => $tags
        ]);

        // $selectedTags = $article->getSelectedTags();
        // $tags = Tag::find()->all();
    }


    /**
     * Finds the Article model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Article the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Article::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
