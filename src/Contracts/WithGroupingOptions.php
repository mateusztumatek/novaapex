<?php

namespace Mateusztumatek\Novaapex\Contracts;

use Laravel\Nova\Http\Requests\NovaRequest;

interface WithGroupingOptions{

    public function defaultGroupOption(NovaRequest $request) : mixed;

    public function groupOptions(NovaRequest $request) : array;
}
