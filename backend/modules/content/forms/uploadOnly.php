<?php

namespace backend\modules\content\forms;

use yii\base\Model;
use yii\web\UploadedFile;

class UploadOnly extends Model
{
    /**
     * @var UploadedFile
     */
    public $imageFile;
	

    public function rules()
    {
        return [
            [['imageFile'], 'file', 'skipOnEmpty' => false, 'extensions' => 'png,jpg'],

        ];
    }
    
    public function upload()
    {
        if ($this->validate()) {
            //$name = $this->imageFile->baseName;
            //文件系统支持gb2312，系统使用utf-8，因此保存文件名用GB2312,存储用UTF-8；
            $name = uniqid().'.'.$this->imageFile->extension;
            $url = 'upload/cover/' .$name;
            //$name = iconv("utf-8","gb2312",$this->imageFile->baseName);
            //$this->imageFile->saveAs('upload/cover/' . $name . '.' . $this->imageFile->extension);
            $this->imageFile->saveAs('upload/cover/' . $name);
            return $url;
        } else {
            exit('uploadonly form validate error!');
            return false;
        }
    }
}




?>