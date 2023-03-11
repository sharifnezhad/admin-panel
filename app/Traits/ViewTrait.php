<?php

namespace App\Traits;

use App\GlobalParams;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Lang;

trait ViewTrait
{

    public static function view($path, $data = [], $title = 'SharifWeb')
    {

        return view($path, $data)
            ->with([
                'title' => $title,
                'user' => Auth::user(),
                'lang' => self::addLanguage(),
                'menu' => self::addMenu(),
                'result' => request()->result ?? null
            ]);
    }

    /**
     * add language
     * @return array
     */
    protected static function addLanguage()
    {
        $languageDirectoryFiles = scandir(lang_path(Lang::locale()));
        $languageDirectoryFiles = array_diff($languageDirectoryFiles, ['.', '..']);
        $lang = [];
        foreach ($languageDirectoryFiles as $file) {
            $file = explode('.', $file);
            $lang = array_merge($lang, trans($file[0]));
        }

        return $lang;
    }

    /**
     * add menu
     * @return array
     */
    protected static function addMenu()
    {
        $getModules = self::getPostTypeMenu();
        $mainMenu = [
            'dashboard' => GlobalParams::dashboardUrl()
        ];
        collect($getModules)->each(function ($module) use (&$mainMenu) {

            $subMenu = collect($module['menu'])->mapWithKeys(function ($menu) use ($module) {
                return [
                    $menu['title'] => "{$module['type']}/{$module['slug']}/{$menu['url']}"
                ];
            })->toArray();

            $mainMenu = array_merge($mainMenu, [
                $module['title'] => [
                    'sub_menu' => $subMenu
                ]
            ]);
        });

        return $mainMenu;
    }

    /**
     * Getting post type menus from config
     *
     * @return \Illuminate\Support\Collection
     */
    private static function getPostTypeMenu()
    {
        return collect(Config::all())->filter(function ($item, $key) {
            return array_key_exists('module', $item) && array_key_exists('menu', $item);
        });
    }
}
