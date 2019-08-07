<?php
declare(strict_types=1);

namespace Webbaard\Immutability\NamedConstructor;

class Name
{
    private $name;

    public function __construct(string $name) {
        $this->name = $name;
    }

    public function getName(): string {
        return $this->name;
    }
}
