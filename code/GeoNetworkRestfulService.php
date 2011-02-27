<?php
/**
 * @author Rainer Spittel (rainer at silverstripe dot com)
 * @package geonetwork
 * @subpackage code
 */

/**
 * GeoNetwork specific restful service
 *
 * GeoNetwork requires authentication via cookies. The current RestfulService
 * implementation does not allow the usage of cookies and pass those on to
 * following requests.
 * This implementation authenticates the given username/password at the 
 * GeoNetwork node and perform a search.
 */
class GeoNetworkRestfulService extends RestfulService {
	
	/**
	 * attribute stores the flag is the request need to authenticate at 
	 * the server side first (i.e. required for the insert method).
	 * @var boolean
	 */
	private $requireAuthentication = false;
	
	/**
	 * Sets the flag for authentication.
	 * @param boolean $value 
	 */
	public function setRequireAuthentication($value) {
		$this->requireAuthentication = $value;
	}

	/**
	 * Gets the flag for authentication.
	 * @return boolean 
	 */
	public function getRequireAuthentication() {
		return $this->requireAuthentication;
	}

	/**
	 * Return GeoNetwork's username
	 *
	 * Return the username, stored in the geonetwork registration page or
	 * get the default username, if no username is available and this 
	 * environment is the development environment.
	 *
	 * @param RegisterDataPage $page Registration page for the current request.
	 *
	 * @return string geonetwork username
	 */
	protected function getUsername(RegisterDataPage $page) {
		$username = '';
		if (!isset($page->Username) || $page->Username == '') {
			if (Director::isDev() ) {
				$username = 'silverstripe';
			} else {
				$username = $page->Username;
			}
		} else {
			$username = $page->Username;
		}
		return $username;	
	}

	/**
	 * Return GeoNetwork's password
	 *
	 * Return the password, stored in the geonetwork registration page or
	 * get the default password, if no password is available and this 
	 * environment is the development environment.
	 *
	 * @param RegisterDataPage $page Registration page for the current request.
	 *
	 * @return string geonetwork password
	 */
	protected function getPassword(RegisterDataPage $page) {
		$password = '';

		if (!isset($page->Password) || $page->Password == '') {
			if (Director::isDev() ) {
				$password = 'silverstripe';
			} else {
				$password = $page->Password;				
			}
		} else {
			$password = $page->Password;				
		}
		return $password;	
	}

	/**
	 * Send a CURL request
	 *
	 * Makes a request to the RESTful server, and return a {@link RestfulService_Response} 
	 * object for parsing of the result. The flag requireAuthentication {@see requireAuthentication} 
	 * is used to identify if authentication is required (i.e. for insert new 
	 * metadata).
	 *
	 * @see requireAuthentication
	 *
	 * @throws GeoNetworkRestfulService_Exception
	 */
	public function request($subURL = '', $method = "GET", $data = null, $headers = null) {
		
		$controller = Controller::curr();
		$cookie_filename = TEMP_FOLDER."/gncookie.txt";
		// get GeoNetwork Page type
		$page = $controller->data();
		if (!isset($page)) throw new GeoNetworkRestfulService_Exception('Metadata Catalogue Page is not defined correctly.');

		$url = $this->baseURL . $subURL; // Url for the request
		if($this->queryString) {
			if(strpos($url, '?') !== false) {
				$url .= '&' . $this->queryString;
			} else {
				$url .= '?' . $this->queryString;
			}
		}
		$url = str_replace(' ', '%20', $url); // Encode spaces
		$method = strtoupper($method);
		
		assert(in_array($method, array('GET','POST','PUT','DELETE','HEAD','OPTIONS')));

		$ch = curl_init();
		
		$timeout = 5;
		$useragent = "SilverStripe/2.4";
        curl_setopt($ch, CURLOPT_COOKIESESSION, true);
        curl_setopt($ch, CURLOPT_COOKIEFILE, $cookie_filename);     // Used to store login info
        curl_setopt($ch, CURLOPT_COOKIEJAR, $cookie_filename);      // Used to store login info
        curl_setopt($ch, CURLOPT_VERBOSE, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HEADER,0);
		curl_setopt($ch, CURLOPT_USERAGENT, $useragent);
		curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
	
		// Add headers
		if($this->customHeaders) {
			$headers = array_merge((array)$this->customHeaders, (array)$headers);
		}
	
		if($headers) curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

		// log into GeoNetwork
		if ($this->getRequireAuthentication() ) {
			// get authentication information from the geonetwork registration page.
			// if no username/password information are available, use the default
			// values for the dev-environment.
			$username = $this->getUsername($page);
			$password = $this->getPassword($page);			
			
			$auth_url = $this->baseURL .'/srv/en/xml.user.login?username='.$username.'&password='.$password;
			curl_setopt($ch, CURLOPT_URL, $auth_url);

			$auth_response = curl_exec($ch);
			if (!strpos($auth_response,"<ok />")) {
				throw new GeoNetworkRestfulService_Exception("Authentication failed.", E_USER_WARNING);
			}
		}		

		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $method);
		
		// Add fields to POST requests
		if($method == 'POST') {
			curl_setopt($ch, CURLOPT_POST, 1);
			curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
		}
	
		// Run request
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($ch, CURLOPT_URL, $url);
		
		$responseBody = curl_exec($ch);
		$curlError = curl_error($ch);

		if($curlError) {
			throw new GeoNetworkRestfulService_Exception("Curl Error:" . $curlError, E_USER_WARNING);
		}

		$statusCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
		$response = new RestfulService_Response($responseBody, curl_getinfo($ch, CURLINFO_HTTP_CODE));

		if ($this->getRequireAuthentication() ) {

			$auth_url = $this->baseURL .'/srv/en/xml.user.logout';
			curl_setopt($ch, CURLOPT_URL, $auth_url);
			$ret = curl_exec($ch);

			$auth_response = curl_exec($ch);
			if (!strpos($auth_response,"<ok />")) {
				throw new GeoNetworkRestfulService_Exception("log out from GeoNetwork failed.", E_USER_WARNING);
			}
		}
		curl_close($ch);
		return $response;
	}

}

/**
 * Customised Exception class
 */
class GeoNetworkRestfulService_Exception extends Exception {}

?>