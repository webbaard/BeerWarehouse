<?php
declare(strict_types=1);

namespace Webbaard\Immutability\Reflection;

final class Beer
{
    private $name;
    private $brewer;
    private $style;

    public function __construct(string $name, string $brewer, string $style)
    {
        $this->name = $name;
        $this->brewer = $brewer;
        $this->style = $style;
    }

    public function getName(): string {
        return $this->name;
    }
    public function getBrewer(): string {
        return $this->brewer;
    }
    public function getStyle(): string {
        return $this->style;
    }

}
