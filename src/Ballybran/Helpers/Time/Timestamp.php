<?php

/**
 * KNUT7 K7F (http://framework.artphoweb.com/)
 * KNUT7 K7F (tm) : Rapid Development Framework (http://framework.artphoweb.com/).
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @see      http://github.com/zebedeu/artphoweb for the canonical source repository
 *
 * @copyright (c) 2015.  KNUT7  Software Technologies AO Inc. (http://www.artphoweb.com)
 * @license   http://framework.artphoweb.com/license/new-bsd New BSD License
 * @author    Marcio Zebedeu - artphoweb@artphoweb.com
 *
 * @version   1.0.2
 */

namespace Ballybran\Helpers\Time;

date_default_timezone_set(DEFAULT_UTC);

class Timestamp
{
    private static $tempo_da_sessao;

    /**
     * inserir_tempo.
     *
     * @param mixed $tempo_da_sessao
     *
     * @return int
     */
    private static function inserir_tempo(int $tempo_da_sessao): int
    {
        $diferenca_tempo = time() - $tempo_da_sessao;
        $segundos = $diferenca_tempo;
        $minutos = round($diferenca_tempo / 60);
        $horas = round($diferenca_tempo / 3600);
        $dia = round($diferenca_tempo / 86400);
        $semana = round($diferenca_tempo / 604800);
        $mes = round($diferenca_tempo / 2592000);
        $ano = round($diferenca_tempo / 31536000);
        //segundos

        if ($segundos <= 60) {
            echo " $segundos segundos agora<br/>";
        }
        //minutos
        elseif ($minutos <= 60) {
            if ($minutos == 1) {
                echo "one minuto  e $segundos agora <br/>";
            } else {
                echo "$minutos minutos agora<br/>";
            }
        }

        //horas
        elseif ($horas <= 24) {
            if ($horas == 1) {
                echo "uma hora agora e $minutos minutos e $segundos segundos<br/>";
            } else {
                echo "$horas horas agora<br/>";
            }
        }

        // dias
        elseif ($dia <= 7) {
            if ($dia == 1) {
                echo 'um dia agora <br/>';
            } else {
                echo "$dia dias agora<br/>";
            }
        }

        //semanas
        elseif ($semana <= 4) {
            if ($semana == 1) {
                echo 'uma semana agora<br/>';
            } else {
                echo "$semana semanas agora<br/>";
            }
        }

        //mes
        elseif ($mes <= 12) {
            if ($mes == 1) {
                echo 'um mes agora<br/>';
            } else {
                echo "$mes meses agora<br/>";
            }
        }

        //semanas
        else {
            if ($ano == 1) {
                echo 'um ano agora<br/>';
            } else {
                echo "$ano anos agora<br/>";
            }
        }

        return $tempo_da_sessao;
    }

    /**
     * _getDataTime_stemp.
     *
     * @param mixed $data
     *
     * @return string
     */
    public static function _getDataTime_stemp(string $data): string
    {
        self::$tempo_da_sessao = strtotime($data);

        return self::inserir_tempo(self::$tempo_da_sessao);
    }

    public static function distanceOfTimeInWords($fromTime, $toTime = 0, $showLessThanAMinute = false)
    {
        $distanceInSeconds = round(abs($toTime - strtotime($fromTime)));
        $distanceInMinutes = round($distanceInSeconds / 60);

        if ($distanceInMinutes <= 1) {
            if (!$showLessThanAMinute) {
                return ($distanceInMinutes == 0) ? 'less than a minute' : '1 minute';
            } else {
                if ($distanceInSeconds < 5) {
                    return 'less than 5 seconds';
                }
                if ($distanceInSeconds < 10) {
                    return 'less than 10 seconds';
                }
                if ($distanceInSeconds < 20) {
                    return 'less than 20 seconds';
                }
                if ($distanceInSeconds < 40) {
                    return 'about half a minute';
                }
                if ($distanceInSeconds < 60) {
                    return 'less than a minute';
                }

                return '1 minute';
            }
        }
        if ($distanceInMinutes < 45) {
            return $distanceInMinutes.' minutes';
        }
        if ($distanceInMinutes < 90) {
            return 'about 1 hour';
        }
        if ($distanceInMinutes < 1440) {
            return 'about '.round(floatval($distanceInMinutes) / 60.0).' hours';
        }
        if ($distanceInMinutes < 2880) {
            return '1 day';
        }
        if ($distanceInMinutes < 43200) {
            return 'about '.round(floatval($distanceInMinutes) / 1440).' days';
        }
        if ($distanceInMinutes < 86400) {
            return 'about 1 month';
        }
        if ($distanceInMinutes < 525600) {
            return round(floatval($distanceInMinutes) / 43200).' months';
        }
        if ($distanceInMinutes < 1051199) {
            return 'about 1 year';
        }

        return 'over '.round(floatval($distanceInMinutes) / 525600).' years';
    }

    /**
     * dataTime.
     *
     * @param string $format
     *
     * @return string
     */
    public static function dataTime(string $format = 'Y-m-d H:i:s'): string
    {
        $data = new \DateTime();

        return $data->format($format);
    }

    public static function setDataTime(string $format = 'Y-m-d H:i:s')
    {
        $data = new \DateTime();
        $data_f = $data->format($format);

        // setlocale() used with strftime().
        $my_locale = setlocale(LC_ALL, MY_LOCALE);
        if (MY_LOCALE == true) {
            return $data_inicial = strftime('%d %B %Y', strtotime(trim($data_f)));
        } else {
            return $data_f = $data->format($format);
        }
    }
}
