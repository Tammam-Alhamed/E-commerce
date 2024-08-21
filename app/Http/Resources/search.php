<?php

namespace App\Http\Resources;

use App\Models\size;
use App\Models\color;
use App\Models\image;
use Illuminate\Http\Resources\Json\JsonResource;

class search extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        // return parent::toArray($request);
        foreach([$this] as $item){ 
            $images = image::where('images_items'  , $item->items_id)->get();
        }
        foreach([$this] as $item){ 
            $colors = color::where('colors_items'  , $item->items_id)->get();
        }
        foreach([$this] as $item){ 
            $sizes = size::where('sizes_items'  , $item->items_id)->get();
        }
        return [
            'size' => sizesItems::collection($sizes),
            'color' => colorsItems::collection($colors),
            'image' => imagesItems::collection($images) , 
            'itemspricedisount' => "$this->itemspricedisount",
            'itemspricedisount_d' => "$this->itemspricedisount_d",
            'items_id' => "$this->items_id",
            'items_cat' => "$this->items_cat",
            'items_name' => $this->items_name,
            'items_name_ar' => $this->items_name_ar,
            'items_name_ru' => $this->items_name_ru,
            'items_desc' => $this->items_desc,
            'items_desc_ru' => $this->items_desc_ru,
            'items_image_main' => "$this->items_image_main",
            'items_active' => "$this->items_active",
            'items_price' => "$this->items_price",
            'items_price_d' => "$this->items_price_d",
            'items_discount' => "$this->items_discount",
            'items_date' => "$this->items_date",
            'items_delay' => "$this->items_delay",
            'items_status' => "$this->items_status",
            'items_filter' => "$this->items_filter",
            'items_sold' => "$this->items_sold",
            'categories_id' => "$this->categories_id",
            'categories_shope' => "$this->categories_shope",
            'categories_name' => $this->categories_name,
            'categories_name_ar' => $this->categories_name_ar,
            'categories_name_ru' => $this->categories_name_ru,
            'categories_image' => "$this->categories_image",
            'categories_datetime' => "$this->categories_datetime",
            'itemsprice' => "$this->itemsprice",  
        ];
    }
}
