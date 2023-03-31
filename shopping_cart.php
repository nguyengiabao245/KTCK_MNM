<?php include_once('header.php');?>
<?php
    require_once("/enities/product.class.php");
    require_once("/enities/category.class.php");
    $cates = Category::list_category();
    
    session_start();
    error_reporting(E_ALL);
    ini_set('display_errors','1');

    if(isset($_GET['id'])){
        $pro_id = $_GET["id"];
        $was_found = false;
        $i=0;

        if(!isset($_SESSION["cart_items"]) || count($_SESSION["cart_items"])<1){
            $_SESSION["cart_items"] = array(0=> array("pro_id" => $pro_id, "quantity" => 1));
        }
        else{
            foreach($_SESSION["cart_items"] as $item){
                $i++;
                while(list($key,$value) = each($item)){
                    if($key == "pro_id" && $value == $pro_id){
                        array_splice($_SESSION["cart_items"], $i-1, 1, array((array("pro_id" =>$pro_id, "quantity" => $item["quantity"]+1))));
                        $was_found = true;
                    }
                }
            }
            if($was_found ==false){
            array_push($_SESSION["cart_items"], array("pro_id" => $pro_id, "quantity" => 1));
            }
        }
        header("Location: shoppong_cart.php");
    }
?>