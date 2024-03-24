<?php

namespace App\Http\Controllers;

use App\Http\Requests\AvatarRequest;
use Illuminate\Http\Request;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;
use App\Models\avatar;

class AvatarController extends Controller
{
    public function isBool($value)
    {
        if ($value == 'true') {
            return true;
        } else if ($value == 'false') {
            return false;
        }
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $avatars = Avatar::all();
        return response()->json($avatars, 200);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $isLocked = $this->isBool($request->isLocked);
        $eqquiped = $this->isBool($request->eqquiped);
        // $data = $converted->validated();
        // function isBoolean($value)
        // {
        //     if ($value) {
        //         return true;
        //     } else {
        //         return false;
        //     }
        // }

        $uploadedFile = $request->file('image');
        $uploadedImage = Cloudinary::upload($uploadedFile->getRealPath(), [
            'folder' => 'Resonance-Riddle',
        ]);

        $avatar = new avatar([
            'image' => $uploadedImage->getSecurePath(),
            'price' => $request->price,
            'isLocked' => $isLocked,
            'eqquiped' => $eqquiped,
            // 'price' => $data['price'],
            // 'isLocked' => isBoolean($data['isLocked']),
            // 'eqquiped' => isBoolean($data['eqquiped']),
        ]);
        $avatar->save();

        return response()->json(['message' => 'Avatar created successfully'], 201);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function getOne($id)
    {
        $avatar = Avatar::where('_id', $id)->first();
        return response()->json($avatar, 200);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(AvatarRequest $request, $id)
    {
        $data = $request->validated();
        $avatar = avatar::find($id);

        function isBooleanTwo($value)
        {
            if ($value) {
                return true;
            } else {
                return false;
            }
        }

        $uploadedFile = $request->file('image');
        $uploadedImage = Cloudinary::upload($uploadedFile->getRealPath(), [
            'folder' => 'Resonance-Riddle',
        ]);

        $avatar->image = $uploadedImage->getSecurePath();
        $avatar->price = $request->input('price');
        $avatar->isLocked = isBooleanTwo('isLocked');
        $avatar->eqquiped = isBooleanTwo('eqquiped');
        $avatar->update();

        return response()->json(['message' => 'Avatar updated successfully'], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $avatar = Avatar::findOrFail($id);
        $avatar->delete();

        return response()->json(['message' => 'Avatar deleted successfully'], 200);
    }
}
