<?php

require_once __DIR__.'/../src/autoload.php';

use Symfony\Component\HttpKernel\Kernel;
use Symfony\Component\DependencyInjection\Loader\LoaderInterface;

class AppKernel extends Kernel
{
	const CONFIG_FORMAT = 'yml';

    public function registerRootDir()
    {
        return __DIR__;
    }

    public function registerBundles()
    {
        $bundles = array(
            new Symfony\Bundle\FrameworkBundle\FrameworkBundle(),
            new Symfony\Bundle\TwigBundle\TwigBundle(),

            // enable third-party bundles
            new Symfony\Bundle\ZendBundle\ZendBundle(),
            new Symfony\Bundle\SwiftmailerBundle\SwiftmailerBundle(),
            new Symfony\Bundle\DoctrineBundle\DoctrineBundle(),
            //new Symfony\Bundle\DoctrineMigrationsBundle\DoctrineMigrationsBundle(),
            //new Symfony\Bundle\DoctrineMongoDBBundle\DoctrineMongoDBBundle(),

            // register your common bundles
            new Bundle\DoctrineUserBundle\DoctrineUserBundle(),

            // register your app bundles
            new Application\HelloBundle\HelloBundle(),
            new Application\SiteBundle\SiteBundle(),
            new Application\UserBundle\UserBundle(),
        );

        if ($this->isDebug()) {
            $bundles[] = new Symfony\Bundle\WebProfilerBundle\WebProfilerBundle();
        }

        return $bundles;
    }

    public function registerBundleDirs()
    {
        return array(
            'Application'     => __DIR__.'/../src/Application',
            'Bundle'          => __DIR__.'/../src/Bundle',
            'Symfony\\Bundle' => __DIR__.'/../src/vendor/symfony/src/Symfony/Bundle',
        );
    }

    public function registerContainerConfiguration(LoaderInterface $loader)
    {
    	$template = __DIR__.'/config/config_'.$this->getEnvironment().'%s.'.self::CONFIG_FORMAT;
        $loader->load($this->getLocalConfigurationFile($template));
    }

    /**
     * Returns the config_{environment}_local.yml file or 
     * the default config_{environment}.yml if it does not exist.
     * Useful to override development password.
     *
     * @param string The configuration file template
     * @return string The configuration file path
     */
    protected function getLocalConfigurationFile($template)
    {
        if(!file_exists($file = sprintf($template, '_local'))) {
            $file = sprintf($template, '');
        }

        return $file;
    }
}
