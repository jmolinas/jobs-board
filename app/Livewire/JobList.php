<?php

namespace App\Livewire;

use App\Models\JobsBoard;
use Livewire\Component;
use Livewire\Attributes\Layout;

#[Layout('layouts.app')]
class JobList extends Component
{
    public function parseJobPositions()
    {
        $xmlUrl = 'https://mrge-group-gmbh.jobs.personio.de/xml';

        // Fetch XML content
        $xmlContent = file_get_contents($xmlUrl);
        if ($xmlContent === false) {
            die('Error fetching XML feed.');
        }

        // Load XML into SimpleXML
        $xml = simplexml_load_string($xmlContent, 'SimpleXMLElement', LIBXML_NOCDATA);
        if ($xml === false) {
            die('Error parsing XML.');
        }
        $positions = [];
        foreach ($xml->position as $position) {
            $positions[] = [
                'title' => (string) $position->name,
                'location' => (string) $position->office,
                'department' => (string) $position->department,
                'employment_type' => (string) $position->employmentType,
                'description' => (string) $position->jobDescriptions->jobDescription->value,
                'id' => (string) $position->id,
            ];
        }
        return $positions;
    }

    public function render()
    {
        return view('livewire.job-list', [
            'jobs' => JobsBoard::latest()->published()->get(),
            'positions' => $this->parseJobPositions(),
        ]);
    }
}
