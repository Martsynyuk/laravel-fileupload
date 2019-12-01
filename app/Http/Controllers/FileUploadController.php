<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\FileUpload;
use Illuminate\Http\File;
use Illuminate\Routing\Redirector;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use resources\libs\SimpleXLSX;

class FileUploadController extends Controller
{
    public function index()
    {
        return view('test.file');
    }

    public function fileUpload(Request $request)
    {
        /**
         * Illuminate\Support\Facades\Validator $validator
         */
        $validator = $this->customValidator($request);
        $validator->validate();

        if ($validator->fails()) {
            return view('test.file', ['errors' => $validator->errors()] );
        }

        $xslx = new SimpleXLSX($request->file('file')->get());
        $model = new FileUpload();
        $model->multiInsert($xslx);
    }

    protected function customValidator(Request $request)
    {
        return Validator::make($request->all(), $this->rules(), $this->messages());
    }

    public function rules() {
        return [
            'file' => 'mimes:xlsx|
            mimetypes:application/vnd.openxmlformats-officedocument.spreadsheetml.sheet|
            file|
            max:10240',
        ];
    }
    public function messages()
    {
        return [
            'file.mimes' => "file should be xlsx",
            'file.max' => "maximum file size to upload is 10MB (10240 KB)",
            'file.mimetypes' => "wrong mime types",
            'file.file' => 'file uploads fail'
        ];
    }
}