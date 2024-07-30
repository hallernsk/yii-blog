<?php

use app\models\Comments;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var app\models\CategorySearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Comments';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="category-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php // echo $this->render('_search', ['model' => $searchModel]);?>

    <?php if(!empty($comments)): ?>
            <table class="table">
                <thead>
                    <tr>
                        <td>#</td>
                        <td> Author </td>
                        <td> Text </td>
                        <td> Action </td>
                    </tr>
                </thead>

                <tbody>
                    <?php foreach($comments as $comment): ?>
                    <tr>
                        <td><?= $comment->id ?></td>
                        <td><?= $comment->user->name ?? 'Anonymous'?> </td>
                        <td><?= $comment->text ?> </td>
                        <td> 
                            <a href="<?= Url::to(['comment/delete', 'id' => $comment->id]) ?>" class="btn btn-danger">Delete</a>
                        </td>
                    </tr>                  

                    <?php endforeach; ?>
                </tbody>
            </table>
    
    <?php endif; ?>


</div>
