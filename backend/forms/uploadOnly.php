<?php

namespace backend\forms;

use yii\base\Model;
use yii\web\UploadedFile;

class UploadOnly extends Model
{
    /**
     * @var UploadedFile
     */
    public $imageFile;
    public $param;
	
    public $directory='files';
    
    public $ext = 'xls,xlsx';

    public $url;

    public function rules()
    {
        return [
            ['param','required'],
            [['imageFile'], 'file', 'skipOnEmpty' => false, 'extensions' => $this->ext],

        ];
    }

    public function setDirectory($directory)
    {
        $this->directory = $directory;
        return true;
    }

    public function setExtension($extension)
    {
        $this->extension = $extension;
        return true;
    }
    
    public function upload()
    {

        if ($this->validate()) {
            //$name = $this->imageFile->baseName;
            //文件系统支持gb2312，系统使用utf-8，因此保存文件名用GB2312,存储用UTF-8；
            $name = uniqid().'.'.$this->imageFile->extension;
            $url = 'upload/'.$this->directory.'/'.$name;
            $this->url = $url;
            //$name = iconv("utf-8","gb2312",$this->imageFile->baseName);
            //$this->imageFile->saveAs('upload/cover/' . $name . '.' . $this->imageFile->extension);
            $this->imageFile->saveAs($url);
            return $url;
        } else {
            exit('uploadonly form validate error!');
            return false;
        }
    }


    public function delFile()
    {
        return  unlink($this->url);
    }
}




?>