<?php

namespace frontend\modules\files\models;

use Yii;

/**
 * This is the model class for table "file_image".
 *
 * @property string $id_file
 * @property integer $user
 * @property string $created
 * @property integer $is_tmp
 * @property integer $server
 * @property string $path
 * @property integer $width
 * @property integer $height
 * @property string $crop_sets
 * @property integer $cnt_use
 *
 * @property GalAlbumImages[] $galAlbumImages
 * @property GalAlbum[] $idAlbums
 * @property GalAlbum[] $galAlbums
 * @property TInternet[] $tInternets
 * @property WallRecord[] $wallRecords
 * @property CCommunity[] $cCommunities
 * @property Users $user0
 */
class FileImage extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'file_image';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user', 'server'], 'required'],
            [['user', 'is_tmp', 'server', 'width', 'height', 'cnt_use'], 'integer'],
            [['created'], 'safe'],
            [['path', 'crop_sets'], 'string'],
			['is_tmp', 'default', 'value' => 1],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_file' => 'Id File',
            'user' => 'User',
            'created' => 'Created',
            'is_tmp' => 'Is Tmp',
            'server' => 'Server',
            'path' => 'Path',
            'width' => 'Width',
            'height' => 'Height',
            'crop_sets' => 'Crop Sets',
            'cnt_use' => 'Cnt Use',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGalAlbumImages()
    {
        return $this->hasMany(GalAlbumImages::className(), ['id_file' => 'id_file']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdAlbums()
    {
        return $this->hasMany(GalAlbum::className(), ['id_album' => 'id_album'])->viaTable('gal_album_images', ['id_file' => 'id_file']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGalAlbums()
    {
        return $this->hasMany(GalAlbum::className(), ['main_img' => 'id_file']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTInternets()
    {
        return $this->hasMany(TInternet::className(), ['id_file' => 'id_file']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getWallRecords()
    {
        return $this->hasMany(WallRecord::className(), ['photo' => 'id_file']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCCommunities()
    {
        return $this->hasMany(CCommunity::className(), ['logo' => 'id_file']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser0()
    {
        return $this->hasOne(Users::className(), ['id' => 'user']);
    }
	
	public function setSize()
	{
		// @todo Please modify the following code to remove attributes that should not be searched
		$imageInfo = @getimagesize($_SERVER['DOCUMENT_ROOT'].$this->path);
		$this->width = $imageInfo[0];
		$this->height = $imageInfo[1];
	}
	
	public function beforeSave($insert)
	{
		if(parent::beforeSave($insert))
		{
			if($this->created) $this->created = date("Y-m-d\TH:i:s", strtotime($this->created));
			else $this->created = date("Y-m-d\TH:i:s", time());
			return true;
		}
		else
			return false;
	}
}
