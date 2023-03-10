<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Models\Category;
use App\Models\Order;
use App\Http\Requests\StoreMenuRequest;
use App\Http\Requests\UpdateMenuRequest;

class MenuController extends Controller
{
    public function index()
    {
        return view('menus.index', [
            'title' => 'Menu',
            'menus' => Menu::with('category')->options(request(['q', 'category', 'sortby', 'order']))->paginate(is_numeric(request('limit', 8)) ? request('limit', 8) : 8),
            'categories' => Category::all(),
            'sortables' => Menu::$sortable
        ]);
    }

    public function store(StoreMenuRequest $request)
    {
        $validated_data = $request->validated();
        if ($request->hasFile('img')) {
            $validated_data['img'] = $this->uploadFile($request->file('img'), public_path('img/menus'));
        }

        $menu = Menu::create($validated_data);

        $this->storeActivityLog('create', 'Membuat menu ' . $menu->name);

        return redirect()->back()->with('success', 'Menu berhasil ditambahkan!');
    }

    public function edit(Menu $menu)
    {
        return view('menus.edit', [
            'title' => 'Ubah Menu',
            'menu' => $menu,
            'categories' => Category::all()
        ]);
    }

    public function update(UpdateMenuRequest $request, Menu $menu)
    {
        $validated_data = $request->validated();

        if ($request->hasFile('img')) {
            if ($menu->img) {
                $this->deleteFile(public_path('img/menus/' . $menu->img));
            }
            $validated_data['img'] = $this->uploadFile($request->file('img'), public_path('img/menus'));
        } else if ($validated_data['delete_img']) {
            if ($menu->img) {
                $this->deleteFile(public_path('img/menus/' . $menu->img));
            }
            $validated_data['img'] = null;
        }

        unset($validated_data['delete_img']);

        $menu->update($validated_data);

        $this->storeActivityLog('update', 'Mengubah menu ' . $menu->name);

        return redirect($request->previous_url ?? route('menus.index'))->with('success', 'Menu berhasil diubah!');
    }

    public function destroy(Menu $menu)
    {
        if (!$menu) {
            return redirect()->back()->with('error', 'Menu tidak ditemukan!');
        }

        if (Order::where('menu_id', $menu->id)->exists()) {
            return redirect()->back()->with('error', 'Menu tidak dapat dihapus karena memiliki pesanan!');
        }

        if ($menu->img) {
            $this->deleteFile(public_path('img/menus/' . $menu->img));
        }

        $menu->delete();

        $this->storeActivityLog('delete', 'Menghapus menu ' . $menu->name);

        return redirect()->back()->with('success', 'Menu berhasil dihapus!');
    }
}
