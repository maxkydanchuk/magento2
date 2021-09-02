<?php

namespace Training\CarEntity\Ui\DataProvider;

use Magento\Framework\Api\FilterBuilder;
use Magento\Framework\Api\Search\ReportingInterface;
use Magento\Framework\Api\Search\SearchCriteriaBuilder;
use Magento\Framework\Api\Search\SearchResultInterface;
use Magento\Framework\App\RequestInterface;
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Framework\View\Element\UiComponent\DataProvider\DataProvider;
use Magento\Store\Api\StoreManagementInterface;
use Magento\Store\Model\StoreManagerInterface;
use Magento\Ui\DataProvider\SearchResultFactory;
use Training\CarEntity\Api\Data\CarEntityInterface;
use Training\CarEntity\Query\CarEntity\GetListQuery;

/**
 * DataProvider component.
 */
class CarEntityDataProvider extends DataProvider
{
    /**
     * @var GetListQuery
     */
    private $getListQuery;

    /**
     * @var SearchResultFactory
     */
    private $searchResultFactory;

    /**
     * @var array
     */
    private $loadedData = [];
    private $storeManager;

    /**
     * @param string $name
     * @param string $primaryFieldName
     * @param string $requestFieldName
     * @param ReportingInterface $reporting
     * @param SearchCriteriaBuilder $searchCriteriaBuilder
     * @param RequestInterface $request
     * @param FilterBuilder $filterBuilder
     * @param GetListQuery $getListQuery
     * @param SearchResultFactory $searchResultFactory
     * @param array $meta
     * @param array $data
     */
    public function __construct(
        $name,
        $primaryFieldName,
        $requestFieldName,
        ReportingInterface $reporting,
        SearchCriteriaBuilder $searchCriteriaBuilder,
        RequestInterface $request,
        FilterBuilder $filterBuilder,
        GetListQuery $getListQuery,
        SearchResultFactory $searchResultFactory,
        StoreManagerInterface $storeManager,
        array $meta = [],
        array $data = []
    )
    {
        parent::__construct(
            $name,
            $primaryFieldName,
            $requestFieldName,
            $reporting,
            $searchCriteriaBuilder,
            $request,
            $filterBuilder,
            $meta,
            $data
        );
        $this->getListQuery = $getListQuery;
        $this->searchResultFactory = $searchResultFactory;
        $this->storeManager = $storeManager;
    }

    /**
     * @inheritDoc
     */
    public function getSearchResult(): SearchResultInterface
    {
        $searchCriteria = $this->getSearchCriteria();
        $result = $this->getListQuery->execute($searchCriteria);

        return $this->searchResultFactory->create(
            $result->getItems(),
            $result->getTotalCount(),
            $searchCriteria,
            'car_entity_id'
        );
    }

    /**
     * @return string
     * @throws NoSuchEntityException
     */
    public function getMediaUrl(): string
    {
        return $this->storeManager->getStore()
                ->getBaseUrl(\Magento\Framework\UrlInterface::URL_TYPE_MEDIA) . CarEntityInterface::BASE_IMAGE_PATH . '/';
    }

    /**
     * Get data.
     *
     * @return array
     * @throws NoSuchEntityException
     */
    public function getData(): array
    {
        if ($this->loadedData) {
            return $this->loadedData;
        }
        $this->loadedData = parent::getData();
        $itemsById = [];

        foreach ($this->loadedData['items'] as $item) {
                if ($item['image']) {
                    $image_temp = [];
                    $image_temp[0]['name'] = $item["image"];
                    $image_temp[0]['url'] = $this->getMediaUrl().$item['image'];
                    $image_temp[0]['type'] = 'image';
                    $item['image'] = $image_temp;
                }
            $itemsById[(int)$item['car_entity_id']] = $item;
            }

        if ($id = $this->request->getParam('car_entity_id', null)) {
            $this->loadedData['items'][0] = $itemsById[(int)$id];
        }

        return $this->loadedData;
    }

}
