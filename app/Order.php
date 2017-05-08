<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use Illuminate\Notifications\Notifiable;
use App\Payment;

class Order extends Model
{
  use Notifiable;

  public function getRouteKeyName()
  {
    return 'uuid';
  }

  protected $shipping_tax, $post_tax_shipping, $total_tax, $post_tax_total, $payment_status;

  protected $fillable = [
    'uuid', 'name', 'email', 'phone_number', 'address', 'comments', 'invoice_url'
  ];

  public function products()
  {
    return $this->belongsToMany('App\Product')
    ->withTrashed()
    ->withPivot('product_title', 'product_quantity', 'product_price');
  }

  public function orderStatus()
  {
    return $this->belongsTo('App\OrderStatus');
  }

  public function shippingMethod()
  {
    return $this->belongsTo('App\ShippingMethod');
  }

  public function user()
  {
    return $this->belongsTo('App\User');
  }

  public function paymentMethod()
  {
    return $this->belongsTo('App\PaymentMethod');
  }

  public function getCreatedAtAttribute($date)
  {
    $currentDate = new Carbon($date);
    return Carbon::createFromFormat('Y-m-d H:i:s', $currentDate)->format('d.m.Y, H:i');
  }

  public function getShippingTaxAttribute()
  {
    return number_format((floatval($this->shipping_cost) * 0.23) / 1.23, 2) . ' ' . __('$');
  }

  public function getPostTaxShippingAttribute()
  {
    return number_format((floatval($this->shipping_cost) - floatval($this->getShippingTaxAttribute())), 2) . ' ' . __('$');
  }

  public function getTotalTaxAttribute()
  {
    return number_format((floatval($this->total_cost) * 0.23) / 1.23, 2) . ' ' . __('$');
  }

  public function getPostTaxTotalAttribute()
  {
    return number_format((floatval($this->total_cost) - floatval($this->getTotalTaxAttribute())), 2) . ' ' . __('$');
  }

  public function getPaymentStatusAttribute()
  {
    $payment = Payment::where('session_id', $this->uuid)->first();
    if($payment)
    {
      if($payment->verified)
        return '<span class="label label-success" style="font-size: 16px">' . __('Payment verified') . '</span>';
      else if($payment->cancelled)
        return '<span class="label label-danger" style="font-size: 16px">' . __('Payment error') . '</span>';
      else
        return '<span class="label label-warning" style="font-size: 16px">' . __('Payment verification') . '</span>';
    }
  }
}
