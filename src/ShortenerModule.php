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


use eseperio\shortener\models\Shortener;
use yii\base\Module;
use yii\db\Expression;
use yii\helpers\Url;

class ShortenerModule extends Module
{

//        $options="ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz123456789";
    /**
     * Must have a lenght of 61
     * @var string
     */
    public $options = "NkAXITYvw3iObfKEaoeCUxqm2Dnrugl9PthVSM8yc7GQdBJHW6Lz4ZsjR15pF";

    /**
     * @param $id
     * @return mixed|string the url
     */
    public function expand($id)
    {
        $model = Shortener::find()
            ->where(['shortened' => (new Expression("BINARY('$id')"))])
            ->one();

        if (!empty($model)) {
//Delete record if is not valid anymore.
            if (!is_null($model->valid_until) && time() > $model->valid_until) {
                $model->delete();
            } else {
                return $model->url;
            }
        }

        return false;

    }

    /**
     * @param $url      string|array It accepts any url format allowed by Yii2
     * @param $lifetime integer Time in seconds that the links must be available
     */
    public function short($url, $lifetime)
    {
        $model = new Shortener();
        $model->setAttributes([
            'url' => Url::to($url),
            'valid_until' => empty($lifetime) ? null : time() + $lifetime
        ]);
    }


    public function getShortId()
    {
        return $this->generateShortId();
    }

    /**
     * Method to generate short id of url
     */
    private function generateShortId()
    {
//        $options="ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz123456789";
//        Shuffled
        $id = [];
        $monthYear = +date('y') + +date('M');
        $dayHour = +date('j') + +date('G');
        $id = [
            $this->options[$monthYear],
            $this->options[$dayHour],
            $this->options[+date('i')],
            $this->options[+date('s')],
            $this->options[+date('s')],
        ];

        return join("", $id);


    }
}
