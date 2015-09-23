<?php

/**
 * This file is part of Zenify.
 *
 * For the full copyright and license information, please view
 * the file LICENSE that was distributed with this source code.
 */

namespace Zenify\ModularPresenterMapping\DI;

use Nette\Application\IPresenterFactory;
use Nette\DI\CompilerExtension;
use Nette\DI\Statement;
use Zenify\ModularPresenterMapping\Contract\Application\PresenterMappingProviderInterface;


final class ModularPresenterMappingExtension extends CompilerExtension
{

	/**
	 * {@inheritdoc}
	 */
	public function beforeCompile()
	{
		$containerBuilder = $this->getContainerBuilder();
		$presenterFactoryDefinition = $containerBuilder->getDefinition(
			$containerBuilder->getByType(IPresenterFactory::class)
		);

		foreach ($containerBuilder->findByType(PresenterMappingProviderInterface::class) as $providerDefinition) {
			$presenterFactoryDefinition->addSetup('setMapping', [
				new Statement(['@' . $providerDefinition->getClass(), 'provide'])
			]);
		}
	}

}
