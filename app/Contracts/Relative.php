<?php
namespace App\Contracts;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
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
