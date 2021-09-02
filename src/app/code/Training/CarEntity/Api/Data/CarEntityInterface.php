<?php

namespace Training\CarEntity\Api\Data;


interface CarEntityInterface
{
    /**
     * String constants for property names
     */
    const CAR_ENTITY_ID = "car_entity_id";
    const NAME = "name";
    const PRICE = "price";
    const QUANTITY = "quantity";
    const DESCRIPTION = "description";
    const IMAGE = "image";
    const BASE_TMP_IMAGE_PATH = 'catalog/tmp/carEntity';
    const BASE_IMAGE_PATH = 'catalog/carEntity';

    /**
     * Getter for CarEntityId.
     *
     * @return int|null
     */
    public function getCarEntityId(): ?int;

    /**
     * Setter for CarEntityId.
     *
     * @param int|null $carEntityId
     *
     * @return void
     */
    public function setCarEntityId(?int $carEntityId): void;

    /**
     * Getter for Name.
     *
     * @return string|null
     */
    public function getName(): ?string;

    /**
     * Setter for Name.
     *
     * @param string|null $name
     *
     * @return void
     */
    public function setName(?string $name): void;

    /**
     * Getter for Price.
     *
     * @return string|null
     */
    public function getPrice(): ?string;

    /**
     * Setter for Price.
     *
     * @param string|null $price
     *
     * @return void
     */
    public function setPrice(?string $price): void;

    /**
     * Getter for Quantity.
     *
     * @return string|null
     */
    public function getQuantity(): ?string;

    /**
     * Setter for Quantity.
     *
     * @param string|null $quantity
     *
     * @return void
     */
    public function setQuantity(?string $quantity): void;

    /**
     * @return string|null
     */
    public function getDescription(): ?string ;

    /**
     * @param string|null $description
     *
     * @return void
     */
    public function setDescription(?string $description): void;

    /**
     * @return string|null
     */
    public function getImage(): ?string ;

    /**
     * @param string|null $image
     *
     * @return void
     */
    public function setImage(?string $image): void;
}
