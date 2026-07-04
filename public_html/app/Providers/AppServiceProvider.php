<?php
namespace App\Providers;
use Botble\Base\Helpers\BaseHelper;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Event;
class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }
    public function boot(): void
    {
        add_action('render_dashboard_menu', function() {
            if (function_exists('dashboard_menu')) {
                dashboard_menu()->removeItem('cms-core-page');
                dashboard_menu()->removeItem('cms-plugins-contact');
                dashboard_menu()->removeItem('cms-core-appearance');
                dashboard_menu()->removeItem('cms-plugins-plugin-management');
                dashboard_menu()->removeItem('cms-core-platform-administration');
                dashboard_menu()->removeItem('cms-core-tools');
                dashboard_menu()->removeItem('cms-core-settings');
                dashboard_menu()->removeItem('cms-core-settings-general');
                dashboard_menu()->removeItem('cms-core-settings-email');
                dashboard_menu()->removeItem('cms-core-settings-media');
                dashboard_menu()->removeItem('cms-packages-theme');
                dashboard_menu()->removeItem('cms-core-role-permission');
                dashboard_menu()->removeItem('cms-plugin-audit-log');
                dashboard_menu()->removeItem('cms-plugins-ecommerce');
                dashboard_menu()->removeItem('cms-core-media');
                dashboard_menu()->removeItem('cms-core-plugins');
                dashboard_menu()->removeItem('cms-core-dashboard');

                if (!dashboard_menu()->hasItem('cms-website-content')) {
                    dashboard_menu()->registerItem([
                        'id'          => 'cms-website-content',
                        'priority'    => 5,
                        'parent_id'   => null,
                        'name'        => 'Website Content',
                        'icon'        => 'fas fa-edit',
                        'url'         => url(config('core.base.general.admin_dir', 'admin') . '/website-content'),
                        'permissions' => [],
                        'active'      => false,
                    ]);
                }
            }
        }, 999);
    }
}