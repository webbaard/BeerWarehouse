<?php
declare(strict_types=1);

namespace Webbaard\Immutability\FinalClass;

class MutableBeer extends Beer
{
    private $name;
    private $brewer;
    private $style;

    public function setName($name): void {
        $this->name = $name;
    }
    public function setBrewer($brewer): void {
        $this->brewer = $brewer;
    }
    public function setStyle($style): void {
        $this->style = $style;
    }
}
