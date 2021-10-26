<?php

namespace App\Http\Controllers\front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class PaidController extends Controller
{
  public function index(Request $request)
    {
			if(isset($_GET['tap_id'])){
				$curl = curl_init();
				curl_setopt_array($curl, array(
				  CURLOPT_URL => "https://api.tap.company/v2/charges/".$_GET['tap_id'],
				  CURLOPT_RETURNTRANSFER => true,
				  CURLOPT_ENCODING => "",
				  CURLOPT_MAXREDIRS => 10,
				  CURLOPT_TIMEOUT => 30,
				  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
				  CURLOPT_CUSTOMREQUEST => "GET",
				  CURLOPT_POSTFIELDS => "{}",
				  CURLOPT_HTTPHEADER => array(
					"authorization: Bearer sk_test_2TiYFrNgQk0KABUsdc8Em6fu"
				  ),
				));

				$response = curl_exec($curl);
				$err = curl_error($curl);

				curl_close($curl);

				if ($err) {
				  echo "cURL Error #:" . $err;
				} else {
					// here is response
				  DB::insert("insert into test (response) values ('".$response."')"); 
				}
			}


        
        return '<html>
		  <head>
			<meta charset="utf-8" />
			<meta
			  name="viewport"
			  content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0"
			/>

			<link
			  rel="shortcut icon"
			  href="https://goSellJSLib.b-cdn.net/v1.6.0/imgs/tap-favicon.ico"
			/>
			<link
			  href="https://goSellJSLib.b-cdn.net/v1.6.0/css/gosell.css"
			  rel="stylesheet"
			/>
		  </head>
		  <body>

			<script
			  type="text/javascript"
			  src="https://goSellJSLib.b-cdn.net/v1.6.0/js/gosell.js"
			></script>

			<div id="root"></div>
			<script>
			var x;
				goSell.showResult({
					callback: response => {
						x = JSON.stringify(response, null, 4)
					}
				});
			</script>
		  </body>
		</html>';
    }
}
