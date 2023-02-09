<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\ProjectStoreRequest;
use App\Models\Project;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function store(ProjectStoreRequest $request)
    {
        $project = Project::query()->create([
            'title' => $request->project_name
        ]);

        return response()->json($project, 200);
    }
}
