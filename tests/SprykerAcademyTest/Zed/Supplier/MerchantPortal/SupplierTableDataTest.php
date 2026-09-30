<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

declare(strict_types = 1);

namespace SprykerAcademyTest\Zed\Supplier\MerchantPortal;

use Codeception\Test\Unit;
use Generated\Shared\Transfer\SupplierMerchantPortalTableCriteriaTransfer;
use Orm\Zed\Merchant\Persistence\SpyMerchantQuery;
use Orm\Zed\Supplier\Persistence\PyzMerchantToSupplier;
use Orm\Zed\Supplier\Persistence\PyzSupplier;
use SprykerAcademy\Zed\SupplierMerchantPortalGui\Persistence\SupplierMerchantPortalGuiRepository;

/**
 * Exercise 15: the Merchant Portal table lists the suppliers of the logged-in merchant only.
 */
class SupplierTableDataTest extends Unit
{
    protected const string MERCHANT_REFERENCE = 'MER000008';

    public function testTableDataListsOnlyTheSuppliersOfTheMerchant(): void
    {
        $merchantEntity = SpyMerchantQuery::create()->findOneByMerchantReference(static::MERCHANT_REFERENCE);
        if ($merchantEntity === null) {
            $this->markTestSkipped(sprintf('The demo merchant %s does not exist in this shop.', static::MERCHANT_REFERENCE));
        }

        $prefix = 'mp-table-test-' . uniqid();
        $ownSupplier = $this->createSupplier($prefix . '-own');
        $foreignSupplier = $this->createSupplier($prefix . '-foreign');
        (new PyzMerchantToSupplier())
            ->setFkMerchant($merchantEntity->getIdMerchant())
            ->setFkSupplier($ownSupplier->getIdSupplier())
            ->save();

        $criteriaTransfer = (new SupplierMerchantPortalTableCriteriaTransfer())
            ->setMerchantReference(static::MERCHANT_REFERENCE)
            ->setSearchTerm($prefix)
            ->setPage(1)
            ->setPageSize(25);

        $guiTableDataResponseTransfer = (new SupplierMerchantPortalGuiRepository())->getSupplierTableData($criteriaTransfer);

        $names = [];
        foreach ($guiTableDataResponseTransfer->getRows() as $row) {
            $names[] = $row->getResponseData()['name'] ?? null;
        }

        $this->assertSame([$ownSupplier->getName()], $names);
        $this->assertSame(1, $guiTableDataResponseTransfer->getTotal());
        $this->assertNotContains($foreignSupplier->getName(), $names);
    }

    protected function createSupplier(string $name): PyzSupplier
    {
        $supplierEntity = (new PyzSupplier())
            ->setName($name)
            ->setDescription('merchant portal test supplier')
            ->setStatus(1)
            ->setEmail($name . '@example.com')
            ->setPhone('+1-555-0000');
        $supplierEntity->save();

        return $supplierEntity;
    }
}
