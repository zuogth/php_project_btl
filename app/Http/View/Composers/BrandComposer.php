<?php

namespace App\Http\View\Composers;

use App\Models\Brand;
use Illuminate\View\View;

class BrandComposer
{
    protected $users;

    public function __construct()
    {
    }

    public function compose(View $view)
    {
        $brands = Brand::select('id', 'brandname', 'brandcode')->get();

        $view->with('brands', $brands);
    }

}
