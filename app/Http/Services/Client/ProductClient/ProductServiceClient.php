<?php

namespace App\Http\Services\Client\ProductClient;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Support\Facades\DB;
use Illuminate\Pagination\Paginator;
class ProductServiceClient
{
//////////////////////////list product////////////////////////////
    public function findAllByType($cateName,$type){
        try {
            $cate = Category::where('categorycode',$cateName)->where('status',1)->get('id')->first();
            if ($type != null){
                $catechild = Category::where('parent_id',$cate->id)->where('categorycode',$type)->get('id');
            }  else{
                $catechild = Category::where('parent_id',$cate->id)->get('id');
            }
            $result = array();

            foreach ($catechild as $e){
                $result[] = $e->id;
            }
            $main=self::mainGetCount();

            return DB::table('product')
                ->leftJoin('comments','product.id','=','comments.product_id')
                ->joinSub($main,'main','main.id','=','product.id')
                ->where('status',1)
//                ->whereBetween('category_id',[$result[0], $result[count($result)-1]])
                    ->whereIn('category_id',$result)
                ->select('product.*','main.count')
                ->selectRaw('count(comments.product_id) as cmt')
                ->selectRaw('ROUND(avg( comments.stars),1) as star')
                ->groupBy('product.id','product.productname','product.pricesell','product.priceentry','product.description','product.content','product.productcode','product.category_id','product.brand_id','product.images','product.status','product.discount','main.count')
                ->orderBy('product.id');
        } catch (\Exception $ex){
            return false;
        }
    }

    public function starsProduct()
    {
        return DB::table('comments')
            ->select('comments.product_id')
            ->selectRaw('avg(stars) as star')
            ->groupBy('comments.product_id')
            ->get();
    }

    public function findAllByBrand($cateName,$brand){
        try {
            $cate = Category::where('categorycode',$cateName)->where('status',1)->get('id')->first();
            if ($brand != null){
                $brand = Brand::where('brandcode',$brand)->get()->first();
            }

            $catechild = Category::where('parent_id',$cate->id)->get('id');
            $result = array();
            foreach ($catechild as $e){
                $result[] = $e->id;
            }
            $main=self::mainGetCount();
            return DB::table('product')
                ->leftJoin('comments','product.id','=','comments.product_id')
                ->joinSub($main,'main','main.id','=','product.id')
                ->where('status',1)
                ->whereIn('category_id',$result)
                ->when($brand != null, function ($query) use ($brand){
                    $query->where('brand_id',$brand->id);
                })
                ->select('product.*','main.count')
                ->selectRaw('count(comments.product_id) as cmt')
                ->selectRaw('ROUND(avg( comments.stars),1) as star')
                ->groupBy('product.id')
                ->orderBy('product.id');
        } catch (\Exception $e){
            return false;
        }
    }
    public function findProductByRequest($request){
        $cate = Category::where('categorycode',$request->type)->where('status',1)->get('id')->first();
        $catechild = Category::where('parent_id',$cate->id)->get('id');
        $result = array();
        foreach ($catechild as $e){
            $result[] = $e->id;
        }

        $main=self::mainGetCount();

       return DB::table('product')
           ->leftJoin('comments','product.id','=','comments.product_id')
           ->joinSub($main,'main','main.id','=','product.id')
            ->where('status',1)
           ->whereIn('category_id',$result)
           ->when($request->brand != null, function ($query) use ($request){
                $query->where('brand_id',$request->brand);
            })
           ->when($request->category != null, function ($query) use ($request){
               $query->where('category_id',$request->category);
           })
           ->when($request->speciality != null, function ($query) use ($request){
               $query->join('product_speciality','product.id','=','product_speciality.product_id')
                   ->join('speciality','speciality.id','=','product_speciality.speciality_id')
                   ->where('speciality.id',$request->speciality);
           })
            ->select('product.*','main.count')
           ->selectRaw('count(comments.product_id) as cmt')
           ->selectRaw('ROUND(avg( comments.stars),1) as star')
           ->groupBy('product.id')
           ->when($request->select_option == 'name_asc', function ($query) use ($request){
               $query->orderBy('product.productname','asc');
           })
           ->when($request->select_option == 'name_desc', function ($query) use ($request){
               $query->orderBy('product.productname','desc');
           })
           ->when($request->select_option == 'price_asc', function ($query) use ($request){
               $query->orderBy('product.pricesell','asc');
           })
           ->when($request->select_option == 'price_desc', function ($query) use ($request){
               $query->orderBy('product.pricesell','desc');
           })
           ->when($request->select_option == '5000000', function ($query) use ($request){
               $query->where('product.pricesell','<',+ $request->select_option);
           })
           ->when($request->select_option == '15000000', function ($query) use ($request){
               $query->whereBetween('product.pricesell',[$request->select_option-10000000,+$request->select_option]);
           })
           ->when($request->select_option == '25000000', function ($query) use ($request){
               $query->whereBetween('product.pricesell',[$request->select_option-10000000,+$request->select_option]);
           })
           ->when($request->select_option == '35000000', function ($query) use ($request){
               $query->where('product.pricesell','>',+ $request->select_option);
           });

    }

    public function pagination($request){
        $cateName = $request->categoryCode;
        $type = $request->typeCode;
        $brand = $request->brandCode;

        $page = (($request->page) - 1) * 6;;

        if ($cateName != null || $type != null){
          return  self::findAllByType($cateName,$type)
              ->offset($page)
              ->limit(6)
              ->get();
        }
        if ($cateName != null && $brand != null){
            return  self::findAllByBrand($cateName,$brand)
                ->offset($page)
                ->limit(6)
                ->get();
        }
    }
    public function totalProduct($request){
        $cateName = $request->categoryCode;
        $type = $request->typeCode;
        $brand = $request->brandCode;

        if ($cateName != null || $type != null){
         //   return  self::findAllByType($cateName,$type)->get();
            return self::findAllByType($cateName,$type)->get();
        }
//        if ($cateName != null && $brand != null){
//            return  self::findAllByBrand($cateName,$brand);
//        }
    }


/////////////////////////////////////////////////////////
/// home product////////////////////////////////////////
///
    public function findProductSale(){
        $main=self::mainGetCount();
        return DB::table('product')
            ->joinSub($main,'main','main.id','=','product.id')
            ->where('discount','>','0')
            ->select('product.*','main.count')
            ->orderBy('product.id')
            ->paginate(8);
    }

//    hiển thị sản phẩm bán
    public function findProductByBestSell(){
        $main=self::mainGetCount();
        return DB::table('product')
           ->join('product_bill','product.id','=','product_bill.product_id')
            ->joinSub($main,'main','main.id','=','product.id')
            ->select("product.id",'product.images','product.productname','product.discount','product.description','product.pricesell','product.productcode','main.count')
            ->selectRaw("sum(product_bill.quantily) as quantily")
            ->groupBy('product.id','product.images','product.productname','product.discount','product.description','product.pricesell','product.productcode','main.count')
            ->orderBy('quantily', 'desc')
            ->paginate(6)->items();
    }
//    hiển thị sản phẩm bán theo đánh giá
    public function findProductByStars(){
        $main=self::mainGetCount();
        return DB::table('product')
            ->join('comments','product.id','=','comments.product_id')
            ->joinSub($main,'main','main.id','=','product.id')
            ->select("product.*",'main.count')
            ->selectRaw("ROUND(avg( comments.stars),1) as rate ")
            ->groupBy('product.id')
            ->orderBy('rate', 'desc')
            ->paginate(6)->items();
    }

//    hiển thị sản phẩm theo gợi ý
    public function findProductBYValue($request){
        $main=self::mainGetCount();
            if ($request->value == 'new'){
                $prodcuct = DB::table('product')
                    ->join('product_receipt','product.id','=','product_receipt.product_id')
                    ->join('receipt','receipt.id','=','product_receipt.receipt_id')
                    ->joinSub($main,'main','main.id','=','product.id')
                    ->select("product.*",'main.count')
                    ->selectRaw("max(receipt.receipt_date) as date")
                    ->groupBy('product.id')
                    ->orderBy('date', 'desc')
                    ->paginate(6)->items();
            } else if ($request->value == 'bestseller'){
                $prodcuct = self::findProductByBestSell();
            } else if($request->value == 'rate'){
                $prodcuct = self::findProductByStars();
            } else {
                $prodcuct =DB::table('product')
                    ->joinSub($main,'main','main.id','=','product.id')
                    ->select("product.*",'main.count')
                    ->inRandomOrder()
                         ->paginate(6)->items();
            }
        return $prodcuct;
    }

   public function findProductByCateAndBestSell($cateName){
       try {
           $cate = Category::where('categorycode',$cateName)->where('status',1)->get('id')->first();
           $catechild = Category::where('parent_id',$cate->id)->get('id');
           $result = array();
           foreach ($catechild as $e){
               $result[] = $e->id;
           }
           return DB::table('product')
               ->leftJoin('product_bill','product.id','=','product_bill.product_id')
               ->leftJoin('comments','product.id','=','comments.product_id')
               ->where('status',1)
               ->whereIn('category_id',$result)
               ->select("product.*")
               ->selectRaw("sum(product_bill.quantily) as quantily")
               ->selectRaw('count(comments.product_id) as cmt')
               ->selectRaw('ROUND(avg( comments.stars),1) as star')
               ->groupBy('product.id')
               ->orderBy('quantily', 'desc')
               ->paginate(8)->items();
       } catch (\Exception $ex){
           return false;
       }
    }
//////////////////////////////////////////////////////
//    product detail

    public function findOneByProductCode($id){
        return $id;
    }

   public function findById($id){
        return Product::find($id);
   }

   private function mainGetCount(){
       $pb=DB::table('product_bill')
           ->join('bill','bill.id','=','product_bill.bill_id')
           ->where('bill.bill_type','=','bill')
           ->select('product_bill.*');
       $receipt=DB::table('product')
           ->select('product.id',DB::raw('sum(product_receipt.quantily) as count'))
           ->leftJoin('product_receipt','product_receipt.product_id','=','product.id')
           ->groupBy('product.id');

       return DB::table('product')
           ->select('product.id',
               DB::raw('if(receipt.count is null,0,receipt.count)-if(sum(pb.quantily) is null,0,sum(pb.quantily)) as count'))
           ->leftJoinSub($pb,'pb','product.id','=','pb.product_id')
           ->joinSub($receipt,'receipt','receipt.id','=','product.id')
           ->groupBy('product.id','receipt.count');
   }
}
