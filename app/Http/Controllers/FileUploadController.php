<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\FileUpload;
use Illuminate\Http\File;
use Illuminate\Routing\Redirector;
use Illuminate\Http\Request;

class FileUploadController extends Controller
{
    public function index()
    {
        return view('test.file');
    }

    public function fileUpload(Request $request)
    {
        
    }
}