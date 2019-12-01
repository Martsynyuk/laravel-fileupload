<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use resources\libs\SimpleXLSX;

class FileUpload extends Model
{
    protected $table = 'file_uploads';
    protected $primaryKey = 'id';
    private $fields = [
        'Рубрика' => 'department',
        'Рубрика1' => 'type',
        'Категория товара' => 'category',
        'Производитель' => 'brand',
        'Наименование товара' => 'name',
        'Код модели (артикул производителя)' => 'sku',
        'Описание товара' => 'description',
        'Цена розн., грн.' => 'price',
        'Гарантия' => 'warranty',
        'Наличие' => 'stock_status',
    ];

    public function multiInsert(SimpleXLSX $object)
    {
        $data = [];
        $count = 1;

        foreach( $object->rows() as $array) {
            $arr = [];

            foreach ($array as $key => $item) {
                if (array_key_exists($key, $this->fields)) {
                    $arr[$this->fields[$key]] = $item;
                }
            }

            $count++;
            $data[] = $arr;

            if ($count >= 5000) {
                DB::table($this->table)->insert($data);
                $data = [];
            }
        }
    }
}
