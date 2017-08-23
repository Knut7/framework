<?php

/**
 * APWEB Framework (http://framework.artphoweb.com/)
 * APWEB FW(tm) : Rapid Development Framework (http://framework.artphoweb.com/)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @link      http://github.com/zebedeu/artphoweb for the canonical source repository
 * Copyright (c) 2017.  APWEB  Software Technologies AO Inc. (http://www.artphoweb.com)
 * @license   http://framework.artphoweb.com/license/new-bsd New BSD License
 * @author    Marcio Zebedeu - artphoweb@artphoweb.com
 * @version   1.0.0
 */

namespace FWAP\Helpers;

class Language
{

    /**
     * Variable holds array with language.
     *
     * @var array
     */
    private $array;

    /**
     * Load language function.
     *
     * @param string $name
     * @param string $code
     */
    public function Load($name)
    {
        /** lang file */
        $file = DIR_LANGUAGE . LANGUAGE_CODE . DS . "$name.php";

        /** check if is readable */
        if (is_readable($file)) {
            /** require file */
            return $this->array = require_once($file);
        } else {
            echo Exception::langNotLoad();
        }
    }

    /**
     * Get element from language array by key.
     *
     * @param  string $value
     *
     * @return string
     */
    public function get($value)
    {
        if (!empty($this->array[$value])) {
            return $this->array[$value];
        } else {
            return $value;
        }
    }

    /**
     * Get lang for views.
     *
     * @param  string $value this is "word" value from language file
     * @param  string $name name of file with language
     * @param  string $code optional, language code
     *
     * @return string
     */
    public static function show($value, $name)
    {
        /** lang file */
        $file = DIR_LANGUAGE . LANGUAGE_CODE . DS . "$name.php";

        /** check if is readable */
        if (is_readable($file)) {
            /** require file */
            $array = include($file);
        } else {
            /** display error */
//            echo Error::display("Could not load language file '$code/$name.php'");
//            die;
        }

        if (!empty($array[$value])) {
            return $array[$value];
        } else {
            return $value;
        }
    }
}
