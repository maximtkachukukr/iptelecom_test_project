<?php

declare(strict_types=1);

namespace Core\Http\Validation\Rule;

use App\Model\User\ResourceModel\Phone;
use Core\Model\ResourceModel;

readonly class UniqueRule implements RuleInterface
{
    private readonly ResourceModel $resource;
    private readonly string $column;

    public function __construct(array $params)
    {
        $this->column = $params['column'];
        $this->resource = new $params['resourceModel']();
    }

    /**
     * @inheritDoc
     */
    public function isValid(mixed $value): bool
    {
        return !$this->resource->getCountResult('`' . $this->column . '` = ?', [$value]);
    }

    /**
     * @inheritDoc
     */
    public function getDefaultErrorMessage(): string
    {
        return 'This value already exists';
    }
}