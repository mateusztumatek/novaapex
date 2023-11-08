<?php
namespace Mateusztumatek\Novaapex\Http\Requests;
use Illuminate\Foundation\Http\FormRequest;
use Mateusztumatek\Novaapex\Novaapex;

class GetSeriesRequest extends FormRequest {

    public function authorize(){
        return true;
    }

    public function rules() : array{
        return [
            'date' => ['array'],
            'date[0]' => ['string', 'datetime'],
            'date[1]' => ['string', 'datetime'],
            'key' => ['required', 'string']
        ];
    }

    public function getInstance() : Novaapex{
        return app()->make($this->key) ?? abort(404);
    }
}
