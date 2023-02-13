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
        $newPostId = Post::query()->latest('id')->value('id') + 1;
        $data['menu'] = [
            'dashboard' => route('home')
        ];
        foreach (Config::get('posttypes') as $name => $details) {
            $data['menu'] = array_merge($data['menu'], [
                $details['labels']['menu_name'] => [
                    'sub_menu' => [
                        $details['labels']['title'] => $details['path'],
                        $details['labels']['add_new'] => $details['path'] . '/create?id=' . $newPostId,
                    ]
                ]
            ]);
        }

        $data = array_merge($data, [
            'title' => $title,
            'user' => Auth::user(),
        ]);

        return view($path, $data);
    }

    protected static function redirectToHome()
    {
        return to_route('home');
    }
}
