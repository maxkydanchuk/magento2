<?php

namespace Training\CarEntity\Command\CarEntity;

use Exception;
use Magento\Framework\DataObject;
use Magento\Framework\Exception\CouldNotSaveException;
use Psr\Log\LoggerInterface;
use Training\CarEntity\Api\Data\CarEntityInterface;
use Training\CarEntity\Model\CarEntityModel;
use Training\CarEntity\Model\CarEntityModelFactory;
use Training\CarEntity\Model\ResourceModel\CarEntityResource;

/**
 * Save CarEntity Command.
 */
class SaveCommand
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
     * Save CarEntity.
     *
     * @param CarEntityInterface|DataObject $carEntity
     *
     * @return int
     * @throws CouldNotSaveException
     */
    public function execute(CarEntityInterface $carEntity): int
    {
        try {
            /** @var CarEntityModel $model */
            $model = $this->modelFactory->create();
            $model->addData($carEntity->getData());
            $model->setHasDataChanges(true);

            if (!$model->getId()) {
                $model->isObjectNew(true);
            }
            $this->resource->save($model);
        } catch (Exception $exception) {
            $this->logger->error(
                __('Could not save CarEntity. Original message: {message}'),
                [
                    'message' => $exception->getMessage(),
                    'exception' => $exception
                ]
            );
            throw new CouldNotSaveException(__('Could not save CarEntity.'));
        }

        return (int)$model->getEntityId();
    }
}
