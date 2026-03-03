<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

declare(strict_types = 1);

namespace Pyz\Yves\CustomerPage;

use Pyz\Yves\CustomerPage\Form\FormFactory;
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
        return $this->getProvidedDependency(CustomerPageDependencyProvider::CLIENT_HELLO_WORLD);
    }

    public function createMessageTransformer(): MessageTransformer
    {
        return new MessageTransformer(
            $this->getHelloWorldClient(),
        );
    }

    public function createCustomerFormFactory(): FormFactory
    {
        return new FormFactory();
    }
}
