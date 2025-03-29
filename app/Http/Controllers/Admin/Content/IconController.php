<?php

namespace App\Http\Controllers\Admin\Content;

use App\Models\Content\Icon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Content\IconRequest;

class IconController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $icons = Icon::orderBy('created_at')->simplePaginate(15);
        return view('admin.content.icon.index', compact('icons'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.content.icon.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(IconRequest $request)
    {
        $inputs = $request->all();
        $icon = Icon::create($inputs);
        return redirect()->route('admin.content.icon.index')->with('swal-success', 'آیکون جدید با موفقیت ثبت شد');
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
    public function edit(Icon $icon)
    {
        return view('admin.content.icon.edit', compact('icon'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(IconRequest $request, Icon $icon)
    {
        $inputs = $request->all();
        $icon->update($inputs);
        return redirect()->route('admin.content.icon.index')->with('swal-success', 'آیکون با موفقیت ویرایش شد');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Icon $icon)
    {
        $result = $icon->delete();
        return redirect()->route('admin.content.icon.index')->with('swal-success', 'آیکون با موفقیت حذف شد');
    }

    /**
     * Change status of the specified resource.
     *
     * @param  Icon  $icon
     * @return \Illuminate\Http\Response
     */
    public function status(Icon $icon)
    {
        $icon->status = $icon->status == 0 ? 1 : 0;
        $result = $icon->save();
        if($result){
            if($icon->status == 0){
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
