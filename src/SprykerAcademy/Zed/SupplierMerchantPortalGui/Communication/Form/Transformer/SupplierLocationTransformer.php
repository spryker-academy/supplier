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
        if ($value === null) {
            return [];
        }

        $data = [];
        foreach ($value as $locationTransfer) {
            $data[] = [
                'idSupplierLocation' => $locationTransfer->getIdSupplierLocation(),
                'city' => $locationTransfer->getCity(),
                'country' => $locationTransfer->getCountry(),
                'address' => $locationTransfer->getAddress(),
                'zipCode' => $locationTransfer->getZipCode(),
                'isDefault' => $locationTransfer->getIsDefault(),
            ];
        }

        return $data;
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
        $locationTransfers = new ArrayObject();

        if ($value === null || !is_array($value)) {
            return $locationTransfers;
        }

        foreach ($value as $locationData) {
            $locationTransfer = (new SupplierLocationTransfer())
                ->setCity($locationData['city'] ?? null)
                ->setCountry($locationData['country'] ?? null)
                ->setAddress($locationData['address'] ?? null)
                ->setZipCode($locationData['zipCode'] ?? null)
                ->setIsDefault((bool)($locationData['isDefault'] ?? false));

            if (!empty($locationData['idSupplierLocation'])) {
                $locationTransfer->setIdSupplierLocation((int)$locationData['idSupplierLocation']);
            }

            $locationTransfers->append($locationTransfer);
        }

        return $locationTransfers;
    }
}
