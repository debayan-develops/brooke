<?php

namespace App\Admin\Content\Application\DTOs;

class CategoryData
{
    public function __construct(
        public readonly string $name,
        public readonly array $categoryType
    ) {}

    public static function fromRequest(array $data): self
    {
        return new self(
            name: $data['name'],
            categoryType: $data['categoryType']
        );
    }
}