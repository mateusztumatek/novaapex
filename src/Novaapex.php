<?php

namespace Mateusztumatek\Novaapex;

use Laravel\Nova\Card;
use Laravel\Nova\Http\Requests\NovaRequest;
use Laravel\Nova\Nova;

abstract class Novaapex extends Card
{
    /**
     * The width of the card (1/3, 1/2, or full).
     *
     * @var string
     */
    public $width = '2/3';

    public $height = '400px';

    public $date_picker_available = false;

    public function __construct($component = null)
    {
        parent::__construct($component);
        $request = app()->make(NovaRequest::class);
        $this->withMeta([
            'date_picker_available' => $this->date_picker_available,
            'series' => $this->series($request, $this->getDateToSeries()),
            'options' => $this->options($request),
            'darkModeOptions' => (method_exists($this, 'darkModeOptions'))
                    ? array_merge($this->options($request), $this->darkModeOptions())
                    : null,
            'type' => $this->type($request),
            'dateRange' => (method_exists($this, 'defaultDateRange'))? $this->defaultDateRange($request) : null,
            'key' => get_class($this)
        ]);
    }

    /**
     * Get the component name for the element.
     *
     * @return string
     */
    public function component()
    {
        return 'novaapex';
    }

    abstract public function series(NovaRequest $request, array $dateRange = []) : array;

    abstract public function options(NovaRequest $request) : array;

    abstract public function type(NovaRequest $request) : string;

    protected function getDateToSeries(){
        if(!method_exists($this, 'defaultDateRange')) return [];
        return request()->date ?? $this->defaultDateRange(app()->make(NovaRequest::class)) ?? [];
    }
}
