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
        // TODO-1: Turn the SupplierLocationTransfer objects of $value (null when there are none) into a list of arrays
        //         with the keys city, country, address, zipCode and isDefault, and return it as JSON (json_encode()).

        return '[]';
    }

    /**
     * JSON of the submitted table rows -> transfers.
     *
     * @return \ArrayObject<int, \Generated\Shared\Transfer\SupplierLocationTransfer>
     */
    public function reverseTransform(mixed $value): ArrayObject
    {
        // TODO-2: $value is the JSON the table wrote (or null). Decode it and append a SupplierLocationTransfer for every
        //         row: city, country, address, zipCode, and isDefault as a boolean
        //         (filter_var($row['isDefault'] ?? false, FILTER_VALIDATE_BOOLEAN)).

        return new ArrayObject();
    }
}
