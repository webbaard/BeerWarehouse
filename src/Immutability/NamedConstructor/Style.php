<?php
declare(strict_types=1);

namespace Webbaard\Immutability\NamedConstructor;

class Style
{
    private $style;

    public function __construct(string $style) {
        $this->style = $style;
    }

    public function getStyle(): string {
        return $this->style;
    }
}
