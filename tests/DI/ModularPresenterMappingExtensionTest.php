<?php

namespace Zenify\ModularPresenterMapping\Tests\DI;

use Nette\Application\IPresenterFactory;
use Nette\Application\PresenterFactory;
use Nette\DI\Compiler;
use Nette\DI\Statement;
use PHPUnit_Framework_TestCase;
use Zenify\ModularPresenterMapping\DI\ModularPresenterMappingExtension;
use Zenify\ModularPresenterMapping\Tests\DI\ModularPresenterMappingSource\PresenterMappingProvider;


final class ModularPresenterMappingExtensionTest extends PHPUnit_Framework_TestCase
{

	/**
	 * @var ModularPresenterMappingExtension
	 */
	private $extension;


	protected function setUp()
	{
		$this->extension = new ModularPresenterMappingExtension;
		$this->extension->setCompiler(new Compiler, 'presenterMapping');

		$containerBuilder = $this->extension->getContainerBuilder();
		$containerBuilder->addDefinition('presenterFactory')
				->setClass(PresenterFactory::class);
	}


	public function testBeforeCompile()
	{
		$containerBuilder = $this->extension->getContainerBuilder();
		$containerBuilder->addDefinition('mappingProvider')
			->setClass(PresenterMappingProvider::class);

		$containerBuilder->prepareClassList();
		$this->extension->beforeCompile();

		$presenterFactoryDefinition = $containerBuilder->getDefinition($containerBuilder->getByType(IPresenterFactory::class));
		$setup = $presenterFactoryDefinition->getSetup();
		$this->assertSame('setMapping', $setup[0]->getEntity());
		$this->assertInstanceOf(Statement::class, $setup[0]->arguments[0]);
	}

}
