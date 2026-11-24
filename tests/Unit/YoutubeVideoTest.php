<?php

use App\Models\YoutubeVideo;
use Illuminate\Support\Facades\Storage;

it('extracts video ids from supported youtube links', function (string $url, string $videoId) {
    expect(YoutubeVideo::extractVideoId($url))->toBe($videoId);
})->with([
    ['https://www.youtube.com/watch?v=dQw4w9WgXcQ', 'dQw4w9WgXcQ'],
    ['https://youtu.be/dQw4w9WgXcQ?t=10', 'dQw4w9WgXcQ'],
    ['https://youtube.com/shorts/dQw4w9WgXcQ', 'dQw4w9WgXcQ'],
    ['https://www.youtube.com/live/dQw4w9WgXcQ', 'dQw4w9WgXcQ'],
    ['https://www.youtube.com/embed/dQw4w9WgXcQ', 'dQw4w9WgXcQ'],
]);

it('rejects links that are not valid youtube videos', function () {
    expect(YoutubeVideo::extractVideoId('https://example.com/watch?v=dQw4w9WgXcQ'))->toBeNull()
        ->and(YoutubeVideo::extractVideoId('javascript:alert(1)'))->toBeNull()
        ->and(YoutubeVideo::extractVideoId('https://youtu.be/invalid'))->toBeNull();
});

it('provides a privacy-enhanced embed url', function () {
    $video = new YoutubeVideo(['link' => 'https://youtu.be/dQw4w9WgXcQ']);

    expect($video->embed_url)->toBe('https://www.youtube-nocookie.com/embed/dQw4w9WgXcQ');
});

it('provides the public url for an uploaded cover image', function () {
    Storage::fake('public');
    $path = 'youtube-videos/images/cover.jpg';
    Storage::disk('public')->put($path, 'image');
    $video = new YoutubeVideo(['folder' => $path]);

    expect($video->image_url)->toBe(Storage::disk('public')->url($path));
});
