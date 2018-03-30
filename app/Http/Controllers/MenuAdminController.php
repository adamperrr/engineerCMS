<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\MenuLink;
use App\Http\Requests\MenuLinkRequest;

class MenuAdminController extends Controller
{
    public function __construct()
    {
        Controller::__construct();
        $this->middleware(['auth', 'checkAdmin']);
    }

    public function index()
    {
        $menuLinks = MenuLink::orderBy('order', 'asc')->get();

        return view('menu-admin.index', [
            'menuLinks' => $menuLinks
        ]);
    }

    public function create()
    {
        return view('menu-admin.create');
    }

    public function store(MenuLinkRequest $request)
    {
        $menuLink = new MenuLink();
        $menuLink->name = $request->input('name');
        $menuLink->link = $request->input('link');
        $menuLink->order = 0;
        $menuLink->save();

        return redirect()->route('menu-admin.index');
    }

    public function edit(MenuLink $menuLink)
    {
        return view('menu-admin.edit', [
            'menuLink' => $menuLink
        ]);
    }

    public function update(MenuLinkRequest $request, MenuLink $menuLink)
    {
        $menuLink->name = $request->input('name');
        $menuLink->link = $request->input('link');
        $menuLink->save();

        return redirect()->route('menu-admin.index');
    }

    public function updateOrder(Request $request)
    {
        $menulinksID = json_decode($request->menulinksID);
        $menulinks = MenuLink::find($menulinksID);
        $flippedMenulinksID = array_flip($menulinksID); // Exchanges all keys with their associated values in an array

        foreach($menulinks as $key => $link)
        {
            $link->order = $flippedMenulinksID[$link->id];
            $link->save();
        }

        $response = array(
            'status' => 'success',
            'msg' => "Menu order updated",
        );

        return response()->json($response);
    }

    public function destroy(MenuLink $menuLink)
    {
        $menuLink->delete();

        return redirect()->route('menu-admin.index');
    }
}
