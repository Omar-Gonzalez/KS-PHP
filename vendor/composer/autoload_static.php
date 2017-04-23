<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit7951d130f836b665948413cc7434b3f3
{
    public static $classMap = array (
        'KS\\Core\\HTTPMethod\\Method' => __DIR__ . '/../..' . '/../ks/src/core/Method.php',
        'KS\\Core\\KSCore' => __DIR__ . '/../..' . '/../ks/src/core/KSCore.php',
        'KS\\Core\\Log\\KSLog' => __DIR__ . '/../..' . '/../ks/src/core/KSLog.php',
        'KS\\DB\\KSDB' => __DIR__ . '/../..' . '/../ks/src/db/KSDB.php',
        'KS\\DB\\QU\\QueryUtils' => __DIR__ . '/../..' . '/../ks/src/db/QueryUtils.php',
        'KS\\HTML\\Form\\KSForm' => __DIR__ . '/../..' . '/../ks/src/html/KSForm.php',
        'KS\\HTML\\HTMLInterface' => __DIR__ . '/../..' . '/../ks/src/html/HTMLInterface.php',
        'KS\\HTML\\KSHTML' => __DIR__ . '/../..' . '/../ks/src/html/KSHTML.php',
        'KS\\Model\\KSModel' => __DIR__ . '/../..' . '/../ks/src/model/KSModel.php',
        'KS\\Models\\Book' => __DIR__ . '/../..' . '/../ks/models/Models.php',
        'KS\\Models\\Keyboard' => __DIR__ . '/../..' . '/../ks/models/Models.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->classMap = ComposerStaticInit7951d130f836b665948413cc7434b3f3::$classMap;

        }, null, ClassLoader::class);
    }
}
