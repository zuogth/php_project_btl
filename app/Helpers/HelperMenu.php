<?php

namespace App\Helpers;



use NumberFormatter;

class HelperMenu
{
    public static function menus($menus,$brands,$parent_id = null,$child = ''){

        $html = '';
        foreach ($menus as $key => $menu){
            if ($menu->parent_id == $parent_id){
                $html .= '
                <li  class="nav-item">
                    <a class="nav-link" href="/product/'.$child.''.$menu->categorycode.'">'.$menu->categoryname.'</a>';
                if (self::isChild($menus, $menu->id)){
                    $child = $menu->categorycode.'/';
                    $html .='  <div class="hidden-menu-child">
                                <div class="h-menu-child d-flex">
                                <div class="m-category-list"><ul>';
                    foreach ($brands as $brand){
                        $html .= '<li><h5><a class="list-brand" href="/product/brand/'.$child.''.$brand->brandcode.'">'.$brand->brandname.'
                                            <i class="fas fa-angle-right"></i></a></h5></li>';
                    }
                    $html .='</ul> <ul>'.self::menus($menus,$brands,$menu->id,$child).'</ul>';
                    $html.='<img src="'.$menu->thumb.'" width="250px">';
                    $html .='</div>
                             </div>
                             </div>';
                    $child = '';
                }
                $html .= '</li>';
            }
        }
        return $html;
    }

    public static function isChild($menus, $id){
        foreach ($menus as  $menu){
            if ($menu->parent_id == $id){
                return true;
            }
        }
        return false;
    }


    public static function pricesale($price, $discount){
        $html = '';
        if ($discount  > 0){
            $html .= ' <span style="text-decoration: line-through; color: red">'.self::priceCovert($price).'
                                            </span> - <span>'. self::priceCovert($price * (100 - $discount)/100) .' </span>';

        } else {
            $html .= ' <span>'.self::priceCovert($price).'</span>';
        }
            return $html;
    }
    public static function priceCovert($price)
    {
        if($price>0){
            $fmt = new NumberFormatter( 'it-IT', NumberFormatter::CURRENCY );
            return $fmt->formatCurrency($price, "VND");
        }
        return '_';
    }

    public static function bill($value)
    {
        $html = '';
        if($value){
            $html .='<div class="label-prod-item"><i class="fab fa-sellsy"></i>
                            <span>Đã bán: </span>
                            <span> ' .$value->count_bill.'</span>
                        </div>';

        } else{
            $html .='<div class="label-prod-item"><i class="fab fa-sellsy"></i>
                            <span>Đã bán: </span>
                            <span>0</span>
                        </div>';
        }
        return $html;
    }

    public static function repo($bill,$receipt)
    {
        $html = '';
        if($receipt != null && $bill !=null){
            $html .='<div class="label-prod-item"><i class="fas fa-warehouse"></i>
                            <span>Còn trong kho:</span>
                            <span id="count-span">'. $receipt->count_receipt - $bill->count_bill .'</span>
                        </div>';

        } else if ($receipt != null && $bill == null){
            $html .='<div class="label-prod-item"><i class="fas fa-warehouse"></i>
                            <span>Còn trong kho:</span>
                            <span id="count-span">'. $receipt->count_receipt .'</span>
                        </div>';
        }
        else{
            $html .='<div class="label-prod-item"><i class="fas fa-warehouse"></i>
                            <span>Còn trong kho:</span>
                            <span id="count-span"> 0 </span>
                        </div>';
        }
        return $html;
    }

}
