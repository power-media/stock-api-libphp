<?php

/**
 * Copyright 2017 Adobe Systems Incorporated. All rights reserved.
 * This file is licensed to you under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License. You may obtain a copy
 * of the License at http://www.apache.org/licenses/LICENSE-2.0
 */
namespace AdobeStock\Api\Client;

use AdobeStock\Api\Client\SearchCategory as SearchCategoryFactory;
use AdobeStock\Api\Core\Config as CoreConfig;
use AdobeStock\Api\Request\SearchCategory as SearchCategoryRequest;
use AdobeStock\Api\Response\SearchCategory as SearchCategoryResponse;
use AdobeStock\Api\Client\Http\HttpInterface;
use AdobeStock\Api\Request\SearchFiles as SearchFilesRequest;
use AdobeStock\Api\Response\SearchFiles as SearchFilesResponse;
use AdobeStock\Api\Client\Http\HttpClient;
use AdobeStock\Api\Request\License as LicenseRequest;
use AdobeStock\Api\Client\License as LicenseFactory;
use AdobeStock\Api\Response\License as LicenseResponse;
use GuzzleHttp\Psr7\Request;
use AdobeStock\Api\Request\LicenseHistory as LicenseHistoryRequest;
use AdobeStock\Api\Response\LicenseHistory as LicenseHistoryResponse;
class AdobeStock
{
    /**
     * Configuration that needs to be initialized.
     * @var CoreConfig
     */
    private $_config;
    /**
     * Factory object of all search category apis.
     * @var SearchCategoryFactory
     */
    private $_search_category_factory;
    /**
     * Factory object of all search Files apis.
     * @var SearchFiles
     */
    private $_search_files_factory;
    /**
     * Factory object of all license apis.
     * @var LicenseFactory;
     */
    private $_license_factory;
    /**
     * Factory object of all license History apis.
     * @var LicenseHistory
     */
    private $_license_history_factory;
    /**
     * Custom http client object.
     * @var HttpInterface
     */
    private $_http_client;
    /**
     * Constructor for AdobeStock client that requires following
     * configuration to be initialized.
     * @param string        $api_key     Api Key for config
     * @param string        $product     Target Product
     * @param string        $target_env  Target Environment Prod/Stage
     * @param HttpInterface $http_client Custom http client
     */
    public function __construct($api_key, $product, $target_env, HttpInterface $http_client = null)
    {
        $this->_config = new CoreConfig($api_key, $product, $target_env);
        $this->_search_category_factory = new SearchCategoryFactory($this->_config);
        $this->_search_files_factory = new SearchFiles($this->_config);
        $this->_license_factory = new LicenseFactory($this->_config);
        $this->_license_history_factory = new LicenseHistory($this->_config);
        if ($http_client === null) {
            $this->_http_client = new HttpClient();
        } else {
            $this->_http_client = $http_client;
        }
    }
    /**
     * Setter function for custom Http client.
     * @param HttpInterface $http_client custom Http client
     * @return AdobeStock client.
     */
    public function setHttpClient(HttpInterface $http_client)
    {
        $this->_http_client = $http_client;
        return $this;
    }
    /**
     * Get information about a category of Stock assets, such as travel
     * or animals for a specified category identifier, optionally localized.
     * @param SearchCategoryRequest $request      object containing
     * category-id and locale
     * @param string                $access_token Users ims access token
     * @return SearchCategoryResponse contains id,name and link of the asset category.
     */
    public function searchCategory(SearchCategoryRequest $request, $access_token)
    {
        $response = $this->_search_category_factory->getCategory($request, $access_token, $this->_http_client);
        return $response;
    }
    /**
     * Get category information for zero or more category identifiers.
     * If you request information without specifying a category,
     * this returns a list of all stock categories.
     * @param SearchCategoryRequest $request      object containing
     * category-id and locale
     * @param string                $access_token Users ims access token
     * @return array list of SearchCategoryResponse objects each containing information about asset category.
     */
    public function searchCategoryTree(SearchCategoryRequest $request, $access_token)
    {
        $response = $this->_search_category_factory->getCategoryTree($request, $access_token, $this->_http_client);
        return $response;
    }
    /**
     * Method to initialize search files.
     * @param SearchFilesRequest $request
     * @param string             $access_token
     * @return AdobeStock
     */
    public function searchFilesInitialize(SearchFilesRequest $request, $access_token = null)
    {
        $this->_search_files_factory->searchFilesInitialize($request, $access_token, $this->_http_client, true);
        return $this;
    }
    /**
     * Method to get next search files response page.
     * @return SearchFilesResponse
     */
    public function getNextResponse()
    {
        $response = $this->_search_files_factory->getNextResponse();
        return $response;
    }
    /**
     * Method to get to previous search files response page.
     * @return SearchFilesResponse
     */
    public function getPreviousResponse()
    {
        $response = $this->_search_files_factory->getPreviousResponse();
        return $response;
    }
    /**
     * Method to get response from last api call.
     * @return SearchFilesResponse
     */
    public function getLastResponse()
    {
        $response = $this->_search_files_factory->getLastResponse();
        return $response;
    }
    /**
     * Method to skip to a specific search files response page.
     * @param int $page_index
     * @return SearchFilesResponse
     */
    public function getResponsePage($page_index)
    {
        $response = $this->_search_files_factory->getResponsePage($page_index);
        return $response;
    }
    /**
     * Method to get total search files available.
     * @return int
     */
    public function totalSearchFiles()
    {
        $total_files = $this->_search_files_factory->totalSearchFiles();
        return $total_files;
    }
    /**
     * Method to get total search results pages.
     * @return int
     */
    public function totalSearchPages()
    {
        $total_pages = $this->_search_files_factory->totalSearchPages();
        return $total_pages;
    }
    /**
     * Method to get response from last api call.
     * @return int
     */
    public function currentSearchPageIndex()
    {
        $current_page = $this->_search_files_factory->currentSearchPageIndex();
        return $current_page;
    }
    /**
     * Requests licensing information about a specific asset for a specific user
     * @param LicenseRequest $request      object containing
     * category-id and locale
     * @param string         $access_token Users ims access token
     * @return LicenseResponse contains LicenseEntitlement,LicensePurchaseOptions,LicenseMemberInfo,cce_agency and contents
     */
    public function getContentInfo(LicenseRequest $request, $access_token)
    {
        $response = $this->_license_factory->getContentInfo($request, $access_token, $this->_http_client);
        return $response;
    }
    /**
     * Requests a license for an asset for a specific user.
     * @param LicenseRequest $request
     * @param string         $access_token
     * @return LicenseResponse contains LicenseEntitlement,LicensePurchaseOptions,LicenseMemberInfo,cce_agency and contents
     */
    public function getContentLicense(LicenseRequest $request, $access_token)
    {
        $response = $this->_license_factory->getContentLicense($request, $access_token, $this->_http_client);
        return $response;
    }
    /**
     * It can be used to get the licensing capabilities for a specific user.
     * This API returns the user's available purchase quota, the member
     * identifier, and information that you can use to present licensing
     * options to the user when the user next requests an asset purchase.
     * In this 3 cases can occur -
     * User has enough quota to license the next asset.
     * User doesn't have enough quota and is set up to handle overage.
     * User doesn't have quota and there is no overage plan.
     * @param LicenseRequest $request
     * @param string         $access_token
     * @return LicenseResponse contains LicenseEntitlement,LicensePurchaseOptions,LicenseMemberInfo,cce_agency and contents
     */
    public function getMemberProfile(LicenseRequest $request, $access_token)
    {
        $response = $this->_license_factory->getMemberProfile($request, $access_token, $this->_http_client);
        return $response;
    }
    /**
     * Notifies the system when a user cancels a licensing operation.
     * It can be used if the user refuses the opportunity to purchase
     * or license the requested asset.
     * @param LicenseRequest $request
     * @param string         $access_token
     * @return int $response_code
     */
    public function abandonLicense(LicenseRequest $request, $access_token)
    {
        $response_code = $this->_license_factory->abandonLicense($request, $access_token, $this->_http_client);
        return $response_code;
    }
    /**
     * Provide the guzzle request object that contains url of the asset that can be downloaded by hitting request with guzzle client send method if it is already licensed
     * @param LicenseRequest $request
     * @param string         $access_token
     * @return Request guzzle request object containing url of the asset.
     */
    public function downloadAssetRequest(LicenseRequest $request, $access_token)
    {
        $guzzle_request = $this->_license_factory->downloadAssetRequest($request, $access_token, $this->_http_client);
        return $guzzle_request;
    }
    /**
     * Provide the url of the asset if it is already licensed.
     * @param LicenseRequest $request
     * @param string         $access_token
     * @return string url of the asset.
     */
    public function downloadAssetUrl(LicenseRequest $request, $access_token)
    {
        $url = $this->_license_factory->downloadAssetUrl($request, $access_token, $this->_http_client);
        return $url;
    }
    /**
     * Provide the Image Buffer if it is already licensed.
     * @param LicenseRequest $request
     * @param string         $access_token
     * @return string Image stream.
     */
    public function downloadAssetStream(LicenseRequest $request, $access_token)
    {
        $image_stream = $this->_license_factory->downloadAssetStream($request, $access_token, $this->_http_client);
        return $image_stream;
    }
    /**
     * Method to initialize license history.
     * @param LicenseHistoryRequest $request      License History request object
     * @param string                $access_token Access token
     * @return AdobeStock
     */
    public function initializeLicenseHistory(LicenseHistoryRequest $request, $access_token = null)
    {
        $this->_license_history_factory->initializeLicenseHistory($request, $access_token, $this->_http_client);
        return $this;
    }
    /**
     * Method to get next license history files response page.
     * @return LicenseHistoryResponse
     */
    public function getNextLicenseHistory()
    {
        $response = $this->_license_history_factory->getNextLicenseHistory();
        return $response;
    }
    /**
     * Method to get previous license history files response page.
     * @return LicenseHistoryResponse
     */
    public function getPreviousLicenseHistory()
    {
        $response = $this->_license_history_factory->getPreviousLicenseHistory();
        return $response;
    }
    /**
     * Method to get response from last api call.
     * @return LicenseHistoryResponse
     */
    public function getLastLicenseHistory()
    {
        $response = $this->_license_history_factory->getLastLicenseHistory();
        return $response;
    }
    /**
     * Method to skip to a specific license files response page.
     * @param int $page_index
     * @return LicenseHistoryResponse
     */
    public function getLicenseHistoryPage($page_index)
    {
        $response = $this->_license_history_factory->getLicenseHistoryPage($page_index);
        return $response;
    }
    /**
     * Method to get total license files available.
     * @return int
     */
    public function getTotalLicenseHistoryFiles()
    {
        $total_files = $this->_license_history_factory->getTotalLicenseHistoryFiles();
        return $total_files;
    }
    /**
     * Method to get total license results pages.
     * @return int
     */
    public function getTotalLicenseHistoryPages()
    {
        $total_pages = $this->_license_history_factory->getTotalLicenseHistoryPages();
        return $total_pages;
    }
    /**
     * Method to get response from last api call.
     * @return int
     */
    public function currentLicenseHistoryPageIndex()
    {
        $current_page = $this->_license_history_factory->currentLicenseHistoryPageIndex();
        return $current_page;
    }
}