<?php 
	

	/**
	* Date : 15/02/2016
	* Programmer: Muhammad Ariff Noor Azmi
	*/
	class Billplz extends Auth
	{
		public function CreateBill($cus_name,$cus_email,$cus_mobile,$amount,$callback_url,$description="",$bill_id=null)
		{

			if ($bill_id != null ) {
				
				// Check either bill is valid
				$check = $this->GetBill($bill_id);

				if ($check->paid == false) {
					
					header("Location: '".$check->url."'");
				}
				else{

					$message[] = array(

						"message" => "Bill have been paid"
					);
					return json_encode($message);
				}

			}
			else{

				$ch = curl_init("https://www.billplz.com/api/v2/bills/");
				curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
				curl_setopt($ch, CURLOPT_USERPWD, Auth::my_token().":");
				curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
				curl_setopt($ch,CURLOPT_POSTFIELDS, array(
					'collection_id' => Auth::collection_id(),
			        'name' => $cus_name,
			        'email' => $cus_email,
			        'mobile' => $cus_mobile,
			        'amount' => $amount,
			        'metadata[description]' => $description,
			        'callback_url' => $callback_url
				));
				$response = json_decode(curl_exec($ch));
				curl_close($ch);
				return $response;
			}
			/*
			===================================
			Sample response from billplz server
			===================================
			"id": "8X0Iyzaw",
			"collection_id": "inbmmepb",
			"paid": false,
			"state": "pending",
			"amount": 200 ,
			"paid_amount": 0,
			"due_at": "2015-3-9",
			"email" :"api@billplz.com",
			"mobile": null,
			"name": "MICHAEL API",
			"metadata": {},
			"url": "https://www.billplz.com/bills/CGh_CE_0"
			===================================
          	*/
		}

		public function GetBill($bill_id)
		{
			$ch = curl_init("https://www.billplz.com/api/v2/bills/".$bill_id."");
			curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
			curl_setopt($ch, CURLOPT_USERPWD, Auth::my_token().":");
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			$response = json_decode(curl_exec($ch));
			curl_close($ch);
			return $response;

			/*
			========================================================
			Sample response from billplz server for get bill details
			========================================================
			{
				"id": "W_79pJDk",
				"collection_id": "inbmmepb",
				"paid": false,
				"state": "pending",
				"amount": 200,
				"paid_amount": 0,
				"due_at": "2020-12-31",
				"email": "api@billplz.com",
				"mobile": "+60112223333",
				"name": "MICHAEL API",
				"metadata":
				{
				"id": "9999",
				"description": "This is to test bill creation"
				},
				"url": "http: //billplz.dev/bills/W_79pJDk"
        	}
        	========================================================
			*/
		}

		public function DeleteBill($bill_id)
		{
		    $ch = curl_init("https://www.billplz.com/api/v2/bills/".$bill_id."");
			curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
			curl_setopt($ch, CURLOPT_USERPWD, Auth::my_token().":");
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "DELETE");
		    $result = curl_exec($ch);
		    $result = json_decode($result);
		    curl_close($ch);

		    return $result;
		}
	}
	
	class Auth 
	{
		
		protected function my_token()
		{
			return "place-your-token-here";

		}
		protected function collection_id()
		{
			return "place-your-collection-id-here";
		}
	}

?>