<?php

namespace App\Observers;

use App\Models\Artist;

class ArtistObserver
{
    /**
     * Khi xóa ca sĩ thì sẽ xóa những bài hát của ca sĩ này
     * @param Artist $artist Ca sĩ
     */
    public function deleting(Artist $artist)
    {
        $artist->songs()->delete();
    }
}
