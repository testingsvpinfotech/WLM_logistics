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
                                    "username": "ERCARGODCB2BR",
                                    "password": "Deepak@2024"
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

if(!function_exists('Bookingdelhivery'))
{
    function Bookingdelhivery($data , $key)
    {
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
                'Authorization: Bearer ' . json_encode($key),
            ),
          
        ));
        $response = curl_exec($curl);
        curl_close($curl);
        $response1 = json_decode($response);
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
            $response_job_id = curl_exec($curl);
            curl_close($curl);
            $response11 = json_decode($response_job_id);
          return  $forwording_no = $response11->status->value->lrnum;
        }
    }
}
 
?>