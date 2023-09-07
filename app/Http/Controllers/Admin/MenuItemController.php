<?php

namespace App\Http\Controllers\Admin;

use App\Contracts\MenuRepositoryInterface;
use App\Http\Requests\Admin\MenuItemRequest;
use App\Models\Menu;
use App\Models\MenuItem;
use Illuminate\Http\Request;
use Storage;

class MenuItemController extends BaseAdminController
{
    public function create(Request $request, MenuRepositoryInterface $menuRepository)
    {
        $menu = Menu::find($request->get('menu_id'));
        $parents = MenuItem::all();
        return view('admin.menu_items.create', compact('menu', 'parents'));
    }

    public function store(MenuItemRequest $request)
    {
        $menu = Menu::find($request->get('menu_id'));
        $validated = $request->validated();
        $data = [
            'key' => $validated['key'],
            'link' => $validated['link'] ?? null,
            'mega' => $validated['mega'] ?? 0,
            'parent_id' => $validated['parent_id'] ?? null
        ];

        if (isset($validated['image'])) {
            $data['image'] = $validated['image']->store('public/images');
        }

        $menuItem = $menu->items()->create($data);
        $menuItem->addTranslations($validated);
        return redirect()->route('admin.menus.show', $menu)->with('success', 'Menu item created successfully!');
    }

    public function edit(Request $request, MenuItem $menuItem)
    {
        $menu = Menu::find($request->get('menu_id'));

        $parents = MenuItem::where('menu_id', $menu->id)->get();
        return view('admin.menu_items.edit', compact('menu', 'menuItem', 'parents'));
    }

    public function update(MenuItemRequest $request, MenuItem $menuItem)
    {
        $menu = Menu::find($request->get('menu_id'));
        $validated = $request->validated();

        $data = [
            'key' => $validated['key'],
            'link' => $validated['link'] ?? null,
            'mega' => $validated['mega'] ?? 0,
            'parent_id' => $validated['parent_id'] ?? null
        ];

        if (isset($validated['image'])) {
            if ($menu->image && Storage::exists($menu->image)) {
                Storage::delete($menu->image);
            }
            $data['image'] = $validated['image']->store('public/images');
        }

        $menuItem->update($data);
        $menuItem->addTranslations($validated);

        return redirect()->route('admin.menus.show', $menu)->with('success', 'Menu item updated successfully!');
    }

    public function destroy(Request $request, MenuItem $menuItem)
    {
        $menuItem->delete();
        $menu = Menu::find($request->get('menu_id'));
        return redirect()->route('admin.menus.show', $menu)->with('success', 'Menu item deleted successfully!');
    }
}
