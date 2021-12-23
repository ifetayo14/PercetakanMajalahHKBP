<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
class CheckoutController extends Controller
{
public function checkout(){
//mengarah kepada file checkout.blade.php yang ada di view
return view('checkout');
}
}