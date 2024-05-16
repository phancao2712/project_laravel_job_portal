<?php

namespace App\Services;

class CalculateMatchingPercentageService
{
    function calculate($candidate, $job)
    {
        $skillsMatch = $this->checkSkillsMatch($candidate, $job);
        $experienceMatch = $this->checkExperienceMatch($candidate, $job);
        $addressMatch = $this->checkAddress($candidate, $job);
        $totalPoints = $skillsMatch + $experienceMatch + $addressMatch;
        $maxPossiblePoints = 100;
        $matchingPercentage = ($totalPoints / $maxPossiblePoints) * 100;

        return $matchingPercentage;
    }

    function checkSkillsMatch($candidate, $job)
    {
        $candidateSkill = $candidate?->skills->pluck('skill_id')->toArray();
        $jobSkill = $job?->skills->pluck('skill_id')->toArray();
        $matchingSkills = array_intersect($candidateSkill, $jobSkill);
        $skillsMatchPoints = count($matchingSkills);
        return $skillsMatchPoints;
    }

    function checkExperienceMatch($candidate, $job)
    {
        $experiences = $candidate->experience?->id;
        $expJob = $job->jobExperience?->id;

        if ($experiences === $expJob) {
            return (100 / 3);
        }
        return 0;
    }

    function checkAddress($candidate, $job)
    {
        $total = 100 / 3;
        $countryCandidate = $candidate->candidateCountry->id;
        $countryJob = $job->countries?->id;

        $provinceCandidate = $candidate->candidateProvince?->id;
        $provinceJob = $job->provinces?->id;
        if ($countryCandidate === $countryJob) {
            $total = $total / 2;
            if ($provinceJob === $provinceCandidate) {
                $total = $total * 2;
            }
        }
        return $total;
    }
}
