<?php

$urlIn = "https://xxx:xxx@xxx.myshopify.com/admin/api/2020-10/inventory_levels.json?inventory_item_ids=".$_POST['inventory_item_id'];

$dataInv = file_get_contents($urlIn);

$dataArr = json_decode($dataInv,true);
$location_id = $dataArr['inventory_levels'][0]['location_id'];

$postdata = http_build_query(
    array(
        "location_id" => $location_id,
        "inventory_item_id" => $_POST['inventory_item_id'],
        "available" => $_POST['inventory_quantity']
    )
);

print_r($postdata);

$opts = array('http' =>
    array(
        'method'  => 'POST',
        'header'  => 'Content-Type: application/x-www-form-urlencoded',
        'content' => $postdata
    )
);

$context  = stream_context_create($opts);
$urlIv = "https://xxx:xxx@xxx.myshopify.com/admin/api/2020-10/inventory_levels/set.json";
$result = file_get_contents($urlIv, false, $context);















// $data = array("products"=>array(
//                             "id"=>$_POST['product_id'],
//                             "title"=>$_POST['title'],
//                             "variants"=>array(array("id"=>$_GET['id'],"inventory_quantity"=>$_POST['inventory_quantity'],"old_inventory_quantity"=>$_POST['inventory_quantity']))
//                         )
//         );

        


// $url = "https://b35dd511e1f44068e9825c312be7a8a6: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@itfastprint.myshopify.com/admin/api/2020-10/products/{$_POST['product_id']}.json";

// // print_r(json_encode($arr));

// $data_json = json_encode($data);

// $ch = curl_init();
// curl_setopt($ch, CURLOPT_URL, $url);
// curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json','Content-Length: ' . strlen($data_json)));
// curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'PUT');
// curl_setopt($ch, CURLOPT_POSTFIELDS,$data_json);
// curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
// $response  = curl_exec($ch);
// print_r($response);
// curl_close($ch);
header('Location: ' . $_SERVER['HTTP_REFERER']);