<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit7951d130f836b665948413cc7434b3f3
{
    public static $classMap = array (
        'KS\\Core\\HTTPMethod\\Method' => __DIR__ . '/../..' . '/../ks/ks-src/ks-core/Method.php',
        'KS\\Core\\KSCore' => __DIR__ . '/../..' . '/../ks/ks-src/ks-core/KSCore.php',
        'KS\\Core\\Log\\KSLog' => __DIR__ . '/../..' . '/../ks/ks-src/ks-core/KSLog.php',
        'KS\\DB\\KSDB' => __DIR__ . '/../..' . '/../ks/ks-src/ks-db/KSDB.php',
        'KS\\DB\\QU\\QueryUtils' => __DIR__ . '/../..' . '/../ks/ks-src/ks-db/QueryUtils.php',
        'KS\\HTML\\Form\\KSForm' => __DIR__ . '/../..' . '/../ks/ks-src/ks-html/KSForm.php',
        'KS\\HTML\\HTMLInterface' => __DIR__ . '/../..' . '/../ks/ks-src/ks-html/HTMLInterface.php',
        'KS\\HTML\\KSHTML' => __DIR__ . '/../..' . '/../ks/ks-src/ks-html/KSHTML.php',
        'KS\\Model\\Bird' => __DIR__ . '/../..' . '/../ks/ks-src/Models.php',
        'KS\\Model\\Cat' => __DIR__ . '/../..' . '/../ks/ks-src/Models.php',
        'KS\\Model\\Computer' => __DIR__ . '/../..' . '/../ks/ks-src/Models.php',
        'KS\\Model\\Dog' => __DIR__ . '/../..' . '/../ks/ks-src/Models.php',
        'KS\\Model\\House' => __DIR__ . '/../..' . '/../ks/ks-src/Models.php',
        'KS\\Model\\Job' => __DIR__ . '/../..' . '/../ks/ks-src/Models.php',
        'KS\\Model\\KSModel' => __DIR__ . '/../..' . '/../ks/ks-src/ks-model/KSModel.php',
        'KS\\Model\\Person' => __DIR__ . '/../..' . '/../ks/ks-src/Models.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->classMap = ComposerStaticInit7951d130f836b665948413cc7434b3f3::$classMap;

        }, null, ClassLoader::class);
    }
}