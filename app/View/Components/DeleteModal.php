<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Str;
use Illuminate\View\Component;

class DeleteModal extends Component
{
    public string $label;
    public string $routeName;
    public string $paramName;

    /**
     * Create a new component instance.
     */
    public function __construct(public string $model)
    {
        $this->label = class_basename($model);
        $this->paramName = Str::snake($this->label);
        $this->routeName = Str::plural(Str::kebab($this->label)) . '.destroy';
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.delete-modal');
    }
}
