<?php
/**
 *
 * Developed by Waizabú <code@waizabu.com>
 *
 *
 */

namespace eseperio\shortener\controllers;


use eseperio\shortener\ShortenerModule;
use yii\web\NotFoundHttpException;

/**
 * Class DefaultController
 * @package eseperio\shortener\controllers
 */
class DefaultController extends \yii\web\Controller
{


    /**
     * @param $id
     * @return \yii\web\Response
     * @throws NotFoundHttpException
     */
    public function actionParse($id)
    {
        $module = \Yii::$app->getModule('shortener');
        /* @var $module ShortenerModule */

        if($url= $module->expand($id))
            return $this->redirect($url);

        throw new NotFoundHttpException();
    }
}
