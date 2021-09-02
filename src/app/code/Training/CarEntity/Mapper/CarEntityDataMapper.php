<?php

namespace Training\CarEntity\Mapper;

use Magento\Framework\DataObject;
use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;
use Training\CarEntity\Api\Data\CarEntityInterface;
use Training\CarEntity\Api\Data\CarEntityInterfaceFactory;
use Training\CarEntity\Model\CarEntityModel;

/**
 * Converts a collection of CarEntity entities to an array of data transfer objects.
 */
class CarEntityDataMapper
{
    /**
     * @var CarEntityInterfaceFactory
     */
    private $entityDtoFactory;

    /**
     * @param CarEntityInterfaceFactory $entityDtoFactory
     */
    public function __construct(
        CarEntityInterfaceFactory $entityDtoFactory
    )
    {
        $this->entityDtoFactory = $entityDtoFactory;
    }

    /**
     * Map magento models to DTO array.
     *
     * @param AbstractCollection $collection
     *
     * @return array|CarEntityInterface[]
     */
    public function map(AbstractCollection $collection): array
    {
        $results = [];
        /** @var CarEntityModel $item */
        foreach ($collection->getItems() as $item) {
            /** @var CarEntityInterface|DataObject $entityDto */
            $entityDto = $this->entityDtoFactory->create();
            $entityDto->addData($item->getData());

            $results[] = $entityDto;
        }

        return $results;
    }
}
