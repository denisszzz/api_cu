<?php

namespace Api\Helper;

use Firebase\JWT\JWT;

class FuncHelpers {

    public function createTag($tags) {
        if ($tags==="") return null;
        $tagsArray = [];
        if (is_array($tags)) {
            foreach ($tags as $tag) {
                $tagsArray[] = ["url" => "/api/cuprum/tags/{$tag}", "label" => $tag];
            }
        }else{
            $tagsArray[] = ["url" => "/api/cuprum/tags/{$tags}", "label" => $tags];
        }
        return $tagsArray;
    }

    public function humanDate($format, $timestamp = 0, $nominative_month = false)
    {
        if(!$timestamp) $timestamp = time();
        elseif(!preg_match("/^[0-9]+$/", $timestamp)) $timestamp = strtotime($timestamp);

        $F = $nominative_month ? array(1=>"Январь", "Февраль", "Март", "Апрель", "Май", "Июнь", "Июль", "Август", "Сентябрь", "Октябрь", "Ноябрь", "Декабрь") : array(1=>"Января", "Февраля", "Марта", "Апреля", "Мая", "Июня", "Июля", "Августа", "Сентября", "Октября", "Ноября", "Декабря");
        $M = array(1=>"Янв", "Фев", "Мар", "Апр", "Май", "Июн", "Июл", "Авг", "Сен", "Окт", "Ноя", "Дек");
        $l = array("Воскресенье", "Понедельник", "Вторник", "Среда", "Четверг", "Пятница", "Суббота");
        $D = array("Вс", "Пн", "Вт", "Ср", "Чт", "Пт", "Сб");

        $format = str_replace("F", $F[date("n", $timestamp)], $format);
        $format = str_replace("M", $M[date("n", $timestamp)], $format);
        $format = str_replace("l", $l[date("w", $timestamp)], $format);
        $format = str_replace("D", $D[date("w", $timestamp)], $format);

        return date($format, $timestamp);
    }

    public function getUserToken() {
        $headers = null;
        if ($_SERVER['Authorization']) {
            $headers = trim($_SERVER["Authorization"]);
        }
        elseif ($_SERVER['HTTP_AUTHORIZATION']) {
            $headers = trim($_SERVER["HTTP_AUTHORIZATION"]);
        }
        elseif (function_exists('apache_request_headers')) {
            $requestHeaders = apache_request_headers();
            $requestHeaders = array_combine(array_map('ucwords', array_keys($requestHeaders)), array_values($requestHeaders));
            if (isset($requestHeaders['Authorization'])) {
                $headers = trim($requestHeaders['Authorization']);
            }
        }
        if (!empty($headers)) {
            if (preg_match('/Bearer\s(\S+)/', $headers, $matches)) {
                $data = JWT::decode($matches[1], 'secret', array('HS256'));
                return $data->_id;
            }
        }
        return null;
    }
}