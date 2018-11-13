<?php
/* @var $this yii\web\View */
use backend\modules\content\models\Information;
use yii\widgets\ListView;
use yii\data\ActiveDataProvider;
use yii\helpers\Html;
use yii\helpers\Url;
$this->title = '学生首页';
//$this->params['breadcrumbs'][] = $this->title;

?>
<div class="row">
        <!-- /.col -->
        <div class="col-md-12">
          <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
              <li class="active"><a href="#test" data-toggle="tab" aria-expanded="false">课堂任务</a></li>
              <li class=""><a href="#content" data-toggle="tab" aria-expanded="false">信息技术学习</a></li>
               
              <li class=""><a href="#settings" data-toggle="tab" aria-expanded="false">视频中心</a></li>
            </ul>
            <div class="tab-content">

            <div class="tab-pane" id="content">
            <?php
            if ($section1) {
            foreach ($section1 as $key1 => $section_1) {
              //exit(var_export($section_1));
            ?>
            <div class="box box-success direct-chat direct-chat-success">
            <div class="box-header with-border">
              <h3 class="box-title"><?=$section_1->itemname?></h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <?php 
                  $dataProvider = new ActiveDataProvider([
                    'query' => Information::find()->where(['infoitem'=>$section_1->itemid]),
                    'pagination' => [
                        'pageSize' =>10,
                    ],
                  ]);
                  echo ListView::widget([
                    'dataProvider' => $dataProvider,
                    'itemView' => 'item',
                    'layout'=> "{items}",
                  ]);

              ?>
            </div>
            <!-- /.box-body -->
            <div class="box-footer">
                  <a href="<?=Url::toRoute(['/site/list','cate'=>$section_1->itemid])?>" class="small-box-footer pull-right">More info <i class="fa fa-arrow-circle-right"></i></a>
            </div>
            <!-- /.box-footer-->
          </div>
              <?php
              }
              }
               ?>
              </div>
              <div class="tab-pane  active" id="test">

                               <div id="chartwk" style="width:100%;height:540px;"></div>
            
                          </div>


              <div class="tab-pane" id="settings">
                  sss
              </div>
              <!-- /.tab-pane -->
            </div>
            <!-- /.tab-content -->
          </div>
          <!-- /.nav-tabs-custom -->
        </div>
        <!-- /.col -->
      </div>
<script src="js/echarts.js"></script>
<script type="text/javascript">
var myChartwk = echarts.init(document.getElementById('chartwk'));
option = {
    tooltip: {
        trigger: 'item',
        formatter: "{a} <br/>{b}: {c} ({d}%)"
    },
    legend: {
        orient: 'vertical',
        x: 'left',
        data:['直达','营销广告','搜索引擎','邮件营销','联盟广告','视频广告','百度','谷歌','必应','其他']
    },
    series: [
        {
            name:'访问来源',
            type:'pie',
            selectedMode: 'single',
            radius: ['10%','30%'],

            label: {
                normal: {
                    position: 'inner'
                }
            },
            labelLine: {
                normal: {
                    show: false
                }
            },
            data:[
                {value:535, name:'直达', selected:true},
                {value:679, name:'营销广告'},
                {value:1548, name:'搜索引擎'}
            ]
        },
        {
            name:'访问来源',
            type:'pie',
            radius: ['40%', '55%'],
            label: {
                normal: {
                    formatter: '{a|{a}}{abg|}\n{hr|}\n  {b|{b}：}{c}  {per|{d}%}  ',
                    backgroundColor: '#eee',
                    borderColor: '#aaa',
                    borderWidth: 1,
                    borderRadius: 4,
                    // shadowBlur:3,
                    // shadowOffsetX: 2,
                    // shadowOffsetY: 2,
                    // shadowColor: '#999',
                    // padding: [0, 7],
                    rich: {
                        a: {
                            color: '#999',
                            lineHeight: 22,
                            align: 'center'
                        },
                        // abg: {
                        //     backgroundColor: '#333',
                        //     width: '100%',
                        //     align: 'right',
                        //     height: 22,
                        //     borderRadius: [4, 4, 0, 0]
                        // },
                        hr: {
                            borderColor: '#aaa',
                            width: '100%',
                            borderWidth: 0.5,
                            height: 0
                        },
                        b: {
                            fontSize: 16,
                            lineHeight: 33
                        },
                        per: {
                            color: '#eee',
                            backgroundColor: '#334455',
                            padding: [2, 4],
                            borderRadius: 2
                        }
                    }
                }
            },
            data:[
                {value:335, name:'直达'},
                {value:310, name:'邮件营销'},
                {value:234, name:'联盟广告'},
                {value:135, name:'视频广告'},
                {value:1048, name:'百度'},
                {value:251, name:'谷歌'},
                {value:147, name:'必应'},
                {value:102, name:'其他'}
            ]
        }
    ]
};
myChartwk.setOption(option);
</script>