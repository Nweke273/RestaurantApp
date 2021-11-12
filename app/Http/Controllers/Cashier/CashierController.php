<?php

namespace App\Http\Controllers\Cashier;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Menu;
use App\Models\Table;
use Illuminate\Http\Request;
use Symfony\Component\CssSelector\Node\FunctionNode;

class CashierController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        return view('cashier.index')
            ->with('categories', $categories);
    }


    public function getTables()
    {
        $tables = Table::all();
        $html = '';
        foreach ($tables as $table) {
            $html .= '<div class="col-md-2">';
            $html .= '<button class = "btn btn-primary btn-table data-id="' . $table->id . '" data-name="' . $table->name . '">
           <img class="img-fluid" src="' . url('images/table.png') . '">
           <br> 
<span class="badge badge-sucess">' . $table->name . '</span>
           </button>';
            $html .= '</div>';
        }
        return $html;
    }

    public function getMenuByCategory($id)
    {
        $menus = Menu::where('category_id', $id)->get();
        $html = '';
        foreach ($menus as $menu) {
            $html .= '<div class="col-md-3 text-center">
            <a class="btn btn-outline-secondary menu" data-id="' . $menu->id . '" data-name ="' . $menu->name . '">
            <img class="img-fluid" src="' . url('/menu_images/' . $menu->image) . '">
            <br>
            ' . $menu->name . '
            <br>
            $' . number_format($menu->price) . '
            </a>
            </div>';
        }
        return $html;
    }

    public function orderFood(Request $request)
    {
        return $request->menu_id;
    }
}
