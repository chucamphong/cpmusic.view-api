<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Song
 *
 * @property int $id
 * @property string $name
 * @property string $other_name
 * @property string $thumbnail
 * @property string $url
 * @property string $year
 * @property int $views
 * @property int $category_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Artist[] $artists
 * @property-read int|null $artists_count
 * @property-read \App\Models\Category $category
 * @property-read string $slug
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Song newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Song newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Song query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Song search($name)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Song whereCategoryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Song whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Song whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Song whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Song whereOtherName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Song whereThumbnail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Song whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Song whereUrl($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Song whereViews($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Song whereYear($value)
 * @mixin \Eloquent
 */
class Song extends Model
{
    protected $fillable = [
        'name', 'other_name', 'thumbnail', 'url', 'year', 'views',
    ];

    protected $hidden = [
        'category_id'
    ];

    /**
     * Tạo dựng mối quan hệ với bảng thể loại
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function category() {
        return $this->belongsTo(Category::class);
    }

    public function artists() {
        return $this->belongsToMany(Artist::class);
    }

    /**
     * Xóa bỏ dấu cách và dấu trong câu
     * @return string
     */
    public function getSlugAttribute(): string
    {
        return \Str::slug($this->name, '-', 'vi');
    }

    /** @noinspection PhpUnused */
    public function scopeSearch(Builder $query, string $name): Builder
    {
        return $query->where('name', 'LIKE', "%$name%")
            ->orWhere('other_name', 'LIKE', "%$name%")
            ->orWhereHas('category', function (Builder $query) use ($name) {
                return $query->where('name', 'LIKE', "%$name%");
            });
    }
}
