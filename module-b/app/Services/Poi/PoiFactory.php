<?php


namespace App\Services\Poi;

class PoiFactory
{
    private array $start;
    private array $end;
    private array $startPoint;
    private int $width;
    private int $height;

    public function __construct(
        array $start = ['latitude' => 13.772478, 'longitude' => 100.482653],
        array $end = ['latitude' => 13.736280, 'longitude' => 100.536051],
        int $width = 1280,
        int $height = 800
    ) {
        $this->start = $start;
        $this->end = $end;
        $this->width = $width;
        $this->height = $height;
        $this->mapStartPoint();
    }

    private function calc(array $source, array $target): array
    {
        $_a = new Poi($source['latitude'], $target['longitude']);
        $a = new Poi($target['latitude'], $target['longitude']);

        $y = $_a->distanceTo($a);

        $_b = new Poi($source['latitude'], $source['longitude']);
        $b = new Poi($source['latitude'], $target['longitude']);

        $x = $_b->distanceTo($b);

        return [
            'x' => $x,
            'y' => $y
        ];
    }

    private function mapStartPoint(): void
    {
        $calc = $this->calc($this->start, $this->end);

        $this->startPoint = [
            'x' => $calc['x'] / $this->width,
            'y' => $calc['y'] / $this->height
        ];
    }

    public function calculate(array $target): array
    {

        $calc = $this->calc($this->start, $target);

        return [
            'x' => floor($calc['x'] / $this->startPoint['x']),
            'y' => floor($calc['y'] / $this->startPoint['y'])
        ];
    }
}

