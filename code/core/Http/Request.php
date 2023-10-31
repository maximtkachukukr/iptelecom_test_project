<?php

declare(strict_types=1);

namespace Core\Http;

readonly class Request implements RequestInterface
{
    /**
     * @inheritDoc
     */
    public function getParam(string $paramName): mixed
    {
        if (array_key_exists($paramName, $_POST)) {
            return $_POST[$paramName];
        }
        if (array_key_exists($paramName, $_GET)) {
            return $_POST[$paramName];
        }
        if (array_key_exists($paramName, $_FILES) && $_FILES[$paramName]['error'] !== UPLOAD_ERR_NO_FILE) {
            return $_FILES[$paramName];
        }

        return null;
    }

    /**
     * @inheritDoc
     */
    public function isAjax(): bool
    {
        return !empty($_SERVER['HTTP_X_REQUESTED_WITH'])
            && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest';
    }

    /**
     * @inheritDoc
     */
    public function isPost(): bool
    {
        return $_SERVER['REQUEST_METHOD'] === 'POST';
    }

    /**
     * @inheritDoc
     */
    public function getParams(): array
    {
        return ($this->isPost()) ? $_POST : $_GET;
    }
}