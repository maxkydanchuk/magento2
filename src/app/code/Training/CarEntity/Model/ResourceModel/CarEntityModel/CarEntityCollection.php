<?php

namespace Training\CarEntity\Model\ResourceModel\CarEntityModel;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;
use Training\CarEntity\Model\CarEntityModel;
use Training\CarEntity\Model\ResourceModel\CarEntityResource;

class CarEntityCollection extends AbstractCollection
{
    /**
     * @var string
     */
    protected $_eventPrefix = 'car_entity_collection';


    /**
     * @inheritdoc
     */
    protected function _construct()
    {
        $this->_init(CarEntityModel::class, CarEntityResource::class);
    }
}
