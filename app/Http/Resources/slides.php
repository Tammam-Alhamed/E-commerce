<?php

namespace App\Http\Resources;

use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Http\Resources\Json\JsonResource;

class slides extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|Arrayable|\JsonSerializable
     */
    public function toArray($request): array|\JsonSerializable|Arrayable
    {
        $data = parent::toArray($request);
        
        // Transform offers to include additional images and items
        if (isset($data['offers']) && is_array($data['offers'])) {
            foreach ($data['offers'] as &$offer) {
                // Process additional images
                if (isset($offer['additional_images']) && is_array($offer['additional_images'])) {
                    // Extract just the image names from additional_images
                    $offer['additional_images'] = array_map(function($image) {
                        return $image['images_name'] ?? $image;
                    }, $offer['additional_images']);
                }
                
                // Process items - they should already be properly formatted from the relationship
                if (isset($offer['items']) && is_array($offer['items'])) {
                    // Items are already loaded through the relationship, no additional processing needed
                    // The items will include their full data from the items table
                }
            }
        }
        
        return $data;
    }
}
