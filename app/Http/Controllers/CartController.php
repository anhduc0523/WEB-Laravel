<?php

namespace App\Http\Controllers;


use App\Http\Services\Menu\MenuService;
use Illuminate\Http\Request;
use App\Http\Services\CartService;
use Illuminate\Support\Facades\Session;

class CartController extends Controller
{
    protected $cartService;

    protected $menu;

    public function __construct(CartService $cartService , MenuService $menuService)
    {
        $this->cartService = $cartService;
        $this->menu = $menuService;
    }

    public function index(Request $request)
    {
        $result = $this->cartService->create($request);
        if ($result === false) {
            return redirect()->back();
        }

        return redirect('/carts');
    }

    public function show()
    {
        $products = $this->cartService->getProduct();
        $menus = $this->menu->show();
        return view('carts.list', [
            'title' => 'Giỏ Hàng',
            'products' => $products,
            'menus' => $menus,
            'carts' => Session::get('carts')
        ]);
    }

    public function update(Request $request)
    {
        $this->cartService->update($request);

        return redirect('/carts');
    }

    public function remove($id = 0)
    {
        $this->cartService->remove($id);

        return redirect('/carts');
    }

    public function addCart(Request $request)
    {
        $this->cartService->addCart($request);

        return redirect()->back();
    }
}
