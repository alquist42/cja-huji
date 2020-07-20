<?php

namespace App\Http\Requests;

use App\Models\Item;
use Illuminate\Foundation\Http\FormRequest;

class PostItem extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            //
        ];
    }

    protected function prepareForValidation()
    {
        $defaultItem = [
            'name' => '',
            'ntl' => '',
            'description' => '',
            'addenda' => '',
            'publish_state' => Item::PUBLISH_STATE_NOT_PUBLISHED,
            'artifact_at_risk' => false,
            'creation_date' => null,
            'reconstruction_dates_object' => null,
            'activity_dates_object' => null,
            'copyright' => null,
        ];

        $data = $this->all();
        $data['item'] = $defaultItem;

        if ($this->has('item')) {
            $itemData = $this->input('item');
            foreach ($itemData as $key => $value) {
                if (!empty($itemData[$key])) {
                    $data['item'][$key] = $itemData[$key];
                }
            }
        }

        $this->replace($data);
    }
}
