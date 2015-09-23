# ModularPresenterMapping

[![Build Status](https://img.shields.io/travis/Zenify/ModularPresenterMapping.svg?style=flat-square)](https://travis-ci.org/Zenify/ModularPresenterMapping)
[![Quality Score](https://img.shields.io/scrutinizer/g/Zenify/ModularPresenterMapping.svg?style=flat-square)](https://scrutinizer-ci.com/g/Zenify/ModularPresenterMapping)
[![Code Coverage](https://img.shields.io/scrutinizer/coverage/g/Zenify/ModularPresenterMapping.svg?style=flat-square)](https://scrutinizer-ci.com/g/Zenify/ModularPresenterMapping)
[![Downloads](https://img.shields.io/packagist/dt/zenify/modular-presenter-mapping.svg?style=flat-square)](https://packagist.org/packages/zenify/modular-presenter-mapping)
[![Latest stable](https://img.shields.io/packagist/v/zenify/modular-presenter-mapping.svg?style=flat-square)](https://packagist.org/packages/zenify/modular-presenter-mapping)


## Install

Via Composer

```sh
$ composer require zenify/modular-presenter-mapping
```

Register the extension in `config.neon`:

```yaml
extensions:
	- Zenify\ModularPresenterMapping\DI\ModularPresenterMappingExtension
```


## Usage

To add own presenter mapping, create class that will implement [`Zenify\ModularPresenterMapping\Contract\Application\PresenterMappingProviderInterface`](src/Contract/Application/PresenterMappingProviderInterface.php)

```php
use Zenify\ModularPresenterMapping\Contract\Application\PresenterMappingProviderInterface;


final class MyExtensionPresenterMapping implements PresenterMappingProviderInterface
{

	/**
	 * {@inheritdoc}
	 */
	public function provide()
	{
		return [
			// module => it's namespace, "*" is for presenter name
			'PayPal' => 'My\Package\Presenter\*Presenter'   
		];
	}
	
}
```

Then in redirect: 

```php
$this->redirect('PayPal:Payment');
```

or template:

```smarty
<a n:href="PayPal:Payment">Pay!</a>
```
 
would go to: `My\Package\Presenter\PaymentPresenter`.


## Testing

```sh
$ phpunit
```


## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.
