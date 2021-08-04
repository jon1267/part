<?php

namespace App\Models;

/**
 * Class StatusColor
 * Статический класс обертка для данных (цвета статусов заказа)
 * StatusColor::getColorBy($id) $id={0,1...} вернет строку цвета
 * StatusColor::$colors = ['grey', 'green', 'blue', 'red']
 * @package App\Models
 */
class StatusColor
{
    public static $colors = [
        0=>'grey', 1=>'green', 2=>'red', 3 =>'red', 4=>'green', 5=>'blue', 6=>'red',
        7=>'coral', 8=>'darkgreen', 9=> 'crimson',177=>'red', 178=>'blue', 179=>'red',
        181=>'pink', 182=>'pink', 183=>'pink',
    ];

    public static function getColorBy($id)
    {
        //return (isset(self::$colors[$id])) ? self::$colors[$id] : 'grey'; // php < 7.0
        return self::$colors[$id] ?? 'grey';
    }
}
