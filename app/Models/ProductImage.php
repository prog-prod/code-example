<?php

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property int $id
 * @property int $product_id
 * @property int $user_id
 * @property bool $main
 * @property string $filename
 * @property int|null $color_id
 * @property int $order
 * @property string $sm_filename
 * @property string $md_filename
 * @property string $lg_filename
 * @property-read string $basename
 * @property-read Product $product
 * @property-read User $user
 * @property-read Color|null $color
 *
 * @method static Builder|ProductImage whereId($value)
 * @method static Builder|ProductImage whereProductId($value)
 * @method static Builder|ProductImage whereUserId($value)
 * @method static Builder|ProductImage whereMain($value)
 * @method static Builder|ProductImage whereFilename($value)
 * @method static Builder|ProductImage whereColorId($value)
 * @method static Builder|ProductImage whereOrder($value)
 * @method static Builder|ProductImage whereSmFilename($value)
 * @method static Builder|ProductImage whereMdFilename($value)
 * @method static Builder|ProductImage whereLgFilename($value)
 *
 * @mixin Eloquent
 */
class ProductImage extends Model
{
    use HasFactory;

    protected $fillable = [
        "product_id",
        "user_id",
        "main",
        "filename",
        "color_id",
        "order",
        "sm_filename",
        "md_filename",
        "lg_filename",
    ];

    public function getBasenameAttribute(): string
    {
        return basename($this->filename);
    }

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function color(): BelongsTo
    {
        return $this->belongsTo(Color::class);
    }
}
