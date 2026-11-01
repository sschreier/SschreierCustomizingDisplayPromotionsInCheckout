<?php
declare(strict_types=1);

/*
 * (c) Sebastian Schreier <info@web-solutions-dresden.de>
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Sschreier\CustomizingDisplayPromotionsInCheckout;

use Shopware\Core\Framework\Context;
use Shopware\Core\Framework\DataAbstractionLayer\Search\Criteria;
use Shopware\Core\Framework\DataAbstractionLayer\Search\Filter\EqualsFilter;
use Shopware\Core\Framework\Plugin;
use Shopware\Core\Framework\Plugin\Context\UninstallContext;

class SschreierCustomizingDisplayPromotionsInCheckout extends Plugin
{
    public const CUSTOM_FIELD_SET_TECHNICAL_NAME = 'sschreier_promotion';

    public function uninstall(UninstallContext $uninstallContext): void
    {
        if ($uninstallContext->keepUserData()) {
            parent::uninstall($uninstallContext);

            return;
        }

        $this->removeCustomFieldSet($uninstallContext->getContext());

        parent::uninstall($uninstallContext);
    }

    private function removeCustomFieldSet(Context $context): void
    {
        $customFieldSetRepository = $this->container->get('custom_field_set.repository');

        $criteria = new Criteria();
        $criteria->addFilter(new EqualsFilter('name', self::CUSTOM_FIELD_SET_TECHNICAL_NAME));

        $result = $customFieldSetRepository->searchIds($criteria, $context);
        $primaryKeyData = $result->getPrimaryKeyData();

        if ($primaryKeyData !== []) {
            $customFieldSetRepository->delete($primaryKeyData, $context);
        }
    }
}
