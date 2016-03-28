<?php

namespace frontend\modules\files\models;

use Yii;

/**
 * This is the model class for table "file_doc".
 *
 * @property string $id_file
 * @property integer $user
 * @property string $created
 * @property integer $is_tmp
 * @property integer $server
 * @property string $path
 * @property string $name
 * @property string $type
 * @property integer $cnt_use
 *
 * @property WorkResumeWork[] $workResumeWorks
 * @property Users $user0
 */
class FileDoc extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'file_doc';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user', 'is_tmp', 'server', 'name', 'type'], 'required'],
            [['user', 'is_tmp', 'server', 'cnt_use'], 'integer'],
            [['created'], 'safe'],
            [['path', 'name', 'type'], 'string']
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
            'name' => 'Name',
            'type' => 'Type',
            'cnt_use' => 'Cnt Use',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getWorkResumeWorks()
    {
        return $this->hasMany(WorkResumeWork::className(), ['id_doc' => 'id_file']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser0()
    {
        return $this->hasOne(Users::className(), ['id' => 'user']);
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
