<?php

/**
 * Description of KindEditorAsset
 *  KindEditor资源组织文件
 * @author Qinn Pan <Pan JingKui, pjkui@qq.com>
 * @link http://www.pjkui.com
 * @QQ 714428042
 * @date 2015-3-4

 */
namespace pjkui\kindeditor;
use yii\web\AssetBundle;
class KindEditorAsset extends AssetBundle {
    //put your code here
    public $js=[
        'kindeditor-min.js',
        'lang/zh_cn.js',
       // 'kindeditor.js'
    ];
    public $css=[
        'themes/default/default.css'
    ];
    
    public $jsOptions=[
        'charset'=>'utf8',
    ];


    public function init() {
        //资源所在目录
        $this->sourcePath = dirname(__FILE__) . DIRECTORY_SEPARATOR ;
    }
}

?>
