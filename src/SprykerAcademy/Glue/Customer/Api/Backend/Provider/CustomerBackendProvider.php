<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace SprykerAcademy\Glue\Customer\Api\Backend\Provider;

use ApiPlatform\Metadata\Operation;
use ApiPlatform\State\Pagination\TraversablePaginator;
use ApiPlatform\State\ProviderInterface;
use ArrayObject;
use Generated\Api\Backend\CustomersBackendResource;
use Generated\Shared\Transfer\CustomerCollectionTransfer;
use Spryker\Zed\Customer\Business\CustomerFacadeInterface;

class CustomerBackendProvider implements ProviderInterface
{
    public function __construct(
        private CustomerFacadeInterface $customerFacade,
    ) {
    }

    /**
     * @param \ApiPlatform\Metadata\Operation $operation
     * @param array<string, mixed> $uriVariables
     * @param array<string, mixed> $context
     *
     * @return object|array<object>|null
     */
    public function provide(Operation $operation, array $uriVariables = [], array $context = []): object|array|null
    {
        // Single resource (GET /customers/{id})
        if (isset($uriVariables['customerReference'])) {
            return $this->getCustomer($uriVariables['customerReference']);
        }

        // Collection (GET /customers)
        return $this->getCustomers($context);
    }

    private function getCustomer(string $customerReference): ?CustomersBackendResource
    {
        $customerTransfer = $this->customerFacade->findCustomerByReference($customerReference);

        return CustomersBackendResource::fromArray($customerTransfer->toArray());
    }

    private function getCustomers(array $context): TraversablePaginator
    {
        $filters = $context['filters'] ?? [];
        $page = (int)($filters['page'] ?? 1);
        $itemsPerPage = (int)($filters['itemsPerPage'] ?? 10);
        $customerCollection = new CustomerCollectionTransfer();

        $customerCollection = $this->customerFacade->getCustomerCollection($customerCollection);

        $resources = [];
        foreach ($customerCollection->getCustomers() as $customerTransfer) {
            $resources[] = CustomersBackendResource::fromArray($customerTransfer->toArray(false, true));
        }

        return new TraversablePaginator(
            new ArrayObject($resources),
            $page,
            $itemsPerPage,
            $customerCollection->getCustomers()->count(),
        );
    }
}
