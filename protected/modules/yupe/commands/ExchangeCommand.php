<?php

/**
 * Class ExchangeCommand
 */
class ExchangeCommand extends \yupe\components\ConsoleCommand
{
    public $path     = '/root/yandex-disk/CS56/';
    public $pathSite = '/var/www/roman/data/www/centr-sadovoda.ru/upload/images/goods';
    public $fileName = 'cs56.xls';

    public function actionIndex()
    {
        $this->saveCategory($this->getCategory());
        $this->saveProduct($this->getProduct());
    }

    public function getId($db, $tableName, $id, $select = 'id')
    {
        return $db
            ->createCommand()
            ->select($select)
            ->from('{{'.$tableName.'}}')
            ->where('id=:id', [':id' => $id])
            ->queryRow();
    }

    public function saveCategory($data)
    {
        $db = Yii::app()->db;
        foreach ($data as $item) {
            $category = $this->getId($db, 'store_category', $item['id']);

            if ($category) {
                // Обновить
                $db
                    ->createCommand()
                    ->update('{{store_category}}', $item, 'id=:id', [':id'=>$item['id']]);
            } else {
                // Записать
                $item['slug'] = $this->convert($item['name']).'-'.rand(1, 10000);
                $db
                    ->createCommand()
                    ->insert('{{store_category}}', $item);
            }
        }
    }

    public function saveProduct($data)
    {
        $db = Yii::app()->db;
        foreach ($data as $item) {
            $category = $this->getId($db, 'store_product', $item['id']);

            if ($category) {
                // Обновить
                $db
                    ->createCommand()
                    ->update('{{store_product}}', $item, 'id=:id', [':id'=>$item['id']]);
            } else {
                // Записать
                $item['slug'] = $this->convert($item['name']).'-'.rand(1, 10000);
                $db
                    ->createCommand()
                    ->insert('{{store_product}}', $item);
            }
        }
    }

    /**
     * Получить массив категорий
     * @return array категории для записи в базу
     */
    public function getCategory()
    {
        $items = [];
        foreach ($this->getData() as $key => $item) {
            if (isset($item[1]) && (int)$item[1] === 1) {
                $items[$item[2]] = [
                    "id"          => $item[2],
                    "parent_id"   => ($item[3]===null) ? null : $item[3],
                    "name"        => $item[4],
                    "name_short"  => $item[4],
                    "description" => $item[5],
                    "image"       => $item[8],
                    "sort"        => $item[10],
                    // "color"    => $item[10],
                    "status"      => 1
                ];
            }
        }
        return $items;
    }

    /**
     * Вытаскивает основную информацию о товарах из файла xml
     * @return array массив данных о товаре
     */
    public function getProduct()
    {
        $items = [];
        foreach ($this->getData() as $key => $item) {
            if (isset($item[1]) && (int)$item[1] === 0) {
                $items[$item[2]] = [
                    "id"                  => trim($item[2]),
                    "name"                => trim($item[4]),
                    "title"               => trim($item[4]),
                    "price"               => str_replace(',', '.', $item[6]),
                    "price_opt"           => str_replace(',', '.', $item[7]),
                    "description"         => trim($item[5]),
                    "in_stock"            => 1,
                    "quantity"            => trim($item[8]),
                    "sku"                 => trim($item[2]),
                    "category_id"         => ($item[3]===null) ? 0 : $item[3],
                    "status"              => 1,
                    "position"            => trim($item[10]),
                    "image"               => $this->copyImg(trim($item[9])),
                    "create_time"         => date('Y-m-d H:i:s'),
                    "update_time"         => date('Y-m-d H:i:s'),
                    // "amount_package"   => trim($item[11]),
                    // "discount_price"   => trim($item[12]),
                    // "discount_rubles"  => trim($item[13]),
                    // "discount_percent" => trim($item[14]),
                    "meta_keywords"       => trim($item[15]),
                    // "manufac_id"       => $item[2],
                ];
            }
        }
        return $items;
    }

    public function getData()
    {
        $filePath = $this->path.$this->fileName;

        $reader = \PhpOffice\PhpSpreadsheet\IOFactory::createReader('Xls');
        $reader->setReadDataOnly(true);
        $spreadsheet = $reader->load($filePath);

        $worksheet = $spreadsheet->getActiveSheet();

        return $worksheet->toArray();
    }

    /**
     * Транслит строки
     * @param string $str необработанная строка
     * @return string строка в транслите
     */
    public function convert($str)
    {
        $tr = [
            "А"=>"a", "Б"=>"b", "В"=>"v", "Г"=>"g", "Д"=>"d", "Е"=>"e", "Ё"=>"e",
            "Ж"=>"j", "З"=>"z", "И"=>"i", "Й"=>"y", "К"=>"k", "Л"=>"l", "М"=>"m",
            "Н"=>"n", "О"=>"o", "П"=>"p", "Р"=>"r", "С"=>"s", "Т"=>"t", "У"=>"u",
            "Ф"=>"f", "Х"=>"h", "Ц"=>"ts", "Ч"=>"ch", "Ш"=>"sh", "Щ"=>"sch", "Ъ"=>"",
            "Ы"=>"i", "Ь"=>"j", "Э"=>"e", "Ю"=>"yu", "Я"=>"ya", "а"=>"a", "б"=>"b",
            "в"=>"v", "г"=>"g", "д"=>"d", "е"=>"e", "ё"=>"e", "ж"=>"j", "з"=>"z",
            "и"=>"i", "й"=>"y", "к"=>"k", "л"=>"l", "м"=>"m", "н"=>"n", "о"=>"o",
            "п"=>"p", "р"=>"r", "с"=>"s", "т"=>"t", "у"=>"u", "ф"=>"f", "х"=>"h",
            "ц"=>"ts", "ч"=>"ch", "ш"=>"sh", "щ"=>"sch", "ъ"=>"y", "ы"=>"i", "ь"=>"j",
            "э"=>"e", "ю"=>"yu", "я"=>"ya", " "=> "-", "."=> "", "/"=> "-", ","=>"-",
            "-"=>"-", "–"=>"-", "—"=>"-" ,"("=>"", ")"=>"", "["=>"", "]"=>"", "="=>"-", "+"=>"-",
            "*"=>"", "?"=>"", "\""=>"", "'"=>"", "&"=>"", "%"=>"", "#"=>"", "@"=>"",
            "!"=>"", ";"=>"", "№"=>"", "^"=>"", ":"=>"", "~"=>"", "\\"=>"", "«"=>"",
            "»"=>"", "`"=>"", "'"=>"",'a'=>'a','b'=>'b','c'=>'c','d'=>'d','e'=>'e',
            'f'=>'f','j'=>'j','h'=>'h','i'=>'i','j'=>'j','k'=>'k','l'=>'l','m'=>'m',
            'n'=>'n','o'=>'o','p'=>'p','q'=>'q','r'=>'r','s'=>'s','t'=>'t','u'=>'u',
            'v'=>'v','w'=>'w','x'=>'x','y'=>'y','z'=>'z','A'=>'a','B'=>'b','C'=>'c',
            'D'=>'d','E'=>'e','F'=>'f','J'=>'j','H'=>'h','I'=>'i','J'=>'j','K'=>'k',
            'L'=>'l','M'=>'m','N'=>'n','O'=>'o','P'=>'p','Q'=>'q','R'=>'r','S'=>'s',
            'T'=>'t','U'=>'u','V'=>'v','W'=>'w','X'=>'x','Y'=>'y','Z'=>'z','“'=>'','”'=>'',
            '…'=>'',
        ];
        return strtr($str, $tr);
    }

    public function copyImg($image)
    {
        $pathIn = $this->path.'Goods/'.$image;
        $pathOut = Yii::getPathOfAlias('webroot.uploads.store.product').'/'.$image;

        if (file_exists($pathIn)) {
            if (file_exists($pathOut)) {
                if (hash_file('md5', $pathIn) != hash_file('md5', $pathOut)) {
                    @copy($pathIn, $pathOut);
                }
            } else {
                @copy($pathIn, $pathOut);
            }

            return $image;
        }

        return null;
    }
}
