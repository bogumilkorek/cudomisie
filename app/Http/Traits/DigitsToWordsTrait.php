<?php
namespace App\Http\Traits;

trait digitsToWordsTrait {

  public function digitsToWords($number) {
    $number = explode(".", $number);
    $f = new \NumberFormatter(env('APP_LOCALE'), \NumberFormatter::SPELLOUT );

    // If amount ends with '00' we don't need to do anything
    if(!isset($number[1]) || (isset($number[1]) && $number[1] == '00'))
      return $f->format($number[0]) . ' ' . __('dollars') . ' ' . __('and') . ' ' . __('zero') . ' ' . __('cents');
    // If not we need to format dollars and cents separately
    else
      return $f->format($number[0]) . ' ' . __('dollars') . ' ' .  __('and') . ' ' . $f->format($number[1]) . ' ' . __('cents');
  }
}
