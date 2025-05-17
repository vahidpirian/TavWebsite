<?php

namespace App\Http\Controllers\Admin\Content;

use App\Models\Content\Icon;
use App\Models\Content\Menu;
use App\Models\Content\Page;
use App\Models\Content\Service;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Content\MenuRequest;

class MenuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $menus = Menu::orderBy('sort_order')->simplePaginate(10);
        return view('admin.content.menu.index', compact('menus'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $menus = Menu::where('parent_id', null)->get();
        $pages = Page::where('status', 1)->get();
        $services = Service::where('status', 1)->get();
        $icons = Icon::all();

        return view('admin.content.menu.create', compact('menus','pages','services','icons'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(MenuRequest $request)
    {
        $inputs = $request->all();
        $menu = Menu::create($inputs);
        return redirect()->route('admin.content.menu.index')->with('swal-success', 'منوی  جدید شما با موفقیت ثبت شد');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Menu $menu)
    {
        $parent_menus = Menu::where('parent_id', null)->get()->except($menu->id);
        $pages = Page::where('status', 1)->get();
        $services = Service::where('status', 1)->get();
        $icons = Icon::all();

        return view('admin.content.menu.edit', compact('menu' ,'services','icons','pages','parent_menus','pages'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(MenuRequest $request, Menu $menu)
    {
        $inputs = $request->all();
        $menu->update($inputs);
        return redirect()->route('admin.content.menu.index')->with('swal-success', 'منوی  شما با موفقیت ویرایش شد');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Menu $menu)
    {
        $result = $menu->delete();
        return redirect()->route('admin.content.menu.index')->with('swal-success', ' منو شما با موفقیت حذف شد');
    }

    public function sort(Request $request)
    {
        try {
            $items = $request->input('items', []);

            foreach($items as $item) {
                Menu::where('id', $item['id'])->update(['sort_order' => $item['sort']]);
            }

            return response()->json(['success' => true]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
        }
    }


    public function status(Menu $menu){

        $menu->status = $menu->status == 0 ? 1 : 0;
        $result = $menu->save();
        if($result){
                if($menu->status == 0){
                    return response()->json(['status' => true, 'checked' => false]);
                }
                else{
                    return response()->json(['status' => true, 'checked' => true]);
                }
        }
        else{
            return response()->json(['status' => false]);
        }

    }
}
