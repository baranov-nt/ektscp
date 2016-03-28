<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "gal_album".
 *
 * @property string $id_album
 * @property string $name
 * @property string $description
 * @property string $main_img
 * @property integer $status
 * @property integer $user
 * @property integer $community
 * @property string $id_product
 * @property integer $id_estate
 * @property integer $id_adsAgency_place
 * @property integer $id_office
 * @property integer $id_terminal
 *
 * @property AdsAgencyPlace $idAdsAgencyPlace
 * @property CCommunity $community0
 * @property FileImage $mainImg
 * @property PProduct $idProduct
 * @property TTerminal $idTerminal
 * @property GalAlbumImages[] $galAlbumImages
 * @property FileImage[] $idFiles
 */
class GalAlbum extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'gal_album';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'description'], 'required'],
            [['name', 'description'], 'string'],
            [['main_img', 'status', 'user', 'community', 'id_product', 'id_estate', 'id_adsAgency_place', 'id_office', 'id_terminal'], 'integer']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_album' => 'Id Album',
            'name' => 'Name',
            'description' => 'Description',
            'main_img' => 'Main Img',
            'status' => 'Status',
            'user' => 'User',
            'community' => 'Community',
            'id_product' => 'Id Product',
            'id_estate' => 'Id Estate',
            'id_adsAgency_place' => 'Id Ads Agency Place',
            'id_office' => 'Id Office',
            'id_terminal' => 'Id Terminal',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdAdsAgencyPlace()
    {
        return $this->hasOne(AdsAgencyPlace::className(), ['id_place' => 'id_adsAgency_place']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCommunity0()
    {
        return $this->hasOne(CCommunity::className(), ['id_community' => 'community']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMainImg()
    {
        return $this->hasOne(FileImage::className(), ['id_file' => 'main_img']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdProduct()
    {
        return $this->hasOne(PProduct::className(), ['id_product' => 'id_product']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdTerminal()
    {
        return $this->hasOne(TTerminal::className(), ['id_terminal' => 'id_terminal']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGalAlbumImages()
    {
        return $this->hasMany(GalAlbumImages::className(), ['id_album' => 'id_album']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdFiles()
    {
        return $this->hasMany(FileImage::className(), ['id_file' => 'id_file'])->viaTable('gal_album_images', ['id_album' => 'id_album']);
    }
}
