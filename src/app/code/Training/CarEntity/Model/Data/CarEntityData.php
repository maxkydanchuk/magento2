<?php

namespace Training\CarEntity\Model\Data;

use Magento\Framework\DataObject;

use Training\CarEntity\Api\Data\CarEntityInterface;

class CarEntityData extends DataObject implements CarEntityInterface
{
    /**
     * @inheritDoc
     */
    public function getCarEntityId(): ?int
    {
        return $this->getData(self::CAR_ENTITY_ID) === null ? null
            : (int)$this->getData(self::CAR_ENTITY_ID);
    }

    /**
     * @inheritDoc
     */
    public function setCarEntityId(?int $carEntityId): void
    {
        $this->setData(self::CAR_ENTITY_ID, $carEntityId);
    }

    /**
     * @inheritDoc
     */
    public function getName(): ?string
    {
        return $this->getData(self::NAME);
    }

    /**
     * @inheritDoc
     */
    public function setName(?string $name): void
    {
        $this->setData(self::NAME, $name);
    }

    /**
     * @inheritDoc
     */
    public function getPrice(): ?string
    {
        return $this->getData(self::PRICE);
    }

    /**
     * @inheritDoc
     */
    public function setPrice(?string $price): void
    {
        $this->setData(self::PRICE, $price);
    }

    /**
     * @inheritDoc
     */
    public function getQuantity(): ?string
    {
        return $this->getData(self::QUANTITY);
    }

    /**
     * @inheritDoc
     */
    public function setQuantity(?string $quantity): void
    {
        $this->setData(self::QUANTITY, $quantity);
    }

    /**
     * @inheritDoc
     */
    public function getDescription(): ?string
    {
       return $this->getData(self::DESCRIPTION);
    }

    /**
     * @inheritDoc
     */
    public function setDescription(?string $description): void
    {
        $this->setData(self::DESCRIPTION, $description);
    }

    /**
     * @inheritDoc
     */
    public function getImage(): ?string
    {
        return $this->getData(self::IMAGE);
    }

    /**
     * @inheritDoc
     */
    public function setImage(?string $image): void
    {
        $this->setData(self::IMAGE, $image);
    }
}
