<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */

namespace Magento\Integration\Model;

use Magento\Framework\App\ObjectManager;
use Magento\Framework\Exception\LocalizedException;
use Magento\Integration\Api\CustomerTokenServiceInterface;
use Magento\Integration\Api\Exception\UserTokenException;
use Magento\Integration\Api\UserTokenRevokerInterface;
use Magento\Integration\Model\Oauth\Token\RequestThrottler;

/**
 * @inheritdoc
 */
class CustomerTokenService implements CustomerTokenServiceInterface
{
    /**
     * @var UserTokenRevokerInterface
     */
    private $tokenRevoker;

    /**
     * Initialize service
     *
     * @param UserTokenRevokerInterface|null $tokenRevoker
     */
    public function __construct(
        ?UserTokenRevokerInterface $tokenRevoker = null
    ) {
        $this->tokenRevoker = $tokenRevoker ?? ObjectManager::getInstance()->get(UserTokenRevokerInterface::class);
    }

    /**
     * Revoke token by customer id.
     *
     * @param int $customerId
     * @return bool
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function revokeCustomerAccessToken($customerId)
    {
        try {
            $this->tokenRevoker->revokeFor(new CustomUserContext((int)$customerId, CustomUserContext::USER_TYPE_CUSTOMER));
        } catch (UserTokenException $exception) {
            throw new LocalizedException(__('Failed to revoke customer\'s access tokens'), $exception);
        }
        return true;
    }

    /**
     * Get request throttler instance
     *
     * @return RequestThrottler
     * @deprecated 100.0.4
     */
    private function getRequestThrottler()
    {
        return;
    }

    public function createCustomerAccessToken($username, $password)
    {
        // TODO: Implement createCustomerAccessToken() method.
    }
}
