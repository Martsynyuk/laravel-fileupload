<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FileUpload extends Model
{
    protected $table = 'file_uploads';
    protected $primaryKey = 'id';

    /**
     * properties for file validation
     */
    private $file_headers_for_validation = [
        'Рубрика',
        'Рубрика1',
        'Категория товара',
        'Производитель',
        'Наименование товара',
        'Код модели (артикул производителя)',
        'Описание товара',
        'Цена розн., грн.',
        'Гарантия',
        'Наличие'
    ];
    private $maxFileSize = 1; // in mbytes
    private $fileExtension = '.xlsx';

    public function compareHeaders(array $headers) {
        if (!empty(array_diff($headers, $this->file_headers_for_validation))
            || !empty(array_diff($this->file_headers_for_validation, $headers))
        ) {
            return $this->returnHeaders();
        }

        return true;
    }

    public function maxFileSize($pathToFile)
    {
        if ($this->maxFileSize < round(filesize($pathToFile) / 1048576, 2)) {
            return 'File should be smaller than ' . $this->maxFileSize;
        }

        return true;
    }

    public function fileExpresion($pathToFile)
    {
        if (!$this->matches('/.*(' . $this->fileExtension . ')$/', $pathToFile)) {
            return 'File should be ' . $this->fileExtension;
        }

        return true;
    }

    public function fileMimeType($pathToFile) {
        return mime_content_type($pathToFile);
    }

    protected function matches($expresion, $object)
    {
        preg_match($expresion, $object, $match);

        if (!empty($match)) {
            return $match;
        }

        return false;
    }

    public function returnHeaders()
    {
        return implode(', ', $this->file_headers_for_validation);
    }
}
