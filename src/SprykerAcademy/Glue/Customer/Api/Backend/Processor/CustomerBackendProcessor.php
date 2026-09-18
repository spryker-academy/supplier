<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace SprykerAcademy\Glue\Customer\Api\Backend\Processor;

use ApiPlatform\Metadata\Delete;
use ApiPlatform\Metadata\Operation;
use ApiPlatform\Metadata\Patch;
use ApiPlatform\Metadata\Post;
use ApiPlatform\State\ProcessorInterface;
use Generated\Api\Backend\CustomersBackendResource;
use Spryker\Zed\Customer\Business\CustomerFacadeInterface;

class CustomerBackendProcessor implements ProcessorInterface
{
    public function __construct(
        private CustomerFacadeInterface $customerFacade,
    ) {
    }

    /**
     * @param mixed $data
     * @param \ApiPlatform\Metadata\Operation $operation
     * @param array<string, mixed> $uriVariables
     * @param array<string, mixed> $context
     *
     * @return mixed
     */
    public function process(mixed $data, Operation $operation, array $uriVariables = [], array $context = []): mixed
    {
        if ($operation instanceof Delete) {
            $this->customerFacade->deleteCustomer($uriVariables['customerReference']);

            return null;
        }

        if ($operation instanceof Post) {
            $customerTransfer = $this->mapToTransfer($data);
            $savedCustomer = $this->customerFacade->createCustomer($customerTransfer);

            return $this->mapToResource($savedCustomer);
        }

        if ($operation instanceof Patch) {
            $customerTransfer = $this->mapToTransfer($data);
            $customerTransfer->setCustomerReference($uriVariables['customerReference']);
            $updatedCustomer = $this->customerFacade->updateCustomer($customerTransfer);

            return $this->mapToResource($updatedCustomer);
        }

        return null;
    }

    private function mapToTransfer(CustomersBackendResource $resource): CustomerTransfer
    {
        $transfer = new CustomerTransfer();
        $transfer->fromArray($resource->toArray(), true);

        return $transfer;
    }

    private function mapToResource(CustomerTransfer $transfer): CustomersBackendResource
    {
        $resource = new CustomersBackendResource();
        $resource->fromArray($transfer->toArray());

        return $resource;
    }
}
