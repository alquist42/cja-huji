<?php
namespace App\Contracts;

/**
 * Interface Relative
 * @property Collection parent
 * @property Collection children
 */
interface Relative
{
    /**
     * @return BelongsTo
     */
    public function parent();
    /**
     * @return HasMany
     */
    public function children();
}
