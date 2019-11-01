<?php declare(strict_types=1);

namespace SwagVueStorefront\VueStorefront\PageResult\Product;

use Shopware\Core\Content\Product\Aggregate\ProductMedia\ProductMediaCollection;
use Shopware\Core\Content\Product\Aggregate\ProductPrice\ProductPriceCollection;
use Shopware\Core\Content\Property\Aggregate\PropertyGroupOption\PropertyGroupOptionCollection;
use Shopware\Core\Content\Property\PropertyGroupCollection;
use Shopware\Core\Framework\Pricing\ListingPriceCollection;
use Shopware\Storefront\Page\Product\ProductPage;
use SwagVueStorefront\VueStorefront\PageLoader\Context\PageLoaderContext;

/**
 * This is a helper class which strips down fields in the response and assembles the product page result.
 * It's really more of a preprocessor than a hydrator to be exact.
 *
 * It seems reasonable to create an interface for hydrators, however there is no common input format for them other than a custom struct.
 * Don't want to over-engineer here.
 *
 * @package SwagVueStorefront\VueStorefront\PageResult\Product
 */
class ProductPageResultHydrator
{
    public function hydrate(PageLoaderContext $pageLoaderContext, ProductPage $productPage): ProductPageResult
    {
        $pageResult = new ProductPageResult();

        $pageResult->setProduct($productPage->getProduct());

        // Request rückbauen! (WIP)
        $pageResult->getProduct()->setProperties(new PropertyGroupOptionCollection());
        $pageResult->getProduct()->setSortedProperties(new PropertyGroupCollection());

        $pageResult->getProduct()->setPrices(new ProductPriceCollection());
        $pageResult->getProduct()->setListingPrices(new ListingPriceCollection());

        $pageResult->getProduct()->setMedia(new ProductMediaCollection());

        $pageResult->setResourceType($pageLoaderContext->getResourceType());
        $pageResult->setResourceIdentifier($pageLoaderContext->getResourceIdentifier());

        return $pageResult;
    }
}
