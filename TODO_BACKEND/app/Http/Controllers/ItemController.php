<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;
use Illuminate\Support\Carbon;

class ItemController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Item::orderBy('created_at', 'desc')->get();
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'description' => 'required|string|max:255',
            'completed' => 'nullable|boolean',
        ]);
        $newItems = Item::create($request->all());
        return $newItems;
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $items = Item::find($id);
        if($items) {
            return $items;
        }
        return "Items not Found";
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $existingItem = Item::find($id);
        if($existingItem){
            $request->validate([
                'description' => 'required|string|max:255',
                'completed' => 'nullable|boolean',
            ]);
            $existingItem->update($request->all());
            return "Item updated successfully";
        }
        return "Item not found";
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $existingItem = Item::find($id);
        if($existingItem) {
            $existingItem->delete();
            return "Item deleted successfully";
        }
        return "Item not found";
    }
}
