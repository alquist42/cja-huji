<?php
namespace App\Contracts;

/**
 * Interface CatalogRelatives
 */
interface RelativesService
{
    /**
     * Update model relatives (parent and children)
     *
     * @param  Relative  $model
     * @param  array  $relatives
     */
    public function updateRelatives(Relative $model, array $relatives);
    /**
     * Update model parent (changes parent to a new one)
     *
     * @param  Relative  $child
     * @param  string  $parentId
     */
    public function updateParent(Relative $child, $parentId);
    /**
     * Update model children (removes all current children from relation and assigns new ones)
     *
     * @param  Relative  $parent
     * @param  array  $childrenIds
     */
    public function updateChildren(Relative $parent, array $childrenIds);
}
