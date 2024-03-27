<?php

namespace Modules\CircleXO\App\View\Components;

use Illuminate\View\Component;
use Illuminate\View\View;
use ProtoneMedia\Splade\Components\Form;
use ProtoneMedia\Splade\Components\Form\InteractsWithFormElement;

class Recap extends Component
{
    use InteractsWithFormElement;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(
        public string $name = '',
        public string $vModel = '',
        public string $type = 'text',
        public string $label = '',
        public string $validationKey = '',
        public bool $showErrors = true,
        public string $prepend = '',
        public string $append = '',
        public string $help = '',
        public bool $alwaysEnablePrepend = false,
        public bool $alwaysEnableAppend = false,
        public bool $disabled = false,
    )
    {
        Form::allowAttribute($name);
    }

    public function isHidden(): bool
    {
        return $this->type === 'hidden';
    }



    /**
     * Get the view/contents that represent the component.
     */
    public function render(): View|string
    {
        return view('circle-xo::components.recap');
    }
}
