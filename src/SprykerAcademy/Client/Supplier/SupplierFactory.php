<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

declare(strict_types=1);

namespace SprykerAcademy\Client\Supplier;

use Spryker\Client\Kernel\AbstractFactory;
use Spryker\Client\ZedRequest\ZedRequestClientInterface;
use SprykerAcademy\Client\Supplier\Zed\SupplierStub;
use SprykerAcademy\Client\Supplier\Zed\SupplierStubInterface;
use SprykerAcademy\Client\SupplierSearch\SupplierSearchClientInterface;

class SupplierFactory extends AbstractFactory
{
    /**
     * @return \SprykerAcademy\Client\Supplier\Zed\SupplierStubInterface
     */
    public function createSupplierStub(): SupplierStubInterface
    {
        // TODO-1: Create and return a new SupplierStub instance.
        // Hint-1: Pass $this->getZedRequestClient() to the constructor
        // Hint-2: return new SupplierStub($this->getZedRequestClient());

        return new SupplierStub($this->getZedRequestClient());
    }

    /**
     * @return \Spryker\Client\ZedRequest\ZedRequestClientInterface
     */
    public function getZedRequestClient(): ZedRequestClientInterface
    {
        // TODO-2: Get the ZedRequest client from the provided dependencies.
        // Hint-1: Use $this->getProvidedDependency() with SupplierDependencyProvider::CLIENT_ZED_REQUEST

        return $this->getProvidedDependency(SupplierDependencyProvider::CLIENT_ZED_REQUEST);
    }

    /**
     * @return \SprykerAcademy\Client\SupplierSearch\SupplierSearchClientInterface
     */
    public function getSupplierSearchClient(): SupplierSearchClientInterface
    {
        // TODO-3: Get the SupplierSearch client from the provided dependencies.
        // Hint-1: Use $this->getProvidedDependency() with SupplierDependencyProvider::CLIENT_SUPPLIER_SEARCH

        return $this->getProvidedDependency(SupplierDependencyProvider::CLIENT_SUPPLIER_SEARCH);
    }
}
