<?php

namespace frontend\modules\files\models;

use Yii;

/**
 * This is the model class for table "file_video".
 *
 * @property string $id_file
 * @property integer $user
 * @property string $created
 * @property integer $is_tmp
 * @property integer $cnt_use
 * @property integer $mode
 * @property string $code
 *
 * @property Users $user0
 * @property WallRecord[] $wallRecords
 */
class FileVideo extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'file_video';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user', 'created', 'is_tmp', 'cnt_use', 'mode', 'code'], 'required'],
            [['user', 'is_tmp', 'cnt_use', 'mode'], 'integer'],
            [['created'], 'safe'],
            [['code'], 'string']
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
            'cnt_use' => 'Cnt Use',
            'mode' => 'Mode',
            'code' => 'Code',
        ];
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
    public function getWallRecords()
    {
        return $this->hasMany(WallRecord::className(), ['video' => 'id_file']);
    }
	
	protected function beforeSave($insert)
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
	
	public function initVideo($url) {
		try {
			if(strpos($url, 'youtu.be/') !== FALSE) {
				$this->mode = 1;
				$this->code = current(explode('?', end(explode('/', $url))));
			} 
			else if(strpos($url, 'youtube') !== FALSE) {
				$this->mode = 1;
				if(preg_match("/http.+?v=([a-z0-9\-_]+)/i", $url, $matches));
					$this->code = $matches[1];
			}
			else if(strpos($url, 'rutube') !== FALSE) {
				$this->mode = 2;
				if(preg_match("/http.+?video\/([a-z0-9\-_]+)/i", $url, $matches))
					$this->code = $matches[1];
				else if(preg_match("/http.+?tracks\/(\d+?).html/i", $url, $matches))
					$this->code = $matches[1];
			}
		} catch (Exception $e) { }
		if($this->code) return true;
		else return false;
	}
	
	public function getPreview() {
		switch($this->mode) {
			case 1:
				return '<img class="preview" src="http://img.youtube.com/vi/'.$this->code.'/0.jpg" />';
			case 2:
				$opts = array('http' =>
					array(
						'method'  => 'GET',
						'timeout' => 10
					)
				);
				$context = stream_context_create($opts);
				try { $result = @file_get_contents('http://rutube.ru/api/video/'.$this->code, false, $context); }
				catch(Exception $e) { $result = false; }
				if($result) {
					$vi = json_decode($result);
					return '<img class="preview" src="'.$vi->thumbnail_url.'" />';
				}
				else
					return '<img class="preview" src="/images/rutube_default.jpg" />';
		}
	}
	
	public function getPlayer($width = 600, $height = 337) {
		switch($this->mode) {
			case 1:
				return '<div class="video-player youtube"><iframe title="YouTube video player" width="'.$width.'px" height="'.$height.'px" src="https://www.youtube-nocookie.com/embed/'.$this->code.'?fs=1&amp;hl=ru_RU&amp;rel=0&amp;wmode=opaque" frameborder="0" allowfullscreen></iframe></div>';
			case 2:
				return '<div class="video-player rutube"><iframe width="'.$width.'px" height="'.$height.'px" src="//rutube.ru/video/embed/'.$this->code.'" frameborder="0" webkitAllowFullScreen mozallowfullscreen allowfullscreen></iframe></div>';
		}
	}
}
