<?php
namespace Mateusztumatek\Novaapex\Http\Controllers;
use App\Http\Controllers\Controller;
use Mateusztumatek\Novaapex\Http\Requests\GetSeriesRequest;

class NovaapexController extends Controller {
    public function getSeries(GetSeriesRequest $request){
        return response()->json($request->getInstance());
    }
}
