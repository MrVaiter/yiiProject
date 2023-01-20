<?php

namespace app\modules\admin\controllers;

use app\models\Article;
use app\models\Topic;
use yii\data\Pagination;
use yii\web\Controller;

/**
 * Default controller for the `admin` module
 */
class DefaultController extends Controller
{
    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex()
    {
        $popular = Article::find()->orderBy('viewed desc')->limit(3)->all();
        $recent = Article::find()->orderBy('date desc')->limit(3)->all();
        $topics = Topic::find()->all();

        $query = Article::find();

        $count = $query->count();

        $pagination = new Pagination(['totalCount' => $count, 'pageSize'=> 1]);

        $articles = $query->offset($pagination->offset)
            ->limit($pagination->limit)
            ->all();

        return $this->render('index',[
            'articles'=>$articles,
            'popular' => $popular,
            'recent' => $recent,
            'topics' => $topics,
            'pagination'=>$pagination,
        ]);
    }
}
