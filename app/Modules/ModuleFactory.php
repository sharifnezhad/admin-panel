<?php

namespace Modules;

use App\Exceptions\ModuleNotFindException;

class ModuleFactory
{
    public static function getModule($moduleName, $config)
    {
        $moduleName = ucfirst($moduleName);
        $class = '';
        if (!class_exists($class)) {
            throw new ModuleNotFindException('Module not find');
        }

        return app($class, ['config' => $config]);
    }
}
