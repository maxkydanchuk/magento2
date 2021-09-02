<?php

namespace Training\CarEntity\Controller\Adminhtml\CarEntity;

use JMS\Serializer\Tests\Fixtures\Discriminator\Car;
use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Framework\App\Action\HttpPostActionInterface;
use Magento\Framework\App\Filesystem\DirectoryList;
use Magento\Framework\App\Request\DataPersistorInterface;
use Magento\Framework\App\ResponseInterface;
use Magento\Framework\Controller\ResultInterface;
use Magento\Framework\DataObject;
use Magento\Framework\Exception\CouldNotSaveException;
use Magento\Framework\Filesystem;
use Magento\Framework\UrlInterface;
use Magento\Store\Model\StoreManagerInterface;
use Training\CarEntity\Api\Data\CarEntityInterface;
use Training\CarEntity\Api\Data\CarEntityInterfaceFactory;
use Training\CarEntity\Command\CarEntity\SaveCommand;

/**
 * Save CarEntity controller action.
 */
class Save extends Action implements HttpPostActionInterface
{
    /**
     * Authorization level of a basic admin session
     *
     * @see _isAllowed()
     */
    const ADMIN_RESOURCE = 'Training_CarEntity::management';

    /**
     * @var DataPersistorInterface
     */
    private $dataPersistor;

    /**
     * @var SaveCommand
     */
    private $saveCommand;

    /**
     * @var CarEntityInterfaceFactory
     */
    private $entityDataFactory;
    /**
     * @var Filesystem\Driver\File
     */
    private $file;
    /**
     * @var Filesystem\Directory\WriteInterface
     */
    private $mediaDirectory;
    private $storeManager;

    /**
     * @param Context $context
     * @param DataPersistorInterface $dataPersistor
     * @param SaveCommand $saveCommand
     * @param CarEntityInterfaceFactory $entityDataFactory
     * @throws \Magento\Framework\Exception\FileSystemException
     */
    public function __construct(
        Context $context,
        DataPersistorInterface $dataPersistor,
        SaveCommand $saveCommand,
        CarEntityInterfaceFactory $entityDataFactory,
        Filesystem $filesystem,
        Filesystem\Driver\File $file,
        StoreManagerInterface $storeManager
    )
    {
        parent::__construct($context);
        $this->dataPersistor = $dataPersistor;
        $this->saveCommand = $saveCommand;
        $this->entityDataFactory = $entityDataFactory;
        $this->mediaDirectory = $filesystem->getDirectoryWrite(DirectoryList::MEDIA);
        $this->file = $file;
        $this->storeManager = $storeManager;
    }

    /**
     * @param array $rawData
     * @return array
     * @throws \Magento\Framework\Exception\FileSystemException
     */
    protected function _filterParams(array $rawData)
    {
        $data = $rawData;

        if (isset($data['general']['image']) && is_array($data['general']['image'])) {
            if (!empty($data['general']['image']['delete'])) {
                $data['general']['image'] = null;
            } else {
                if (isset($data['general']['image'][0]['name'])) {
                    if(isset($data['general']['image'][0]['tmp_name'])){
                        $this->mediaDirectory->copyFile(
                            CarEntityInterface::BASE_TMP_IMAGE_PATH . '/' . $data['general']['image'][0]['name'],
                            CarEntityInterface::BASE_IMAGE_PATH . '/' . $data['general']['image'][0]['name']
                        );
                        $this->file->deleteFile($this->mediaDirectory->getAbsolutePath() .
                            CarEntityInterface::BASE_TMP_IMAGE_PATH . '/' . $data['general']['image'][0]['name']);
                    } else {
                        $baseMediaUrl = $this->getBaseMediaUrl();
                        if (!str_contains($data['general']['image'][0]['url'], $baseMediaUrl)){
                            $this->mediaDirectory->copyFile(
                                ltrim($data['general']['image'][0]['url'], 'media/'),
                                CarEntityInterface::BASE_IMAGE_PATH . '/' . $data['general']['image'][0]['name']
                            );
                        }
                    }
                    $data['general']['image'] = $data['general']['image'][0]['name'];
                } else {
                    unset($data['general']['image']);
                }
            }
        }
        return $data;
    }


    /**
     * Save CarEntity Action.
     *
     * @return ResultInterface
     */

    public function execute()
    {
        $resultRedirect = $this->resultRedirectFactory->create();
        $params = $this->getRequest()->getParams();
        $filteredParams = $this->_filterParams($params);


        try {
            /** @var CarEntityInterface|DataObject $entityModel */
            $entityModel = $this->entityDataFactory->create();
            $entityModel->addData($filteredParams['general']);
            $this->saveCommand->execute($entityModel);
            $this->messageManager->addSuccessMessage(
                __('The CarEntity data was saved successfully')
            );
            $this->dataPersistor->clear('entity');
        } catch (CouldNotSaveException $exception) {
            $this->messageManager->addErrorMessage($exception->getMessage());
            $this->dataPersistor->set('entity', $params);

            return $resultRedirect->setPath('*/*/edit', [
                'car_entity_id' => $this->getRequest()->getParam('car_entity_id')
            ]);
        }

        return $resultRedirect->setPath('*/*/');
    }

    public function getBaseMediaUrl(): string
    {
        return $this->storeManager->getStore()
            ->getBaseUrl(UrlInterface::URL_TYPE_MEDIA);
    }

}
