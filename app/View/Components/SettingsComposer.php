<?php

namespace App\View\Components;

use App\Models\Setting;
use Illuminate\View\Component;

class SettingsComposer extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(Setting $setting)
    {
        $this->setting = $setting;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.settings-composer');
    }
}
