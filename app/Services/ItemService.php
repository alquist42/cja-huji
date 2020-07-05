<?php


namespace App\Services;

use App\Models\Copyright;
use App\Models\Date;
use App\Models\Item;
use App\Models\Taxonomy\Maker;
use Illuminate\Database\Eloquent\Model;

class ItemService
{
    /**
     * @var Item
     */
    private $item;

    public function __construct(Item $item)
    {
        $this->item = $item;
    }

    /**
     * Save the item using provided data.
     *
     * @param array $data
     * @return Item
     */
    public function saveItem(array $data)
    {
        $this->item->update($this->prepareHasOneRelations($data['item']));
        $this->updateTaxonomy($data['taxonomy']);

        return $this->item;
    }

    /**
     *  Convert data used in the 'HasOne' relations.
     *
     * @param array $data
     * @return array
     */
    private function prepareHasOneRelations(array $data)
    {
        $relationsMap = [
            [
                'model'       => Date::class,
                'field'       => 'date',
                'object_name' => 'creation_date',
            ],
            [
                'model'       => Date::class,
                'field'       => 'reconstruction_dates',
                'object_name' => 'reconstruction_dates_object',
            ],
            [
                'model'       => Date::class,
                'field'       => 'activity_dates',
                'object_name' => 'activity_dates_object',
            ],
            [
                'model'       => Copyright::class,
                'field'       => 'copyright_id',
                'object_name' => 'copyright',
            ],
        ];

        foreach ($relationsMap as $relation) {
            /** @var Model $model */
            $model = $relation['model'];
            $field = $relation['field'];
            $value = $data[$relation['object_name']];

            if (is_array($value)) {
                $value = $value['id'];
            } elseif (is_string($value)) {
                $date = $model::firstOrCreate(['name' => $value]);
                $value = $date->id;
            } else {
                $value = null;
            }

            $data[$field] = $value;
        }

        return $data;
    }

    /**
     *  Convert data used in the 'makers' taxon.
     *
     * @param array $data
     * @return array
     */
    private function processMakersTaxon(array $data)
    {
        $makersData = $data['makers'];
        $makers = [];

        foreach ($makersData as $makerData) {
            if (isset($makerData['id'])) {
                $makers[] = ['id' => $makerData['id']];
            } else {
                $maker = Maker::firstOrCreate([
                    'maker_name_id' => $makerData['artist']['id'],
                    'maker_profession_id' => $makerData['profession']['id'],
                ]);
                $makers[] = ['id' => $maker->id];
            }
        }

        $data['makers'] = $makers;

        return $data;
    }

    /**
     * Sync taxonomy items.
     *
     * @param array $data
     */
    private function updateTaxonomy(array $data)
    {
        $data = $this->processMakersTaxon($data);

        $taxons = [
            'locations',
            'origins',
            'schools',
            'subjects',
            'objects',
            'historical_origins',
            'periods',
            'collections',
            'communities',
            'sites',
            'makers',
        ];

        foreach ($taxons as $taxon) {
            $items = [];
            foreach ($data[$taxon] as $taxonData) {
                $items[$taxonData['id']] = ['entity_type' => 'set'];
            }

            $this->item->$taxon()->sync($items);
        }
    }
}
