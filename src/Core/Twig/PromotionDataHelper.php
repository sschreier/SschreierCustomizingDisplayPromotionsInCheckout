<?php
declare(strict_types=1);

/*
 * (c) Sebastian Schreier <info@sebastianschreier.de>
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Sschreier\CustomizingDisplayPromotionsInCheckout\Core\Twig;

use Shopware\Core\Framework\DataAbstractionLayer\EntityRepository;
use Shopware\Core\Framework\DataAbstractionLayer\Search\Criteria;
use Shopware\Core\Framework\DataAbstractionLayer\Search\Filter\EqualsFilter;
use Shopware\Core\System\SalesChannel\SalesChannelContext;
use Twig\Environment;
use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;

class PromotionDataHelper extends AbstractExtension
{
    /** @var Environment */
    private $twigEnvironment;

    public function __construct(
        Environment $twigEnvironment,
        protected EntityRepository $promotionRepository
    ) {
        $this->twigEnvironment = $twigEnvironment;
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

    public function getPromotionDataByPromotionId($promotionId, SalesChannelContext $context): array
    {
        $promotion = $this->promotionRepository->search(
            (new Criteria())
                ->addFilter(new EqualsFilter('id', $promotionId)),
            $context->getContext()
        )->getEntities()->first();

        $array = [];
        $array['promotion'] = $promotion;

        return $array;
    }
}
