<?php

/**
 * Get the timestamp for a given calendar date
 *
 * @param $date A calendar date (dd/mm/aaaa in french, mm/dd/aaaa in english)
 * @param $locale The locale (ie : "fr", "en")
 * @param $debug Display debug info
 *
 * @return \Illuminate\View\View
 */

if (!function_exists('calendar_to_timestamp')) {

  function calendar_to_timestamp($date, $locale = 'fr', $debug = false) {

    if ($locale == 'fr') {
      if (!preg_match("#^(((0[1-9]|[12]\d|3[01])\/(0[13578]|1[02])\/((19|[2-9]\d)\d{2}))|((0[1-9]|[12]\d|30)\/(0[13456789]|1[012])\/((19|[2-9]\d)\d{2}))|((0[1-9]|1\d|2[0-8])\/02\/((19|[2-9]\d)\d{2}))|(29\/02\/((1[6-9]|[2-9]\d)(0[48]|[2468][048]|[13579][26])|((16|[2468][048]|[3579][26])00))))$#", $date)) {
          throw new \Exception("Invalid french date format passed to calendar_to_timestamp() : ".$date);
      }
    } elseif ($locale == 'en') {
      if (!preg_match("#^(0[1-9]|1[0-2])\/(0[1-9]|1\d|2\d|3[01])\/(19|20)\d{2}$#", $date)) {
          throw new \Exception("Invalid english date format passed to calendar_to_timestamp() : ".$date);
      }
    } else {
      throw new \Exception("Invalid locale passed to calendar_to_timestamp() : ".$date);
    }

    $exp = explode('/', $date);

    if ($locale == 'fr') {
      $timestamp = mktime(0, 0, 0, $exp[1], $exp[0], $exp[2]);
    } elseif ($locale == 'en') {
      $timestamp = mktime(0, 0, 0, $exp[0], $exp[1], $exp[2]);
    }

    if ($debug) {
      echo "<br />$date ($locale) = " . date('d/m/Y', $timestamp) . "(fr)<br />";
    }

    return $timestamp;
  }

}