<?php
defined('BASEPATH') OR exit('No direct script access allowed'); 
Class TransactionModel extends CI_Model {

    /*function search_product() {
    	if (isset($_REQUEST['query'])) {
    		$query = $_REQUEST['query'];
    		$find = $this->db->like('product_name', '$query');
			$array = array();
		    while ($row = mysql_fetch_array($find)) {
		        $array[] = array (
		            'label' => $row['city'].', '.$row['zip'],
		            'value' => $row['city'],
		        );
    	}
    //RETURN JSON ARRAY
    		echo json_encode ($array);
		}
    }*/

    function simpanTransaksi($data) {
    	return $this->db->insert_batch('transaction', $data);
    	/*$count = count($data['count']);
		for($i = 0; $i<$count; $i++){
			$entries[] = array(
				//'transaction_date'=>$data['transaction_date'][$i],
				'id_transaction'=>$data['itTransaction'][$i],
				'transaction_date'=>$data['date'][$i],
				'transaction_type'=>$data['type'][$i],
				'id_user'=>$data['user'][$i],
				'transaction_customer'=>$data['customer'][$i],
				'id_product'=>$data['idProduct'][$i],
				'stock_price'=>$data['stockPrice'][$i],
				'product_price'=>$data['Price'][$i],
				'transaction_qty'=>$data['quantity'][$i],
			);
		}
		$this->db->insert_batch('transaction', $entries); 
		if($this->db->affected_rows() > 0)
			return 1;
		else
			return 0;*/
    }

}