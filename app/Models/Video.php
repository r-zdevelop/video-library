<?php

namespace App\Models;

use App\Constants\AppConstants;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\App;

class Video extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'description', 'url', 'views'];

    /**
     * get videos by search term
     */
    public static function scopeSearch($search, $pagination = AppConstants::DEFAULT_PAGINATION)
    {
        return Video::when($search, function ($query, $search) {
            $matchedVideos = $query->where('title', 'like', "%{$search}%")
                ->orWhere('description', 'like', "%{$search}%");  // Get the matched videos to increment search_count

            // Increment search_count for each matched video
            foreach ($matchedVideos->get() as $video) {
                $video->increment('search_count');
            }

            return $matchedVideos;  // Return the collection of matched videos
        })
            ->paginate($pagination); // Adjust the number per page as needed
    }
}
