<?php

namespace App\Helpers;

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
                    <td>".self::status($category->status)."</td>
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

    public static function status($status):string{
        if($status==1){
            return '<span class="btn btn-success btn-xs">Yes</span>';
        }
        return '<span class="btn btn-danger btn-xs">No</span>';
    }

    public static function statusBill($status):string{
        if($status==1){
            return '<span class="btn btn-warning btn-xs">Đang giao</span>';
        }elseif ($status==2)
        {
            return '<span class="btn btn-success btn-xs">Hoàn tất</span>';
        }
        return '<span class="btn btn-danger btn-xs">Đang xử lý</span>';
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
}
