<?php

namespace App\Livewire;

use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('layouts.app')]
class JobDetails extends Component
{
    public $job;

    public function mount($id)
    {
        $xmlUrl = 'https://mrge-group-gmbh.jobs.personio.de/xml';
        $xmlContent = file_get_contents($xmlUrl);

        if ($xmlContent === false) {
            abort(404, 'Job not found');
        }

        $xml = simplexml_load_string($xmlContent, 'SimpleXMLElement', LIBXML_NOCDATA);

        foreach ($xml->position as $position) {
            if ((string) $position->id == $id) {
                $this->job = [
                    'id' => (string) $position->id,
                    'title' => (string) $position->name,
                    'location' => (string) $position->office,
                    'department' => (string) $position->department,
                    'employment_type' => (string) $position->employmentType,
                    'description' => trim((string) $position->jobDescriptions->jobDescription->value),
                    'url' => (string) $position->url,
                ];
                return;
            }
        }

        abort(404, 'Job not found');
    }
}
