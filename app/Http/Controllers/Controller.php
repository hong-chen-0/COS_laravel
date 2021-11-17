<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use Qcloud\Cos\Api;

class Controller extends BaseController
{
  use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

  //腾讯云COS创建文件夹
  public function COScreateFolder(){ 
    $cosClient = new \Qcloud\Cos\Client(
      array(
        'region' => getenv('COS_REGION'),//替换为用户的 region，已创建桶归属的region可以在控制台查看，https://console.cloud.tencent.com/cos5/bucket
        'schema' => 'https', //协议头部，默认为http
        'credentials'=> array(
          'secretId'  => getenv('COS_SECRET_ID'),//替换为用户的 secretId，请登录访问管理控制台进行查看和管理，https://console.cloud.tencent.com/cam/capi
          'secretKey' => getenv('COS_SECRET_KEY')//替换为用户的 secretKey，请登录访问管理控制台进行查看和管理，https://console.cloud.tencent.com/cam/capi
         )
      )
    );
    try {
      $result = $cosClient->putObject(array(
        'Bucket' => getenv('COS_BUCKET'), //格式：BucketName-APPID
        'Key' => 'folder3/',
        'Body' => "",
      ));
      // 请求成功
      print_r($result);
    } catch (\Exception $e) {
      // 请求失败
      echo($e);
    }
  }

  //腾讯云COS新增文件
  public function COSaddFile($local_path){ 
    $cosClient = new \Qcloud\Cos\Client(
      array(
        'region' => getenv('COS_REGION'),//替换为用户的 region，已创建桶归属的region可以在控制台查看，https://console.cloud.tencent.com/cos5/bucket
        'schema' => 'https', //协议头部，默认为http
        'credentials'=> array(
          'secretId'  => getenv('COS_SECRET_ID'),//替换为用户的 secretId，请登录访问管理控制台进行查看和管理，https://console.cloud.tencent.com/cam/capi
          'secretKey' => getenv('COS_SECRET_KEY')//替换为用户的 secretKey，请登录访问管理控制台进行查看和管理，https://console.cloud.tencent.com/cam/capi
         )
      )
    );
    try {
      $result = $cosClient->putObject(array(
        'Bucket' => getenv('COS_BUCKET'), //格式：BucketName-APPID
        'Key' => 'blue_copy', //存储为
        'Body' => fopen($local_path, 'rb'),//文件地址
      ));
      // 请求成功
      print_r($result);
    } catch (\Exception $e) {
      // 请求失败
      echo($e);
    }
  }

  //腾讯云COS查询文件列表
  public function COSsaveFile(){ 
    $cosClient = new \Qcloud\Cos\Client(
      array(
        'region' => getenv('COS_REGION'),//替换为用户的 region，已创建桶归属的region可以在控制台查看，https://console.cloud.tencent.com/cos5/bucket
        'schema' => 'https', //协议头部，默认为http
        'credentials'=> array(
          'secretId'  => getenv('COS_SECRET_ID'),//替换为用户的 secretId，请登录访问管理控制台进行查看和管理，https://console.cloud.tencent.com/cam/capi
          'secretKey' => getenv('COS_SECRET_KEY')//替换为用户的 secretKey，请登录访问管理控制台进行查看和管理，https://console.cloud.tencent.com/cam/capi
        )
      )
    );
    try {
      $result = $cosClient->listObjects(array(
        'Bucket' => getenv('COS_BUCKET'), //格式：BucketName-APPID
        'Delimiter' => '',
        'EncodingType' => 'url',
        'Marker' => '',
        'Prefix' => '',
        'MaxKeys' => 1000,
      ));
      // 请求成功
      print_r($result);
    } catch (\Exception $e) {
      // 请求失败
      echo($e);
    }
  }
}
