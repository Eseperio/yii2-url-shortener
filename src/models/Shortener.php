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

namespace eseperio\shortener\models;

use eseperio\shortener\ShortenerModule;
use yii\behaviors\SluggableBehavior;

/**
 * This is the model class for table "yii2_shortener".
 *
 * @property int $id
 * @property string $url
 * @property string $shortened
 * @property int $valid_until
 */
class Shortener extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'yii2_shortener';
    }

    /**
     * @param $event
     * @return string
     */
    public static function getSlugValue($event)
    {
        $module = \Yii::$app->getModule('shortener');

        /* @var $module ShortenerModule */
        return $module->getShortId();
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['valid_until'], 'integer'],
            [['url'], 'string', 'max' => 256],
            [['shortened'], 'string', 'max' => 16],
            [['shortened'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'url' => 'Url',
            'shortened' => 'Shortened',
            'valid_until' => 'Valid Until',
        ];
    }

    /**
     * @return array
     */
    public function behaviors()
    {
        return [
            'sluggable' => [
                'class' => SluggableBehavior::class,
                'slugAttribute' => 'shortened',
                'ensureUnique' => true,
                'value' => [$this, 'getSlugValue']
            ]
        ];
    }
}
