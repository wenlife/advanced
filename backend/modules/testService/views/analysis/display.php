<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model app\models\Student */

$this->title = '导入成绩';
$this->params['breadcrumbs'][] = $this->title;
?>

<div>
 <table class='table table-bordered'>
 	<th>
 		<td>name</td>
 		<td>school</td>
 		<td>class</td>
 		<td>YW</td>
 		<td>DS</td>
 		<td>YY</td>
 		<td>WL</td>
 		<td>HX</td>
 		<td>SW</td>
 		<td>ZF</td>
 	</th>
 <?php
foreach ($data as $key => $data) {
	echo "<tr><td>";
	echo $data[0];
	echo "</td><td>";
	echo $data[1];
	echo "</td><td>";
	echo $data[2];
	echo "</td><td>";
	echo $data[3];
	echo "</td><td>";
	echo $data[4];
	echo "</td><td>";
	echo $data[5];
	echo "</td><td>";
	echo $data[6];
	echo "</td><td>";
	echo $data[7];
	echo "</td><td>";
	echo $data[8];
	echo "</td><td>";
	echo $data[9];
	echo "</td><td>";
	echo $data[10];
	echo "</td></tr>";
}
 ?>
 </table>
</div>