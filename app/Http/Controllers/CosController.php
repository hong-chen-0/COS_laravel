<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CosController extends Controller
{
  public function addFolder(Request $request){
    $this->COScreateFolder();
  }
  public function addFile(Request $request){
    $this->COSaddFile('./img/blue.jpg');
  }
}
