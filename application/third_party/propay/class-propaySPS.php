<?php
//
//  propaySPS class
//
//	provides an easy set of functions to communicate with ProPay's ProtectPay API
//
//

class propaySPS {
		
		var $authToken = "";
		var $billerID = "";
		var $encoding = "utf-8";
		var $soapURL = "https://protectpaytest.propay.com/API/SPS.svc";
		var $soapAction = "http://propay.com/SPS/contracts/SPSService/";  // GetPayers
		
		// ** how do we start and end our SOAP envelopes?
		var $envelopeStart = "<?xml version=\"1.0\" encoding=\"utf-8\"?><soap:Envelope xmlns:soap=\"http://schemas.xmlsoap.org/soap/envelope/\" xmlns:xsi=\"http://www.w3.org/2001/XMLSchema-instance\" xmlns:xsd=\"http://www.w3.org/2001/XMLSchema\"><soap:Body>";
		
		var $envelopeEnd = 	"</soap:Body></soap:Envelope>";	
		
		function propaySPS($auth_token, $biller_id, $environment = "test"){
			  $this->authToken = $auth_token;
				$this->billerID = $biller_id;
				
				if ($environment == "test"){
				   $this->soapURL = "https://protectpaytest.propay.com/API/SPS.svc";
				}else{
				   // anything other than test will be "live"
				   $this->soapURL = "https://protectpay.propay.com/API/SPS.svc";
				}
				
		}
		
		// ************************************************************************		
		//
		//            FUNCTIONS USED BY CODE THAT USES THE CLASS
		//	
		// ************************************************************************
		
		//
		// CreatePayer
		function CreatePayer($accountName, $returnFullEnvelope = "N"){
			  $xml = "<CreatePayer xmlns=\"http://propay.com/SPS/contracts\">"
						  ."<identification>"
							  ."<AuthenticationToken xmlns=\"http://propay.com/SPS/types\">".$this->authToken."</AuthenticationToken>"
				 				."<BillerAccountId xmlns=\"http://propay.com/SPS/types\">".$this->billerID."</BillerAccountId>"
							."</identification>"
							."<accountName>".$accountName."</accountName>"
							."</CreatePayer>";
				
				$soapEnvelope = $this->envelopeStart.$xml.$this->envelopeEnd;
				
				$result = $this->post_url($this->soapURL, $soapEnvelope, $this->soapAction."CreatePayer");
			 	
				// return full envelope if requests
			  if ($returnFullEnvelope == "Y"){
			 		return $result;
			  }
				
			  // parse the $result
			  $xmlResult = $this->xmlize($result);
				$responseArray = $xmlResult['s:Envelope']['#']['s:Body'][0]['#']['CreatePayerResponse'][0]['#']['CreatePayerResult'][0]['#'];
				
				// What's the result code?
			  $returnArray['result']['ResultCode'] = $responseArray['a:RequestResult'][0]['#']['a:ResultCode'][0]['#'];
			  $returnArray['result']['ResultMessage'] = $responseArray['a:RequestResult'][0]['#']['a:ResultMessage'][0]['#'];
			  $returnArray['result']['ResultValue'] = $responseArray['a:RequestResult'][0]['#']['a:ResultValue'][0]['#'];
			 
				// what's the external id assigned?
				$returnArray['result']['ExternalAccountID'] = $responseArray['a:ExternalAccountID'][0]['#'];
				
				return $returnArray;
		}
		
		//
		// DeletePayer()
		function DeletePayer($PayerAccountId, $returnFullEnvelope = "N"){
			  $xml = "<DeletePayer xmlns=\"http://propay.com/SPS/contracts\">"
						  ."<identification>"
							  ."<AuthenticationToken xmlns=\"http://propay.com/SPS/types\">".$this->authToken."</AuthenticationToken>"
				 				."<BillerAccountId xmlns=\"http://propay.com/SPS/types\">".$this->billerID."</BillerAccountId>"
							."</identification>"
							."<payerAccountId>".$PayerAccountId."</payerAccountId>"
							."</DeletePayer>";
				
				$soapEnvelope = $this->envelopeStart.$xml.$this->envelopeEnd;
				
				$result = $this->post_url($this->soapURL, $soapEnvelope, $this->soapAction."DeletePayer");
				
				// return full envelope if requests
			  if ($returnFullEnvelope == "Y"){
			 		return $result;
			  }
				
			  // parse the $result
			  $xmlResult = $this->xmlize($result);
							
				$responseArray = $xmlResult['s:Envelope']['#']['s:Body'][0]['#']['DeletePayerResponse'][0]['#']['DeletePayerResult'][0]['#'];
				
				// What's the result code?
			  $returnArray['result']['ResultCode'] = $responseArray['a:ResultCode'][0]['#'];
			  $returnArray['result']['ResultMessage'] = $responseArray['a:ResultMessage'][0]['#'];
			  $returnArray['result']['ResultValue'] = $responseArray['a:ResultValue'][0]['#'];
			 
				return $returnArray;
		}
	  
		//
		// CreatePaymentMethod
		function CreatePaymentMethod($PayerAccountId, $PaymentMethodType, $AccountNumber, $Description, $ExpirationDate = "", $AccountName = "", $Address1 = "", $Address2 = "", $Address3 = "", $City = "", $State = "", $ZipCode = "", $Country = "", $Priority = "", $returnFullEnvelope = "N"){
			  // if empty, should we add this in element: xsi:nil=\"true\" 
				
				$xml = "<CreatePaymentMethod xmlns=\"http://propay.com/SPS/contracts\">"
				  	  ."<identification>"
					  	  ."<AuthenticationToken xmlns=\"http://propay.com/SPS/types\">".$this->authToken."</AuthenticationToken>"
				 				."<BillerAccountId xmlns=\"http://propay.com/SPS/types\">".$this->billerID."</BillerAccountId>"
							."</identification>"
							."<pmAdd>";
					  	  // values that are empty need xsi:nil=\"true\" added to it
								if (empty($AccountName)){
								  $xml = $xml."<AccountName xsi:nil=\"true\" xmlns=\"http://propay.com/SPS/types\" />";
								}else{
								  $xml = $xml."<AccountName xmlns=\"http://propay.com/SPS/types\">".$AccountName."</AccountName>";
								}

								$xml = $xml."<AccountNumber xmlns=\"http://propay.com/SPS/types\">".$AccountNumber."</AccountNumber>";
								
								// Billing is picky
								if (empty($Address1) && empty($Address2) && empty($Address3) && empty($City) && empty($Country) && empty($State) && empty($ZipCode)){
								  $xml = $xml."<BillingInformation xsi:nil=\"true\" xmlns=\"http://propay.com/SPS/types\" />";
								}else{
									
									$xml = $xml."<BillingInformation xmlns=\"http://propay.com/SPS/types\">";
									
									if (!empty($Address1)){
									  $xml = $xml."<Address1>".$Address1."</Address1>";
									}
								  if (!empty($Address2)){
									  $xml = $xml."<Address2>".$Address2."</Address2>";
									}
									if (!empty($Address3)){
									  $xml = $xml."<Address3>".$Address3."</Address3>";
									}
									if (!empty($City)){
									  $xml = $xml."<City>".$City."</City>";
									}
									if (!empty($Country)){
									  $xml = $xml."<Country>".$Country."</Country>";
									}
									if (!empty($State)){
									  $xml = $xml."<State>".$State."</State>";
									}
									if (!empty($ZipCode)){
									  $xml = $xml."<ZipCode>".$ZipCode."</ZipCode>";
									}
								  
									$xml = $xml."</BillingInformation>";
								
								}  
								
								$xml = $xml."<Description xmlns=\"http://propay.com/SPS/types\">".$Description."</Description>";
								
								if (empty($ExpirationDate)){
								  $xml = $xml."<ExpirationDate xsi:nil=\"true\" xmlns=\"http://propay.com/SPS/types\" />";
								}else{
								  $xml = $xml."<ExpirationDate xmlns=\"http://propay.com/SPS/types\">".$ExpirationDate."</ExpirationDate>";								
								}
							
							// rest always required	
		          $xml = $xml."<PayerAccountId xmlns=\"http://propay.com/SPS/types\">".$PayerAccountId."</PayerAccountId>"
								."<PaymentMethodType xmlns=\"http://propay.com/SPS/types\">".$PaymentMethodType."</PaymentMethodType>"
							."</pmAdd>"
							."</CreatePaymentMethod>";
				
				$soapEnvelope = $this->envelopeStart.$xml.$this->envelopeEnd;
			 
			  $result = $this->post_url($this->soapURL, $soapEnvelope, $this->soapAction."CreatePaymentMethod"); 
			 
			  // return full envelope if requests
			  if ($returnFullEnvelope == "Y"){
			 		return $result;
			  }
				
				$xmlResult = $this->xmlize($result);
				
				$responseArray = $xmlResult['s:Envelope']['#']['s:Body'][0]['#']['CreatePaymentMethodResponse'][0]['#']['CreatePaymentMethodResult'][0]['#'];
			  
			  // What's the result code?
			  $returnArray['result']['ResultCode'] = $responseArray['a:RequestResult'][0]['#']['a:ResultCode'][0]['#'];
			  $returnArray['result']['ResultMessage'] = $responseArray['a:RequestResult'][0]['#']['a:ResultMessage'][0]['#'];
			  $returnArray['result']['ResultValue'] = $responseArray['a:RequestResult'][0]['#']['a:ResultValue'][0]['#'];
				
				// what's the a:PaymentMethodId assigned?
				$returnArray['result']['PaymentMethodId'] = $responseArray['a:PaymentMethodId'][0]['#'];
				
				return $returnArray;		
		}
		
		//
		// ProcessPayment()
		function ProcessPayment($PayerAccountId, $Amount, $CurrencyCode = "USD", $Invoice = "", $returnFullEnvelope = "N"){
				
				$xml = "<ProcessPayment xmlns=\"http://propay.com/SPS/contracts\">"
						  ."<identification>"
							   ."<AuthenticationToken xmlns=\"http://propay.com/SPS/types\">".$this->authToken."</AuthenticationToken>"
				 				."<BillerAccountId xmlns=\"http://propay.com/SPS/types\">".$this->billerID."</BillerAccountId>"
							."</identification>"
							."<transactionInfo>"
							   ."<Amount xmlns=\"http://propay.com/SPS/types\">".$Amount."</Amount>"
								 ."<CurrencyCode xmlns=\"http://propay.com/SPS/types\">".$CurrencyCode."</CurrencyCode>"
								 ."<PayerAccountId xmlns=\"http://propay.com/SPS/types\">".$PayerAccountId."</PayerAccountId>";
								 
								 if (empty($Invoice)){
								   $xml = $xml."<Invoice xsi:nil=\"true\" xmlns=\"http://propay.com/SPS/types\" />";
								 }else{
								   $xml = $xml."<Invoice xmlns=\"http://propay.com/SPS/types\">".$Invoice."</Invoice>";
								 }
								 
							 $xml = $xml."</transactionInfo>"
							 ."</ProcessPayment>";
				
				$soapEnvelope = $this->envelopeStart.$xml.$this->envelopeEnd;
			 
			  $result = $this->post_url($this->soapURL, $soapEnvelope, $this->soapAction."ProcessPayment");
				
			  // return full envelope if requests
			  if ($returnFullEnvelope == "Y"){
			 		 return $result;
			  }
				
				// parse the $result
			  $xmlResult = $this->xmlize($result);

				$responseArray = $xmlResult['s:Envelope']['#']['s:Body'][0]['#']['ProcessPaymentResponse'][0]['#']['ProcessPaymentResult'][0]['#'];
								
			  // What's the result code?
			  $returnArray['result']['ResultCode'] = $responseArray['a:RequestResult'][0]['#']['a:ResultCode'][0]['#'];
			  $returnArray['result']['ResultMessage'] = $responseArray['a:RequestResult'][0]['#']['a:ResultMessage'][0]['#'];
			  $returnArray['result']['ResultValue'] = $responseArray['a:RequestResult'][0]['#']['a:ResultValue'][0]['#'];
				
				$transactionArray = $responseArray['a:Transactions'];
				
				//
				// internal errors will result in "check_value == true" (improper formatting of amount?)
				$check_value = $transactionArray[0]['@']['i:nil'];
				if (!empty($transactionArray) && $check_value != "true"){
					 
				  // now the transaction information
					$transactionArray = $responseArray['a:Transactions'][0]['#']['a:TransactionInformation'][0]['#'];
				  $returnArray['result']['TransactionInformation']['AVSCode'] = $transactionArray['a:AVSCode'][0]['#'];
			    $returnArray['result']['TransactionInformation']['AuthorizationCode'] = $transactionArray['a:AuthorizationCode'][0]['#'];
			
			    $returnArray['result']['TransactionInformation']['ResultCode'] = $transactionArray['a:ResultCode'][0]['#']['a:ResultCode'][0]['#'];
			    $returnArray['result']['TransactionInformation']['ResultMessage'] = $transactionArray['a:ResultCode'][0]['#']['a:ResultMessage'][0]['#'];
			    $returnArray['result']['TransactionInformation']['ResultValue'] = $transactionArray['a:ResultCode'][0]['#']['a:ResultValue'][0]['#'];
				
			    $returnArray['result']['TransactionInformation']['TransactionHistoryId'] = $transactionArray['a:TransactionHistoryId'][0]['#'];
			    $returnArray['result']['TransactionInformation']['TransactionId'] = $transactionArray['a:TransactionId'][0]['#'];
			    $returnArray['result']['TransactionInformation']['TransactionResult'] = $transactionArray['a:TransactionResult'][0]['#'];
				}else{
					
					//
					// Misc Failure
					$returnArray['result']['TransactionInformation']['ResultCode'] = "65";
			    $returnArray['result']['TransactionInformation']['ResultMessage'] = "Internal Error";
			    $returnArray['result']['TransactionInformation']['ResultValue'] = "";
					
				}

				return $returnArray;
				
		}
		
		//
		// PartialRefundPayment
		function PartialRefundPayment($originalTransactionID, $amount, $returnFullEnvelope = "N"){
			  
				$xml = "<PartialRefundPayment xmlns=\"http://propay.com/SPS/contracts\">"
						  ."<id>"
							 ."<AuthenticationToken xmlns=\"http://propay.com/SPS/types\">".$this->authToken."</AuthenticationToken>"
 							 ."<BillerAccountId xmlns=\"http://propay.com/SPS/types\">".$this->billerID."</BillerAccountId>"
							."</id>"
							."<originalTransactionID>".$originalTransactionID."</originalTransactionID>"
							."<amount>".$amount."</amount>"
							."</PartialRefundPayment>";
				
				
				$soapEnvelope = $this->envelopeStart.$xml.$this->envelopeEnd;
				
				$result = $this->post_url($this->soapURL, $soapEnvelope, $this->soapAction."PartialRefundPayment");
			 	
				// return full envelope if requests
			  if ($returnFullEnvelope == "Y"){
			 		return $result;
			  }
				
			  // parse the $result
			  $xmlResult = $this->xmlize($result);
				$responseArray = $xmlResult['s:Envelope']['#']['s:Body'][0]['#']['PartialRefundPaymentResponse'][0]['#']['PartialRefundPaymentResult'][0]['#'];
				
				// What's the result code?
			  $returnArray['result']['ResultCode'] = $responseArray['a:RequestResult'][0]['#']['a:ResultCode'][0]['#'];
			  $returnArray['result']['ResultMessage'] = $responseArray['a:RequestResult'][0]['#']['a:ResultMessage'][0]['#'];
			  $returnArray['result']['ResultValue'] = $responseArray['a:RequestResult'][0]['#']['a:ResultValue'][0]['#'];
			 
				$transactionArray = $responseArray['a:Transaction'];
				
				//
				// internal errors will result in "check_value == true" (improper formatting of amount?)
				$check_value = $transactionArray[0]['@']['i:nil'];
				if (!empty($transactionArray) && $check_value != "true"){
					 
				  // now the transaction information
					$transactionArray = $responseArray['a:Transaction'][0]['#'];
				  $returnArray['result']['Transaction']['AVSCode'] = $transactionArray['a:AVSCode'][0]['#'];
			    $returnArray['result']['Transaction']['AuthorizationCode'] = $transactionArray['a:AuthorizationCode'][0]['#'];
			
			    $returnArray['result']['Transaction']['ResultCode'] = $transactionArray['a:ResultCode'][0]['#']['a:ResultCode'][0]['#'];
			    $returnArray['result']['Transaction']['ResultMessage'] = $transactionArray['a:ResultCode'][0]['#']['a:ResultMessage'][0]['#'];
			    $returnArray['result']['Transaction']['ResultValue'] = $transactionArray['a:ResultCode'][0]['#']['a:ResultValue'][0]['#'];
				
			    $returnArray['result']['Transaction']['TransactionHistoryId'] = $transactionArray['a:TransactionHistoryId'][0]['#'];
			    $returnArray['result']['Transaction']['TransactionId'] = $transactionArray['a:TransactionId'][0]['#'];
			    $returnArray['result']['Transaction']['TransactionResult'] = $transactionArray['a:TransactionResult'][0]['#'];
				}else{
					
					//
					// Misc Failure
					$returnArray['result']['Transaction']['ResultCode'] = "65";
			    $returnArray['result']['Transaction']['ResultMessage'] = "Internal Error";
			    $returnArray['result']['Transaction']['ResultValue'] = "";
					
				}
				
				return $returnArray;
		}
		
		//
		// DeletePaymentMethod
		function DeletePaymentMethod($PayerAccountId, $PaymentID, $returnFullEnvelope = "N"){
				
				$xml = "<DeletePaymentMethod xmlns=\"http://propay.com/SPS/contracts\">"
						  ."<identification>"
								."<AuthenticationToken xmlns=\"http://propay.com/SPS/types\">".$this->authToken."</AuthenticationToken>"
				 				."<BillerAccountId xmlns=\"http://propay.com/SPS/types\">".$this->billerID."</BillerAccountId>"
							."</identification>"
							."<payerAccountId>".$PayerAccountId."</payerAccountId>"
							."<paymentID>".$PaymentID."</paymentID>"
							."</DeletePaymentMethod>";
				
				$soapEnvelope = $this->envelopeStart.$xml.$this->envelopeEnd;
			 
			  $result = $this->post_url($this->soapURL, $soapEnvelope, $this->soapAction."DeletePaymentMethod");
			 
			  //echo"<br>Envelope Sent:<br><textarea cols='60' rows='20'>".$soapEnvelope."</textarea><br>";
			 
			  // return full envelope if requests
			  if ($returnFullEnvelope == "Y"){
			 		 return $result;
			  }
				
				// parse the $result
			  $xmlResult = $this->xmlize($result);
				
			  $responseArray = $xmlResult['s:Envelope']['#']['s:Body'][0]['#']['DeletePaymentMethodResponse'][0]['#']['DeletePaymentMethodResult'][0]['#'];
			  
			  // What's the result code?
			  $returnArray['result']['ResultCode'] = $responseArray['a:ResultCode'][0]['#'];
			  $returnArray['result']['ResultMessage'] = $responseArray['a:ResultMessage'][0]['#'];
			  $returnArray['result']['ResultValue'] = $responseArray['a:ResultValue'][0]['#'];
				
				return $returnArray;
				
		}
		
		//
		// GetPayers()
		function GetPayers($ExternalId1, $ExternalId2, $Name, $returnFullEnvelope = "N"){
				
				$xml = "<GetPayers xmlns=\"http://propay.com/SPS/contracts\">"
		  			  ."<billerId>"
			   			  ."<AuthenticationToken xmlns=\"http://propay.com/SPS/types\">".$this->authToken."</AuthenticationToken>"
				 				."<BillerAccountId xmlns=\"http://propay.com/SPS/types\">".$this->billerID."</BillerAccountId>"
							."</billerId>"
							."<criteria>"
			   			  ."<ExternalId1 xsi:nil=\"true\" xmlns=\"http://propay.com/SPS/types\">".$ExternalId1."</ExternalId1>"
				 				."<ExternalId2 xsi:nil=\"true\" xmlns=\"http://propay.com/SPS/types\">".$ExternalId2."</ExternalId2>"
				 				."<Name xmlns=\"http://propay.com/SPS/types\">".$Name."</Name>"
							."</criteria>"
							."</GetPayers>";
							
			 $soapEnvelope = $this->envelopeStart.$xml.$this->envelopeEnd;
			 
			 $result = $this->post_url($this->soapURL, $soapEnvelope, $this->soapAction."GetPayers");
			 
			 // return full envelope if requests
			 if ($returnFullEnvelope == "Y"){
			 		return $result;
			 }
			 
			 // parse the $result
			 $xmlResult = $this->xmlize($result);
			 $responseArray = $xmlResult['s:Envelope']['#']['s:Body'][0]['#']['GetPayersResponse'][0]['#']['GetPayersResult'][0]['#'];
			 
			 // What's the result code?
			 $returnArray['result']['ResultCode'] = $responseArray['a:RequestResult'][0]['#']['a:ResultCode'][0]['#'];
			 $returnArray['result']['ResultMessage'] = $responseArray['a:RequestResult'][0]['#']['a:ResultMessage'][0]['#'];
			 $returnArray['result']['ResultValue'] = $responseArray['a:RequestResult'][0]['#']['a:ResultValue'][0]['#'];
			 
			 // And now for the payers
			 if (!empty($responseArray['a:Payers'][0]['#'])){
			   $payersArray = $responseArray['a:Payers'][0]['#']['a:PayerInfo'];
				 $returnArray['result']['numPayers'] = count($payersArray);
			   for ($x=0; $x<count($payersArray); $x++){
					  $returnArray['payers'][$x]['ExternalId1'] = $payersArray[$x]['#']['a:ExternalId1'][0]['#'];
					  $returnArray['payers'][$x]['ExternalId2'] = $payersArray[$x]['#']['a:ExternalId2'][0]['#'];
					  $returnArray['payers'][$x]['Name'] = $payersArray[$x]['#']['a:Name'][0]['#'];
					  $returnArray['payers'][$x]['payerAccountId'] = $payersArray[$x]['#']['a:payerAccountId'][0]['#'];
					}
			 }else{
			    // let's return the fact that there are no payers
					$returnArray['result']['numPayers'] = 0;
			 }
			 
			 return $returnArray;
							
		}
		
		
		//
		// GetAllPayerPaymentMethods
		function GetAllPayerPaymentMethods($PayerAccountId, $returnFullEnvelope = "N"){
			 $xml = "<GetAllPayerPaymentMethods xmlns=\"http://propay.com/SPS/contracts\">"
			 			   ."<billerIdentification>"
						   ."<AuthenticationToken xmlns=\"http://propay.com/SPS/types\">".$this->authToken."</AuthenticationToken>"
				 				."<BillerAccountId xmlns=\"http://propay.com/SPS/types\">".$this->billerID."</BillerAccountId>"
						   ."</billerIdentification>"
						   ."<payerAccountId>".$PayerAccountId."</payerAccountId>"
			 			 ."</GetAllPayerPaymentMethods>";
						 
			 $soapEnvelope = $this->envelopeStart.$xml.$this->envelopeEnd;
			 
			 $result = $this->post_url($this->soapURL, $soapEnvelope, $this->soapAction."GetAllPayerPaymentMethods");
			 
			 // return full envelope if requests
			 if ($returnFullEnvelope == "Y"){
			 		return $result;
			 }
			 
			 // parse the $result
			 $xmlResult = $this->xmlize($result);
			 $responseArray = $xmlResult['s:Envelope']['#']['s:Body'][0]['#']['GetAllPayerPaymentMethodsResponse'][0]['#']['GetAllPayerPaymentMethodsResult'][0]['#'];
			 
			 // What's the result code?
			 $returnArray['result']['ResultCode'] = $responseArray['a:RequestResult'][0]['#']['a:ResultCode'][0]['#'];
			 $returnArray['result']['ResultMessage'] = $responseArray['a:RequestResult'][0]['#']['a:ResultMessage'][0]['#'];
			 $returnArray['result']['ResultValue'] = $responseArray['a:RequestResult'][0]['#']['a:ResultValue'][0]['#'];
			 
			 // And now for the payment methods for this payer
			 if (!empty($responseArray['a:PaymentMethods'][0]['#'])){
			   $methodsArray = $responseArray['a:PaymentMethods'][0]['#']['a:PaymentMethodInformation'];
				 $returnArray['result']['numMethods'] = count($methodsArray);
			   for ($x=0; $x<count($methodsArray); $x++){
					  $returnArray['PaymentMethodInformation'][$x]['AccountName'] = $methodsArray[$x]['#']['a:AccountName'][0]['#'];
						
						$billingArray = $methodsArray[$x]['#']['a:BillingInformation'][0]['#'];
						if (!empty($billingArray)){
						   $returnArray['PaymentMethodInformation'][$x]['billingInfo']['Address1'] = $billingArray['a:Address1'][0]['#'];
							 $returnArray['PaymentMethodInformation'][$x]['billingInfo']['Address2'] = $billingArray['a:Address2'][0]['#'];
							 $returnArray['PaymentMethodInformation'][$x]['billingInfo']['Address3'] = $billingArray['a:Address3'][0]['#'];
							 $returnArray['PaymentMethodInformation'][$x]['billingInfo']['City'] = $billingArray['a:City'][0]['#'];
							 $returnArray['PaymentMethodInformation'][$x]['billingInfo']['Country'] = $billingArray['a:Country'][0]['#'];
							 $returnArray['PaymentMethodInformation'][$x]['billingInfo']['State'] = $billingArray['a:State'][0]['#'];
							 $returnArray['PaymentMethodInformation'][$x]['billingInfo']['ZipCode'] = $billingArray['a:ZipCode'][0]['#'];
						}
						
						$returnArray['PaymentMethodInformation'][$x]['DateCreated'] = $methodsArray[$x]['#']['a:DateCreated'][0]['#'];
						$returnArray['PaymentMethodInformation'][$x]['Description'] = $methodsArray[$x]['#']['a:Description'][0]['#'];
						$returnArray['PaymentMethodInformation'][$x]['ExpirationDate'] = $methodsArray[$x]['#']['a:ExpirationDate'][0]['#'];
						$returnArray['PaymentMethodInformation'][$x]['ObfuscatedAccountNumber'] = $methodsArray[$x]['#']['a:ObfuscatedAccountNumber'][0]['#'];
						$returnArray['PaymentMethodInformation'][$x]['PaymentMethodID'] = $methodsArray[$x]['#']['a:PaymentMethodID'][0]['#'];
						$returnArray['PaymentMethodInformation'][$x]['PaymentMethodType'] = $methodsArray[$x]['#']['a:PaymentMethodType'][0]['#'];
						$returnArray['PaymentMethodInformation'][$x]['Priority'] = $methodsArray[$x]['#']['a:Priority'][0]['#'];																																										
					}
			 }else{
			    // let's return the fact that there are no methods for this payer
					$returnArray['result']['numMethods'] = 0;
			 }
			 
			 return $returnArray;
			 
		}
		
		// 
		// GetTempToken()
		function GetTempToken($PayerAccountId, $AccountName, $DurationSeconds = "120", $returnFullEnvelope = "N"){
		   $xml = "<GetTempToken xmlns=\"http://propay.com/SPS/contracts\">"
			         ."<tempTokenRequest>"
							 ."<Identification xmlns=\"http://propay.com/SPS/types\">"
							   ."<AuthenticationToken xmlns=\"http://propay.com/SPS/types\">".$this->authToken."</AuthenticationToken>"
				 			   ."<BillerAccountId xmlns=\"http://propay.com/SPS/types\">".$this->billerID."</BillerAccountId>"					 
							 ."</Identification>"
							 ."<PayerInfo xmlns=\"http://propay.com/SPS/types\">"
							   ."<Id>".$PayerAccountId."</Id>"
							   ."<Name>".$AccountName."</Name>"
							 ."</PayerInfo>"
							 ."<TokenProperties xmlns=\"http://propay.com/SPS/types\">"
							   ."<DurationSeconds>".$DurationSeconds."</DurationSeconds>"
							 ."</TokenProperties>"
							 ."</tempTokenRequest>"
							 ."</GetTempToken>";
			 			 
			 $soapEnvelope = $this->envelopeStart.$xml.$this->envelopeEnd;
			 
			 $result = $this->post_url($this->soapURL, $soapEnvelope, $this->soapAction."GetTempToken");
			 
			 // return full envelope if requests
			 if ($returnFullEnvelope == "Y"){
			 		return $result;
			 }
			
			 // parse the $result
			 $xmlResult = $this->xmlize($result);
			 $responseArray = $xmlResult['s:Envelope']['#']['s:Body'][0]['#']['GetTempTokenResponse'][0]['#']['GetTempTokenResult'][0]['#'];
			 
			 // What's the result code?
			 $returnArray['result']['ResultCode'] = $responseArray['a:RequestResult'][0]['#']['a:ResultCode'][0]['#'];
			 $returnArray['result']['ResultMessage'] = $responseArray['a:RequestResult'][0]['#']['a:ResultMessage'][0]['#'];
			 $returnArray['result']['ResultValue'] = $responseArray['a:RequestResult'][0]['#']['a:ResultValue'][0]['#'];
			 
			 if (!empty($responseArray['a:TempToken'][0]['#'])){
			 		$returnArray['result']['TempToken'] = $responseArray['a:TempToken'][0]['#'];  
			 }
			 
			 if (!empty($responseArray['a:PayerId'][0]['#'])){
			 		$returnArray['result']['PayerId'] = $responseArray['a:PayerId'][0]['#'];  
			 }
			 
			 if (!empty($responseArray['a:CredentialId'][0]['#'])){
			 		$returnArray['result']['CredentialId'] = $responseArray['a:CredentialId'][0]['#'];  
			 }
			 
			 return $returnArray; 
				 
							 
		}
		
		
		// ************************************************************************		
		//
		//                        FUNCTIONS USED BY CLASS
		//	
		// ************************************************************************
		// ** start: post_url() **
		function post_url($url, $data, $soap_action, $timeout = 200) {
 
	    $headers = array(
              "POST /API/SPS.svc HTTP/1.0",
              "Content-type: text/xml;charset=\"utf-8\"",
              "Accept: text/xml",
              "SOAPAction: \"$soap_action\"",
              "Content-length: ".strlen($data),
      );
        
      $ch = curl_init ();
		  curl_setopt ( $ch, CURLOPT_URL, $url );
		  curl_setopt ( $ch, CURLOPT_RETURNTRANSFER, 1 );
		  curl_setopt ( $ch, CURLOPT_TIMEOUT, ( int ) $timeout );
		  curl_setopt ( $ch, CURLOPT_SSL_VERIFYPEER, 0 );
      curl_setopt ($ch, CURLOPT_HTTPHEADER, $headers);
      curl_setopt ( $ch, CURLOPT_POST, 1 );
		  curl_setopt ( $ch, CURLOPT_POSTFIELDS, $data );
		  curl_setopt($ch, CURLOPT_HEADER, 0);
 
		  $xmlResponse = curl_exec ( $ch );
			
			/*
      $ch_info=curl_getinfo($ch);
		  print_r($ch_info);
			*/
			
			curl_close($ch);
		  return $xmlResponse;
    }	
    // ** end: post_url() **
		
		
		//
		// ** start: xmlize() **
		function xmlize($data, $WHITE=1) {
    	$data = trim($data);
    	$vals = $index = $array = array();
    	$parser = xml_parser_create();
    	xml_parser_set_option($parser, XML_OPTION_CASE_FOLDING, 0);
    	xml_parser_set_option($parser, XML_OPTION_SKIP_WHITE, $WHITE);
    	if ( !xml_parse_into_struct($parser, $data, $vals, $index) ){
		    // quitely exit
			  //die(sprintf("XML error: %s at line %d",
        //             xml_error_string(xml_get_error_code($parser)),
        //             xml_get_current_line_number($parser)));
			  //mail("to@email.com", "xmlize died - (where from?)", "$data", ""); 
			  return 1;
    	}
    	xml_parser_free($parser);

    	$i = 0; 

    	$tagname = $vals[$i]['tag'];
    	if ( isset ($vals[$i]['attributes'] ) ){
        $array[$tagname]['@'] = $vals[$i]['attributes'];
    	} else {
        $array[$tagname]['@'] = array();
    	}

    	$array[$tagname]["#"] = $this->xml_depth($vals, $i);

    	return $array;
		}	  
		// ** end:  xmlize() **
		
		// ** start: xml_depth() -- used by xmlize() **
		function xml_depth($vals, &$i) { 
      $children = array(); 

      if ( isset($vals[$i]['value']) ){
        array_push($children, $vals[$i]['value']);
    	}

    	while (++$i < count($vals)) { 
          switch ($vals[$i]['type']) { 
             case 'open': 
                if ( isset ( $vals[$i]['tag'] ) ){
                    $tagname = $vals[$i]['tag'];
                } else {
                    $tagname = '';
                }

                if ( isset ( $children[$tagname] ) ){
                    $size = sizeof($children[$tagname]);
                } else {
                    $size = 0;
                }

                if ( isset ( $vals[$i]['attributes'] ) ) {
                    $children[$tagname][$size]['@'] = $vals[$i]["attributes"];
                }

                $children[$tagname][$size]['#'] = $this->xml_depth($vals, $i);

              break; 


              case 'cdata':
                array_push($children, $vals[$i]['value']); 
              break; 

              case 'complete': 
                $tagname = $vals[$i]['tag'];

                if( isset ($children[$tagname]) ){
                    $size = sizeof($children[$tagname]);
                } else {
                    $size = 0;
                }

                if( isset ( $vals[$i]['value'] ) ){
                    $children[$tagname][$size]["#"] = $vals[$i]['value'];
                } else {
                    $children[$tagname][$size]["#"] = '';
                }

                if ( isset ($vals[$i]['attributes']) ) {
                    $children[$tagname][$size]['@']
                                             = $vals[$i]['attributes'];
                }			

              break; 

              case 'close':
                return $children; 
              break;
          } 
        } 
	    return $children;
    }
    // ** end: xml_depth() -- used by xmlize() **
			
			
			
}
// ** end: propaySPS class **


?>