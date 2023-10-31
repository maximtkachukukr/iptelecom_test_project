<?php

declare(strict_types=1);

namespace Core\Http;

interface RequestInterface
{
    /**
     * Get all params
     *
     * @return array
     */
    public function getParams(): array;

    /**
     * Get param from request
     *
     * @param string $paramName
     * @return string|null
     */
    public function getParam(string $paramName): mixed;

    /**
     * Is request ajax
     *
     * @return bool
     */
    public function isAjax(): bool;

    /**
     * Is post request
     *
     * @return bool
     */
    public function isPost(): bool;
}