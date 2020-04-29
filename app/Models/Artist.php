<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Artist
 *
 * @property int $id
 * @property string $name
 * @property string $avatar
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Song[] $songs
 * @property-read int|null $songs_count
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Artist newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Artist newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Artist query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Artist whereAvatar($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Artist whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Artist whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Artist whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Artist whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Artist extends Model
{
    protected $fillable = [
        'name', 'avatar'
    ];

    public function songs() {
        return $this->belongsToMany(Song::class);
    }
}
