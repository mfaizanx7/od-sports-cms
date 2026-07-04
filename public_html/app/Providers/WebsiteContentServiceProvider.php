<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Botble\Base\Supports\DashboardMenu;
use Botble\Base\Traits\LoadAndPublishDataTrait;

class WebsiteContentServiceProvider extends ServiceProvider
{
    use LoadAndPublishDataTrait;

    public function boot()
    {
        if (is_plugin_active('core/base')) {
            $this->registerMenu();
        }
    }

    protected function registerMenu()
    {
        dashboard_menu()->registerItem([
            'id' => 'cms-website-content',
            'priority' => 5,
            'parent_id' => null,
            'name' => 'Website Content',
            'icon' => 'fas fa-edit',
            'url' => route('admin.website-content.index'),
            'permissions' => [],
            'active' => false,
        ]);
    }
}
