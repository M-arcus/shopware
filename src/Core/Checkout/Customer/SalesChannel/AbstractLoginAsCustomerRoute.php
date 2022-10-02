<?php declare(strict_types=1);

namespace Shopware\Core\Checkout\Customer\SalesChannel;

use Shopware\Core\Framework\Validation\DataBag\RequestDataBag;
use Shopware\Core\System\SalesChannel\ContextTokenResponse;
use Shopware\Core\System\SalesChannel\SalesChannelContext;

/**
 * This route is used to login as customer and get a new context token
 * The required parameters are "customerId" and "salesChannelId" and "token"
 * The parameter "token" will be validated using hmac to ensure it is not guessable
 */
abstract class AbstractLoginAsCustomerRoute
{
    abstract public function getDecorated(): AbstractLoginRoute;

    abstract public function loginAsCustomer(RequestDataBag $data, SalesChannelContext $context): ContextTokenResponse;
}
