<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Lang;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    protected static $dashboardUrl;

    public function __construct()
    {
        self::$dashboardUrl = route('manager');
    }

    /**
     * @param string $path
     * @param array $data
     * @param string $title
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    protected static function view($path, $data = [], $title = 'SharifWeb')
    {
        //Add lang
        $languageDirectoryFiles = scandir(lang_path(Lang::locale()));
        $languageDirectoryFiles = array_diff($languageDirectoryFiles, ['.', '..']);
        $data['lang'] = [];
        foreach ($languageDirectoryFiles as $file) {
            $file = explode('.', $file);
            $data['lang'] = array_merge($data['lang'], trans($file[0]));
        }
        // Add menu
        $data['menu'] = [
            'dashboard' => self::$dashboardUrl
        ];
        foreach (Config::get('posttypes') as $name => $details) {
            $data['menu'] = array_merge($data['menu'], [
                $details['labels']['menu_name'] => [
                    'sub_menu' => [
                        $details['labels']['title'] => $details['slug'],
                        $details['labels']['add_new'] => $details['slug'] . '/create'
                    ]
                ]
            ]);
        }

        return view($path, $data)
            ->with([
                'title' => $title,
                'user' => Auth::user(),
                'settings' => config('settings'),
                'lang' => $data['lang'],
                'menu' => $data['menu'],
            ]);
    }

    protected static function redirectToHome()
    {
        return to_route('manager');
    }
}
