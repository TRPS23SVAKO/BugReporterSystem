<?php

namespace App\View\Components;

use App\Models\Project;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class SingleProject extends Component
{
    public Project $project;

    public function __construct(
        public int $projectId
    )
    {
        $this->project = Project::query()->select(['id', 'name', 'display_name', 'role_color'])->find($this->projectId);
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.single-project');
    }
}
