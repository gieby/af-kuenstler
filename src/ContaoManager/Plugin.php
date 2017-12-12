<?php

namespace yupdesign\AFKuenstler\ContaoManager;
/**
 * Use-Statements für das normale manager-Plugin, als auch für Routing
 */
use Contao\ManagerPlugin\Bundle\Config\BundleConfig;
use Contao\ManagerPlugin\Bundle\BundlePluginInterface;
use Contao\ManagerPlugin\Bundle\Parser\ParserInterface;
use Contao\ManagerPlugin\Routing\RoutingPluginInterface;
use Symfony\Component\Config\Loader\LoaderResolverInterface;
use Symfony\Component\HttpKernel\KernelInterface;

class Plugin implements BundlePluginInterface, RoutingPluginInterface
{
	/**
	 * {@inheritdoc}
	 */
	public function getBundles(ParserInterface $parser)
	{
		return [
				BundleConfig::create('yupdesign\AFKuenstler\yupdesignAFKuenstler')
						->setLoadAfter(['Contao\CoreBundle\ContaoCoreBundle'])
						->setReplace(['af']),
		];
	}
}