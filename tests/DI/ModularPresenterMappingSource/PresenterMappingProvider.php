<?php

namespace Zenify\ModularPresenterMapping\Tests\DI\ModularPresenterMappingSource;

use Zenify\ModularPresenterMapping\Contract\Application\PresenterMappingProviderInterface;


final class PresenterMappingProvider implements PresenterMappingProviderInterface
{

	/**
	 * {@inheritdoc}
	 */
	public function provide()
	{
		return [
			'Some' => 'Zenify\ModularPresenterMapping\Tests\Presenter\*Presenter',
			'Admin' => 'Zenify\ModularPresenterMapping\Tests\Presenter\AdminModule\Presenter\*Presenter',
			'Front' => 'Zenify\ModularPresenterMapping\Tests\Presenter\FrontModule\Presenter\*Presenter'
		];
	}

}
