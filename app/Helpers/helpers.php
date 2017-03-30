<?php

use DateTime;

if ( ! function_exists('date_to_url'))
{
  /**
   *
   */
  function date_to_url($date, $fmt = 'Y/m/d')
  {
    return date($fmt, strtotime($date));
  }
}

if ( ! function_exists('date_to_fmt'))
{
  /**
   *
   */
  function date_to_fmt($date, $fmt = 'Y/m/d')
  {
    return date($fmt, strtotime($date));
  }
}

if ( ! function_exists('fmt_time'))
{
  /**
   *
   */
  function fmt_time($time, $fmt = 'HH:mm')
  {
    if (is_null($time) || empty($time)) {
      return null;
    }
    $arr = explode(':', $time);
    return $arr[0] . ':' . $arr[1];
  }
}

if ( ! function_exists('current_path'))
{
  /**
   *
   */
  function current_path()
  {
    return $_SERVER['PATH_INFO'];
  }
}
if ( ! function_exists('match_current_url'))
{
  /**
   *
   */
  function match_current_url($url)
  {
    if (current_path() == $url) {
      return true;
    }
    return false;
  }
}

if ( ! function_exists('to_dotweek'))
{
  /**
   *
   */
  function to_dotweek($date, $isja = true)
  {
    $datetime = new DateTime($date);
    $w = (int)$datetime->format('w');
    $week = ["日", "月", "火", "水", "木", "金", "土"];
    if ($isja) {
      return $week[$w];
    }
    return $w;
  }
}

if ( ! function_exists('date_dotweek'))
{
  /**
   *
   */
  function date_dotweek($date)
  {
    $datetime = new DateTime($date);
    $w = (int)$datetime->format('w');
    return $w;
  }
}

if ( ! function_exists('array_chunk'))
{
  /**
   *
   */
  function array_chunk($array, $n = 1)
  {
    $parent = [];
    $child = [];
    foreach ($array as $value) {
      $child[] = $value;
      if (count($child) === $n) {
        $parent[] = $child;
        $child = [];
      }
    }
    return $parent;
  }
}
