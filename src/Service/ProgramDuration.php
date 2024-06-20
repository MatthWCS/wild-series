<?php

namespace App\Service;

use App\Entity\Program;

class ProgramDuration
{
    public function calculate(Program $program): array
    {
        $programTime = 0;

        foreach ($program->getSeasons() as $season) {
            foreach ($season->getEpisodes() as $episode) {
                $programTime += $episode->getDuration();
            }
        }
        return $this->convertProgram($programTime);
    }

    public function convertProgram($programTime): array
    {
        $days = round($programTime / (60 * 24));
        $hours = round($programTime % 24);
        $minutes = $programTime % 60;

        return ['days' => $days, 'hours' => $hours, 'minutes' => $minutes];
    }
}