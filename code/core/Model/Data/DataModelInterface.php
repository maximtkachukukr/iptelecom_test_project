<?php

declare(strict_types=1);

namespace Core\Model\Data;

interface DataModelInterface
{
    /**
     * Get primary key value
     *
     * @return int|null
     */
    public function getId(): ?int;

    /**
     * Set primary key value
     *
     * @param int $id
     * @return void
     */
    public function setId(int $id): void;

    /**
     * Get all data for saving to DB
     * @return array
     */
    public function getData(): array;

    /**
     * Set data from DB
     *
     * @param array $data
     * @return void
     */
    public function setData(array $data): void;
}