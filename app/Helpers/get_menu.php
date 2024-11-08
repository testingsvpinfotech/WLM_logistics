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
?>