<?php
namespace backend\modules\content\libary;
use Yii;
use backend\modules\content\models\Information;
use backend\modules\content\models\Picturelist;
use backend\modules\content\models\Videolist;
use backend\modules\content\models\ContentMenu;
use yii\helpers\Url;

class InformationConverse{

	public $contentMenu;

	function __construct($contentMenu)
	{
		$this->contentMenu = $contentMenu;
	}

	public function contentType()
	{
		$contentType = null;
		switch ($this->contentMenu->type) {
			case 'information':
				$contentType = Information::find()->where(['infoid'=>$this->contentMenu->articleid]);
				break;
			case 'picture':
				$contentType = Picturelist::find()->where(['id'=>$this->contentMenu->articleid]);
				break;
			case 'video':
				$contentType = Videolist::find()->where(['id'=>$this->contentMenu->articleid]);
				break;
			
			default:
				$contentType = null;
				break;
		}
		return $contentType;
	}

	public function contentFrontView()
	{
		$url = null;
		switch ($this->contentMenu->type) {
			case 'information':
				$url = Url::to(['site/detail','id'=>$this->contentMenu->articleid]);
				break;
			case 'picture':
				$url = Url::to(['site/pdetail','id'=>$this->contentMenu->articleid]);
				break;
			case 'video':
				$url = Url::to(['site/vdetail','id'=>$this->contentMenu->articleid]);
				break;
			
			default:
				$url = null;
				break;
		}

	    return $url;
	}

	
}
?>