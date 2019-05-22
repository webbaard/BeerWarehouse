<?php
declare(strict_types=1);

namespace Webbaard\Immutability\PrivateVariables;

class Beer
{
    private $name;
    private $brewer;
    private $style;

    public function getName(): string {
        return $this->name;
    }
    public function setName($name): void {
        $this->name = $name;
    }
    public function getBrewer(): string {
        return $this->brewer;
    }
    public function setBrewer($brewer): void {
        $this->brewer = $brewer;
    }
    public function getStyle(): string {
        return $this->style;
    }
    public function setStyle($style): void {
        $this->style = $style;
    }
}
