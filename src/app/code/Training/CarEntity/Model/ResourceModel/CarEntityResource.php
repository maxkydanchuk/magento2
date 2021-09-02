<?php

namespace Training\CarEntity\Model\ResourceModel;

use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

class CarEntityResource extends AbstractDb
{
    /**
     * @var string
     */
    protected $_eventPrefix = 'car_entity_resource_model';

    /**
     * @inheritdoc
     */
    protected function _construct()
    {
        $this->_init('car_entity', 'car_entity_id');
        $this->_useIsObjectNew = true;
    }
}
