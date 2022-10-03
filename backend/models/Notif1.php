<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "notif1".
 *
 * @property int $id
 * @property int $id_sm
 * @property string $created_at
 * @property int $tujuan
 * @property string $isi
 * @property string $header
 * @property int $id_sk
 * @property string $status
 */
class Notif1 extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'notif1';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
           
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_sm' => 'Id Sm',
            'created_at' => 'Created At',
            'tujuan' => 'Tujuan',
            'isi' => 'Isi',
            'header' => 'Header',
            'id_sk' => 'Id Sk',
            'status' => 'Status',
        ];
    }

    public function getSm()
    {
        return $this->hasMany(Suratmasuk::class, ['id_sm' => 'id_sm']);
    }
}
