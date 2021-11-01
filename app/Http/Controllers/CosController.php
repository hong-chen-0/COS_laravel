<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CosController extends Controller
{
  public function test(Request $request){
    $this->COScreateFolder();
  }
  public function test2(Request $request){
    $this->COSaddFile('./img/blue.jpg');
  }
}
