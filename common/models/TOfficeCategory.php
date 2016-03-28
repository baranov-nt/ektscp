<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "t_office_category".
 *
 * @property integer $id_office
 * @property integer $category
 * @property integer $is_main
 *
 * @property TCategories $category0
 * @property TOffice $idOffice
 */
class TOfficeCategory extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 't_office_category';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_office', 'category'], 'required'],
            [['id_office', 'category', 'is_main'], 'integer']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_office' => Yii::t('app', 'Id Office'),
            'category' => Yii::t('app', 'Category'),
            'is_main' => Yii::t('app', 'Is Main'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCategory0()
    {
        return $this->hasOne(TCategories::className(), ['id_category' => 'category']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdOffice()
    {
        return $this->hasOne(TOffice::className(), ['id_office' => 'id_office']);
    }
}
