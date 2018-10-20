<?php
namespace backend\libary;
use Yii;
use PHPExcel;

class CommonFunction{

	static function getSubjects()
	{
    $subjects = [
		    'yw'=>'语文','ds'=>'数学','yy'=>'英语',
		    'wl'=>'物理','hx'=>'化学','sw'=>'生物',
		    'zz'=>'政治','ls'=>'历史','dl'=>'地理',
		    'ty'=>'体育','xx'=>'信息','ms'=>'美术',
		    'yu'=>'音乐','zf'=>'总分'
		];
		return $subjects;
	}

	static function getAllTeachDuty()
	{
		    $subjects = [
		    'bzr'=>'班主任','yw'=>'语文','ds'=>'数学',
		    'yy'=>'英语','wl'=>'物理','hx'=>'化学',
		    'sw'=>'生物','zz'=>'政治','ls'=>'历史',
		    'dl'=>'地理','ty'=>'体育','xx'=>'信息',
		    'ms'=>'美术','yu'=>'音乐',
		];
		return $subjects;
	}
	static function getLksubjects()
	{
		$subjects = [
		    'yw'=>'语文','ds'=>'数学','yy'=>'英语',
		    'wl'=>'物理','hx'=>'化学','sw'=>'生物',
		];
		return $subjects;
	}

	static function getWksubjects()
	{
		$subjects = [
		    'yw'=>'语文','ds'=>'数学','yy'=>'英语',
		    'zz'=>'政治','ls'=>'历史','dl'=>'地理',
		];
		return $subjects;
	}

	static function getClassType()
	{
		return ['lk'=>'理科','wk'=>'文科'];
	}

	static function getTeacherType()
	{
		return ['js'=>'教师','ma'=>'管理员'];
	}

	static function getSchool()
	{
		return ['市七中'=>"市七中"];
	}

	static function gradelist()
	{
	    $year = date('Y');
	    $yearRange = range($year-3,$year+3);
	    foreach ($yearRange as $key => $value) {
	        $gradelist[$value] = $value.'届';
	    }
	    return $gradelist;
	}

	static function dataCompare($datafore,$datanow)
	{
		
	}


static function export($title='export',$headerArr=null,Array $data)
    {
    	$cellName = ['A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 'N', 'O', 'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y', 'Z', 'AA', 'AB', 'AC', 'AD', 'AE', 'AF', 'AG', 'AH', 'AI', 'AJ', 'AK', 'AL', 'AM', 'AN', 'AO', 'AP', 'AQ', 'AR', 'AS', 'AT', 'AU', 'AV', 'AW', 'AX', 'AY', 'AZ']; 
        if ($headerArr==null) {
          $headerArr = ['编号','用户名','生成时间'];
        }
        
        $fileName = "export.xlsx";
        $objPHPExcel = new PHPExcel();
        $objProps = $objPHPExcel->getProperties();

        $key = 0;
        foreach($headerArr as $keyhead=>$v){
        	$colum = $cellName[$key];
             $objPHPExcel->setActiveSheetIndex(0)->setCellValue($colum.'1',$v);
            $key++;
            if ($key>count($cellName)) {
            	break;
            }
        }

        $recordArr = array();
        $key=0;
        if ($data!=null) {
            $row = '2';
            foreach ($data as $row_id => $val) {
               $colum = 0;
               foreach ($val as $key2 => $val2) {
               	    $columAsc = $cellName[$colum];
                    $recordArr[$row][$columAsc] = $val2;
                    $objPHPExcel->setActiveSheetIndex(0)->setCellValue($columAsc.$row,$val2);
                    $colum++;
               }
                 $row++;
            }
        }
        //exit(var_export(count($data)));
       // exit(var_export($recordArr));

        $objPHPExcel->getActiveSheet()->setTitle('sheet1');
        $objPHPExcel->setActiveSheetIndex(0);

        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header("Content-Disposition: attachment; filename=\"$fileName\"");
        header('Cache-Control: max-age=0');

        $writer = \PHPExcel_IOFactory::createWriter($objPHPExcel,'Excel2007');
        $writer->save('php://output');
        return 0;
    }


    //==========================================
}


?>