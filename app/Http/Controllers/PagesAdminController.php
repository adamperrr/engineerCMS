<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Page;
use App\Subpage;
use App\Http\Requests\PageRequest;

class PagesAdminController extends Controller
{
    public function __construct()
    {
        Controller::__construct();
        $this->middleware(['auth', 'checkAdmin']);
    }

    public function index()
    {
        $pages = Page::with(['subpages' => function ($query) {
            $query->orderBy('order', 'asc');
        }])->orderBy('order', 'asc')->get();

        return view('pages-admin.index', [
            'pages' => $pages
        ]);
    }

    public function show(Page $page)
    {
        $id = $page->id;
        $subpages = Subpage::where('page_id', $id)
        ->orderBy('order', 'asc')
        ->get();

        return view('pages-admin.show', [
            'page' => $page,
            'subpages' => $subpages
        ]);
    }  

    public function create()
    {
        return view('pages-admin.create');
    }    

    public function save(PageRequest $request)
    {
        $page = new Page();
        $page->title = $request->input('title');
        $page->description = $request->input('description');
        $page->pageVisibility = $request->input('pageVisibility') == null ? 0 : 1;
        $page->titleVisibility = $request->input('titleVisibility') == null ? 0 : 1;
        $page->descVisibility = $request->input('descVisibility') == null ? 0 : 1;
        $page->order = 0;
        $page->save();

        return redirect()->route('pages-admin.index');
    }
    
    public function edit(Page $page)
    {
        return view('pages-admin.edit', [
            'page' => $page
        ]);
    }

    public function update(PageRequest $request, Page $page)
    {
        $page->title = $request->input('title');
        $page->description = $request->input('description');
        $page->pageVisibility = $request->input('pageVisibility') == null ? 0 : 1;
        $page->titleVisibility = $request->input('titleVisibility') == null ? 0 : 1;
        $page->descVisibility = $request->input('descVisibility') == null ? 0 : 1;
        $page->save();

        return redirect()->route('pages-admin.index');
    }

    public function destroy(Page $page)
    {
        $subpages = Subpage::where('page_id', $page->id)->get();

        foreach($subpages as $key => $subpage)
        {
            $subpage->delete();
        }

        $page->delete();

        return redirect()->route('pages-admin.index');
    }

}
