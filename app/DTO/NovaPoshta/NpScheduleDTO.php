<?php

namespace App\DTO\NovaPoshta;

class NpScheduleDTO
{
    public string $monday;
    public string $tuesday;
    public string $wednesday;
    public string $thursday;
    public string $friday;
    public string $saturday;
    public string $sunday;

    /**
     * @param string $monday
     * @param string $tuesday
     * @param string $wednesday
     * @param string $thursday
     * @param string $friday
     * @param string $saturday
     * @param string $sunday
     */
    public function __construct(
        string $monday,
        string $tuesday,
        string $wednesday,
        string $thursday,
        string $friday,
        string $saturday,
        string $sunday
    ) {
        $this->monday = $monday;
        $this->tuesday = $tuesday;
        $this->wednesday = $wednesday;
        $this->thursday = $thursday;
        $this->friday = $friday;
        $this->saturday = $saturday;
        $this->sunday = $sunday;
    }
}
