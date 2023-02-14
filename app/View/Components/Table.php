<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Table extends Component
{
    private $headers;
    private $body;
    private $type;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($type, $headers, $body)
    {
        $this->type = $type;
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
        return view('components.table.' . $this->type, [
            'headers' => $this->headers,
            'body' => $this->body
        ]);
    }

}
