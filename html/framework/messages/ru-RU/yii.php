<?php
/**
 * Created by PhpStorm.
 * User: krok
 * Date: 03.08.18
 * Time: 12:36
 */

return array_merge(require(YII2_PATH . '/messages/ru/yii.php'), [
    '{nFormatted} GiB' => '{nFormatted} ГБ',
    '{nFormatted} KiB' => '{nFormatted} КБ',
    '{nFormatted} MiB' => '{nFormatted} МБ',
    '{nFormatted} PiB' => '{nFormatted} ПБ',
    '{nFormatted} TiB' => '{nFormatted} ТБ',
    '{nFormatted} {n, plural, =1{gibibyte} other{gibibytes}}' => '{nFormatted} {n, plural, one{гигабайт} few{гигабайта} many{гигабайтов} other{гигабайта}}',
    '{nFormatted} {n, plural, =1{kibibyte} other{kibibytes}}' => '{nFormatted} {n, plural, one{килобайт} few{килобайта} many{килобайтов} other{килобайта}}',
    '{nFormatted} {n, plural, =1{mebibyte} other{mebibytes}}' => '{nFormatted} {n, plural, one{мегабайт} few{мегабайта} many{мегабайтов} other{мегабайта}}',
    '{nFormatted} {n, plural, =1{pebibyte} other{pebibytes}}' => '{nFormatted} {n, plural, one{петабайт} few{петабайта} many{петабайтов} other{петабайта}}',
    '{nFormatted} {n, plural, =1{tebibyte} other{tebibytes}}' => '{nFormatted} {n, plural, one{терабайт} few{терабайта} many{терабайтов} other{терабайта}}',
]);
