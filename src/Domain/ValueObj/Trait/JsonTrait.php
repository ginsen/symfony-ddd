<?php

declare(strict_types=1);

namespace App\Domain\ValueObj\Trait;

use Assert\Assertion;

trait JsonTrait
{
    private array $values;


    /**
     * @param iterable $arr
     */
    public static function fromArray($arr): self
    {
        self::checkAssertionArray($arr);

        return self::fromJson(json_encode($arr));
    }


    public static function fromJson($json): self
    {
        self::checkAssertionJson($json);

        $instance         = new static();
        $instance->values = json_decode($json, true);

        return $instance;
    }


    public function isEmpty(): bool
    {
        return empty($this->toArray());
    }


    public function toArray(): array
    {
        return $this->values;
    }


    public function toJson(): string
    {
        return json_encode($this->values);
    }


    public function isEqual(self $json): bool
    {
        return $this->toJson() === $json->toJson();
    }


    public function __toString(): string
    {
        return $this->toJson();
    }


    /**
     * @param string $json
     * @throws
     */
    protected static function checkAssertionJson($json): void
    {
        Assertion::isJsonString($json, 'Invalid JSON format');
    }


    /**
     * @param iterable $arr
     * @throws
     */
    protected static function checkAssertionArray($arr): void
    {
        Assertion::isArray($arr, 'Invalid array format');
    }


    private function __construct() {}
}
