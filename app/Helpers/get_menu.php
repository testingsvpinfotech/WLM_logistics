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
?>