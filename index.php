<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">

<?php
// program ini baru bisa untuk update stok produk saja 

// curl 
$link = isset($_GET['p'])?"&page_info=".$_GET['p']:'';
$url ="https://xxx:xxx@xxx.myshopify.com/admin/api/2020-10/products.json"; // ubah sesuai dengan url kalian 
$curl = curl_init( $url );
curl_setopt($curl, CURLOPT_HTTPHEADER, array("Content-Type: application/json"));
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
$json_response = json_decode(curl_exec($curl),true);
curl_close($curl);
// end curl
// print_r($json_response);

echo "<h3>Produk</h3>";
echo "<table class='table table-bordered table-hover'>
            <tr>
                <th>ID PRODUK</th>
                <th width='150px'>JUDUL PRODUK</th>
                <th>VARIANT</th>
            </tr>";
$no = 1;
foreach ($json_response['products'] as $p) {
        echo "<tr>
                <td>{$p['id']}</td>
                <td>{$p['title']}</td>
                <td>";
?>  
        <table class='table table-hover'>
            <tr>
                <td width='100px'>ID Varian</td>
                <td width='100px'>Varian</td>
                <td width='100px'>SKU</td>
                <td width='100px'>QTY</td>
                <td width='50px'>Aksi</td>
            </tr>
            <?php
                foreach ($p['variants'] as $v) {
                    echo "<form action='edit.php?id={$v['id']}' method='post'> 
                            <tr>
                                <td>{$v['id']}</td>  
                                <td>{$v['title']}</td>  
                                <td>{$v['sku']}</td>  
                                <td>
                                        <input type='hidden' name='product_id' value='{$v['product_id']}'>
                                        <input type='hidden' name='title' value='{$p['title']}'>
                                        <input type='hidden' name='inventory_item_id' value='{$v['inventory_item_id']}'>
                                        <input type='number' name='inventory_quantity' value='{$v['inventory_quantity']}'>
                                </td>  
                                <td><input type='submit' value='ubah'></td>
                            </tr>
                          
                          </form>";
                          
                }
            ?>
        </table>
<?php
            echo "</td>
              </tr>";
        $no++;
}

echo "</table>";