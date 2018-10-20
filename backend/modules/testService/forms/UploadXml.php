<?php

namespace backend\modules\testService\forms;

use yii\base\Model;
use yii\web\UploadedFile;

class UploadXml extends Model
{
    /**
     * @var UploadedXml
     */
    public $url;
    public $file;

    public $exam;

    public $type;
	

    public function rules()
    {
        return [
            [['file'], 'file', 'skipOnEmpty' => false, 'extensions' => 'xls,xlsx'],
            ['exam', 'required'],
             ['type', 'required'],

        ];
    }
    
    public function upload()
    {
        if ($this->validate()) {
            //$name = $this->file->baseName;
            //文件系统支持gb2312，系统使用utf-8，因此保存文件名用GB2312,存储用UTF-8；
            $name = uniqid().'.'.$this->file->extension;
            $url = 'upload/file/' .$name;
            //$name = iconv("utf-8","gb2312",$this->file->baseName);
            //$this->file->saveAs('upload/file/' . $name . '.' . $this->file->extension);
            $this->file->saveAs('upload/file/' . $name);
            $this->url = $url;
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