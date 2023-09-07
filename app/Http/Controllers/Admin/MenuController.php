<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\MenuRequest;
use App\Models\Menu;
use Storage;

class MenuController extends BaseAdminController
{
    public function index()
    {
        $menus = Menu::all();
        return view('admin.menus.index', compact('menus'));
    }

    public function create()
    {
        return view('admin.menus.create');
    }

    public function store(MenuRequest $request)
    {
        $validated = $request->validated();
        $data = [
            'name' => $validated['name'],
        ];

        if (isset($validated['image'])) {
            $image = $validated['image'];
            $data['image'] = $image->store('public/images');
        }

        $menu = Menu::create($data);

        return redirect()->route('admin.menus.index')->with('success', 'Menu created successfully!');
    }

    public function show(Menu $menu)
    {
        $menu->load('items.parent');
        return view('admin.menus.show', compact('menu'));
    }

    public function edit(Menu $menu)
    {
        return view('admin.menus.edit', compact('menu'));
    }

    public function update(MenuRequest $request, Menu $menu)
    {
        $validated = $request->validated();
        $data = [
            'name' => $validated['name'],
        ];

        if (isset($validated['image'])) {
            if ($menu->image && Storage::exists($menu->image)) {
                Storage::delete($menu->image);
            }
            $image = $validated['image'];
            $data['image'] = $image->store('public/images');
        }

        $menu->update($data);

        return redirect()->route('admin.menus.index')->with('success', 'Menu updated successfully!');
    }

    public function destroy(Menu $menu)
    {
        $menu->delete();

        return redirect()->route('admin.menus.index')->with('success', 'Menu deleted successfully!');
    }
}
