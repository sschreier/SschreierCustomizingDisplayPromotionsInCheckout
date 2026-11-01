<?php
declare(strict_types=1);

/*
 * (c) Sebastian Schreier <info@web-solutions-dresden.de>
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Sschreier\CustomizingDisplayPromotionsInCheckout\Core\Twig;

use Shopware\Core\Checkout\Promotion\PromotionEntity;
use Shopware\Core\Framework\DataAbstractionLayer\EntityRepository;
use Shopware\Core\Framework\DataAbstractionLayer\Search\Criteria;
use Shopware\Core\System\SalesChannel\SalesChannelContext;
use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;

class PromotionDataHelper extends AbstractExtension
{
    public function __construct(private readonly EntityRepository $promotionRepository)
    {
    }

    public function getFunctions(): array
    {
        return [
            new TwigFunction(
                'sschreier_get_promotion_data_by_promotion_id',
                [$this, 'getPromotionDataByPromotionId']
            ),
        ];
    }

    public function getPromotionDataByPromotionId(?string $promotionId, SalesChannelContext $context): ?PromotionEntity
    {
        if ($promotionId === null || $promotionId === '') {
            return null;
        }

        return $this->promotionRepository
            ->search(new Criteria([$promotionId]), $context->getContext())
            ->getEntities()
            ->first();
    }
}
