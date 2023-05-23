<?php

namespace App\Http\Controllers;

use App\Models\BlogCategory;
use App\Models\BlogPost;
use Illuminate\Http\Request;
use App\Models\Menu;
use App\Models\MenuItem;
use App\Models\Page;
use Illuminate\Support\Facades\Session;

class MenuController extends Controller
{
    //

    public function index()
    {
        $menuitems = '';
        $desiredMenu = '';
        if (isset($_GET['id']) && $_GET['id'] != 'new') {
            $id = $_GET['id'];
            $desiredMenu = Menu::where('id', $id)->first();

            if ($desiredMenu->content != '') {
                $menuitems = json_decode($desiredMenu->content);
                $menuitems = $menuitems[0];

                foreach ($menuitems as $menu) {
                    $menu->title = MenuItem::where('id', $menu->id)->value('title');
                    $menu->name = MenuItem::where('id', $menu->id)->value('name');
                    $menu->slug = MenuItem::where('id', $menu->id)->value('slug');
                    $menu->target = MenuItem::where('id', $menu->id)->value('target');
                    $menu->type = MenuItem::where('id', $menu->id)->value('type');
                    if (!empty($menu->children[0])) {
                        foreach ($menu->children[0] as $child) {
                            $child->title = MenuItem::where('id', $child->id)->value('title');
                            $child->name = MenuItem::where('id', $child->id)->value('name');
                            $child->slug = MenuItem::where('id', $child->id)->value('slug');
                            $child->target = MenuItem::where('id', $child->id)->value('target');
                            $child->type = MenuItem::where('id', $child->id)->value('type');
                            if (!empty($child->children[0])) {
                                foreach ($child->children[0] as $child) {
                                    $child->title = MenuItem::where('id', $child->id)->value('title');
                                    $child->name = MenuItem::where('id', $child->id)->value('name');
                                    $child->slug = MenuItem::where('id', $child->id)->value('slug');
                                    $child->target = MenuItem::where('id', $child->id)->value('target');
                                    $child->type = MenuItem::where('id', $child->id)->value('type');
                                }
                            }
                        }
                    }
                }
            } else {
                $menuitems = MenuItem::where('menu_id', $desiredMenu->id)->get();
            }
        }

        // else if (isset($_GET['id']) && $_GET['id'] == 'new') {
        // }

        else {
            $desiredMenu = Menu::orderby('id', 'DESC')->first();
            if ($desiredMenu) {
                if ($desiredMenu->content != '') {
                    $menuitems = json_decode($desiredMenu->content);
                    $menuitems = $menuitems[0];
                    foreach ($menuitems as $menu) {
                        $menu->title = MenuItem::where('id', $menu->id)->value('title');
                        $menu->name = MenuItem::where('id', $menu->id)->value('name');
                        $menu->slug = MenuItem::where('id', $menu->id)->value('slug');
                        $menu->target = MenuItem::where('id', $menu->id)->value('target');
                        $menu->type = MenuItem::where('id', $menu->id)->value('type');
                        if (!empty($menu->children[0])) {
                            foreach ($menu->children[0] as $child) {
                                $child->title = MenuItem::where('id', $child->id)->value('title');
                                $child->name = MenuItem::where('id', $child->id)->value('name');
                                $child->slug = MenuItem::where('id', $child->id)->value('slug');
                                $child->target = MenuItem::where('id', $child->id)->value('target');
                                $child->type = MenuItem::where('id', $child->id)->value('type');
                                if (!empty($child->children[0])) {
                                    foreach ($child->children[0] as $child) {
                                        $child->title = MenuItem::where('id', $child->id)->value('title');
                                        $child->name = MenuItem::where('id', $child->id)->value('name');
                                        $child->slug = MenuItem::where('id', $child->id)->value('slug');
                                        $child->target = MenuItem::where('id', $child->id)->value('target');
                                        $child->type = MenuItem::where('id', $child->id)->value('type');
                                    }
                                }
                            }
                        }
                    }
                } else {
                    $menuitems = MenuItem::where('menu_id', $desiredMenu->id)->get();
                }
            }
        }
        return view('admin.header-manage.manage-manu', ['categories' => BlogCategory::all(), 'posts' => BlogPost::all() , 'pages' => Page::all(), 'menus' => Menu::all(), 'desiredMenu' => $desiredMenu, 'menuitems' => $menuitems]);
    }

    public function store(Request $request)
    {
        $data = $request->all();

        $menu = new Menu();
        $menu->title = $request->title;
        $menu->location = '1';
        $menu->content = '[[{"id":"1"}]]';
        if ($menu->save()) {
            $heck = MenuItem::where('title', 'HOME')->first();
            if (empty($check)) {
                $menuItem = new MenuItem();
                $menuItem->id = '1';
                $menuItem->title = 'HOME';
                $menuItem->name = 'Home';
                $menuItem->type = '1';
                $menuItem->menu_id = '1';
                $menuItem->save();
            }
            $newdata = Menu::orderby('id', 'DESC')->first();
            session::flash('success', 'Menu saved successfully !');
            return redirect("/admin/manage-menus?id=$newdata->id");
        } else {
            return redirect()->back()->with('error', 'Failed to save menu !');
        }
    }

    public function addCatToMenu(Request $request)
    {
        $data = $request->all();
        $menuid = $request->menuid;
        $ids = $request->ids;
        $menu = Menu::findOrFail($menuid);
        if ($menu->content == '') {
            foreach ($ids as $id) {
                $data['title'] = BlogCategory::where('id', $id)->value('title');
                $data['slug'] = BlogCategory::where('id', $id)->value('slug');
                $data['type'] = 'category';
                $data['menu_id'] = $menuid;
                $data['updated_at'] = NULL;
                MenuItem::create($data);
            }
        } else {
            $olddata = json_decode($menu->content, true);
            foreach ($ids as $id) {
                $data['title'] = BlogCategory::where('id', $id)->value('title');
                $data['slug'] = BlogCategory::where('id', $id)->value('slug');
                $data['type'] = 'category';
                $data['menu_id'] = $menuid;
                $data['updated_at'] = NULL;
                MenuItem::create($data);
            }
            foreach ($ids as $id) {
                $array['title'] = BlogCategory::where('id', $id)->value('title');
                $array['slug'] = BlogCategory::where('id', $id)->value('slug');
                $array['name'] = NULL;
                $array['type'] = 'category';
                $array['target'] = NULL;
                $array['id'] = MenuItem::where('slug', $array['slug'])->where('name', $array['name'])->where('type', $array['type'])->value('id');
                $array['children'] = [[]];
                array_push($olddata[0], $array);
                $oldata = json_encode($olddata);
                $menu->update(['content' => $olddata]);
            }
        }
    }

    public function addPostToMenu(Request $request)
    {
        $data = $request->all();
        $menuid = $request->menuid;
        $ids = $request->ids;
        $menu = Menu::findOrFail($menuid);
        if ($menu->content == '') {
            foreach ($ids as $id) {
                $data['title'] = BlogPost::where('id', $id)->value('title');
                $data['slug'] = '/post/'.BlogPost::where('id', $id)->value('slug');
                $data['type'] = 'post';
                $data['menu_id'] = $menuid;
                $data['updated_at'] = NULL;
                MenuItem::create($data);
            }
        } else {
            $olddata = json_decode($menu->content, true);
            foreach ($ids as $id) {
                $data['title'] = BlogPost::where('id', $id)->value('title');
                $data['slug'] = '/post/'.BlogPost::where('id', $id)->value('slug');
                $data['type'] = 'post';
                $data['menu_id'] = $menuid;
                $data['updated_at'] = NULL;
                MenuItem::create($data);
            }
            foreach ($ids as $id) {
                $array['title'] = BlogPost::where('id', $id)->value('title');
                $array['slug'] = '/post/'.BlogPost::where('id', $id)->value('slug');
                $array['name'] = NULL;
                $array['type'] = 'post';
                $array['target'] = NULL;
                $array['id'] = MenuItem::where('slug', $array['slug'])->where('name', $array['name'])->where('type', $array['type'])->orderby('id', 'DESC')->value('id');
                $array['children'] = [[]];
                array_push($olddata[0], $array);
                $oldata = json_encode($olddata);
                $menu->update(['content' => $olddata]);
            }
        }
    }
    public function addPageToMenu(Request $request)
    {
        $data = $request->all();
        $menuid = $request->menuid;
        $ids = $request->ids;
        $menu = Menu::findOrFail($menuid);
        if ($menu->content == '') {
            foreach ($ids as $id) {
                $data['title'] = Page::where('id', $id)->value('title');
                $data['slug'] = '/page/'.Page::where('id', $id)->value('slug');
                $data['type'] = 'post';
                $data['menu_id'] = $menuid;
                $data['updated_at'] = NULL;
                MenuItem::create($data);
            }
        } else {
            $olddata = json_decode($menu->content, true);
            foreach ($ids as $id) {
                $data['title'] = Page::where('id', $id)->value('title');
                $data['slug'] = '/page/'.Page::where('id', $id)->value('slug');
                $data['type'] = 'post';
                $data['menu_id'] = $menuid;
                $data['updated_at'] = NULL;
                MenuItem::create($data);
            }
            foreach ($ids as $id) {
                $array['title'] = Page::where('id', $id)->value('title');
                $array['slug'] = '/page/'.Page::where('id', $id)->value('slug');
                $array['name'] = NULL;
                $array['type'] = 'post';
                $array['target'] = NULL;
                $array['id'] = MenuItem::where('slug', $array['slug'])->where('name', $array['name'])->where('type', $array['type'])->orderby('id', 'DESC')->value('id');
                $array['children'] = [[]];
                array_push($olddata[0], $array);
                $oldata = json_encode($olddata);
                $menu->update(['content' => $olddata]);
            }
        }
    }

    public function addCustomLink(Request $request)
    {
        $data = $request->all();
        $menuid = $request->menuid;
        $menu = Menu::findOrFail($menuid);
        if ($menu->content == '') {
            $data['title'] = $request->link;
            $data['slug'] = $request->url;
            $data['type'] = 'custom';
            $data['menu_id'] = $menuid;
            $data['updated_at'] = NULL;
            MenuItem::create($data);
        } else {
            $olddata = json_decode($menu->content, true);
            $data['title'] = $request->link;
            $data['slug'] = $request->url;
            $data['type'] = 'custom';
            $data['menu_id'] = $menuid;
            $data['updated_at'] = NULL;
            MenuItem::create($data);
            $array = [];
            $array['title'] = $request->link;
            $array['slug'] = $request->url;
            $array['name'] = NULL;
            $array['type'] = 'custom';
            $array['target'] = NULL;
            $array['id'] = MenuItem::where('slug', $array['slug'])->where('name', $array['name'])->where('type', $array['type'])->orderby('id', 'DESC')->value('id');
            $array['children'] = [[]];
            array_push($olddata[0], $array);
            $oldata = json_encode($olddata);
            $menu->update(['content' => $olddata]);
        }
    }

    public function updateMenu(Request $request)
    {
        $newdata = $request->all();
        $menu = Menu::findOrFail($request->menuid);
        $content = $request->data;
        $newdata = [];
        $newdata['location'] = $request->location;
        $newdata['content'] = json_encode($content);
        $menu->update($newdata);
    }

    public function updateMenuItem(Request $request)
    {
        $data = $request->all();
        $item = MenuItem::findOrFail($request->id);
        $item->update($data);
        return redirect()->back();
    }

    public function deleteMenuItem($id, $key, $in = '')
    {
        $menuitem = MenuItem::findOrFail($id);
        $menu = Menu::where('id', $menuitem->menu_id)->first();
        if ($menu->content != '') {
            $data = json_decode($menu->content, true);
            $maindata = $data[0];
            if ($in == '') {
                unset($data[0][$key]);
                $newdata = json_encode($data);
                $menu->update(['content' => $newdata]);
            } else {
                unset($data[0][$key]['children'][0][$in]);
                $newdata = json_encode($data);
                $menu->update(['content' => $newdata]);
            }
        }
        $menuitem->delete();
        return redirect()->back();
    }

    public function destroy(Request $request)
    {

        MenuItem::where('menu_id', '1')->delete();
        MenuItem::where('menu_id', $request->id)->delete();
        Menu::findOrFail($request->id)->delete();
        return redirect('/admin/manage-menus')->with('success', 'Menu deleted successfully');
    }
}
