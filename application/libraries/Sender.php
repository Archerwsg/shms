<?php
defined('BASEPATH') OR exit('No direct script access allowed');


	class Sender extends CI_Controller
	{
		public $host;
		public $port;
		/*
		* Username that is to be used for submission
		*/
		public $strUserName;
		/*
		* password that is to be used along with username
		*/
		public $strPassword;
		/*
		* Sender Id to be used for submitting the message
		*/
		public $strSender;
		/*
		* Message content that is to be transmitted
		*/
		public $strMessage;
		/*
		* Mobile No is to be transmitted.
		*/
		public $strMobile;
		/*
		* What type of the message that is to be sent
		* <ul>
		* <li>0:means plain text</li>
		* <li>1:means flash</li>
		* <li>2:means Unicode (Message content should be in Hex)</li>
		* <li>6:means Unicode Flash (Message content should be in Hex)</li> * </ul>
		*/
		public $strMessageType;
		/*
		* Require DLR or not
		* <ul>
		* <li>0:means DLR is not Required</li>
		* <li>1:means DLR is Required</li>
		* </ul>
		*/

        public $strDlr;
        

		//Constructor..
		//public function Sender( $host, $port, $username, $password, $sender, $message, $mobile, $msgtype, $dlr )
		//public function __construct( $host,  $username, $password, $sender, $message, $mobile, $msgtype, $dlr )
        function __construct()
        {
            //parent::__construct();
	        $that =& get_instance();
			
            $this->host				= 'rslr.connectbind.com';
            $this->port				= '8080';
            $this->strMessageType	= 0;
            $this->strDlr			= 1;
			$this->strSender		= $that->db->get_where('settings', array('type' => 'zentech_sender_name'))->row()->description;
            $this->strUserName 		= $that->db->get_where('settings', array('type' => 'zentech_user'))->row()->description;;
            $this->strPassword 		= $that->db->get_where('settings', array('type' => 'zentech_password'))->row()->description;;
        }
        

		private function sms ($message)
		{
			$hex1='';
			if (function_exists('iconv')) {
				$latin = @iconv('UTF-8', 'ISO-8859-1', $message);
				if (strcmp($latin, $message)) {
					$arr = unpack('H*hex', @iconv('UTF-8', 'UCS-2BE', $message));
					$hex1 = strtoupper($arr['hex']);
				}
				if($hex1 =='') {
					$hex2='';
					$hex='';
					for ($i=0; $i < strlen($message); $i++) {
						$hex = dechex(ord($message[$i]));
						$len =strlen($hex);
						$add = 4 - $len;
						if($len < 4) {
							for($j=0;$j<$add;$j++)
							{
								$hex="0".$hex;
							}
						}
						$hex2.=$hex;
					}
					return $hex2;
				} else {
					return $hex1;
				}
			} else {
				print 'iconv Function Not Exists !';
			}
		}


		public function Submit()
		{
			if($this->strMessageType=="2" ||	$this->strMessageType=="6") {
				//Call The Function Of String To HEX.
				$this->strMessage = $this->sms($this->strMessage);
				try {
					//Smpp http Url to send sms.$live_url="http://".$this->host.":".$this->port."/bulksms/bulksms?username=".$this- >strUserName."&password=".$this->strPassword."&type=".$this->strMessageType."&dlr=".$this- >strDlr."&destination=".$this->strMobile."&source=".$this->strSender."&message=".$this->strMessage.""; $parse_url=file($live_url);
					return $parse_url[0];
				} catch(Exception $e) {
					return 'Message:' .$e->getMessage();
				}
			} else {
				$this->strMessage=urlencode($this->strMessage);
			}

			try {
                //Smpp http Url to send sms.
                $live_url="http://".$this->host.":".$this->port."/bulksms/bulksms?username=".$this->strUserName."&password=".$this->strPassword."&type=0&dlr=1&destination=".$this->strMobile."&source=".$this->strSender."&message=".$this->strMessage;
				//$live_url="http://".$this->host.":".$this->port."/bulksms/bulksms?username=".$this->strUserName."&password=".$this->strPassword."&type=".$this->strMessageType."&dlr=".$this->strDlr."&destination=".$this->strMobile."&source=".$this->strSender."&message=".$this->strMessage."";
                $parse_url=file($live_url);
				return $parse_url[0];
			} catch(Exception $e) {
				return 'Message:' .$e->getMessage();
			}
		}
	}

	//Call The Constructor.
	//$obj = new Sender( $host, $port, $username, $password, $senderID, $message, $receiverNumber, $msgtype, $dlr );
    
    //$obj = new Sender( $host, $username, $password, $senderID, $message, $receiverNumber, $msgtype, $dlr );
	//$obj->Submit();
?>
