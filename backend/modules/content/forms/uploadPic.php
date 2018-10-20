<?php

namespace backend\modules\content\forms;

use yii\base\Model;
use yii\web\UploadedFile;

class UploadPic extends Model
{
    /**
     * @var UploadedFile
     */
    public $imageFile;
	public $infoid;
    public $title;
	public $attachdesc;
	public $showorder;
	public $url;

    public function rules()
    {
        return [
            [['imageFile'], 'file', 'skipOnEmpty' => false, 'extensions' => 'mp4,jpg,jpeg,png'],
		 	[['infoid','attachdesc','title','imageFile'], 'required'],
            [['showorder'],'integer'],
        ];
    }
    
    public function upload()
    {
        if ($this->validate()) {
            //$name = $this->imageFile->baseName;
            //文件系统支持gb2312，系统使用utf-8，因此保存文件名用GB2312,存储用UTF-8；
            //2017.1.1 保存文件不再使用中文文件名
            //$name = '中文名字';

            //$url = 'upload/' . $this->imageFile->baseName . '.' . $this->imageFile->extension;
            //$name = iconv("utf-8","gb2312",$this->imageFile->baseName);
            //$this->imageFile->saveAs('upload/' . $name . '.' . $this->imageFile->extension);
            //$this->imageFile->saveAs($url);
            $url = 'upload/media/' .uniqid(). '.' . $this->imageFile->extension;
            $this->imageFile->saveAs($url);
            return $url;
        } else {
            exit(var_export($this->getFirstErrors()));
        }
    }

    public function attributeLabels()
    {
        return [
            'imageFile'=>'文件',
            'infoid'=>'栏目',
            'title'=>'标题',
            'attachdesc'=>'描述',
            'showorder'=>'顺序',
            'url'=>'URL',
        ];
    }
}




?>