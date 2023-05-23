<?php

namespace App\Providers;

use App\Models\BlogCategory;
use App\Models\BlogPost;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;
use App\Models\Menu;
use App\Models\MenuItem;
use App\Models\MediaIcon;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $topNav = Menu::where('location', 1)->first();
        if (!empty($topNav)) {


            $topNavItems = json_decode($topNav->content);
            $topNavItems = $topNavItems[0];
            foreach ($topNavItems as $menu) {
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

            $post = BlogPost::where('status', 'publish')->orderBy('id', 'DESC')->take(3)->get();
            $category = BlogCategory::all();

            view()->share([
                'topNavItems' => $topNavItems, 'media' => MediaIcon::first(), 'categories' => $category, 'posts' => $post,
            ]);
        }
        //
        Paginator::useBootstrap();
    }
}
