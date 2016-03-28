<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "gal_album_images".
 *
 * @property string $id_album
 * @property string $id_file
 * @property string $description
 * @property integer $sort
 * @property string $created
 * @property integer $status
 *
 * @property FileImage $idFile
 * @property GalAlbum $idAlbum
 */
class GalAlbumImages extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'gal_album_images';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_album', 'id_file', 'created'], 'required'],
            [['id_album', 'id_file', 'sort', 'status'], 'integer'],
            [['description'], 'string'],
            [['created'], 'safe']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_album' => 'Id Album',
            'id_file' => 'Id File',
            'description' => 'Description',
            'sort' => 'Sort',
            'created' => 'Created',
            'status' => 'Status',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdFile()
    {
        return $this->hasOne(FileImage::className(), ['id_file' => 'id_file']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdAlbum()
    {
        return $this->hasOne(GalAlbum::className(), ['id_album' => 'id_album']);
    }
}
