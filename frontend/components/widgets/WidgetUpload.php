<?php
namespace frontend\components\widgets;

use Yii;
use yii\base\Widget;

class WidgetUpload extends Widget
{
	public $upload_button;
	public $input_name = false;
	public $name_old_file = false;
	public $selector_file = false;
	public $extensions = false;
	public $popup_hidden = false;
	public $jcrop = false;
	public $image_terminal = false;
	public $different_loading = false;
	
    public function init()
    {
        parent::init();
    }
    public function run()
    {
		return $this->render('widgetupload', [
			"upload_button"=>$this->upload_button,
			"input_name"=>$this->input_name,
			"name_old_file"=>$this->name_old_file,
			"selector_file"=>$this->selector_file,
			"extensions"=>$this->extensions,
			"popup_hidden"=>$this->popup_hidden,
			"jcrop"=>$this->jcrop,
			"image_terminal"=>$this->image_terminal,
			"different_loading"=>$this->different_loading,
		]);
    }
}
?>