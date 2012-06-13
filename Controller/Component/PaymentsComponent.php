<?php
App::uses('Component', 'Controller');

/**
 * PaymentsComponent
 *
 */
class PaymentsComponent extends Component {

/**
 * Components to use
 *
 * @var array
 */
	public $components = array('Session');

/**
 * Settings for PayPal
 *
 * @var array
 */
	protected $_paypalSettings = array(
		'endpoint' => 'https://api-3t.paypal.com/nvp',
		'frontend' => 'https://www.paypal.com/webscr',
		'version'  => 64,
		'username' => '',
		'password' => '',
		'signature'=> '',
		'currency' => 'USD'
	);

/**
 * Controller
 *
 * @var Controller
 */
	protected $_Controller;


/**
 * Called before the Controller::beforeFilter().
 *
 * @param Controller $controller Controller with components to initialize
 * @return void
 */
	public function initialize(Controller $controller) {
		$this->_Controller = $controller;

		$settings = Configure::read('BostonConference.Payments.PayPal');

		if ( is_array($settings) )
			$this->_paypalSettings = array_merge( $this->_paypalSettings, $settings );
	}

/**
 * Processes a payment for a given ammount according to the settings.
 * This action may perform a redirect.
 *
 * @return boolean True if the processing succeeded
 */
	public function process($amount,$items=array()) {
		return $this->_processPaypal($amount,$items);
	}

/**
 * Confirm a payment.
 *
 * @return boolean True if the confirmation succeeded
 */
	public function confirm() {
		return $this->_confirmPaypal();
	}

/**
 * Processes a payment via Paypal
 *
 * @return boolean True if the processing succeeded
 */
	protected function _processPaypal($amount,$items=array()) {

		$nvpstr  = '&PAYMENTREQUEST_0_AMT='. $amount;
		$nvpstr .= '&PAYMENTREQUEST_0_PAYMENTACTION=Sale';
		$nvpstr .= '&RETURNURL=' . Router::url(array('controller'=>'tickets','action'=>'confirm'),true);
		$nvpstr .= '&CANCELURL=' . Router::url(array('controller'=>'tickets','action'=>'cancel'),true);
		$nvpstr .= '&PAYMENTREQUEST_0_CURRENCYCODE='.$this->_paypalSettings['currency'];
		$nvpstr .= '&NOSHIPPING=1';
		$nvpstr .= '&PAYMENTREQUEST_0_DESC=Conference%20Tickets';

		foreach ( $items as $i => $item ) {
			$i = number_format($i,0);
			$nvpstr .= '&L_PAYMENTREQUEST_0_NAME'.$i.'='.$item['name'];
			$nvpstr .= '&L_PAYMENTREQUEST_0_QTY'.$i.'='.$item['quantity'];
			$nvpstr .= '&L_PAYMENTREQUEST_0_AMT'.$i.'='.$item['amount'];
		}
		
		$this->Session->write('PayPal.nvpstr',$nvpstr);

		$resArray = $this->_callPaypalAPI('SetExpressCheckout', $nvpstr);
		$ack = strtoupper($resArray['ACK']);

		if($ack=='SUCCESS' || $ack=='SUCCESSWITHWARNING')
		{
			$token = urldecode($resArray['TOKEN']);
			$this->Session->write('PayPal.Token',$token);

			$this->_Controller->redirect($this->_paypalSettings['frontend'].'?cmd=_express-checkout&token='.$token);
		}

		return false;
	}

/**
 * Confirms a paypal transaction
 *
 * @return boolean True if the transaction is valid
 */
	protected function _confirmPaypal() {
		$token = $this->Session->read('PayPal.Token');

		if ( !$token )
			return false;

		$nvpstr = '&TOKEN='.$token;
		
		$resArray = $this->_callPaypalAPI('GetExpressCheckoutDetails', $nvpstr);
		$ack = strtoupper($resArray['ACK']);

		if($ack=='SUCCESS' || $ack=='SUCCESSWITHWARNING')
		{
			$payerId = $resArray['PAYERID'];
			$amount = $resArray['AMT'];

			$this->Session->write('Ticket.TransactionData',array(
				'type' => 'PayPal',
				'payer_id' => $payerId,
				'amount' => $amount
			));

			$nvpstr .= '&PAYERID='.urlencode($payerId);
			$nvpstr .= $this->Session->read('PayPal.nvpstr');

			$resArray = $this->_callPaypalAPI('DoExpressCheckoutPayment', $nvpstr);
			$ack = strtoupper($resArray['ACK']);

			if ( $ack=='SUCCESS' || $ack=='SUCCESSWITHWARNING' ) {
				$this->Session->write(
					'Ticket.TransactionData.id',
					$resArray['PAYMENTINFO_0_TRANSACTIONID']
				);
				return true;
			}


		}

		
		return false;
	}

/**
 * Make a call to the PayPal API
 *
 * @returns array $hash
 */
	protected function _callPaypalAPI($methodName,$nvpStr)
	{
		//setting the curl parameters.
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL,$this->_paypalSettings['endpoint']);
		curl_setopt($ch, CURLOPT_VERBOSE, 1);

		//turning off the server and peer verification(TrustManager Concept).
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);

		curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
		curl_setopt($ch, CURLOPT_POST, 1);
		
		//NVPRequest for submitting to server
		$nvpreq='METHOD=' . urlencode($methodName) . '&VERSION=' . urlencode($this->_paypalSettings['version']) . '&PWD=' . urlencode($this->_paypalSettings['password']) . '&USER=' . urlencode($this->_paypalSettings['username']) . '&SIGNATURE=' . urlencode($this->_paypalSettings['signature']) . $nvpStr . '&BUTTONSOURCE=';

		//setting the nvpreq as POST FIELD to curl
		curl_setopt($ch, CURLOPT_POSTFIELDS, $nvpreq);

		//getting response from server
		$response = curl_exec($ch);

		//convrting NVPResponse to an Associative Array
		parse_str($response,$nvpResArray);
		parse_str($nvpreq,$nvpReqArray);
		$this->Session->write('PayPal.nvpReqArray',$nvpReqArray);

		if (curl_errno($ch)) 
		{
			$this->Session->write('PayPal.curl_error_no',curl_errno($ch));
			$this->Session->write('PayPal.curl_error_msg',curl_error($ch));
		} 
		else 
		{
			curl_close($ch);
		}

		return $nvpResArray;
	}
}
