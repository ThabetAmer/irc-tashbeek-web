<?php

namespace App\Models\MediaTrait;

use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Spatie\MediaLibrary\Models\Media;

/**
 * Trait MediaFunctionality.
 */
trait MediaFunctionality
{

    use HasMediaTrait;

    public function getAllAttachmentsAttribute($object = false, $collectionName = null)
    {
        if (is_null($collectionName)) {
            $collectionName = $this->collectionName;
        }
        $media = $this->getMedia($collectionName);
        if ($object) {
            return $media;
        }

        $links = [];
        foreach ($media as $singleMedia) {
            $links[] = ['url' => $singleMedia->getUrl(), 'name' => $singleMedia->file_name, 'size' => $singleMedia->size, 'type' => $singleMedia->mime_type];
        }
        return $links;
    }


    public function saveAttachments($attachments = ['file'], $collectionName = null, $diskName = 'upload')
    {
        if ($attachments) {

            if (!is_array($attachments)) {
                $attachments = [$attachments];
            }

            if (is_null($collectionName)) {
                $collectionName = $this->collectionName;
            }
            if ($collectionName and \Request::has($attachments)) {

                $media = $this
                    ->addMultipleMediaFromRequest($attachments)
                    ->each(function ($fileAdder) use ($diskName, $collectionName) {
                        $fileAdder->toMediaCollection($collectionName, $diskName);
                    });

                return $media;
            }
        }
        return null;
    }


    public function deleteFile($modelId, $modelType, $collectionName = null)
    {

        $media = Media::query()
            ->where('model_id', $modelId)
            ->where('model_type', $modelType)
            ->when($collectionName, function ($query) use ($collectionName) {
                return $query
                    ->where('collection_name', $collectionName);

            })
            ->first();


        if ($media) {
            $media->delete();
        }

    }

    public function downloadFile($mediaName, $modelId, $modelType)
    {

        return Media::query()
            ->where('file_name', $mediaName)
            ->where('model_id', $modelId)
            ->where('model_type', $modelType)
            ->first();
    }


    public function hasFile($modelId, $modelType, $collectionName = null)
    {

        $media = Media::query()
            ->where('model_id', $modelId)
            ->where('model_type', $modelType)
            ->when($collectionName, function ($query) use ($collectionName) {
                return $query
                    ->where('collection_name', $collectionName);
            })
            ->first();

        if ($media) {
            return true;
        }

        return false;
    }


}
