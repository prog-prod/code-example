<?php

namespace App\DTO\Slick;

class SlickAnimationDTO
{
    public string $in;
    public string $out;
    public string $delayIn;
    public string $delayOut;
    public string $durationIn;
    public string $durationOut;

    public function __construct(
        string $in,
        string $out,
        string $delayIn,
        string $delayOut,
        string $durationIn,
        string $durationOut
    ) {
        $this->in = $in;
        $this->out = $out;
        $this->delayIn = $delayIn;
        $this->delayOut = $delayOut;
        $this->durationIn = $durationIn;
        $this->durationOut = $durationOut;
    }
}
