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

namespace eseperio\shortener;


use WebApplication;
use yii\base\Application;
use yii\base\BootstrapInterface;

class Bootstrap implements BootstrapInterface
{

    /**
     * Bootstrap method to be called during application bootstrap stage.
     * @param Application $app the application currently running
     */
    public function bootstrap($app)
    {
        if (\Yii::$app->hasModule('shortener')){
            if ($app instanceof \yii\web\Application) {
                $this->initUrlRoutes($app);
            }
        }
    }

    protected function initUrlRoutes(\yii\web\Application $application)
    {
        $module = $application->getModule('shortener');
        /* @var $module ShortenerModule */
        $application->urlManager->addRules($module->urlConfig);
    }
}
