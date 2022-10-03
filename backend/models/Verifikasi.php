<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "verifikasi".
 *
 * @property int $id
 * @property int $id_informasi
 * @property int $id_user
 * @property string $status
 * @property string $ket
 */
class Verifikasi extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'verifikasi';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_informasi', 'id_user', 'status', 'ket'], 'required'],
            [['id_informasi', 'id_user'], 'integer'],
            [['status', 'ket'], 'string', 'max' => 200],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_informasi' => 'Id Informasi',
            'id_user' => 'Id User',
            'status' => 'Status',
            'ket' => 'Ket',
        ];
    }
}
