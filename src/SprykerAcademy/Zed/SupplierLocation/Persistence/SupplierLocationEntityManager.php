<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

declare(strict_types = 1);

namespace SprykerAcademy\Zed\SupplierLocation\Persistence;

use Generated\Shared\Transfer\SupplierLocationTransfer;
use Orm\Zed\SupplierLocation\Persistence\PyzSupplierLocation;
use Spryker\Zed\Kernel\Persistence\AbstractEntityManager;

class SupplierLocationEntityManager extends AbstractEntityManager implements SupplierLocationEntityManagerInterface
{
    public function createSupplierLocation(SupplierLocationTransfer $supplierLocationTransfer): SupplierLocationTransfer
    {
        $supplierLocationEntity = (new PyzSupplierLocation())
            ->setFkSupplier($supplierLocationTransfer->getFkSupplierOrFail())
            ->setCity((string)$supplierLocationTransfer->getCity())
            ->setCountry((string)$supplierLocationTransfer->getCountry())
            ->setAddress((string)$supplierLocationTransfer->getAddress())
            ->setZipCode((string)$supplierLocationTransfer->getZipCode())
            ->setIsDefault((bool)$supplierLocationTransfer->getIsDefault());
        $supplierLocationEntity->save();

        return $supplierLocationTransfer->setIdSupplierLocation($supplierLocationEntity->getIdSupplierLocation());
    }
}
