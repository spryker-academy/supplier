<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

declare(strict_types = 1);

namespace Pyz\Yves\CustomerPage;

use Pyz\Yves\CustomerPage\Form\Transformer\MessageTransformer;
use SprykerAcademy\Client\HelloWorld\HelloWorldClientInterface;
use SprykerShop\Yves\CustomerPage\CustomerPageFactory as SprykerCustomerPageFactory;

/**
 * Note: In the project, this class already exists and extends SprykerCustomerPageFactory.
 * Merge the changes below into the existing class.
 */
class CustomerPageFactory extends SprykerCustomerPageFactory
{
    public function getHelloWorldClient(): HelloWorldClientInterface
    {
        // TODO-1: Get the provided dependency for the HelloWorldClient
        // Hint-1: Have a look at src/SprykerAcademy/Client/HelloWorld/HelloWorldFactory.php::getZedRequestClient() for the right syntax
        // Hint-2: The name of the constant to use is 'CustomerPageDependencyProvider::CLIENT_HELLO_WORLD'
    }

    // TODO-2: Instantiate and return the MessageTransformer to make it available inside the module
    // Hint: Naming convention for methods creating instances of a class: createNameOfTheClass()

    // TODO-3: Override createCustomerFormFactory() from SprykerCustomerPageFactory
    // and make it return our newly created FormFactory instead of the FormFactory of the core
}
