<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ImageProxyController extends Controller
{
    public function loadExternalImage(Request $request)
    {
    
        try {
            $imageUrl = $request->input('url');
    
            if (filter_var($imageUrl, FILTER_VALIDATE_URL)) {
                $ch = curl_init($imageUrl);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                $imageContents = curl_exec($ch);
                $contentType = curl_getinfo($ch, CURLINFO_CONTENT_TYPE);
                curl_close($ch);
    
                return response($imageContents)->header('Content-Type', $contentType);
            }
        } catch (\Exception $e) {
            return $e;
        }
    }
}
