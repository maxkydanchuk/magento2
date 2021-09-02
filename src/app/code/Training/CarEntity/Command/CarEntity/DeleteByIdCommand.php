<?php

namespace Training\CarEntity\Command\CarEntity;

use Exception;
use Magento\Framework\Exception\CouldNotDeleteException;
use Magento\Framework\Exception\NoSuchEntityException;
use Psr\Log\LoggerInterface;
use Training\CarEntity\Model\CarEntityModel;
use Training\CarEntity\Model\CarEntityModelFactory;
use Training\CarEntity\Model\ResourceModel\CarEntityResource;

/**
 * Delete CarEntity by id Command.
 */
class DeleteByIdCommand
{
    /**
     * @var LoggerInterface
     */
    private $logger;

    /**
     * @var CarEntityModelFactory
     */
    private $modelFactory;

    /**
     * @var CarEntityResource
     */
    private $resource;

    /**
     * @param LoggerInterface $logger
     * @param CarEntityModelFactory $modelFactory
     * @param CarEntityResource $resource
     */
    public function __construct(
        LoggerInterface $logger,
        CarEntityModelFactory $modelFactory,
        CarEntityResource $resource
    )
    {
        $this->logger = $logger;
        $this->modelFactory = $modelFactory;
        $this->resource = $resource;
    }

    /**
     * Delete CarEntity.
     *
     * @param int $entityId
     *
     * @return void
     * @throws CouldNotDeleteException|NoSuchEntityException
     */
    public function execute(int $entityId)
    {
        try {
            /** @var CarEntityModel $model */
            $model = $this->modelFactory->create();
            $this->resource->load($model, $entityId, 'car_entity_id');

            if (!$model->getData('car_entity_id')) {
                throw new NoSuchEntityException(
                    __('Could not find CarEntity with id: `%id`',
                        [
                            'id' => $entityId
                        ]
                    )
                );
            }

            $this->resource->delete($model);
        } catch (Exception $exception) {
            $this->logger->error(
                __('Could not delete CarEntity. Original message: {message}'),
                [
                    'message' => $exception->getMessage(),
                    'exception' => $exception
                ]
            );
            throw new CouldNotDeleteException(__('Could not delete CarEntity.'));
        }
    }
}
