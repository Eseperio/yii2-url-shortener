<?php
/**
 * Copyright (c) 2019. Grupo Smart (Spain)
 *
 * This software is protected under Spanish law. Any distribution of this software
 * will be prosecuted.
 *
 * Developed by Waizabú <code@waizabu.com>
 * Updated by: erosdelalamo on 3/7/2019
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
