<?php
namespace App\Models\Imports;

use App\Importer\Importable;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
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
//            'name', 'description'
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
//        Origin::fixTree();
//        Subject::fixTree();
//        C::fixTree();
//        Community::fixTree();
//        Congregation::fixTree();
//        HistoricOrigin::fixTree();
//        Location::fixTree();
//        Maker::fixTree();
//        IObject::fixTree();
//        Period::fixTree();
//        Photographer::fixTree();
//        School::fixTree();
//        Site::fixTree();
//        Item::fixTree();
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
//        Item::create([
//            "id" => $item['id'],
//            "name" => $item['name'],
//            "description" => $item['description'],
//            "lat" => $item['geo_lat'],
//            "lon" => $item['geo_lng'],
//            "parent_id" => $item['parent_id'],
//            "category" => $item['categ'],
//
//            'short_description' => $item['short_description'],
//            'addenda' => $item['addenda'],
//
//
//            'geo_options' => $item['geo_options'],
//
//            'order' => 0,
//
//            'publish_state' => $item['publish_state'],
//            'publish_state_reason' => $item['publish_state_reason'],
//
//            'artifact_at_risk' => $item['artifact_at_risk'],
//            'parental_state' => $item['parental_status'],
//
//            'ntl' => $item['ntl'],
//            'ntl_localname' => $item['ntl_localname'],
//
//            'remarks' => $item['remarks'],
//        ]);

//        Image::create([
//            "id" => $item['id'],
//            "name" => $item['name'],
//            "description" => $item['description'],
//            "item_id" => $item['item_id'],
//            "visual_regions" => $item['visual_regions'],
//            "category" => $item['categ'],
//
//            'addenda' => $item['addenda'],
//
//
//            'nli_pickname' => $item['nli_picname'],
//
//            'order' => 0,
//
//            'publish_state' => $item['publish_state'],
//            'publish_state_reason' => $item['publish_state_reason'],
//
//            'negative_number' => $item['photo_negative_number'],
//
//            'copyright_id' => $item['copyright'],
//            'photographer_id' => $item['photographer'] == 'NULL' ? null : $item['photographer'],
//
//            'original' => 'http://lorempixel.com/800/600/cats/', //$item['original'],
//            'big' => 'http://lorempixel.com/800/600/cats/', //$item['big'],
//            'medium' => 'http://lorempixel.com/800/600/cats/', //$item['medium'],
//            'small' => 'http://lorempixel.com/800/600/cats/', //$item['small'],
//
//            'remarks' => $item['remarks'],
//        ]);

//        Site::create([
//            "id" => $item['id'],
//            "name" => $item['name'],
//            "description" => $item['description'],
//            "parent_id" => ($item['parent_id'] == -1) ? null : $item['parent_id'],
//            "order" => (empty($item['ordering']) || $item['ordering'] === 'NULL') ? 0 : $item['ordering']
//        ]);

        DB::table('item_collection')->insert([
            "item_id" => $item['item_id'],
            "collection_id" => $item['collection_id'],
            "details" => $item['details']
        ]);
    }
}
