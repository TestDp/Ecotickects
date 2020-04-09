<?php
/**
 * Created by PhpStorm.
 * User: DPS-C
 * Date: 27/03/2020
 * Time: 5:43 PM
 */

namespace Eco\Datos\Modelos;


use Illuminate\Database\Eloquent\Model;
use Alexo\LaravelPayU\Payable;

class Orden extends Model
{
    use Payable;

    protected $fillable = ['reference','payu_order_id','transaction_id','state','value','user_id' ];
}