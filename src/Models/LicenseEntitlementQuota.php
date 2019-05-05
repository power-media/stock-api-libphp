<?php

/**
 * Copyright 2017 Adobe Systems Incorporated. All rights reserved.
 * This file is licensed to you under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License. You may obtain a copy
 * of the License at http://www.apache.org/licenses/LICENSE-2.0
 */
namespace AdobeStock\Api\Models;

class LicenseEntitlementQuota
{
    /**
     * @var int Image quota for CCI, CCT and CCE 1st and 2nd generation.
     */
    public $image_quota;
    /**
     * @var int Video quota for CCE 1st generation.
     */
    public $video_quota;
    /**
     * @var int Credits quota for CCE 2nd generation.
     */
    public $credits_quota;
    /**
     * @var int Standard credits quota for CCE 3rd generation.
     */
    public $standard_credits_quota;
    /**
     * @var int Premium credits quota for CCE 3rd generation.
     */
    public $premium_credits_quota;
    /**
     * @var int Universal credits quota for CCE 3rd generation.
     */
    public $universal_credits_quota;
    /**
     * Constructor for LicenseEntitlementQuota
     * @param array $response
     */
    public function __construct(array $response)
    {
        foreach ($response as $key => $val) {
            $this->{$key} = $val;
        }
    }
    /**
     * Get Image quota for CCI, CCT and CCE 1st and 2nd generation.
     * @return int image quota
     */
    public function getImageQuota()
    {
        return $this->image_quota;
    }
    /**
     * Get Video quota for CCE 1st generation.
     * @return int video quota
     */
    public function getVideoQuota()
    {
        return $this->video_quota;
    }
    /**
     * Get Credits quota for CCE 2nd generation.
     * @return int credits quota
     */
    public function getCreditsQuota()
    {
        return $this->credits_quota;
    }
    /**
     * Get Standard credits quota for CCE 3rd generation.
     * @return int standard credits quota
     */
    public function getStandardCreditQuota()
    {
        return $this->standard_credits_quota;
    }
    /**
     * Get Premium credits quota for CCE 3rd generation.
     * @return int premium credits quota
     */
    public function getPremiumCreditsQuota()
    {
        return $this->premium_credits_quota;
    }
    /**
     * Get Universal credits quota for CCE 3rd generation.
     * @return int universal credits quota
     */
    public function getUniversalCreditsQuota()
    {
        return $this->universal_credits_quota;
    }
    /**
     * Setter for ImageQuota.
     * @param int $quota
     * @return LicenseEntitlementQuota
     */
    public function setImageQuota($quota)
    {
        $this->image_quota = $quota;
        return $this;
    }
    /**
     * Setter for VideoQuota.
     * @param int $quota
     * @return LicenseEntitlementQuota
     */
    public function setVideoQuota($quota)
    {
        $this->video_quota = $quota;
        return $this;
    }
    /**
     * Setter for CreditsQuota.
     * @param int $quota
     * @return LicenseEntitlementQuota
     */
    public function setCreditsQuota($quota)
    {
        $this->credits_quota = $quota;
        return $this;
    }
    /**
     * Setter for StandardCreditsQuota.
     * @param int $quota
     * @return LicenseEntitlementQuota
     */
    public function setStandardCreditQuota($quota)
    {
        $this->standard_credits_quota = $quota;
        return $this;
    }
    /**
     * Setter for PremiumCreditsQuota.
     * @param int $quota
     * @return LicenseEntitlementQuota
     */
    public function setPremiumCreditsQuota($quota)
    {
        $this->premium_credits_quota = $quota;
        return $this;
    }
    /**
     * Setter for UniversalCreditsQuota.
     * @param int $quota
     * @return LicenseEntitlementQuota
     */
    public function setUniversalCreditsQuota($quota)
    {
        $this->universal_credits_quota = $quota;
        return $this;
    }
}