<?php
/**
 * Created by PhpStorm.
 * User: krok
 * Date: 09.02.17
 * Time: 16:31
 */

return [
    '<language:\w+\-\w+>' => '/',
    '<language:\w+\-\w+>/<module:[\w\-]+>' => '<module>',
    '<language:\w+\-\w+>/<module:[\w\-]+>/<controller:[\w\-]+>' => '<module>/<controller>',
    '<language:\w+\-\w+>/<module:[\w\-]+>/<controller:[\w\-]+>/<action:[\w\-]+>/<p:\d+>/<per:\d+>' => '<module>/<controller>/<action>',
    '<language:\w+\-\w+>/<module:[\w\-]+>/<controller:[\w\-]+>/<action:[\w\-]+>/<id:\d+>' => '<module>/<controller>/<action>',
    '<language:\w+\-\w+>/<module:[\w\-]+>/<controller:[\w\-]+>/<action:[\w\-]+>' => '<module>/<controller>/<action>',
    /**
     * Системные правила
     */
    /* cp */
    '<language:\w+\-\w+>/cp' => 'cp',
    '<language:\w+\-\w+>/cp/<module:[\w\-]+>' => 'cp/<module>',
    '<language:\w+\-\w+>/cp/<module:[\w\-]+>/<controller:[\w\-]+>' => 'cp/<module>/<controller>',
    // todo: id | p | per
    '<language:\w+\-\w+>/cp/<module:[\w\-]+>/<controller:[\w\-]+>/<action:[\w\-]+>' => 'cp/<module>/<controller>/<action>',
];
