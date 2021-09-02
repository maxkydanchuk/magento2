<?php

namespace Training\CarEntity\Model;

use Magento\Framework\Model\AbstractModel;
use Training\CarEntity\Model\ResourceModel\CarEntityResource;

class CarEntityModel extends AbstractModel
{
    /**
     * @var string
     */
    protected $_eventPrefix = 'car_entity_model';

    /**
     * @inheritdoc
     */
    protected function _construct()
    {
        $this->_init(CarEntityResource::class);
    }
}
