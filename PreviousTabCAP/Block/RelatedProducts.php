<?php
namespace Riksten\PreviousTabCAP\Block;

use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Framework\View\Element\Template;
use Magento\Framework\View\Element\Template\Context;
use Magento\Reports\Block\Product\Widget\Viewed as recentlyViewed;
use Magento\Catalog\Api\ProductRepositoryInterface;

/**
 * Class RelatedProducts
 * @package Riksten\PreviousTabCAP\Block
 */
class RelatedProducts extends Template
{

    /** @var recentlyViewed  $recentlyViewed*/
    protected $recentlyViewed;

    /** @var ProductRepositoryInterface $productRepository */
    protected $productRepository;

    /**
     * RelatedProducts constructor.
     * @param Context $context
     * @param recentlyViewed $recentlyViewed
     * @param ProductRepositoryInterface $productRepository
     * @param array $data
     */
    public function __construct(
        Context $context,
        recentlyViewed $recentlyViewed,
        ProductRepositoryInterface $productRepository,
        array $data = []
    ) {
        $this->recentlyViewed = $recentlyViewed;
        $this->productRepository = $productRepository;
        parent::__construct($context, $data);
    }

    /**
     * @return array
     */
    public function getRecentlyViewedProductIds()
    {
        return $this->recentlyViewed->getItemsCollection()->getAllIds();
    }

    /**
     * @throws NoSuchEntityException
     */
    public function getRelatedProductCollection()
    {
        $productIds = $this->getRecentlyViewedProductIds();
        $relatedProducts = [];

        if ($productIds) {
            foreach ($productIds as $id) {

                /** @var \Magento\Catalog\Model\Product $product */
                $productRepository = $this->productRepository->getById($id);
                $relatedProducts[] = $productRepository;
            }
        }

        return $relatedProducts;
    }

}
