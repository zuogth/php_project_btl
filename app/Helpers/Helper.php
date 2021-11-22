<?php

namespace App\Helpers;

use App\Http\Services\Client\ProductClient\ProductServiceClient;
use NumberFormatter;

class Helper{

    public static function category($categories,$parent_id=0,$char='')
    {

        $html='';
        foreach ($categories as $key => $category) {
            if($category->parent_id==$parent_id){
                $html.="
                <tr>
                    <td>$category->id</td>
                    <td>$char$category->categoryname</td>
                    <td>$category->description</td>
                    <td>".self::status('category',$category->status,$category->id)."</td>
                    <td>
                        <a href='/admin/category/edit/$category->id' class='btn btn-primary btn-sm'><i class='fas fa-edit'></i></a>
                        <a href='#' class='btn btn-danger btn-sm' onclick='removeRow($category->id,\"/admin/category/delete\")'><i class='fas fa-trash-alt'></i></a>
                    </td>
                </tr>
                ";
                unset($categories[$key]);
                $html.=self::category($categories,$category->id,$char."--");
            }

        }
        return $html;
    }

    public static function status($table,$status,$id):string{
        if($status==1){
            return '<span class="btn btn-success btn-xs" id="btn-status" table="'.$table.'" onclick="updateStatus(this,'.$id.',0)">Yes</span>';
        }
        return '<span class="btn btn-danger btn-xs" id="btn-status" table="'.$table.'" onclick="updateStatus(this,'.$id.',1)">No</span>';
    }

    public static function statusBill($status):string{
        if($status==1){
            return '<select name="status" class="btn btn-warning">
                        <option value="0">Đang xử lý</option>
                        <option value="1" selected>Đang giao</option>
                        <option value="2">Hoàn tất</option>
                    <select/>';
        }elseif ($status==2)
        {
            return '<select name="status" class="btn btn-success" disabled>
                        <option value="2" selected>Hoàn tất</option>
                    <select/>';
        }
        return '<select name="status" class="btn btn-danger">
                        <option value="0"  selected>Đang xử lý</option>
                        <option value="1">Đang giao</option>
                        <option value="2">Hoàn tất</option>
                    <select/>';
    }

    public static function statusBillClient($status):string{
        if($status==1){
            return '<span class="btn btn-warning btn-xs">Đang giao</span>';
        }elseif ($status==2)
        {
            return '<span class="btn btn-success btn-xs">Đã giao</span>';
        }
        return '<span class="btn btn-danger btn-xs">Đang xử lý</span>';
    }

    public static function price($price)
    {
        if($price>0){
            $fmt = new NumberFormatter( 'it-IT', NumberFormatter::CURRENCY );
            return $fmt->formatCurrency($price, "VND");
        }
        return '_';
    }

    public static function address($index,$address)
    {
        $arr=explode('-',$address);
        $village='';
        for($i=0;$i<sizeof($arr);$i++){
            if($index==3 && $i>=$index){
                if($i==sizeof($arr)-1){
                    $village.=$arr[$i];
                }else{
                    $village.=$arr[$i].'-';
                }
            }else{
                if($i==$index){
                    return $arr[$i];
                }
            }
        }
        return $village;
    }

    public static function stars($product_id,$stars)
    {
        foreach ($stars as $val)
        {
            if($product_id==$val->product_id){
                return $val->star;
            }
        }
        return 0;
    }

}
