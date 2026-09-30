<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

declare(strict_types = 1);

namespace SprykerAcademy\Zed\SupplierMerchantPortalGui\Communication\Form\Transformer;

use ArrayObject;
use Generated\Shared\Transfer\SupplierLocationTransfer;
use Symfony\Component\Form\DataTransformerInterface;

/**
 * The editable locations table writes the rows the merchant adds into the hidden form field
 * supplierForm[locations], as a JSON array of objects keyed by the column ids
 * (city, country, address, zipCode, isDefault).
 *
 * @implements \Symfony\Component\Form\DataTransformerInterface<\ArrayObject<int, \Generated\Shared\Transfer\SupplierLocationTransfer>, string>
 */
class SupplierLocationTransformer implements DataTransformerInterface
{
    /**
     * Transfers -> JSON for the hidden field.
     *
     * @param \ArrayObject<int, \Generated\Shared\Transfer\SupplierLocationTransfer>|null $value
     */
    public function transform(mixed $value): string
    {
        $rows = [];

        foreach ($value ?? [] as $supplierLocationTransfer) {
            $rows[] = [
                'city' => $supplierLocationTransfer->getCity(),
                'country' => $supplierLocationTransfer->getCountry(),
                'address' => $supplierLocationTransfer->getAddress(),
                'zipCode' => $supplierLocationTransfer->getZipCode(),
                'isDefault' => (bool)$supplierLocationTransfer->getIsDefault(),
            ];
        }

        return (string)json_encode($rows);
    }

    /**
     * JSON of the submitted table rows -> transfers.
     *
     * @return \ArrayObject<int, \Generated\Shared\Transfer\SupplierLocationTransfer>
     */
    public function reverseTransform(mixed $value): ArrayObject
    {
        $supplierLocationTransfers = new ArrayObject();
        $rows = is_string($value) && $value !== '' ? json_decode($value, true) : [];

        foreach (is_array($rows) ? $rows : [] as $row) {
            if (!is_array($row)) {
                continue;
            }

            $supplierLocationTransfers->append(
                (new SupplierLocationTransfer())
                    ->setCity($row['city'] ?? null)
                    ->setCountry($row['country'] ?? null)
                    ->setAddress($row['address'] ?? null)
                    ->setZipCode($row['zipCode'] ?? null)
                    ->setIsDefault(filter_var($row['isDefault'] ?? false, FILTER_VALIDATE_BOOLEAN)),
            );
        }

        return $supplierLocationTransfers;
    }
}
