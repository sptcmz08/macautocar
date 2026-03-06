<?php

namespace App\Http\Controllers;

use App\Models\CarImage;
use Illuminate\Support\Facades\Storage;

class CarImageController extends Controller
{
    public function destroy(CarImage $carImage)
    {
        // Delete the file from storage
        Storage::disk('public')->delete($carImage->path);

        // Delete the record
        $carImage->delete();

        return redirect()->route('dashboard')->with('success', 'ลบรูปภาพเรียบร้อยแล้ว');
    }
}
