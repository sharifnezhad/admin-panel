<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
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
    protected static function view($path, $data = [], $title = 'SharifWeb'){
        $languageDirectoryFiles = scandir(lang_path(Lang::locale()));
        $languageDirectoryFiles = array_diff($languageDirectoryFiles, ['.','..']);
        $data['lang'] = [];
        foreach ($languageDirectoryFiles as $file){
            $file = explode('.', $file);
            $data['lang'] = array_merge($data['lang'], trans($file[0]));
        }
        $data['title'] = $title;

        return view($path, $data);
    }
    protected static function redirectToHome(){
        return to_route('home');
    }
}
