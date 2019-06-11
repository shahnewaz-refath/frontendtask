<?php
require_once 'config.php';
class Api{
	public function select(){
		$database = new Connect;
		$sales = array();
		$data = $database->prepare('SELECT * FROM salesdetails ORDER BY id_pk ASC');
		$data->execute();
		while($output = $data->fetch(PDO::FETCH_ASSOC)){
			$sales[$output['id_pk']] = array(
				'id' => $output['id_pk'],
				'orderId' => $output['orderid'],
				'region' => $output['region'],
				'country' => $output['country'],
				'itemtype' => $output['itemtype'],
				'price' => $output['price']
			);
		}
		return json_encode($sales);
	}
}
?>