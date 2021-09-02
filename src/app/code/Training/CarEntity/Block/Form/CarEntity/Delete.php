<?php

namespace Training\CarEntity\Block\Form\CarEntity;

use Magento\Framework\View\Element\UiComponent\Control\ButtonProviderInterface;

/**
 * Delete entity button.
 */
class Delete extends GenericButton implements ButtonProviderInterface
{
    /**
     * Retrieve Delete button settings.
     *
     * @return array
     */
    public function getButtonData(): array
    {
        return $this->wrapButtonSettings(
            'Delete',
            'delete',
            'deleteConfirm(\''
            . __('Are you sure you want to delete this carentity?')
            . '\', \'' . $this->getUrl('*/*/delete', ['car_entity_id' => $this->getCarEntityId()]) . '\')',
            [],
            20
        );
    }
}
