<?php

declare(strict_types=1);

namespace App\Model\Phone;

class PhoneFactory
{
    public function create(array $dataParams = []): Phone
    {
        return new Phone(...$dataParams);
    }
}