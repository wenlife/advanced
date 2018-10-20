<?php
namespace backend\modules\ana\libary;
use Yii;

class ExamScore{

	public $score;

	public $id;
	public $exam;
	public $name;
	public $yw;
	public $ds;
	public $yy;
	public $wl;
	public $hx;
	public $sw;
	public $zz;
	public $ls;
	public $dl;
	public $zf;
	public function __construct($score)
	{
		$this->score = $score;
		$this->id = $score->stu_id;
		$this->exam = $score->exam_id;
		$this->name = $score->name;
		$this->yw = $score->yw;
		$this->ds = $score->ds;
		$this->yy = $score->yy;
		$this->wl = $score->wl;
		$this->hx = $score->hx;
		$this->sw = $score->sw;
		$this->zz = $score->zz;
		$this->ls = $score->ls;
		$this->dl = $score->dl;

	}

	public function getZHZF()
	{
		return $this->wl+$this->sw+$this->hx+$this->zz+$this->ls+$this->dl;
	}


	public function getZF()
	{
		return $this->yw+$this->ds+$this->yy+$this->getZHZF();
	}


	public function setId($id)
	{
		$this->id = $id;
	}
	public function getId()
	{
		return $this->id;
	}


}



?>