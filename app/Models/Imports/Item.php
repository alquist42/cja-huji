<?php
namespace App\Models\Imports;
use App\Models\Item;
use App\Importer\Importable;
use Futureecom\Utils\AuthGuard\Models\Tenancy;
use Illuminate\Support\Arr;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\In;
use Illuminate\Validation\ValidationException;
/**
 * Class Product
 */
class Items implements Importable
{
    /**
     * @var array
     */
    private $errors = [];

    /**
     * Items constructor.
     */
    public function __construct()
    {
    }
    /**
     * @return bool
     */
    public function hasErrors()
    {
        return count($this->errors) > 0;
    }
    /**
     * @return array
     */
    public function getErrors()
    {
        return $this->errors;
    }
    /**
     * @return array
     */
    public function requiredColumns()
    {
        return [
            'name', 'description'
        ];
    }
    /**
     * @param  Collection  $collection
     */
    public function import(Collection $collection)
    {
        $collection->each(function ($item, $key) {
            try {
                $this->validateItem($item);
                $this->createItem($item);
            } catch (ValidationException $e) {
                $this->errors[$key] = $e->errors();
            }
        });
        Item::fixTree();
    }
    /**
     * @param $item
     * @throws ValidationException
     */
    public function validateItem(array $item)
    {
//        Validator::make($item, [
//            'name' => 'required|string',
//            'brand' => 'required|string',
//            'taxonomy' => 'required|string',
//            'description' => 'nullable|string',
//            'price' => 'required|numeric|min:0',
//            'quantity' => 'required|numeric|min:0',
//            'is_available' => 'required|boolean',
//            'image_url' => 'required|string',
//        ])->validate();
    }
    /**
     * @param $item array
     */
    private function createItem(array $item)
    {
//        array_only($item, array('name', 'description', 'parent_id'))
        Item::create(array(
            "name" => $item['name'],
            "description" => $item['description'],
            "lat" => $item['geo_lat'],
            "lon" => $item['geo_lng'],
            "parent_id" => $item['parent_id'],
            "category" => $item['categ'],
        ));
    }
}
