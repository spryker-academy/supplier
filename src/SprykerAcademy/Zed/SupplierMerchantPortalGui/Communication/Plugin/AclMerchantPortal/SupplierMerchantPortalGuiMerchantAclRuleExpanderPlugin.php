<?php

declare(strict_types=1);

namespace SprykerAcademy\Zed\SupplierMerchantPortalGui\Communication\Plugin\AclMerchantPortal;

use Generated\Shared\Transfer\RuleTransfer;
use Spryker\Zed\AclMerchantPortalExtension\Dependency\Plugin\MerchantAclRuleExpanderPluginInterface;
use Spryker\Zed\Kernel\Communication\AbstractPlugin;

/**
 * @method \SprykerAcademy\Zed\SupplierMerchantPortalGui\Communication\SupplierMerchantPortalGuiCommunicationFactory getFactory()
 */
class SupplierMerchantPortalGuiMerchantAclRuleExpanderPlugin extends AbstractPlugin implements MerchantAclRuleExpanderPluginInterface
{
    /**
     * @uses \Spryker\Shared\Acl\AclConstants::VALIDATOR_WILDCARD
     *
     * @var string
     */
    protected const RULE_VALIDATOR_WILDCARD = '*';

    /**
     * @uses \Spryker\Shared\Acl\AclConstants::ALLOW
     *
     * @var string
     */
    protected const RULE_TYPE_ALLOW = 'allow';

    /**
     * @param list<\Generated\Shared\Transfer\RuleTransfer> $ruleTransfers
     *
     * @return list<\Generated\Shared\Transfer\RuleTransfer>
     */
    public function expand(array $ruleTransfers): array
    {
        $ruleTransfers[] = (new RuleTransfer())
            ->setBundle('supplier-merchant-portal-gui')
            ->setController(static::RULE_VALIDATOR_WILDCARD)
            ->setAction(static::RULE_VALIDATOR_WILDCARD)
            ->setType(static::RULE_TYPE_ALLOW);

        return $ruleTransfers;
    }
}
