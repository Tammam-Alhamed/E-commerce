<?php

namespace App\Http\Controllers;

use App\Models\item;
use App\Models\Offers;
use App\Models\slide;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OffersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\View\View
     */
    public function index($id)
    {
        $offers = DB::table('offers')->select('*')->where('offers_slide'  , $id)->get();
        $slide = slide::find($id);
//        $offers = offers::all()->where($id, "$id" == 'offers_slide');
        return view('admin.offers.index' , compact('offers' , 'slide'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\View\View
     */
    public function create($slideId)
    {
        $slide = slide::find($slideId);
        $items = item::all();
        return view('admin.offers.create',compact("slide" , 'items'));
    }
    public function editItems($offerId)
    {

        $offers = Offers::with('items')->find($offerId);
        $allItems = item::all();
        $itemOffers = DB::table("item_offers")->where('offers_id' , $offerId)->get();
        $images = DB::table('images_offers')->select('*')->where('images_offers'  , $offerId)->get();
        foreach ($offers->items as $item) {
            echo $item->item_name;
        }
        return view('admin.offers.edit_items' , compact('offers','allItems' ,"itemOffers",'images') );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws RandomException
     * @throws RandomException
     */
    public function store(Request $request)
    {
        $request->validate([
            'offers_name' => "required",
            'offers_price' => "required",
        ]);
        $files = $request->file('main_offers_image');
        $newphoto = random_int(min:50 , max:1000000).random_int(min:50 , max:1000000);
        $files->move('Bazar/offers', $newphoto);
        $offer = Offers::create([
            'offers_slide' => $request->offers_slide,
            'offers_name' => $request->offers_name,
            'offers_price' => $request->offers_price,
            'offers_image' => $newphoto,
        ]);
        $filename_multi = $request->file('offers_image');
        if ($filename_multi != null) {
            $file = array();
            $file = $request->offers_image;
            foreach($file as $files){
                // $items_image = $request->items_image;
                $newphoto = random_int(min:50 , max:1000000).random_int(min:50 , max:1000000);
                $files->move('Bazar/offers',$newphoto);
                DB::table('images_offers')->insert( [
                    'images_name'=>  $newphoto,
                    'images_offers' => $offer->offers_id
                    //you can put other insertion here
                ]);
            }
        }

        foreach ($request->input('items_id') as $item) {
            DB::table('item_offers')->insert([
                'items_id' => $item,
                'offers_id' => $offer->offers_id
            ]);
        }
        return redirect()->route('admin.offers.index',$request->offers_slide);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Offers  $offers
     * @return \Illuminate\Http\Response
     */
    public function show(Offers $offers)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Offers  $offers
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\View\View
     */
    public function edit($offer)
    {
//        $offers = Offers::with('items')->findOrFail($offer);
        $offers = Offers::with('items')->find($offer);
        foreach ($offers->items as $item) {

            echo $item->item_name;
        }

        return view('admin.offers.edit', compact('offers'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Offers $offers
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     * @throws \Throwable
     */
    public function update(Request $request, Offers $offers , $offer)
    {

        // Validate the request
        $validator = \Validator::make($request->all(), [
            'offers_name' => 'required|string|max:190',
            'offers_price' => 'required|numeric|min:0',
            'items_id' => 'required|array|min:1',
            'items_id.*' => 'exists:items,items_id',
            // 'offers_image.*' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'item_quantity.*' => 'nullable|integer|min:1'
        ]);

        if ($validator->fails()) {
            \Log::error('Validation failed:', $validator->errors()->toArray());
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        try {
            // Debug logging
            \Log::info('Update request data:', $request->all());
            \Log::info('Items ID type: ' . gettype($request->input('items_id')));
            \Log::info('Items ID value: ' . json_encode($request->input('items_id')));

            // Start database transaction
            DB::beginTransaction();

            // Update the offer basic information
            if ($request->hasFile('main_offers_image')) {
                $files = $request->file('main_offers_image');

                        $newphoto = random_int(min:50 , max:1000000).random_int(min:50 , max:1000000);
                        $files->move('Bazar/offers', $newphoto);
//                        $offers->update([
//                            'offers_slide' => $request->offers_slide,
//                            'offers_image' => $newphoto,
//                            'offers_name' => $request->offers_name,
//                            'offers_price' => $request->offers_price,
//                        ]);
                DB::table('offers')->where('offers_id',$offer)->update(
                    ['offers_slide' => $request->offers_slide,
                        'offers_image' => $newphoto,
                        'offers_name' => $request->offers_name,
                        'offers_price' => $request->offers_price,]
                );
            }else{
                $offers = DB::table('offers')->where('offers_id',$offer)->update(
                    ['offers_slide' => $request->offers_slide,
                    'offers_name' => $request->offers_name,
                    'offers_price' => $request->offers_price,]
                );
//                    $offers->update([
//                        'offers_slide' => $request->offers_slide,
//                        'offers_name' => $request->offers_name,
//                        'offers_price' => $request->offers_price,
//                    ]);


            }


            // Handle new images upload
            if ($request->hasFile('offers_image')) {
                $files = $request->file('offers_image');
                foreach ($files as $file) {
                    if ($file->isValid()) {
                        $newphoto = random_int(min:50 , max:1000000).random_int(min:50 , max:1000000);
                        $file->move('Bazar/offers', $newphoto);

                        DB::table('images_offers')->insert([
                            'images_name' => $newphoto,
                            'images_offers' => $offer
                        ]);
                    }
                }
            }

            // Update items relationship
            // First, remove all existing item associations
            DB::table('item_offers')->where('offers_id', $offer)->delete();

            // Then add new item associations with quantities
            $itemsId = $request->input('items_id');

            // Handle case where items_id might be a string or single value
            if (!is_array($itemsId)) {
                if (is_string($itemsId) && !empty($itemsId)) {
                    $itemsId = [$itemsId];
                } else {
                    \Log::error('Items ID is not an array: ' . gettype($itemsId));
                    throw new \Exception('Items ID must be an array');
                }
            }
            foreach ($itemsId as $itemId) {
                // Ensure itemId is a valid integer
                $itemId = (int) $itemId[0];
                $quantity = (int) $request->input("item_quantity.{$itemId}", 1);

                DB::table('item_offers')->insert([
                    'items_id' => $itemId,
                    'offers_id' => $offer,
                    'qua' => $quantity
                ]);
            }

            // Commit transaction
            DB::commit();

            // Flash success message
            flash()->success('تم تحديث العرض بنجاح', 'عملية ناجحة');

            return redirect()->back();

        } catch (\Exception $e) {
            // Rollback transaction on error
            DB::rollBack();

            // Log the error for debugging
            \Log::error('Error updating offer: ' . $e->getMessage());
            \Log::error('Request data: ' . json_encode($request->all()));
            \Log::error('Stack trace: ' . $e->getTraceAsString());

            // Flash error message
            flash()->error('حدث خطأ أثناء تحديث العرض: ' . $e->getMessage(), 'خطأ في العملية');

            return redirect()->back();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Offers  $offers
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Offers $offer)
    {
        if(!auth()->user()->has_access_to('delete',$offer))abort(403);
        $offer->delete();
        flash()->success('تم حذف التاغ بنجاح','عملية ناجحة');
        return redirect()->route('admin.offers.index');
    }
}
