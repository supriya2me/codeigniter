<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Paytm extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{
	
		header("Pragma: no-cache");
		header("Cache-Control: no-cache");
		header("Expires: 0");
		// following files need to be included
		require_once APPPATH.'/libraries/config_paytm.php';
		require_once APPPATH.'/libraries/encdec_paytm.php';
		$checkSum = "";

		// below code snippet is mandatory, so that no one can use your checksumgeneration url for other purpose .

		$paramList = array();

		$paramList["MID"] = 'xxxxxxxxxxxxx'; //Provided by Paytm
		$paramList["ORDER_ID"] = 'ORDER0000001'; //unique OrderId for every request
		$paramList["CUST_ID"] = 'CUST00001'; // unique customer identifier 
		$paramList["INDUSTRY_TYPE_ID"] = 'xxxxxxxxxxx'; //Provided by Paytm
		$paramList["CHANNEL_ID"] = 'WAP'; //Provided by Paytm
		$paramList["TXN_AMOUNT"] = '1.00'; // transaction amount
		$paramList["WEBSITE"] = 'xxxxxxxx';//Provided by Paytm
		$paramList["CALLBACK_URL"] = 'https://pguat.paytm.com/paytmchecksum/paytmCallback.jsp';//Provided by Paytm
		$paramList["EMAIL"] = 'abc@gmail.com'; // customer email id
		$paramList["MOBILE_NO"] = '9999999999'; // customer 10 digit mobile no.

		$checkSum = getChecksumFromArray($paramList,PAYTM_MERCHANT_KEY);
		$paramList["CHECKSUMHASH"] = $checkSum;
		
		
		$paytmChecksum = "";
		$isValidChecksum = FALSE;

		$paramList = $_POST;// Array having paytm response

		$paytmChecksum = isset($_POST["CHECKSUMHASH"]) ? $_POST["CHECKSUMHASH"] : ""; //Sent by Paytm pg

		$isValidChecksum = verifychecksum_e($paramList, PAYTM_MERCHANT_KEY, $paytmChecksum); //will return TRUE or FALSE string.

		echo $isValidChecksum;

		


	}
	
}
