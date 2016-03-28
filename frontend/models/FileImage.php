<?php

namespace frontend\models;

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
 * @property string $md5
 * @property string $lang
 * @property string $parent
 *
 * @property CCommunity[] $cCommunities
 * @property Users $user0
 * @property GalAlbum[] $galAlbums
 * @property GalAlbumImages[] $galAlbumImages
 * @property GalAlbum[] $idAlbums
 * @property TInternet[] $tInternets
 * @property TMenu[] $tMenus
 * @property TMenu[] $tMenus0
 * @property TSreenshot[] $tSreenshots
 * @property WallRecord[] $wallRecords
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
            [['user', 'created', 'is_tmp', 'server'], 'required'],
            [['user', 'is_tmp', 'server', 'width', 'height', 'cnt_use', 'parent'], 'integer'],
            [['created'], 'safe'],
            [['path', 'crop_sets', 'md5', 'lang'], 'string']
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
            'md5' => 'Md5',
            'lang' => 'Lang',
            'parent' => 'Parent',
        ];
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
    public function getTInternets()
    {
        return $this->hasMany(TInternet::className(), ['id_file' => 'id_file']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTMenus()
    {
        return $this->hasMany(TMenu::className(), ['id_file' => 'id_file']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTMenus0()
    {
        return $this->hasMany(TMenu::className(), ['id_file2' => 'id_file']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTSreenshots()
    {
        return $this->hasMany(TSreenshot::className(), ['id_file' => 'id_file']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getWallRecords()
    {
        return $this->hasMany(WallRecord::className(), ['photo' => 'id_file']);
    }
}
