<?php /** @noinspection PhpSignatureMismatchDuringInheritanceInspection */

/** @noinspection PhpHierarchyChecksInspection */

namespace App\Legacy;

use Symfony\Component\Config\Loader\Loader;
use Symfony\Component\Finder\Finder;
use Symfony\Component\Routing\Route;
use Symfony\Component\Routing\RouteCollection;

class LegacyRouteLoader extends Loader
{
    protected $dolibarr_htdocs;
    protected $old_url;

    public function __construct()
    {
        $this->dolibarr_htdocs = $_ENV['DOLIBARR_HTDOCS'];
        $this->old_url = in_array(
            strtolower($_ENV['DOLIBARR_STYLE_URL']),
            ['1', 'true', 'yes',]
        );
    }

    public function load($resource, $type = null)
    {
        $collection = new RouteCollection();
        $finder = new Finder();
        $finder->files()
            ->notname('*.tpl.php')
            ->notname('*.class.php')
            ->notname('*.lib.php')
            ->notname('*.inc.php')
            ->notname('*.js.php')->notname('*.css.php')
            ->name('*.php');
        $finder->in($this->dolibarr_htdocs);

        /** @var \SplFileInfo $legacyScriptFile */
        foreach ($finder as $legacyScriptFile) {
            /*
             * change
             *  accountancy\admin\account.php
             * to
             * accountancy/admin/account.php
             */
            $relativepath = str_replace('\\', '/', $legacyScriptFile->getRelativePathname());

            // account
            $filenameNoExt = basename($relativepath, '.php');
            // accountancy/admin
            $dirname = dirname($relativepath);

            $routeName = str_replace('/', '__', "{$dirname}__$filenameNoExt");
            // '.__index.php' origins from './index.php'
            $routeName = preg_replace('/^\.__/', '', $routeName);
            $routeName = sprintf('app.legacy.%s', $routeName);

            $collection->add($routeName, new Route(
                $this->old_url ? $relativepath : "$dirname/$filenameNoExt",
                [
                    '_controller' => 'App\Controller\LegacyController::loadLegacyScript',
                    'requestPath' => '/' . $relativepath,
                    'legacyScript' => $legacyScriptFile->getRealPath(),
                ]));
        }

        return $collection;
    }

    /**
     * Returns whether this class supports the given resource.
     *
     * @param mixed $resource A resource
     *
     * @return bool True if this class supports the given resource, false otherwise
     */
    public function supports($resource, string $type = null)
    {
        return 'legacy-doli' === $type;
    }
}
