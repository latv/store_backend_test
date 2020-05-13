<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Items;
use Exception;
use App\Http\Resources\Items as ItemsResource;
class ItemsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Get Items
        $items = Items::paginate(15);
        return ItemsResource::collection($items);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $items = $request->isMethod('put') ? Items::findOrFail($request->id) : new Items;
        $items->SKU = $request->input('SKU');
        $items->price = $request->input('price');
        $items->price = $request->input('price');
        $items->switcherNumber = $request->input('switcherNumber');
try {
        $items->save();
        return new ItemsResource($items);
}

catch (Exception $e) {
    return response()->json(['error' => $e -> getMessage()], 422);
}


    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function isValidSKU(Request $request)
    {
        $SKU = $request->input('SKU');
        try {
            Items::where('SKU',$SKU)->firstOrFail();
            return ['message'=> TRUE];
        } catch (Exception $e) {
            return ['message'=> FALSE];
        }


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
