<?php

if (!function_exists('getMenu')) {
    function getMenu()
    {
        return \Illuminate\Support\Facades\DB::table('tbl_menu_master')->where(['menu_status'=>0])->get();
    }
}
if (!function_exists('getSubMenu')) {
    function getSubMenu($id)
    {
        return \Illuminate\Support\Facades\DB::table('tbl_menu_master')->where(['master_menu_id'=>$id,'menu_status'=>0])->get();
    }
}

if(!function_exists('business_category'))
{
    function business_category()
    {
       return   $data = [
                    '1'=>'SHIPPING & FULFILMENT IN INDIA',
                    '2'=> 'CROSS BORDER COMMERCE'
        ];
    }
}
if(!function_exists('company_type'))
{
    function company_type()
    {
       return   $data = [
                    '1'=>'Domestic',
                    '2'=> 'International'
        ];
    }
}
if(!function_exists('internationalType'))
{
    function internationalType()
    {
       return   $data = [
                    '1'=>'Import',
                    '2'=> 'Export'
        ];
    }
}
if(!function_exists('docType'))
{
    function docType()
    {
       return   $data = [
                    '1'=>'Document',
                    '2'=> 'No Document'
        ];
    }
}
if(!function_exists('walletType'))
{
    function walletType()
    {
       return   $data = [
                    '1'=>'Credit',
                    '2'=> 'Debit'
        ];
    }
}

if(!function_exists('ordersMenus'))
{
    function ordersMenus()
    {
       return   $data = [
                    '1'=>'Setting up a new business',
                    '2'=> 'Between 1-10 orders',
                    '3'=> '11-100 orders',
                    '4'=> '101-1000 orders',
                    '5'=> '1001-5000 orders',
                    '6'=> 'More than 5000 orders'
        ];
    }
}
if(!function_exists('rateType'))
{
    function rateType()
    {
       return   $data = [
                    '0'=>'Fixed',
                    '1'=>'Addtion 250GM',
                    '2'=> 'Addtion 500GM',
                    '3'=> 'Addtion 1000GM',
                    '4'=> 'Per Kg'
        ];
    }
}
// Delhivery Auth
if(!function_exists('delhiveryAuth'))
{
     function delhiveryAuth()
     {
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://btob.api.delhivery.com/ums/login',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => '{
                                    "username": "chetanenterprised2brc",
                                    "password": "123Deepak.com"
                                    }',
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/json',
            ),
            CURLOPT_SSL_VERIFYPEER => false,  // Disable SSL verification
            CURLOPT_SSL_VERIFYHOST => false,  // Disable SSL hostname verification
        ));
        $response_kk = curl_exec($curl);
        curl_close($curl);
       return $jwt = json_decode($response_kk);
     }
}
// XpressBess 
if(!function_exists('XpressbeesAuth'))
{
    function XpressbeesAuth()
    {
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://ship.xpressbees.com/api/users/franchise_login',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => '{
                                    "email": "gst.ercargo@gmail.com",
                                    "password": "Deepak@12345"
                                    }',
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/json',
            ),
            CURLOPT_SSL_VERIFYPEER => false,  // Disable SSL verification
            CURLOPT_SSL_VERIFYHOST => false,  // Disable SSL hostname verification
        ));
        $response_kk = curl_exec($curl);
        curl_close($curl);
       return $jwt = json_decode($response_kk);
    }
}

if(!function_exists('XpressbessBooking')){
    function XpressbessBooking($data,$key)
    {
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://ship.xpressbees.com/api/franchise/shipments',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => $data,
            CURLOPT_HTTPHEADER => array(
                'accept: application/json',
                'Authorization: Bearer ' . $key
            ),
            CURLOPT_SSL_VERIFYPEER => false,  // Disable SSL verification
            CURLOPT_SSL_VERIFYHOST => false,  // Disable SSL hostname verification
        ));
        $response = curl_exec($curl);
        curl_close($curl);
        if (curl_errno($curl)) {
            // Display the cURL error
            echo 'cURL Error: ' . curl_error($curl);
        }
       $response = json_decode($response);
       dd($response);
    }
}
// BlueDartAuth
if(!function_exists('BlueDartAuth'))
{
    function BlueDartAuth()
    {
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://apigateway.bluedart.com/in/transportation/token/v1/login',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_HTTPHEADER => array(
                'ClientID: 	Ey2gEYkyOrlhdlk6ro7TvEggBjXGNjsl',
                'clientSecret: FUnkU7WacsB3AIPa'
            ),
            CURLOPT_CUSTOMREQUEST => 'GET',
            // CURLOPT_HTTPHEADER => array(
            //     'Authorization: Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJzdWIiOiJzdWJqZWN0LXN1YmplY3QiLCJhdWQiOlsiYXVkaWVuY2UxIiwiYXVkaWVuY2UyIl0sImlzcyI6InVybjpcL1wvYXBpZ2VlLWVkZ2UtSldULXBvbGljeS10ZXN0IiwiZXhwIjoxNzExODY1Mjg4LCJpYXQiOjE3MTE3Nzg4ODgsImp0aSI6ImVkMDIzNzE0LWZkNWEtNDZjNC1hODAxLTU4ZGFjNjE2OTM1ZSJ9.oQAAFHN5g4pMF_lyAJQZooR1Kg1yFD8T4jrb-b6iWc4',
            // ),
            CURLOPT_SSL_VERIFYPEER => false,  // Disable SSL verification
            CURLOPT_SSL_VERIFYHOST => false,  // Disable SSL hostname verification
        ));
        $response = curl_exec($curl);
        curl_close($curl);
        return json_decode($response);
    }
}

if(!function_exists('BookingblueDart')){
    function BookingblueDart($data , $key)
    {
        // dd($key);
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://apigateway.bluedart.com/in/transportation/waybill/v1/GenerateWayBill',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS =>$data,
            CURLOPT_HTTPHEADER => array(
                'accept: application/json',
                'JWTToken: '.$key,
                'Content-Type: application/json'
            ),
        ));
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($curl, CURLOPT_VERBOSE, true);
        $response = curl_exec($curl);
        curl_close($curl);
       return $response = json_decode($response);
    }
}

if(!function_exists('Bookingdelhivery'))
{
    function Bookingdelhivery($data , $key)
    {
        // dd($data);
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://btob.api.delhivery.com/v3/manifest',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => $data,
            CURLOPT_HTTPHEADER => array(
                'Authorization: Bearer ' . $key,
            ),
          
        ));
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($curl, CURLOPT_VERBOSE, true);
        $response = curl_exec($curl);
        curl_close($curl);
        if (curl_errno($curl)) {
            // Display the cURL error
            echo 'cURL Error: ' . curl_error($curl);
        }
        $response1 = json_decode($response);
        dd($response1);
        sleep(10);
        if ($response1->job_id) {
            $curl = curl_init();
            curl_setopt_array($curl, array(
                CURLOPT_URL => 'https://btob.api.delhivery.com/v3/manifest?job_id=' . $response1->job_id,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'GET',
                CURLOPT_HTTPHEADER => array(
                    'Authorization: Bearer ' . $key,
                ),
             
            ));
             curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
            curl_setopt($curl, CURLOPT_VERBOSE, true);
            $response_job_id = curl_exec($curl);
            if (curl_errno($curl)) {
                // Display the cURL error
                echo 'cURL Error: ' . curl_error($curl);
            }
           
            curl_close($curl);
            $response11 = json_decode($response_job_id);
          return  $forwording_no = $response11->status->value->lrnum;
        }
    }
}

//  pickup date convter
if(!function_exists('date_convter')){
    function date_convter($netDate)
    {
        preg_match('/\/Date\((\d+)([+-]\d{4})?\)\//', $netDate, $matches);
        $timestampMs = $matches[1];
        $timezoneOffset = $matches[2] ?? null;
        $timestampSeconds = $timestampMs / 1000;
        $date = new DateTime();
        $date->setTimestamp($timestampSeconds);
        if ($timezoneOffset) {
            $hours = (int) substr($timezoneOffset, 0, 3);
            $minutes = (int) substr($timezoneOffset, 3, 2);
            $offsetInSeconds = ($hours * 3600) + ($minutes * 60);
            $date->modify(($hours >= 0 ? '+' : '-') . abs($offsetInSeconds) . ' seconds');
        }
       return $date->format('Y-m-d');
    }
}

// Wearhouse 
if(!function_exists('Wearhouse_creation'))
{
    function Wearhouse_creation($data,$key)
    {
        $curl = curl_init();

		curl_setopt_array($curl, array(
		CURLOPT_URL => 'https://track.delhivery.com/api/backend/clientwarehouse/create/',
		CURLOPT_RETURNTRANSFER => true,
		CURLOPT_ENCODING => '',
		CURLOPT_MAXREDIRS => 10,
		CURLOPT_TIMEOUT => 0,
		CURLOPT_FOLLOWLOCATION => true,
		CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		CURLOPT_CUSTOMREQUEST => 'POST',
		CURLOPT_POSTFIELDS =>json_encode($data),
		CURLOPT_HTTPHEADER => array(
			'Authorization: Bearer '.$key,
            'Content-Type: application/json'
		),
		));
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($curl, CURLOPT_VERBOSE, true);
		$respooooonse = curl_exec($curl);
        if (curl_errno($curl)) {
            // Display the cURL error
            echo 'cURL Error: ' . curl_error($curl);
        }
		curl_close($curl); 
         
		 return $respooooonse;
    }
}

if(!function_exists('SendOtp'))
{
    function SendOtp($number,$otp)
    {
        $tamp_id = 1107172845189433045;
        $enmsg = "Hi, Your Verification ".$otp." code ,NOKA";
        $msg2 = urlencode($enmsg);
        $ch = curl_init();
        curl_setopt($ch,CURLOPT_URL, "https://sms.cell24x7.in/mspProducerM/sendSMS?user=noka&pwd=123456789&sender=NOKAFW&mobile=$number&msg=$msg2&mt=0&tempId=$tamp_id");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);

        $response = curl_exec($ch);
        curl_close($ch);
        if (curl_errno($ch)) {
            $error_msg = 'cURL error: ' . curl_error($ch);
            curl_close($ch);
            return $error_msg;
        } else {
            curl_close($ch);
            return 'true';
        }
    }
}
 
?>