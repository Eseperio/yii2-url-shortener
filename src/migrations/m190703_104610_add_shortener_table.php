<?php
/**
 *
 * Developed by Waizabú <code@waizabu.com>
 *
 *
 */


use yii\db\Migration;

/**
 * Class m190703_104610_add_shortener_table
 */
class m190703_104610_add_shortener_table extends Migration
{

    private $tableName = '{{%url_links}}';

    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable($this->tableName, [
            'id' => $this->primaryKey(),
            'url' => $this->string(255),
            'shortened' => $this->string(25),
            'valid_until' => $this->integer(),
            'created_by' => $this->string(3),
            'created_at' => $this->dateTime(),
            'updated_by' => $this->string(3),
            'updated_at' => $this->dateTime(),
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
