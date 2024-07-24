<?php
    class Product extends Controller {
        //Load list of products layout
        function displayProduct(){
            //Model
            $product=$this->model("ProductModel");
            
            //View
            $this->view("admin/home",[
                "product" => $product->getProduct(),
                "page"=>"displayProduct"
            ]);
        }
    }
?>