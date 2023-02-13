<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Table extends Component
{
    private $headers;
    private $body;
    private $action;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($action, $headers, $body)
    {
        $this->action = $action;
        $this->headers = $headers;
        $this->body = $body;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.table.' . $this->action, [
            'headers' => $this->headers,
            'body' => $this->body
        ]);
    }

}
