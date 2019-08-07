<?php
declare(strict_types=1);

namespace Webbaard\Immutability\NamedConstructor;

final class Beer
{
    private $name;
    private $brewer;
    private $style;

    public function __construct(Name $name, Brewer $brewer, Style $style)
    {
        $this->name = $name;
        $this->brewer = $brewer;
        $this->style = $style;
    }

    public function getName(): Name {
        return $this->name;
    }
    public function getBrewer(): Brewer {
        return $this->brewer;
    }
    public function getStyle(): Style {
        return $this->style;
    }

}
