<?

/**
 * 
 * Класс для работы с просмотренными продуктами 
 *  
 * */
class ProductViewed
{

    /** 
     * 
     * Добавляет продукт в список просмотренных
     * 
     * */
    public static function add($id)
    {
        $items = self::get();
        $items[$id] = [
            'ID' => $id,
            'TIME' => time()
        ];
        setcookie('ProductViewed', json_encode($items), time() + 60 * 60 * 24 * 30, '/', $_SERVER['SERVER_NAME'], false);
    }

    /** 
     * 
     * Удаляет продукт из списка просмотренных
     * 
     * */
    public static function remove($id)
    {
        $items = self::get();
        unset($items[array_search($id, $items)]);
        setcookie('ProductViewed', json_encode($items), time() + 60 * 60 * 24 * 30, '/', $_SERVER['SERVER_NAME'], false);
    }

    private static function _sort_callback($a, $b)
    {
        if ($a['TIME'] == $b['TIME']) {
            return 0;
        }
        return ($a['TIME'] > $b['TIME']) ? -1 : 1;
    }
    /**
     * 
     * Сортируем по дате
     * 
     * */
    public static function sort($arr)
    {
        uasort($arr, 'self::_sort_callback');
        return $arr;
    }
    /** 
     * 
     * Возвращает список ID просмотренных товаров
     * 
     * */
    public static function get()
    {
        $arr = json_decode($_COOKIE['ProductViewed'], true);
        $arr = self::sort($arr);
        return $arr;
    }
}
?>