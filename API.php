<?php
	// Check HTTPS header
	if($_SERVER['SERVER_PORT'] !== 443 && (empty($_SERVER['HTTPS']) || strcmp($_SERVER['HTTPS'], 'off') === 0)) { // Check if the request is not through HTTPS
		http_response_code(403);
		exit(); // Redirect to HTTPS version of request
	}
	
	// Check request method
	$request = $_SERVER['REQUEST_METHOD'];
	$hdrs = getallheaders();
	if(strcmp($request, 'GET') === 0 || strcmp($request, 'HEAD') === 0) { // Check if request is GET or HEAD
		http_response_code(405);
		header('Allow: POST, OPTIONS');
		exit(); // Do not allow this request
		
	} else if(strcmp($request, 'OPTIONS') === 0) { // Check if request is OPTIONS
		http_response_code(204);
		header('Access-Control-Allow-Methods: POST, OPTIONS');
		header('Access-Control-Allow-Origin: '.$hdrs['Origin']);
		header('Access-Control-Allow-Headers: Authorization, Subscription-Key, Content-Type, X-Requested-With');
		header('Content-Length: 0');
		header('Vary: Origin');
		exit();
		
	} else if(strcmp($request, 'POST') !== 0) { // Check if request is not POST
		http_response_code(501);
		exit(); // This request is not implemented
		
	} else { // The request is a POST
		// Check required headers
		if(!isset($_SERVER['CONTENT_TYPE']) || strcmp($_SERVER['CONTENT_TYPE'], 'application/json') !== 0) { // Check if Content-Type header is not set or an invalid value
			http_response_code(415);
			exit(); // Do not allow this content type
			
		} else if(!isset($hdrs['Authorization']) || strcmp($hdrs['Authorization'], '1234567890') !== 0) { // Check if Authorization header is not set or an invalid value
			http_response_code(401);
			exit(); // This request has improper authorization
			
		} else if(!isset($hdrs['Subscription-Key']) || strcmp($hdrs['Subscription-Key'], 'ABCDEFGHIJ') !== 0) { // Check if Subscription-Key header is not set or an invalid value
			http_response_code(401);
			exit(); // This request has improper subscription key
		}
	}
	
	// Check input for proper data structure
	$input = json_decode(file_get_contents('php://input'));
	if(strcmp(gettype($input), 'array') !== 0) { // Check if JSON array is not given
		http_response_code(400);
		exit(); // The request body is not an array
		
	} else { // The request body is an array
		foreach($input as &$obj) { // Loop through each item in the array
			if(strcmp(gettype($obj), 'object') !== 0) { // Check if the item is not an object
				http_response_code(400);
				exit(); // The array item is not an object
				
			} else { // The array item is an object
				// Check string properties
				if(!property_exists($obj, 'SupplierName') || strcmp(gettype($obj->SupplierName), 'string') !== 0 || strlen($obj->SupplierName) > 50) { // Check if property SupplierName is not a string with max length 50
					http_response_code(400);
					exit(); // Object has missing or improper SupplierName property
					
				} else if(!property_exists($obj, 'SupplierID') || strcmp(gettype($obj->SupplierID), 'string') !== 0 || strlen($obj->SupplierID) > 50) { // Check if property SupplierID is not a string with max length 50
					http_response_code(400);
					exit(); // Object has missing or improper SupplierID property
					
				} else if(!property_exists($obj, 'SandMineLocationID') || strcmp(gettype($obj->SandMineLocationID), 'string') !== 0 || strlen($obj->SandMineLocationID) > 50) { // Check if property SandMineLocationID is not a string with max length 50
					http_response_code(400);
					exit(); // Object has missing or improper SandMineLocationID property
					
				} else if(!property_exists($obj, 'TransactionID') || strcmp(gettype($obj->TransactionID), 'string') !== 0 || strlen($obj->TransactionID) > 50) { // Check if property TransactionID is not a string with max length 50
					http_response_code(400);
					exit(); // Object has missing or improper TransactionID property
					
				} else if(!property_exists($obj, 'TMS') || strcmp(gettype($obj->TMS), 'string') !== 0 || strlen($obj->TMS) > 50) { // Check if property TMS is not a string with max length 50
					http_response_code(400);
					exit(); // Object has missing or improper TMS property
					
				} else if(!property_exists($obj, 'LaneID') || strcmp(gettype($obj->LaneID), 'string') !== 0 || strlen($obj->LaneID) > 50) { // Check if property LaneID is not a string with max length 50
					http_response_code(400);
					exit(); // Object has missing or improper LaneID property
					
				} else if(!property_exists($obj, 'Ticket') || strcmp(gettype($obj->Ticket), 'string') !== 0 || strlen($obj->Ticket) > 50) { // Check if property Ticket is not a string with max length 50
					http_response_code(400);
					exit(); // Object has missing or improper Ticket property
					
				} else if(!property_exists($obj, 'PO') || strcmp(gettype($obj->PO), 'string') !== 0 || strlen($obj->PO) > 50) { // Check if property PO is not a string with max length 50
					http_response_code(400);
					exit(); // Object has missing or improper PO property
					
				} else if(!property_exists($obj, 'BOL') || strcmp(gettype($obj->BOL), 'string') !== 0 || strlen($obj->BOL) > 50) { // Check if property BOL is not a string with max length 50
					http_response_code(400);
					exit(); // Object has missing or improper BOL property
					
				} else if(!property_exists($obj, 'Product') || strcmp(gettype($obj->Product), 'string') !== 0 || strlen($obj->Product) > 50) { // Check if property Product is not a string with max length 50
					http_response_code(400);
					exit(); // Object has missing or improper Product property
					
				} else if(!property_exists($obj, 'UOM') || strcmp(gettype($obj->UOM), 'string') !== 0 || strlen($obj->UOM) > 50) { // Check if property UOM is not a string with max length 50
					http_response_code(400);
					exit(); // Object has missing or improper UOM property
					
				} else if(!property_exists($obj, 'CarrierName') || strcmp(gettype($obj->CarrierName), 'string') !== 0 || strlen($obj->CarrierName) > 50) { // Check if property CarrierName is not a string with max length 50
					http_response_code(400);
					exit(); // Object has missing or improper CarrierName property
					
				} else if(!property_exists($obj, 'TruckID') || strcmp(gettype($obj->TruckID), 'string') !== 0 || strlen($obj->TruckID) > 50) { // Check if property TruckID is not a string with max length 50
					http_response_code(400);
					exit(); // Object has missing or improper TruckID property
					
				} else if(!property_exists($obj, 'TrailerID') || strcmp(gettype($obj->TrailerID), 'string') !== 0 || strlen($obj->TrailerID) > 50) { // Check if property TrailerID is not a string with max length 50
					http_response_code(400);
					exit(); // Object has missing or improper TrailerID property
					
				} else if(!property_exists($obj, 'Destination') || strcmp(gettype($obj->Destination), 'string') !== 0 || strlen($obj->Destination) > 50) { // Check if property Destination is not a string with max length 50
					http_response_code(400);
					exit(); // Object has missing or improper Destination property
					
				} else if(!property_exists($obj, 'DestinationID') || strcmp(gettype($obj->DestinationID), 'string') !== 0 || strlen($obj->DestinationID) > 50) { // Check if property DestinationID is not a string with max length 50
					http_response_code(400);
					exit(); // Object has missing or improper DestinationID property
				}
				
				// Check integer properties
				if(!property_exists($obj, 'Gross') || strcmp(gettype($obj->Gross), 'integer') !== 0 || strlen((string)($obj->Gross)) > 7) { // Check if property Gross is not an integer with max length 7
					http_response_code(400);
					exit(); // Object has missing or improper Gross property
					
				} else if(!property_exists($obj, 'Tare') || strcmp(gettype($obj->Tare), 'integer') !== 0 || strlen((string)($obj->Tare)) > 7) { // Check if property Tare is not an integer with max length 7
					http_response_code(400);
					exit(); // Object has missing or improper Tare property
					
				} else if(!property_exists($obj, 'Net') || strcmp(gettype($obj->Net), 'integer') !== 0 || strlen((string)($obj->Net)) > 7) { // Check if property Net is not an integer with max length 7
					http_response_code(400);
					exit(); // Object has missing or improper Net property
				}
				
				// Check datetime properties
				$reg = '/^\d{4}-\d{2}-\d{2}T\d{2}:\d{2}:\d{2}(|\.\d)Z$/'; // UTC (zulu) format w/ up to 1 decimal place in seconds
				if(!property_exists($obj, 'EntryTimeUTC') || strcmp(gettype($obj->EntryTimeUTC), 'string') !== 0 || preg_match($reg, $obj->EntryTimeUTC) !== 1) { // Check if property EntryTimeUTC is not a datetime string with UTC format
					http_response_code(400);
					exit(); // Object has missing or improper EntryTimeUTC property
					
				} else if(!property_exists($obj, 'ExitTimeUTC') || strcmp(gettype($obj->ExitTimeUTC), 'string') !== 0 || preg_match($reg, $obj->ExitTimeUTC) !== 1) { // Check if property ExitTimeUTC is not a datetime string with UTC format
					http_response_code(400);
					exit(); // Object has missing or improper ExitTimeUTC property
				}
			}
		}
	}
	
	// SUCCESS
	http_response_code(200);
	exit(); // The response is well structured
?>
