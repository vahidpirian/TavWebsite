<?php

namespace App\Http\Controllers\Admin\Content;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Content\ServiceMenuRequest;
use App\Models\Content\Icon;
use App\Models\Content\Page;
use App\Models\Content\Service;
use App\Models\Content\ServiceMenu;
use Illuminate\Http\Request;

class ServiceMenuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $menus = ServiceMenu::orderBy('sort_order')->simplePaginate(15);
        return view('admin.content.service-menu.index', compact('menus'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $menus = ServiceMenu::where('parent_id', null)->get();
        $pages = Page::where('status', 1)->get();
        $services = Service::where('status', 1)->get();
        $icons = Icon::all();

        return view('admin.content.service-menu.create', compact('menus','pages','services','icons'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ServiceMenuRequest $request)
    {
        $inputs = $request->all();
        $menu = ServiceMenu::create($inputs);
        return redirect()->route('admin.content.service-menu.index')->with('swal-success', 'منوی  جدید شما با موفقیت ثبت شد');
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
    public function edit(ServiceMenu $menu)
    {
        $parent_menus = ServiceMenu::where('parent_id', null)->get()->except($menu->id);
        $pages = Page::where('status', 1)->get();
        $services = Service::where('status', 1)->get();
        $icons = Icon::all();

        return view('admin.content.service-menu.edit', compact('menu' ,'services','icons','pages','parent_menus','pages'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ServiceMenuRequest $request, ServiceMenu $menu)
    {
        $inputs = $request->all();
        $menu->update($inputs);
        return redirect()->route('admin.content.service-menu.index')->with('swal-success', 'منوی  شما با موفقیت ویرایش شد');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(ServiceMenu $menu)
    {
        $result = $menu->delete();
        return redirect()->route('admin.content.service-menu.index')->with('swal-success', ' منو شما با موفقیت حذف شد');
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


    public function status(ServiceMenu $menu){

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
