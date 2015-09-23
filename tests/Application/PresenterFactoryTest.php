<?php

namespace Zenify\ModularPresenterMapping\Tests\Application;

use Nette\Application\InvalidPresenterException;
use Nette\Application\IPresenterFactory;
use Nette\Application\UI\Presenter;
use PHPUnit_Framework_TestCase;
use Zenify\ModularPresenterMapping\Tests\ContainerFactory;
use Zenify\ModularPresenterMapping\Tests\Presenter\AdminModule\Presenter\SomeAdminPresenter;
use Zenify\ModularPresenterMapping\Tests\Presenter\FrontModule\Presenter\SomeFrontPresenter;
use Zenify\ModularPresenterMapping\Tests\Presenter\SomePresenter;


final class PresenterFactoryTest extends PHPUnit_Framework_TestCase
{

	/**
	 * @var IPresenterFactory
	 */
	private $presenterFactory;


	protected function setUp()
	{
		$container = (new ContainerFactory)->create();
		$this->presenterFactory = $container->getByType(IPresenterFactory::class);
	}


	public function testCreatePresenter()
	{
		/** @var Presenter $presenter */
		$presenter = $this->presenterFactory->createPresenter('Some:Some');
		$this->assertSame(SomePresenter::class, $presenter->getReflection()->getName());

		/** @var Presenter $presenter */
		$presenter = $this->presenterFactory->createPresenter('Admin:SomeAdmin');
		$this->assertSame(SomeAdminPresenter::class, $presenter->getReflection()->getName());

		/** @var Presenter $presenter */
		$presenter = $this->presenterFactory->createPresenter('Front:SomeFront');
		$this->assertSame(SomeFrontPresenter::class, $presenter->getReflection()->getName());
	}


	public function testCreatePresenterFailes()
	{
		$this->setExpectedException(InvalidPresenterException::class);
		$this->presenterFactory->createPresenter('Some');
	}

}
