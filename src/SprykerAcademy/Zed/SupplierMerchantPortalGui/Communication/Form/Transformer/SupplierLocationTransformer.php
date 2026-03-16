<?php

declare(strict_types=1);

namespace SprykerAcademy\Zed\SupplierMerchantPortalGui\Communication\Form\Transformer;

use ArrayObject;
use Generated\Shared\Transfer\SupplierLocationTransfer;
use Symfony\Component\Form\DataTransformerInterface;

class SupplierLocationTransformer implements DataTransformerInterface
{
    /**
     * Transforms SupplierLocationTransfer[] to array for the editable table.
     *
     * @param \ArrayObject<int, \Generated\Shared\Transfer\SupplierLocationTransfer>|null $value
     *
     * @return array<int, array<string, mixed>>
     */
    public function transform(mixed $value): array
    {
        // TODO: Convert SupplierLocationTransfer[] to array of arrays
        // Each array should have: idSupplierLocation, city, country, address, zipCode, isDefault

        return [];
    }

    /**
     * Transforms submitted table data back to SupplierLocationTransfer[].
     *
     * @param array<int, array<string, mixed>>|null $value
     *
     * @return \ArrayObject<int, \Generated\Shared\Transfer\SupplierLocationTransfer>
     */
    public function reverseTransform(mixed $value): ArrayObject
    {
        // TODO: Convert submitted array data to SupplierLocationTransfer[]
        // Create a SupplierLocationTransfer for each row with: city, country, address, zipCode, isDefault

        return new ArrayObject();
    }
}
