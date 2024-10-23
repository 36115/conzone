<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;

use App\Models\User;

use TeamTeaTime\Forum\Support\Access\CategoryAccess;
use TeamTeaTime\Forum\Models\Thread;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class SidebarServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        View::composer('forum::layouts.sidebar', function ($view) {
            $view->with($this->getSidebarData());
        });

        View::composer('profile.show', function ($view) {
            $view->with($this->getSidebarData());
        });
    }

    /**
     * Get the sidebar data.
     *
     * @return array
     */
    private function getSidebarData()
    {
        $threads = Thread::recent()
            ->with('category', 'author', 'lastPost', 'lastPost.author', 'lastPost.thread')
            ->get();

        $categories = CategoryAccess::getFilteredTreeFor(Auth::user())->toTree();

        $userCount = DB::table('users')->count();

        $newestUser = $user = User::orderBy('id', 'DESC')->first();

        return [
            'threads' => $threads,
            'categories' => $categories,
            'userCount' => $userCount,
            'newestUser' => $newestUser
        ];
    }
}