<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class YoutubeVideo extends Model
{
    protected $fillable = [
        'folder',
        'name',
        'description',
        'link',
    ];

    protected $appends = [
        'video_id',
        'embed_url',
        'image_url',
    ];

    public static function extractVideoId(?string $url): ?string
    {
        if (! is_string($url) || filter_var($url, FILTER_VALIDATE_URL) === false) {
            return null;
        }

        $parts = parse_url($url);

        if (! is_array($parts)
            || ! in_array(strtolower($parts['scheme'] ?? ''), ['http', 'https'], true)
            || isset($parts['user'])
            || isset($parts['pass'])
            || isset($parts['port'])) {
            return null;
        }

        $host = strtolower($parts['host'] ?? '');
        $path = trim($parts['path'] ?? '', '/');
        $videoId = null;

        if ($host === 'youtu.be' || $host === 'www.youtu.be') {
            $videoId = explode('/', $path)[0] ?? null;
        } elseif (in_array($host, ['youtube.com', 'www.youtube.com', 'm.youtube.com', 'music.youtube.com'], true)) {
            if ($path === 'watch') {
                parse_str($parts['query'] ?? '', $query);
                $videoId = $query['v'] ?? null;
            } elseif (preg_match('~^(?:embed|shorts|live)/([^/]+)$~', $path, $matches)) {
                $videoId = $matches[1];
            }
        }

        return is_string($videoId) && preg_match('/^[A-Za-z0-9_-]{11}$/', $videoId)
            ? $videoId
            : null;
    }

    public function getVideoIdAttribute(): ?string
    {
        return self::extractVideoId($this->link);
    }

    public function getEmbedUrlAttribute(): ?string
    {
        return $this->video_id
            ? 'https://www.youtube-nocookie.com/embed/'.$this->video_id
            : null;
    }

    public function getImageUrlAttribute(): ?string
    {
        if (! is_string($this->folder) || $this->folder === '') {
            return null;
        }

        if (! str_starts_with($this->folder, 'youtube-videos/images/')) {
            return null;
        }

        return Storage::disk('public')->exists($this->folder)
            ? Storage::disk('public')->url($this->folder)
            : null;
    }
}
