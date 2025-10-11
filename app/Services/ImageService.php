<?php

namespace App\Services;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

class ImageService
{
    protected ImageManager $manager;

    public function __construct()
    {
        $this->manager = new ImageManager(new Driver());
    }

    /**
     * Optimize and save an uploaded image
     *
     * @param UploadedFile $file
     * @param string $directory Directory to save in (e.g., 'avatars', 'posts')
     * @param int|null $maxWidth Maximum width (null for original)
     * @param int|null $maxHeight Maximum height (null for original)
     * @param int $quality Quality percentage (1-100)
     * @param bool $createThumbnail Whether to create a thumbnail
     * @return array ['path' => string, 'thumbnail' => string|null]
     */
    public function optimizeAndSave(
        UploadedFile $file,
        string $directory,
        ?int $maxWidth = null,
        ?int $maxHeight = null,
        int $quality = 85,
        bool $createThumbnail = false
    ): array {
        // Read the uploaded image
        $image = $this->manager->read($file->getRealPath());

        // Resize if dimensions specified
        if ($maxWidth || $maxHeight) {
            $image->scale(width: $maxWidth, height: $maxHeight);
        }

        // Generate unique filename
        $filename = uniqid() . '_' . time() . '.webp';
        $path = $directory . '/' . $filename;

        // Encode to WebP with quality
        $encoded = $image->toWebp($quality);

        // Save to storage
        Storage::disk('public')->put($path, $encoded);

        $result = ['path' => $path, 'thumbnail' => null];

        // Create thumbnail if requested
        if ($createThumbnail) {
            $thumbnailImage = $this->manager->read($file->getRealPath());
            $thumbnailImage->scale(width: 300, height: 300);
            
            $thumbnailFilename = 'thumb_' . $filename;
            $thumbnailPath = $directory . '/' . $thumbnailFilename;
            
            $thumbnailEncoded = $thumbnailImage->toWebp($quality);
            Storage::disk('public')->put($thumbnailPath, $thumbnailEncoded);
            
            $result['thumbnail'] = $thumbnailPath;
        }

        return $result;
    }

    /**
     * Optimize avatar image (square crop)
     *
     * @param UploadedFile $file
     * @param int $size Size for square avatar (default 200)
     * @return string Path to saved avatar
     */
    public function optimizeAvatar(UploadedFile $file, int $size = 200): string
    {
        $image = $this->manager->read($file->getRealPath());

        // Cover the size (crop to square)
        $image->cover($size, $size);

        // Generate unique filename
        $filename = 'avatar_' . uniqid() . '_' . time() . '.webp';
        $path = 'avatars/' . $filename;

        // Encode to WebP with 85% quality
        $encoded = $image->toWebp(85);

        // Save to storage
        Storage::disk('public')->put($path, $encoded);

        return $path;
    }

    /**
     * Optimize post featured image
     *
     * @param UploadedFile $file
     * @return array ['path' => string, 'thumbnail' => string]
     */
    public function optimizePostImage(UploadedFile $file): array
    {
        // Main image: max 1200px width
        $mainImage = $this->manager->read($file->getRealPath());
        $mainImage->scale(width: 1200);

        $filename = 'post_' . uniqid() . '_' . time() . '.webp';
        $mainPath = 'posts/' . $filename;

        $mainEncoded = $mainImage->toWebp(85);
        Storage::disk('public')->put($mainPath, $mainEncoded);

        // Thumbnail: 300px width
        $thumbImage = $this->manager->read($file->getRealPath());
        $thumbImage->scale(width: 300);

        $thumbFilename = 'thumb_' . $filename;
        $thumbPath = 'posts/' . $thumbFilename;

        $thumbEncoded = $thumbImage->toWebp(80);
        Storage::disk('public')->put($thumbPath, $thumbEncoded);

        return [
            'path' => $mainPath,
            'thumbnail' => $thumbPath,
        ];
    }

    /**
     * Optimize team member photo (square)
     *
     * @param UploadedFile $file
     * @param int $size Size for square photo (default 400)
     * @return string Path to saved photo
     */
    public function optimizeTeamPhoto(UploadedFile $file, int $size = 400): string
    {
        $image = $this->manager->read($file->getRealPath());

        // Cover to square
        $image->cover($size, $size);

        $filename = 'team_' . uniqid() . '_' . time() . '.webp';
        $path = 'team/' . $filename;

        $encoded = $image->toWebp(85);
        Storage::disk('public')->put($path, $encoded);

        return $path;
    }

    /**
     * Delete an image and its thumbnail (if exists)
     *
     * @param string|null $path
     * @param string|null $thumbnailPath
     * @return void
     */
    public function delete(?string $path, ?string $thumbnailPath = null): void
    {
        if ($path && Storage::disk('public')->exists($path)) {
            Storage::disk('public')->delete($path);
        }

        if ($thumbnailPath && Storage::disk('public')->exists($thumbnailPath)) {
            Storage::disk('public')->delete($thumbnailPath);
        }
    }
}

