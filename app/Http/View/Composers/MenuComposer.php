<?php


namespace App\Http\View\Composers;
use App\Models\Category;

use Illuminate\View\View;

class MenuComposer
{
    protected $users;

    public function __construct()
    {
    }

    public function compose(View $view)
    {
        $menus = Category::select('id', 'categoryname','categorycode', 'parent_id')->where('status', 1)->get();
        $view->with('menus', $menus);
    }
}
