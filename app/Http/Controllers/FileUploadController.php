<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\FileUpload;

class FileUploadController extends Controller
{
    public function index()
    {
        return view('test.file');
    }
}