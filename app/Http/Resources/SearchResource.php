<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Models\Content\{Post, Project, Service};

class SearchResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'title' => $this->getTitle(),
            'description' => str($this->getDescription())->limit(50),
            'url' => $this->getUrl(),
            'type' => $this->getType(),
            'type_class' => $this->getTypeClass(),
        ];
    }

    private function getTitle()
    {
        return $this->title ?? $this->name;
    }

    private function getDescription()
    {
        return $this->summary ?? $this->description;
    }

    private function getUrl()
    {
        return match (get_class($this->resource)) {
            Post::class => route('blog.show',  $this->slug),
            Project::class => route('project.show', $this->id),
            Service::class => route('service.show', $this->id),
        };
    }

    private function getType()
    {
        return match (get_class($this->resource)) {
            Post::class => 'مقاله',
            Project::class => 'پروژه',
            Service::class => 'خدمات',
        };
    }

    private function getTypeClass()
    {
        return match (get_class($this->resource)) {
            Post::class => 'badge-primary',
            Project::class => 'badge-success',
            Service::class => 'badge-info',
        };
    }
}
