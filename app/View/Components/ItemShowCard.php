<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class ItemShowCard extends Component
{
    public string $title;
    public string $urlEdit;
    public string $urlDelete;
    public string $itemId;

    /**
     * Create a new component instance.
     *
     * @param string $title
     * @param string $urlEdit
     * @param string $urlDelete
     * @param string $itemId
     */
    public function __construct(
        string $title,
        string $urlEdit,
        string $urlDelete,
        string $itemId
    ) {
        $this->title = $title;
        $this->urlEdit = $urlEdit;
        $this->urlDelete = $urlDelete;
        $this->itemId = $itemId;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.item-show-card');
    }
}
