<?php 

class SandCage {
	// Your SandCage API Key
	// This can be retrieved from https://www.sandcage.com/panel/api_key
	protected $sandcage_api_key = '[YOUR SANDCAGE API KEY]';
	
	// SandCage API version
	protected $sandcage_api_version = '0.2';

	// SandCage API endpoint base
	protected $sandcage_api_endpoint_base;

	protected $user_agent;
	protected $follow_location = false;
	protected $timeout = 30;
	protected $post_fields;
	protected $status;
	protected $response;

	public function __construct($sandcage_api_key = null) {

		if (!is_null($sandcage_api_key)) {
			$this->sandcage_api_key = $sandcage_api_key;
		}
		$this->sandcage_api_endpoint_base = 'https://api.sandcage.com/' . $this->sandcage_api_version . '/';
		$this->user_agent = 'SandCage - ' . $this->sandcage_api_version;

	}

	/** 
	 * The "schedule-tasks" service
	 * @param array $payload values to send
	 * @param string $callback_endpoint to send the callback to
	 */ 
	public function scheduleFiles($payload, $callback_endpoint = '') {

		$this->post_fields = array('key'=>$this->sandcage_api_key) + $payload;

		if ($callback_endpoint != '') {
			$this->post_fields['callback_url'] = $callback_endpoint;
		}

		$this->call($this->sandcage_api_endpoint_base . 'schedule-tasks');

	}

	/** 
	 * The "destroy-files" service
	 * @param array $payload values to send
	 * @param string $callback_endpoint to send the callback to
	 */ 
	public function destroyFiles($payload, $callback_endpoint = '') {

		$this->post_fields = array('key'=>$this->sandcage_api_key) + $payload;

		if ($callback_endpoint != '') {
			$this->post_fields['callback_url'] = $callback_endpoint;
		}

		$this->call($this->sandcage_api_endpoint_base . 'destroy-files');

	}

	/** 
	 * The "list-files" service
	 * @param array $payload values to send
	 */ 
	public function listFiles($payload) {

		$this->post_fields = array('key'=>$this->sandcage_api_key) + $payload;

		$this->call($this->sandcage_api_endpoint_base . 'list-files');

	}

	/** 
	 * The "get-info" service
	 * @param array $payload values to send
	 */ 
	public function getInfo($payload) {

		$this->post_fields = array('key'=>$this->sandcage_api_key) + $payload;

		$this->call($this->sandcage_api_endpoint_base . 'get-info');

	}

	/** 
	 * Send a requst using cURL 
	 * @param string $service_endpoint to request
	 */ 
	public function call($service_endpoint) {

		// Initialize the cURL session
		$ch = curl_init($service_endpoint);

		curl_setopt($ch, CURLOPT_USERAGENT, $this->user_agent);

		// Handle open_basedir & safe mode
		if (!ini_get('safe_mode') && !ini_get('open_basedir')) {
			$this->follow_location = true;
		}
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, $this->follow_location);
		curl_setopt($ch, CURLOPT_TIMEOUT, $this->timeout); 
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
		curl_setopt($ch, CURLOPT_POST, TRUE);
		curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($this->post_fields));

		// Execute the cURL session
		$this->response = curl_exec($ch);

		// Retry if certificates are missing.
		if (curl_errno($ch) == CURLE_SSL_CACERT) {

			// Set the pem file holding the CA Root Certificates to verify the peer with.
			curl_setopt($ch, CURLOPT_CAINFO, dirname(__FILE__) . '/cacert.pem');
			
			// Retry execution after setting CURLOPT_CAINFO
			$this->response = curl_exec($ch);
			
		}

		// Get information regarding the transfer
		$this->status = curl_getinfo($ch);

		// Close the cURL session
		curl_close($ch);

	}

	/** 
	 * Return the HTTP status of the call
	 * @return array or FALSE on failure 
	 */ 
	public function getHttpStatus() {

		return $this->status;

	}

	/** 
	 * Return the HTTP status of the call
	 * @return array or FALSE on failure  
	 */ 
	public function getResponse() {

		return $this->response;

	}
}
