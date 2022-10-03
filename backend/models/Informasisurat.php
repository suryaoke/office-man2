<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "informasisurat".
 *
 * @property int $id
 * @property string $tujuan_surat
 * @property string $perihal
 * @property int $id_naskah_dinas
 * @property string $nomor_agenda
 * @property string $tanggal_surat
 * @property string $no_surat
 * @property string $status
 */
class Informasisurat extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'informasisurat';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['tujuan_surat', 'perihal', 'id_naskah_dinas', 'nomor_agenda', 'tanggal_surat', 'no_surat', 'status'], 'required'],
            [['id_naskah_dinas'], 'integer'],
            [['tujuan_surat', 'perihal', 'nomor_agenda', 'tanggal_surat', 'no_surat', 'status'], 'string', 'max' => 200],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'tujuan_surat' => 'Tujuan Surat',
            'perihal' => 'Perihal',
            'id_naskah_dinas' => 'Id Naskah Dinas',
            'nomor_agenda' => 'Nomor Agenda',
            'tanggal_surat' => 'Tanggal Surat',
            'no_surat' => 'No Surat',
            'status' => 'Status',
        ];
    }
}
