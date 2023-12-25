<?php


namespace App\Http\Services\Menu;
use App\Models\Menu;
use Illuminate\Support\Facades\Session;
use Str;

class MenuService
{
    //get the parent_id
    public function getParent(){
        return Menu::where('parent_id',0)->get();
    }

    //getAll to show list
    public function getAll(){
        return Menu::orderbyDesc('id')->paginate(20);
    }

    //add
    public function create($request){
        try {
            Menu::create([
                'name' => (string)$request->input('name'),
                'parent_id' => (int)$request->input('parent_id'),
                'description' => (string)$request->input('description'),
                'content' => (string)$request->input('content'),
                'active' => (string)$request->input('active'),
                'slug' => Str::slug($request->input('name'),'-')
            ]);

            Session::flash('success', 'Tạo Danh Mục Thành Công');
        } catch (\Exception $err) {
            Session::flash('error', $err->getMessage());
            return false;
        }

        return true;
    }

    //update
    public function update($request, $menu){
        if ($request->input('parent_id') != $menu->id) {
            $menu->parent_id = (int)$request->input('parent_id');
        }

        $menu->name = (string)$request->input('name');
        $menu->description = (string)$request->input('description');
        $menu->content = (string)$request->input('content');
        $menu->active = (string)$request->input('active');
        $menu->save();

        Session::flash('success', 'Cập nhật thành công Danh mục');
        return true;
    }

    //delete
    public function destroy($request){
        $id = $request->input('id');
        $menu = Menu::where('id', $id)->first();
        if($menu){
            return Menu::where('id', $id)->orWhere('parent_id', $id)->delete();
        }

        return false;
    }
}