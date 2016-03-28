<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "t_categories".
 *
 * @property integer $id_category
 * @property string $name
 * @property integer $turn
 * @property integer $section
 *
 * @property TSection $section0
 * @property TOfficeCategory[] $tOfficeCategories
 * @property TOffice[] $idOffices
 */
class TCategories extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 't_categories';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'section'], 'required'],
            [['name'], 'string'],
            [['turn', 'section'], 'integer']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_category' => Yii::t('app', 'Id Category'),
            'name' => Yii::t('app', 'Name'),
            'turn' => Yii::t('app', 'Turn'),
            'section' => Yii::t('app', 'Section'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSection0()
    {
        return $this->hasOne(TSection::className(), ['id_section' => 'section']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTOfficeCategories()
    {
        return $this->hasMany(TOfficeCategory::className(), ['category' => 'id_category']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdOffices()
    {
        return $this->hasMany(TOffice::className(), ['id_office' => 'id_office'])->viaTable('t_office_category', ['category' => 'id_category']);
    }
}
