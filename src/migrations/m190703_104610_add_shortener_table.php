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


use yii\db\Migration;

/**
 * Class m190703_104610_add_shortener_table
 */
class m190703_104610_add_shortener_table extends Migration
{

    private $tableName = 'yii2_shortener';

    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable($this->tableName, [
            'id' => $this->primaryKey(),
            'url' => $this->string(256),
            'shortened' => $this->string(16),
            'valid_until'=> $this->integer()
        ]);

        $this->createIndex('shortenedUrl', $this->tableName, [
            'shortened'
        ], true);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        return $this->dropTable($this->tableName);
    }


}
