<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

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

    /**
     * Tạo dựng mối quan hệ với bảng nghệ sĩ
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function artists() {
        return $this->belongsToMany(Artist::class);
    }

    public function setCategory(string $category): Song {
        $category = Category::whereName($category)->first();

        $this->category()->associate($category);

        $this->save();

        return $this;
    }

    /**
     * Gán ca sĩ vào bài hát
     * @param mixed ...$artists
     * @return $this
     */
    public function setArtist(...$artists): Song {
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
}
