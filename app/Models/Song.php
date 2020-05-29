<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Song
 *
 * @property int $id
 * @property string $name
 * @property string|null $other_name
 * @property string $thumbnail
 * @property string $url
 * @property string $year
 * @property int $views
 * @property int $category_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|Artist[] $artists
 * @property-read int|null $artists_count
 * @property-read Category $category
 * @property-read string $slug
 * @method static Builder|Song newModelQuery()
 * @method static Builder|Song newQuery()
 * @method static Builder|Song query()
 * @method static Builder|Song search($name)
 * @method static Builder|Song whereCategoryId($value)
 * @method static Builder|Song whereCreatedAt($value)
 * @method static Builder|Song whereId($value)
 * @method static Builder|Song whereName($value)
 * @method static Builder|Song whereOtherName($value)
 * @method static Builder|Song whereThumbnail($value)
 * @method static Builder|Song whereUpdatedAt($value)
 * @method static Builder|Song whereUrl($value)
 * @method static Builder|Song whereViews($value)
 * @method static Builder|Song whereYear($value)
 * @mixin \Eloquent
 * @property string $country
 * @property-read string $views_formatted
 * @method static Builder|Song whereCountry($value)
 */
class Song extends Model
{
    /**
     * @var string[]
     */
    protected $fillable = [
        'name', 'other_name', 'thumbnail', 'url', 'year', 'views', 'country',
    ];

    /**
     * @var string[]
     */
    protected $hidden = [
        'category_id'
    ];

    /**
     * Tạo dựng mối quan hệ với bảng thể loại
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * Tạo dựng mối quan hệ với bảng nghệ sĩ
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function artists()
    {
        return $this->belongsToMany(Artist::class);
    }

    /**
     * Gán thể loại cho bài hát
     * @param string $category
     * @return $this
     */
    public function setCategory(string $category): Song
    {
        $category = Category::whereName($category)->first();

        $this->category()->associate($category);

        $this->save();

        return $this;
    }

    /**
     * Gán ca sĩ vào bài hát
     * @param array $artists
     * @return $this
     */
    public function setArtist(...$artists): Song
    {
        $artists = collect($artists)
            ->flatten()
            ->map(function ($artist) {
                if (empty($artist)) {
                    return false;
                }
                return Artist::whereName($artist)->first();
            })
            ->filter(function ($artist) {
                return $artist instanceof Artist;
            })
            ->map->id
            ->all();

        $this->artists()->sync($artists);

        return $this;
    }

    /**
     * Xóa bỏ dấu cách và dấu trong câu
     * @return string
     * @noinspection PhpUnused
     */
    public function getSlugAttribute(): string
    {
        return \Str::slug($this->name, '-', 'vi');
    }


    /** @noinspection PhpUnused */
    /**
     * Tìm kiếm $name trong bảng Songs(name, other_name), Category(name) và Artists(name) và trả về kết quả phù hợp
     * @param Builder $query
     * @param string $name
     * @return Builder
     */
    public function scopeSearch(Builder $query, string $name): Builder
    {
        return $query->where('name', 'LIKE', "%$name%")
            ->orWhere('other_name', 'LIKE', "%$name%")
            ->orWhereHas('category', function (Builder $query) use ($name) {
                return $query->where('name', 'LIKE', "%$name%");
            })
            ->orWhereHas('artists', function (Builder $query) use ($name) {
                return $query->where('name', 'LIKE', "%$name%");
            });
    }

    /**
     * @noinspection PhpUnused
     */
    public function setThumbnailAttribute(string $url)
    {
        $this->attributes['thumbnail'] = \Str::of($url)->replace(\Storage::url(''), '');
    }

    /**
     * @noinspection PhpUnused
     */
    public function setUrlAttribute(string $url)
    {
        $this->attributes['url'] = \Str::of($url)->replace(\Storage::url(''), '');
    }

    /** @noinspection PhpUnused */
    public function getViewsFormattedAttribute(): string
    {
        $numberFormater = new \NumberFormatter('vi-VN', \NumberFormatter::DECIMAL);
        return $numberFormater->format($this->views);
    }
}
