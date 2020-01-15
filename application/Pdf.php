<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Pdf {
	
}
/*
class Pdf {

	function pdf() {
		$CI = & get_instance();
		log_message('Debug', 'mPDF class is loaded.');
	}

	function load($param = NULL){
		include_once APPPATH.'/third_party/mpdf7/mpdf.php';
		/*if ($param == NULL) {
			//$param = '"en-GB-x","A","","",10,10,10,10,6,3';
			$param = array(['mode' => 'utf-8', 'format' => [60, 150], 'orientation' => 'P']);
			//$param = ('utf-8', array(120,236));
		}
		return new mPDF($mode='',$format='A6',$default_font_size=0,$default_font='',$mgl=5,$mgr=5,$mgt=3,$mgb=5,$mgh=3,$mgf=3, $orientation='P');
		/*return new mPDF(['mode' => '',
						 'format' => [60, 150],
						 'default_font' =>'',
						 'mgl' => '15',
						 'mgr' => '15',
						 'mgt' => '16',
						 'mgb' => '16',
						 'mgh' => '9',
						 'mgf' => '9', 
						 'orientation' => 'P']);
	}

}*/
//require_once __DIR__ . '/vendor/autoload.php';

//$mpdf = new \Mpdf\Mpdf();