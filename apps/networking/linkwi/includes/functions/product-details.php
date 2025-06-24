<?php

class ProductDetails {

public function __construct($pro_id){

    $sql = new dbase;
    $sql->query("SELECT * FROM products WHERE product_url = '$pro_id'");
    

    if ($sql->fetchCount() == 0)
    {
        redirect("/");
    }
    else
    {

        $row = $sql->fetchSingle();
        $this->product_title = $row['product_title'];
        $this->product_desc = $row['product_desc'];
        $this->product_id = $row['product_id'];
        $this->status = $row['status'];
        $this->pro_label = $row['product_label'];
        $this->pro_price = $row['product_price'];
        $this->pro_img1 = $row['product_img1'];
        $this->pro_img2 = $row['product_img2'];
        $this->pro_img3 = $row['product_img3'];
        $this->pro_img4 = $row['product_img4'];
        $this->pro_img5 = $row['cart_image'];
        $this->pro_psp_price = $row['product_psp_price'];
        $this->product_keywords = $row['product_keywords'];
        
        
       
    }
$sql = Null;

}

public function product_title(){
return $this->product_title;
}

public function product_desc(){
return $this->product_desc;
}

public function product_id(){
return $this->product_id;
}

public function status(){
return $this->status;
}

public function pro_label(){
return $this->pro_label;
}

public function pro_price(){
return $this->pro_price;
}

public function pro_psp_price(){
return $this->pro_psp_price;
}

public function product_keywords(){
return $this->product_keywords;
}
}


function other_voila($pro_id)
{
    $sql = new dbase;
    $sql->query("SELECT * FROM products WHERE product_url != '$pro_id'");
    if ($sql->fetchCount() == 0)
    {
        echo "<script>window.open('linkwi.co','_self')</script>";
    }
    else
    {
        $row = $sql->fetchMultiple();
        foreach($row as $row_){{
        $other_product_title = $row_['product_title'];
        $other_product_desc = $row_['product_desc'];
        $other_product_url = $row_['product_url'];
        $other_status = $row_['status'];
        $other_pro_label = $row_['product_label'];
        $other_pro_price = $row_['product_price'];
        $other_pro_psp_price = $row_['product_psp_price'];
        $other_product_keywords = $row_['product_keywords'];
        
        
        
	echo "<li>
		<article class='post-inline'>
                      <div class='post-inline__header'><span class='post-inline__time'>$$other_pro_psp_price $$other_pro_price</span><a class='post-inline__author meta-author' href='$other_product_url'><span class='badge badge-purple p-1'>$other_pro_label</span></a></div>
                      <p class='post-inline__link'><a href='$other_product_url'> $other_product_title </a></p>
                    </article>
              </li>";
                  
       
                  
      
        }  
    }

}
}