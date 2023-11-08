<?php

namespace Mateusztumatek\Novaapex\Contracts;

use Laravel\Nova\Http\Requests\NovaRequest;

interface HasDefaultDateRange{
    public function defaultDateRange(NovaRequest $request) : array;
}
