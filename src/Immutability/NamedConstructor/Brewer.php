<?php
declare(strict_types=1);

namespace Webbaard\Immutability\NamedConstructor;

class Brewer
{
    private $brewer;

    public function __construct(string $brewer) {
        $this->brewer = $brewer;
    }

    public function getBrewer(): string {
        return $this->brewer;
    }
}
