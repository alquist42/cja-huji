<?php
namespace App\Services;
use Exception;
use App\Contracts\Relative;
use App\Contracts\RelativesService;
use App\Exceptions\ResourceRelationUpdateException;
use Illuminate\Support\Facades\Log;
use Illuminate\Database\Eloquent\Model;
/**
 * Class RelationRelatives
 */
class RelationRelatives implements RelativesService
{
    /**
     * @param  Relative|Model  $model
     * @param  array  $relatives
     * @throws ResourceRelationUpdateException
     */
    public function updateRelatives(Relative $model, array $relatives)
    {
        if (isset($relatives['parent_id'])) {
            $this->updateParent($model, $relatives['parent_id']);
        }
        if (isset($relatives['children_ids'])) {
            $this->updateChildren($model, $relatives['children_ids']);
        }
    }
    /**
     * @param  Relative|Model  $child
     * @param  string  $parentId
     * @throws ResourceRelationUpdateException
     */
    public function updateParent(Relative $child, $parentId)
    {
        try {
            $parentResource = $child->newQuery()->findOrFail($parentId);
            $child->parent()->associate($parentResource);
            $child->save();
        } catch (Exception $e) {
            Log::error($e->getMessage());
            throw new ResourceRelationUpdateException(sprintf('Failed to associate with parent %s.',
                class_basename($child)));
        }
    }
    /**
     * @param  Relative|Model  $parent
     * @param  array  $childrenIds
     * @throws ResourceRelationUpdateException
     */
    public function updateChildren(Relative $parent, array $childrenIds)
    {
        try {
            $this->detachChildren($parent);
            foreach ($childrenIds as $childId) {
                $child = $parent->newQuery()->findOrFail($childId);
                $parent->children()->save($child);
            }
        } catch (Exception $e) {
            Log::error($e->getMessage());
            throw new ResourceRelationUpdateException(sprintf('Failed to associate %s children.',
                class_basename($parent)));
        }
    }
    /**
     * @param  Relative|Model  $parent
     */
    private function detachChildren(Relative $parent)
    {
        foreach ($parent->children as $key => $child) {
            $child->parent()->dissociate();
            $child->save();
            $parent->children->forget($key);
        }
    }
}
