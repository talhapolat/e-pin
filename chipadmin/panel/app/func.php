<?php  
require_once("../../../app/connect.php");
session_start();

$ip		      = $_SERVER["REMOTE_ADDR"];
$timeDamga    = time();
$time         = date("Y/m/d", $timeDamga);

$backurl	  = $_SERVER['HTTP_REFERER'];

function Security($var){
	$clearSpace		= trim($var);
	$clearTag       = strip_tags($clearSpace);
	$etkisizyap     = htmlspecialchars($clearTag);
	$result   	    = $etkisizyap;
	return $result;
}

if (array_key_exists('newproduct', $_POST)) {

  if (isset($_POST["category"])) {
   $inputcategory = Security($_POST["category"]);
 } else
 $inputcategory = "";

 if (isset($_POST["title"])) {
   $inputtitle = Security($_POST["title"]);
 } else
 $inputtitle = "";

 if (isset($_POST["qty"])) {
   $inputqty = Security($_POST["qty"]);
 } else
 $inputqty = "";

 if (isset($_POST["price"])) {
   $inputprice = Security($_POST["price"]);
 } else
 $inputprice = "";

 if (isset($_POST["stock"])) {
   $inputstock = Security($_POST["stock"]);
 } else
 $inputstock = "";

 if (isset($_POST["smalldesc"])) {
  $inputsmalldesc = Security($_POST["smalldesc"]);
} else
$inputsmalldesc = "";

if (isset($_POST["description"])) {
  $inputdescription = Security($_POST["description"]);
} else
$inputdescription = "";

if (isset($_POST["description2"])) {
  $inputdescription2 = Security($_POST["description2"]);
} else
$inputdescription2 = "";

$slug = slugit($inputtitle);

$slugQuery = $dbConnect->prepare("SELECT * FROM product WHERE slug = ?");
$slugQuery->execute([$slug]);
$slugNum = $slugQuery->rowCount();

if ($slugNum > 0) {
  $i = 0;
  while ( $slugNum != 0) {
    $i++;
    $slugQuery2 = $dbConnect->prepare("SELECT * FROM product WHERE slug = ?");
    $slugQuery2->execute([$slug . "-" . $i]);
    $slugNum = $slugQuery2->rowCount();
  }
  $slug = $slug . "-" . $i;
} 

$currentDirectory = $_SERVER['DOCUMENT_ROOT'];
$uploadDirectory = "/images/";

    $errors = []; // Store errors here

    $fileExtensionsAllowed = ['jpeg','jpg','png']; // These will be the only file extensions allowed 

    $fileNam = $_FILES['the_file']['name'];
    $fileSize = $_FILES['the_file']['size'];
    $fileTmpName  = $_FILES['the_file']['tmp_name'];
    $fileType = $_FILES['the_file']['type'];
    $fileExtension = strtolower(end(explode('.',$fileNam)));

    $fileName = generateRandomString() . '.' . $fileExtension;

    $uploadPath = $currentDirectory . $uploadDirectory . basename($fileName); 

    if (isset($_POST['newproduct'])) {

      if (! in_array($fileExtension,$fileExtensionsAllowed)) {
        $errors[] = "This file extension is not allowed. Please upload a JPEG or PNG file";
      }

      if ($fileSize > 4000000) {
        $errors[] = "File exceeds maximum size (4MB)";
      }

      if (empty($errors)) {
        $didUpload = move_uploaded_file($fileTmpName, $uploadPath);

        if ($didUpload) {
        	
        } else {
          echo "An error occurred. Please contact the administrator.";
        }
      } else {
        foreach ($errors as $error) {
          echo $error . "These are the errors" . "\n";
        }
      }

    }

    $product??nsertQuery = $dbConnect->prepare("INSERT INTO product (category_id, title, image, qty, price, stock, smalldesc, description, description2, slug,  statu) values (?,?,?,?,?,?,?,?,?,?,?)");
    $product??nsertQuery->execute([$inputcategory, $inputtitle, $fileName, $inputqty, $inputprice, $inputstock, $inputsmalldesc, $inputdescription, $inputdescription2, $slug, 1]);
    $insertControl = $product??nsertQuery->rowCount();

    if ($insertControl > 0) {
     header("Location:/chipadmin/panel/products.php");
     exit();
   } else {
     echo "error newprod reg";
   }


 }



 if (array_key_exists('updateproduct', $_POST)) {

  $productQuery = $dbConnect->prepare("SELECT * FROM product WHERE id = ?");
  $productQuery->execute([$_POST["pid"]]);
  $productNum = $productQuery->rowCount();
  $product = $productQuery->fetch(PDO::FETCH_ASSOC);  

  if (isset($_POST["category"])) {
    $inputcategory = Security($_POST["category"]);
  } else
  $inputcategory = "";

  if (isset($_POST["title"])) {
    $inputtitle = Security($_POST["title"]);
  } else
  $inputtitle = "";

  if (isset($_POST["qty"])) {
    $inputqty = Security($_POST["qty"]);
  } else
  $inputqty = "";

  if (isset($_POST["price"])) {
    $inputprice = Security($_POST["price"]);
  } else
  $inputprice = "";

  if (isset($_POST["stock"])) {
    $inputstock = Security($_POST["stock"]);
  } else
  $inputstock = "";

  if (isset($_POST["smalldesc"])) {
    $inputsmalldesc = Security($_POST["smalldesc"]);
  } else
  $inputsmalldesc = "";

  if (isset($_POST["description"])) {
    $inputdescription = Security($_POST["description"]);
  } else
  $inputdescription = "";

  if (isset($_POST["description2"])) {
    $inputdescription2 = Security($_POST["description2"]);
  } else
  $inputdescription2 = "";



  if ($_FILES["the_file"]["name"] != null) {

    $currentDirectory = $_SERVER['DOCUMENT_ROOT'];
    $uploadDirectory = "/images/";

    $errors = []; // Store errors here

    $fileExtensionsAllowed = ['jpeg','jpg','png']; // These will be the only file extensions allowed 

    $fileNam = $_FILES['the_file']['name'];
    $fileSize = $_FILES['the_file']['size'];
    $fileTmpName  = $_FILES['the_file']['tmp_name'];
    $fileType = $_FILES['the_file']['type'];
    $fileExtension = strtolower(end(explode('.',$fileNam)));

    $fileName = generateRandomString() . '.' . $fileExtension;    

    $uploadPath = $currentDirectory . $uploadDirectory . basename($fileName); 

    if (isset($_POST['updateproduct'])) {

      if (! in_array($fileExtension,$fileExtensionsAllowed)) {
        $errors[] = "This file extension is not allowed. Please upload a JPEG or PNG file";
      }

      if ($fileSize > 4000000) {
        $errors[] = "File exceeds maximum size (4MB)";
      }

      if (empty($errors)) {
        $didUpload = move_uploaded_file($fileTmpName, $uploadPath);

        if ($didUpload) {

        } else {
          echo "An error occurred. Please contact the administrator.";
        }
      } else {
        foreach ($errors as $error) {
          echo $error . "These are the errors" . "\n";
        }
      }

    }
  } else {
    $fileName = $product["image"];
  }


  $product??nsertQuery = $dbConnect->prepare("UPDATE product SET
    category_id = ?, title = ?, image = ?, qty = ?, price = ?, stock = ?, smalldesc = ?, description = ?, description2 = ?, statu = ?
    WHERE id = ?");
  $product??nsertQuery->execute([$inputcategory, $inputtitle, $fileName, $inputqty, $inputprice, $inputstock, $inputsmalldesc, $inputdescription, $inputdescription2, $product["statu"], $_POST["pid"]]);
  $insertControl = $product??nsertQuery->rowCount();


  header("Location:/chipadmin/panel/products.php");
  exit();

}


if (array_key_exists('productstatuchange', $_GET)) {

  $productQuery = $dbConnect->prepare("SELECT * FROM product WHERE id = ?");
  $productQuery->execute([$_GET["productstatuchange"]]);
  $productNum = $productQuery->rowCount();
  $product = $productQuery->fetch(PDO::FETCH_ASSOC);  

  if ($product["statu"] == 0) {
    $newstatu = 1;
  } else {
    $newstatu = 0;
  }

  if ($productNum == 1) {
    $product??nsertQuery = $dbConnect->prepare("UPDATE product SET
      statu = ?
      WHERE id = ?");
    $product??nsertQuery->execute([$newstatu, $product["id"]]); 
    header("Location:" . $backurl);
  } else {
    echo "HATA KODU: 16546683";
  }    

}


if (array_key_exists('productdelete', $_GET)) {

  $productQuery = $dbConnect->prepare("SELECT * FROM product WHERE id = ?");
  $productQuery->execute([$_GET["productdelete"]]);
  $productNum = $productQuery->rowCount();
  $product = $productQuery->fetch(PDO::FETCH_ASSOC);  

  if ($productNum == 1) {
    $product??nsertQuery = $dbConnect->prepare("UPDATE product SET deleted = 1 
      WHERE id = ?");
    $product??nsertQuery->execute([$product["id"]]); 
    header("Location:" . $backurl);
  } else {
    echo "HATA KODU: 435465280";
  }    

}



if (array_key_exists('newcategory', $_POST)) {

  if (isset($_POST["title"])) {
    $inputtitle = Security($_POST["title"]);
  } else
  $inputtitle = "";

  if (isset($_POST["producttype"])) {
    $inputproducttype = Security($_POST["producttype"]);
  } else
  $inputproducttype = "";

  if (isset($_POST["description"])) {
    $inputdescription = Security($_POST["description"]);
  } else
  $inputdescription = "";

  if (isset($_POST["price"])) {
    $inputprice = Security($_POST["price"]);
  } else
  $inputprice = "";

  if (isset($_POST["birim1"])) {
    $inputbirim1 = Security($_POST["birim1"]);
  } else
  $inputbirim1 = "";

  if (isset($_POST["birim2"])) {
    $inputbirim2 = Security($_POST["birim2"]);
  } else
  $inputbirim2 = "";

  if (isset($_POST["description2"])) {
    $inputdescription2 = Security($_POST["description2"]);
  } else
  $inputdescription2 = "";

  if (isset($_POST["description3"])) {
    $inputdescription3 = Security($_POST["description3"]);
  } else
  $inputdescription3 = "";  


  $slug = slugit($inputtitle);

  $slugQuery = $dbConnect->prepare("SELECT * FROM category WHERE slug = ?");
  $slugQuery->execute([$slug]);
  $slugNum = $slugQuery->rowCount();

  if ($slugNum > 0) {
    $i = 0;
    while ( $slugNum != 0) {
      $i++;
      $slugQuery2 = $dbConnect->prepare("SELECT * FROM category WHERE slug = ?");
      $slugQuery2->execute([$slug . "-" . $i]);
      $slugNum = $slugQuery2->rowCount();
    }
    $slug = $slug . "-" . $i;
  } 


  $currentDirectory = $_SERVER['DOCUMENT_ROOT'];
  $uploadDirectory = "/images/";

    $errors = []; // Store errors here

    $fileExtensionsAllowed = ['jpeg','jpg','png']; // These will be the only file extensions allowed 

    $fileNam = $_FILES['the_file']['name'];
    $fileSize = $_FILES['the_file']['size'];
    $fileTmpName  = $_FILES['the_file']['tmp_name'];
    $fileType = $_FILES['the_file']['type'];
    $fileExtension = strtolower(end(explode('.',$fileNam)));

    $fileName = generateRandomString() . '.' . $fileExtension;

    $uploadPath = $currentDirectory . $uploadDirectory . basename($fileName); 


    if (! in_array($fileExtension,$fileExtensionsAllowed)) {
      $errors[] = "This file extension is not allowed. Please upload a JPEG or PNG file";
    }

    if ($fileSize > 4000000) {
      $errors[] = "File exceeds maximum size (4MB)";
    }

    if (empty($errors)) {
      $didUpload = move_uploaded_file($fileTmpName, $uploadPath);

      if ($didUpload) {

      } else {
        echo "An error occurred. Please contact the administrator.";
      }
    } else {
      foreach ($errors as $error) {
        echo $error . "These are the errors" . "\n";
      }
    }

    $product??nsertQuery = $dbConnect->prepare("INSERT INTO category (title, product_type, description, description2, description3, price, birim1, birim2, slug, image, in_name, in_facemail, in_facepass, in_phone, in_gameid, in_zyngavip, custompacket, statu) values (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)");
    $product??nsertQuery->execute([$inputtitle, $inputproducttype, $inputdescription, $inputdescription2, $inputdescription3, $inputprice, $inputbirim1, $inputbirim2, $slug, $fileName, $_POST["checkInName"], $_POST["checkInFace"], $_POST["checkInFacePass"], $_POST["checkInPhone"], $_POST["checkInGameId"], $_POST["checkInZyngaVip"], $_POST["custompacket"], 1]);
    $insertControl = $product??nsertQuery->rowCount();

    if ($insertControl > 0) {
      header("Location:/chipadmin/panel/categories.php");
      exit();
    } else {
      echo "error newprod reg";
    }


  }


  if (array_key_exists('updatecategory', $_POST)) {

    $categoryQuery = $dbConnect->prepare("SELECT * FROM category WHERE id = ?");
    $categoryQuery->execute([$_POST["updatecategory"]]);
    $categoryNum = $categoryQuery->rowCount();
    $category = $categoryQuery->fetch(PDO::FETCH_ASSOC);

    if (isset($_POST["title"])) {
      $inputtitle = Security($_POST["title"]);
    } else
    $inputtitle = "";

    if (isset($_POST["producttype"])) {
      $inputproducttype = Security($_POST["producttype"]);
    } else
    $inputproducttype = "";

    if (isset($_POST["description"])) {
      $inputdescription = Security($_POST["description"]);
    } else
    $inputdescription = "";

    if (isset($_POST["price"])) {
      $inputprice = Security($_POST["price"]);
    } else
    $inputprice = "";

    if (isset($_POST["birim1"])) {
      $inputbirim1 = Security($_POST["birim1"]);
    } else
    $inputbirim1 = "";

    if (isset($_POST["birim2"])) {
      $inputbirim2 = Security($_POST["birim2"]);
    } else
    $inputbirim2 = "";

    if (isset($_POST["description2"])) {
      $inputdescription2 = Security($_POST["description2"]);
    } else
    $inputdescription2 = "";

    if (isset($_POST["description3"])) {
      $inputdescription3 = Security($_POST["description3"]);
    } else
    $inputdescription3 = ""; 



    if (($_FILES["the_file"]["name"] != null)) {

      $currentDirectory = $_SERVER['DOCUMENT_ROOT'];
      $uploadDirectory = "/images/";

    $errors = []; // Store errors here

    $fileExtensionsAllowed = ['jpeg','jpg','png']; // These will be the only file extensions allowed 

    $fileNam = $_FILES['the_file']['name'];
    $fileSize = $_FILES['the_file']['size'];
    $fileTmpName  = $_FILES['the_file']['tmp_name'];
    $fileType = $_FILES['the_file']['type'];
    $fileExtension = strtolower(end(explode('.',$fileNam)));

    $fileName = generateRandomString() . '.' . $fileExtension;

    $uploadPath = $currentDirectory . $uploadDirectory . basename($fileName); 

    if (isset($_POST['updatecategory'])) {

      if (! in_array($fileExtension,$fileExtensionsAllowed)) {
        $errors[] = "This file extension is not allowed. Please upload a JPEG or PNG file";
      }

      if ($fileSize > 4000000) {
        $errors[] = "File exceeds maximum size (4MB)";
      }

      if (empty($errors)) {
        $didUpload = move_uploaded_file($fileTmpName, $uploadPath);

        if ($didUpload) {

        } else {
          echo "An error occurred. Please contact the administrator.";
        }
      } else {
        foreach ($errors as $error) {
          echo $error . "These are the errors" . "\n";
        }
      }

    }
  } else {
    $fileName = $category["image"];
  }

  $product??nsertQuery = $dbConnect->prepare("UPDATE category SET 
    title = ?, product_type = ?, description = ?, description2 = ?, description3 = ?, price = ?, birim1 = ?, birim2 = ?, image = ?, in_name = ?, in_facemail = ?, in_facepass = ?, in_phone = ?, in_gameid = ?, in_zyngavip = ?, custompacket = ?, statu = ? 
    WHERE id = ?");
  $product??nsertQuery->execute([$inputtitle, $inputproducttype, $inputdescription, $inputdescription2, $inputdescription3, $inputprice, $inputbirim1, $inputbirim2, $fileName, $_POST["checkInName"], $_POST["checkInFace"], $_POST["checkInFacePass"], $_POST["checkInPhone"], $_POST["checkInGameId"], $_POST["checkInZyngaVip"], $_POST["custompacket"], 1, $category["id"]]);
  $insertControl = $product??nsertQuery->rowCount();

  header("Location:/chipadmin/panel/categories.php");
  exit();
}


if (array_key_exists('categorystatuchange', $_GET)) {

  $categoryQuery = $dbConnect->prepare("SELECT * FROM category WHERE id = ?");
  $categoryQuery->execute([$_GET["categorystatuchange"]]);
  $categoryNum = $categoryQuery->rowCount();
  $category = $categoryQuery->fetch(PDO::FETCH_ASSOC);  

  if ($category["statu"] == 0) {
    $newstatu = 1;
  } else {
    $newstatu = 0;
  }

  if ($categoryNum == 1) {
    $category??nsertQuery = $dbConnect->prepare("UPDATE category SET
      statu = ?
      WHERE id = ?");
    $category??nsertQuery->execute([$newstatu, $category["id"]]); 
    header("Location:" . $backurl);
  } else {
    echo "HATA KODU: 49986102235";
  }    

}


if (array_key_exists('categorydelete', $_GET)) {

  $categoryQuery = $dbConnect->prepare("SELECT * FROM category WHERE id = ?");
  $categoryQuery->execute([$_GET["categorydelete"]]);
  $categoryNum = $categoryQuery->rowCount();
  $category = $categoryQuery->fetch(PDO::FETCH_ASSOC);  

  $number = $category["number"];

  if ($categoryNum == 1) {
    $category??nsertQuery = $dbConnect->prepare("UPDATE category SET deleted = 1, number = null 
      WHERE id = ?");
    $category??nsertQuery->execute([$category["id"]]); 

    $category??nsertQuery2 = $dbConnect->prepare("UPDATE category SET number = number-1 
      WHERE number > ?");
    $category??nsertQuery2->execute([$number]);

    header("Location:" . $backurl);
  } else {
    echo "HATA KODU: 5889465280";
  }    

}



if (array_key_exists('categoryorderchange', $_GET)) {

  $categoryQuery = $dbConnect->prepare("SELECT * FROM category WHERE id = ? and deleted = 0");
  $categoryQuery->execute([$_GET["categoryorderchange"]]);
  $categoryNum = $categoryQuery->rowCount();
  $category = $categoryQuery->fetch(PDO::FETCH_ASSOC);

  $number = $category["number"];  


  $categoryQuery2 = $dbConnect->prepare("SELECT * FROM category WHERE deleted = 0");
  $categoryQuery2->execute();
  $categoryTotal = $categoryQuery2->rowCount();


  if ($categoryNum == 1) {

    if ($_GET["order"] == -1 and $number != 1) {

      $categoryOrderQuery = $dbConnect->prepare("UPDATE category SET number = ? 
        WHERE number = ?");
      $categoryOrderQuery->execute([$number, $number-1]);        

      $categoryOrderQuery2 = $dbConnect->prepare("UPDATE category SET number = ? 
        WHERE id = ?");
      $categoryOrderQuery2->execute([$number-1, $category["id"]]);    

    } elseif ($_GET["order"] == 1 and $number != $categoryTotal) {

      $categoryOrderQuery = $dbConnect->prepare("UPDATE category SET number = ? 
        WHERE number = ?");
      $categoryOrderQuery->execute([$number, $number+1]);

      $categoryOrderQuery2 = $dbConnect->prepare("UPDATE category SET number = ? 
        WHERE id = ?");
      $categoryOrderQuery2->execute([$number+1, $category["id"]]);    

    } else {
      header("Location:" . $backurl);
    }

    header("Location:" . $backurl);
  } else {
    echo "HATA KODU: 129955023387";
  }    

}



if (array_key_exists('orderstatuchange', $_GET)) {

  $orderQuery = $dbConnect->prepare("SELECT * FROM orders WHERE id = ?");
  $orderQuery->execute([$_GET["orderstatuchange"]]);
  $orderNum = $orderQuery->rowCount();
  $order = $orderQuery->fetch(PDO::FETCH_ASSOC);  

  $userQuery = $dbConnect->prepare("SELECT * FROM users WHERE id = ?");
  $userQuery->execute([$order["user_id"]]);
  $userNum = $userQuery->rowCount();
  $user = $userQuery->fetch(PDO::FETCH_ASSOC);

  if ($orderNum == 1) {
    $orderChangeQuery = $dbConnect->prepare("UPDATE orders SET statu = ? 
      WHERE id = ?");
    $orderChangeQuery->execute([$_GET["statu"], $_GET["orderstatuchange"]]);

    if ($_GET["statu"] == 3 and $user["invited_user"] != null) {
      $userQuery2 = $dbConnect->prepare("SELECT * FROM users WHERE id = ?");
      $userQuery2->execute([$user["invited_user"]]);
      $userNum2 = $userQuery2->rowCount();
      $user2 = $userQuery2->fetch(PDO::FETCH_ASSOC);
      if ($userNum2 == 1 and $user2["statu"] == 1) {
        $addbalance = number_format($order["price"]*($setting["commission_rate"]*0.01), 2);
        $userChangeBalance = $dbConnect->prepare("UPDATE users SET balance = balance + ? WHERE id = ?");
        $userChangeBalance->execute([$addbalance, $user2["id"]]); 
        $insertControl = $userChangeBalance->rowCount();
        if ($insertControl != 1) {
          echo "HATA KODU: 510065123889";
          exit();
        } else {
          $rewardInsertQuery = $dbConnect->prepare("INSERT INTO reference_rewards (sender_id, invited_id, order_id, balance, created_at) values (?,?,?,?,?)");
          $rewardInsertQuery->execute([$user2["id"], $user["id"], $order["id"], $addbalance, $time]);
          $insertControl = $rewardInsertQuery->rowCount();
        }
      }
    } 
    header("Location:" . $backurl);
  } else {
    echo "HATA KODU: 623065485547";
    exit();
  }    

}


if (array_key_exists('orderdelete', $_GET)) {

  $orderQuery = $dbConnect->prepare("SELECT * FROM orders WHERE id = ?");
  $orderQuery->execute([$_GET["orderdelete"]]);
  $orderNum = $orderQuery->rowCount();
  $order = $orderQuery->fetch(PDO::FETCH_ASSOC);  

  if ($orderNum == 1) {
    $orderChangeQuery = $dbConnect->prepare("UPDATE orders SET deleted = 1 
      WHERE id = ?");
    $orderChangeQuery->execute([$_GET["orderdelete"]]); 
    header("Location:" . $backurl);
  } else {
    echo "HATA KODU: 12056284289";
  }    

}


if (array_key_exists('messagedelete', $_GET)) {

  $messageQuery = $dbConnect->prepare("SELECT * FROM messages WHERE id = ?");
  $messageQuery->execute([$_GET["messagedelete"]]);
  $messageNum = $messageQuery->rowCount();
  $message = $messageQuery->fetch(PDO::FETCH_ASSOC);  

  if ($messageNum == 1) {
    $messageChangeQuery = $dbConnect->prepare("UPDATE messages SET deleted = 1 
      WHERE id = ?");
    $messageChangeQuery->execute([$_GET["messagedelete"]]); 
    header("Location:" . $backurl);
  } else {
    echo "HATA KODU: 442003354899";
  }    

}



if (array_key_exists('orderBstatuchange', $_GET)) {

  $orderQuery = $dbConnect->prepare("SELECT * FROM orders_balance WHERE id = ?");
  $orderQuery->execute([$_GET["orderBstatuchange"]]);
  $orderNum = $orderQuery->rowCount();
  $order = $orderQuery->fetch(PDO::FETCH_ASSOC); 
  $oldstatu = $order["statu"];

  $userQuery = $dbConnect->prepare("SELECT * FROM users WHERE id = ?");
  $userQuery->execute([$order["user_id"]]);
  $userNum = $userQuery->rowCount();
  $user = $userQuery->fetch(PDO::FETCH_ASSOC);

  if ($orderNum == 1) {
    $orderChangeQuery = $dbConnect->prepare("UPDATE orders_balance SET statu = ? WHERE id = ?");
    $orderChangeQuery->execute([$_GET["statu"], $_GET["orderBstatuchange"]]); 
    $insertControl = $orderChangeQuery->rowCount();

    if ($insertControl == 1) {
      if ($_GET["statu"] == 1) {
        $userChangeBalance = $dbConnect->prepare("UPDATE users SET balance = balance + ? WHERE id = ?");
        $userChangeBalance->execute([$order["price"], $user["id"]]); 
        $insertControl = $userChangeBalance->rowCount();
      } else if ($_GET["statu"] != 1 and $oldstatu == 1) {
        $userChangeBalance = $dbConnect->prepare("UPDATE users SET balance = balance - ? WHERE id = ?");
        $userChangeBalance->execute([$order["price"], $user["id"]]); 
        $insertControl = $userChangeBalance->rowCount();
      }
    }

    header("Location:" . $backurl);
  } else {
    echo "HATA KODU: 6232349547";
  }    

}



if (array_key_exists('orderBdelete', $_GET)) {

  $orderQuery = $dbConnect->prepare("SELECT * FROM orders_balance WHERE id = ?");
  $orderQuery->execute([$_GET["orderBdelete"]]);
  $orderNum = $orderQuery->rowCount();
  $order = $orderQuery->fetch(PDO::FETCH_ASSOC);  

  if ($orderNum == 1) {
    $orderChangeQuery = $dbConnect->prepare("UPDATE orders_balance SET deleted = 1 
      WHERE id = ?");
    $orderChangeQuery->execute([$_GET["orderBdelete"]]); 

    header("Location:" . $backurl);
  } else {
    echo "HATA KODU: 44879284289";
  }    

}



if (array_key_exists('newbank', $_POST)) {

  if (isset($_POST["title"])) {
    $inputtitle = Security($_POST["title"]);
  } else
  $inputtitle = "";

  if (isset($_POST["name"])) {
    $inputname = Security($_POST["name"]);
  } else
  $inputname = "";

  if (isset($_POST["sube"])) {
    $inputsube = Security($_POST["sube"]);
  } else
  $inputsube = "";

  if (isset($_POST["account_number"])) {
    $inputaccount_number = Security($_POST["account_number"]);
  } else
  $inputaccount_number = "";

  if (isset($_POST["iban"])) {
    $inputiban = Security($_POST["iban"]);
  } else
  $inputiban = "";

  if (isset($_POST["price"])) {
    $inputprice = Security($_POST["price"]);
  } else
  $inputprice = "";

  $currentDirectory = $_SERVER['DOCUMENT_ROOT'];
  $uploadDirectory = "/images/banks/";

    $errors = []; // Store errors here

    $fileExtensionsAllowed = ['jpeg','jpg','png']; // These will be the only file extensions allowed 

    $fileNam = $_FILES['the_file']['name'];
    $fileSize = $_FILES['the_file']['size'];
    $fileTmpName  = $_FILES['the_file']['tmp_name'];
    $fileType = $_FILES['the_file']['type'];
    $fileExtension = strtolower(end(explode('.',$fileNam)));

    $fileName = generateRandomString() . '.' . $fileExtension;

    $uploadPath = $currentDirectory . $uploadDirectory . basename($fileName); 

    if (! in_array($fileExtension,$fileExtensionsAllowed)) {
      $errors[] = "This file extension is not allowed. Please upload a JPEG or PNG file";
    }

    if ($fileSize > 4000000) {
      $errors[] = "File exceeds maximum size (4MB)";
    }

    if (empty($errors)) {
      $didUpload = move_uploaded_file($fileTmpName, $uploadPath);

      if ($didUpload) {

      } else {
        echo "An error occurred. Please contact the administrator.";
      }
    } else {
      foreach ($errors as $error) {
        echo $error . "These are the errors" . "\n";
      }
    }


    $bank??nsertQuery = $dbConnect->prepare("INSERT INTO bank (title, name, sube, account_number, iban, price, image, statu) values (?,?,?,?,?,?,?,?)");
    $bank??nsertQuery->execute([$inputtitle, $inputname, $inputsube, $inputaccount_number, $inputiban, $inputprice, $fileName, 1]);
    $insertControl = $bank??nsertQuery->rowCount();

    if ($insertControl > 0) {
      header("Location:/chipadmin/panel/banks.php");
      exit();
    } else {
      echo "error newbank reg HATA KODU: 876505462322";
    }


  }


  if (array_key_exists('updatebank', $_POST)) {

    $bankQuery = $dbConnect->prepare("SELECT * FROM bank WHERE id = ?");
    $bankQuery->execute([$_POST["updatebank"]]);
    $bankNum = $bankQuery->rowCount();
    $bank = $bankQuery->fetch(PDO::FETCH_ASSOC);  

    if (isset($_POST["title"])) {
      $inputtitle = Security($_POST["title"]);
    } else
    $inputtitle = "";

    if (isset($_POST["name"])) {
      $inputname = Security($_POST["name"]);
    } else
    $inputname = "";

    if (isset($_POST["sube"])) {
      $inputsube = Security($_POST["sube"]);
    } else
    $inputsube = "";

    if (isset($_POST["account_number"])) {
      $inputaccount_number = Security($_POST["account_number"]);
    } else
    $inputaccount_number = "";

    if (isset($_POST["iban"])) {
      $inputiban = Security($_POST["iban"]);
    } else
    $inputiban = "";

    if (isset($_POST["price"])) {
      $inputprice = Security($_POST["price"]);
    } else
    $inputprice = "";


    if ($_FILES["the_file"]["name"] != null) {

      $currentDirectory = $_SERVER['DOCUMENT_ROOT'];
      $uploadDirectory = "/images/banks/";

    $errors = []; // Store errors here

    $fileExtensionsAllowed = ['jpeg','jpg','png']; // These will be the only file extensions allowed 

    $fileNam = $_FILES['the_file']['name'];
    $fileSize = $_FILES['the_file']['size'];
    $fileTmpName  = $_FILES['the_file']['tmp_name'];
    $fileType = $_FILES['the_file']['type'];
    $fileExtension = strtolower(end(explode('.',$fileNam)));

    $fileName = generateRandomString() . '.' . $fileExtension;

    $uploadPath = $currentDirectory . $uploadDirectory . basename($fileName); 


    if (! in_array($fileExtension,$fileExtensionsAllowed)) {
      $errors[] = "This file extension is not allowed. Please upload a JPEG or PNG file";
    }

    if ($fileSize > 4000000) {
      $errors[] = "File exceeds maximum size (4MB)";
    }

    if (empty($errors)) {
      $didUpload = move_uploaded_file($fileTmpName, $uploadPath);

      if ($didUpload) {

      } else {
        echo "An error occurred. Please contact the administrator.";
      }
    } else {
      foreach ($errors as $error) {
        echo $error . "These are the errors" . "\n";
      }
    }

    
  } else {
    $fileName = $bank["image"];
  }


  $bank??nsertQuery = $dbConnect->prepare("UPDATE bank SET
    title = ?, name = ?, sube = ?, account_number = ?, iban = ?, price = ?, image = ?, statu = ?
    WHERE id = ?");
  $bank??nsertQuery->execute([$inputtitle, $inputname, $inputsube, $inputaccount_number, $inputiban, $inputprice, $fileName, 1, $bank["id"]]);
  $insertControl = $bank??nsertQuery->rowCount();


  header("Location:/chipadmin/panel/banks.php");
  exit();

}


if (array_key_exists('bankstatuchange', $_GET)) {

  $bankQuery = $dbConnect->prepare("SELECT * FROM bank WHERE id = ?");
  $bankQuery->execute([$_GET["bankstatuchange"]]);
  $bankNum = $bankQuery->rowCount();
  $bank = $bankQuery->fetch(PDO::FETCH_ASSOC);  

  if ($bankNum == 1) {
    $bankChangeQuery = $dbConnect->prepare("UPDATE bank SET statu = ? 
      WHERE id = ?");
    $bankChangeQuery->execute([$_GET["statu"], $_GET["bankstatuchange"]]); 
    header("Location:" . $backurl);
  } else {
    echo "HATA KODU: 461531368005";
  }    

}


if (array_key_exists('bankdelete', $_GET)) {

  $bankQuery = $dbConnect->prepare("SELECT * FROM bank WHERE id = ?");
  $bankQuery->execute([$_GET["bankdelete"]]);
  $bankNum = $bankQuery->rowCount();
  $bank = $bankQuery->fetch(PDO::FETCH_ASSOC);  

  if ($bankNum == 1) {
    $bankChangeQuery = $dbConnect->prepare("UPDATE bank SET deleted = 1 
      WHERE id = ?");
    $bankChangeQuery->execute([$_GET["bankdelete"]]); 
    header("Location:" . $backurl);
  } else {
    echo "HATA KODU: 74032213885";
  }    

}



if (array_key_exists('newfaq', $_POST)) {

  if (isset($_POST["title"])) {
    $inputtitle = Security($_POST["title"]);
  } else
  $inputtitle = "";

  if (isset($_POST["content"])) {
    $inputcontent = Security($_POST["content"]);
  } else
  $inputcontent = "";

  $faqInsertQuery = $dbConnect->prepare("INSERT INTO faq (title, content, created_at) values (?,?,?)");
  $faqInsertQuery->execute([$inputtitle, $inputcontent, $time]);
  $insertControl = $faqInsertQuery->rowCount();

  if ($insertControl > 0) {
    header("Location:/chipadmin/panel/faqs.php");
    exit();
  } else {
    echo "error reg HATA KODU: 876588951320";
  }

}




if (array_key_exists('updatefaq', $_POST)) {

  $faqQuery = $dbConnect->prepare("SELECT * FROM faq WHERE id = ?");
  $faqQuery->execute([$_POST["updatefaq"]]);
  $faqNum = $faqQuery->rowCount();
  $faq = $faqQuery->fetch(PDO::FETCH_ASSOC);  

  if (isset($_POST["title"])) {
    $inputtitle = Security($_POST["title"]);
  } else
  $inputtitle = "";

  if (isset($_POST["content"])) {
    $inputcontent = Security($_POST["content"]);
  } else
  $inputcontent = "";


  $faqInsertQuery = $dbConnect->prepare("UPDATE faq SET
    title = ?, content = ?
    WHERE id = ?");
  $faqInsertQuery->execute([$inputtitle, $inputcontent, $faq["id"]]);
  $insertControl = $faqInsertQuery->rowCount();

  header("Location:/chipadmin/panel/faqs.php");

  exit();

}


if (array_key_exists('faqdelete', $_GET)) {

  $faqQuery = $dbConnect->prepare("SELECT * FROM faq WHERE id = ?");
  $faqQuery->execute([$_GET["faqdelete"]]);
  $faqNum = $faqQuery->rowCount();
  $faq = $faqQuery->fetch(PDO::FETCH_ASSOC); 

  if ($faqNum == 1) {
    $faqChangeQuery = $dbConnect->prepare("DELETE FROM faq WHERE id = ?");
    $faqChangeQuery->execute([$_GET["faqdelete"]]); 
    header("Location:" . $backurl);
  } else {
    echo "HATA KODU: 3242521113885";
  }    

}




if (array_key_exists('newblog', $_POST)) {

  if (isset($_POST["title"])) {
    $inputtitle = Security($_POST["title"]);
  } else
  $inputtitle = "";

  if (isset($_POST["text"])) {
    $inputtext = Security($_POST["text"]);
  } else
  $inputtext = "";

  if (isset($_POST["topic"])) {
    $inputtopic = Security($_POST["topic"]);
  } else
  $inputtopic = "";

  $slug = slugit($inputtitle);

  $slugQuery = $dbConnect->prepare("SELECT * FROM blogs WHERE slug = ?");
  $slugQuery->execute([$slug]);
  $slugNum = $slugQuery->rowCount();

  if ($slugNum > 0) {
    $i = 0;
    while ( $slugNum != 0) {
      $i++;
      $slugQuery2 = $dbConnect->prepare("SELECT * FROM blogs WHERE slug = ?");
      $slugQuery2->execute([$slug . "-" . $i]);
      $slugNum = $slugQuery2->rowCount();
    }
    $slug = $slug . "-" . $i;
  } 


  $blog??nsertQuery = $dbConnect->prepare("INSERT INTO blogs (title, text, topic, slug, statu, created_at) values (?,?,?,?,?,?)");
  $blog??nsertQuery->execute([$inputtitle, $inputtext, $inputtopic, $slug, 1, $time]);
  $insertControl = $blog??nsertQuery->rowCount();

  if ($insertControl > 0) {
    header("Location:/chipadmin/panel/blogs.php");
    exit();
  } else {
    echo "error newbank reg HATA KODU: 5641279893001";
  }
  

}


if (array_key_exists('updateblog', $_POST)) {

  $blogQuery = $dbConnect->prepare("SELECT * FROM blogs WHERE id = ?");
  $blogQuery->execute([$_POST["updateblog"]]);
  $blogNum = $blogQuery->rowCount();
  $blog = $blogQuery->fetch(PDO::FETCH_ASSOC);  

  if (isset($_POST["title"])) {
    $inputtitle = Security($_POST["title"]);
  } else
  $inputtitle = "";

  if (isset($_POST["text"])) {
    $inputtext = Security($_POST["text"]);
  } else
  $inputtext = "";

  if (isset($_POST["topic"])) {
    $inputtopic = Security($_POST["topic"]);
  } else
  $inputtopic = "";

  $blog??nsertQuery = $dbConnect->prepare("UPDATE blogs SET
    title = ?, text = ?, topic = ?, statu = ?, created_at = ?
    WHERE id = ?");
  $blog??nsertQuery->execute([$inputtitle, $inputtext, $inputtopic, 1, $time, $blog["id"]]);
  $insertControl = $blog??nsertQuery->rowCount();


  header("Location:/chipadmin/panel/blogs.php");
  exit();

}


if (array_key_exists('blogstatuchange', $_GET)) {

  $blogQuery = $dbConnect->prepare("SELECT * FROM blogs WHERE id = ?");
  $blogQuery->execute([$_GET["blogstatuchange"]]);
  $blogNum = $blogQuery->rowCount();
  $blog = $blogQuery->fetch(PDO::FETCH_ASSOC);  

  if ($blogNum == 1) {
    $blogChangeQuery = $dbConnect->prepare("UPDATE blogs SET statu = ? 
      WHERE id = ?");
    $blogChangeQuery->execute([$_GET["statu"], $_GET["blogstatuchange"]]); 
    header("Location:" . $backurl);
  } else {
    echo "HATA KODU: 15795651205";
  }    

}


if (array_key_exists('blogdelete', $_GET)) {

  $blogQuery = $dbConnect->prepare("SELECT * FROM blogs WHERE id = ?");
  $blogQuery->execute([$_GET["blogdelete"]]);
  $blogNum = $blogQuery->rowCount();
  $blog = $blogQuery->fetch(PDO::FETCH_ASSOC);  

  if ($blogNum == 1) {
    $blogChangeQuery = $dbConnect->prepare("UPDATE blogs SET deleted = 1 
      WHERE id = ?");
    $blogChangeQuery->execute([$_GET["blogdelete"]]); 
    header("Location:" . $backurl);
  } else {
    echo "HATA KODU: 11515795023";
  }    

}



if (array_key_exists('updateUser', $_POST)) {

  $userQuery = $dbConnect->prepare("SELECT * FROM users WHERE id = ?");
  $userQuery->execute([$_POST["updateUser"]]);
  $userNum = $userQuery->rowCount();
  $user = $userQuery->fetch(PDO::FETCH_ASSOC);  

  if (isset($_POST["name"])) {
    $inputname = Security($_POST["name"]);
  } else
  $inputname = "";

  if (isset($_POST["phone"])) {
    $inputphone = Security($_POST["phone"]);
  } else
  $inputphone = "";

  if ($_POST["password"] != null) {
    $inputpassword = Security($_POST["password"]);
    $md5pass       = md5($inputpassword);
  } else
  $md5pass = $user["password"];

  $user??nsertQuery = $dbConnect->prepare("UPDATE users SET
    name = ?, password = ?, phone = ?
    WHERE id = ?");
  $user??nsertQuery->execute([$inputname, $md5pass, $inputphone, $user["id"]]);
  $insertControl = $user??nsertQuery->rowCount();

  header("Location:/chipadmin/panel/users.php");
  exit();

}



if (array_key_exists('userstatuchange', $_GET)) {

  $userQuery = $dbConnect->prepare("SELECT * FROM users WHERE id = ?");
  $userQuery->execute([$_GET["userstatuchange"]]);
  $userNum = $userQuery->rowCount();
  $user = $userQuery->fetch(PDO::FETCH_ASSOC);  

  if ($userNum == 1) {
    $userChangeQuery = $dbConnect->prepare("UPDATE users SET statu = ? 
      WHERE id = ?");
    $userChangeQuery->execute([$_GET["statu"], $_GET["userstatuchange"]]); 
    header("Location:" . $backurl);
  } else {
    echo "HATA KODU: 15795651205";
  }    

}



if (array_key_exists('userdelete', $_GET)) {

  $userQuery = $dbConnect->prepare("SELECT * FROM users WHERE id = ?");
  $userQuery->execute([$_GET["userdelete"]]);
  $userNum = $userQuery->rowCount();
  $user = $userQuery->fetch(PDO::FETCH_ASSOC);  

  if ($userNum == 1) {
    $userChangeQuery = $dbConnect->prepare("UPDATE users SET deleted = 1 
      WHERE id = ?");
    $userChangeQuery->execute([$_GET["userdelete"]]); 
    header("Location:" . $backurl);
  } else {
    echo "HATA KODU: 94051238551";
  }    

}



if (array_key_exists('updatemainsettings', $_POST)) {

  $settingQuery = $dbConnect->prepare("SELECT * FROM settings WHERE id = ?");
  $settingQuery->execute([$_POST["updatemainsettings"]]);
  $settingNum = $settingQuery->rowCount();
  $setting = $settingQuery->fetch(PDO::FETCH_ASSOC);  

  if (isset($_POST["title"])) {
    $inputtitle = Security($_POST["title"]);
  } else
  $inputtitle = "";

  if (isset($_POST["url"])) {
    $inputurl = Security($_POST["url"]);
  } else
  $inputurl = "";

  if (isset($_POST["description"])) {
    $inputdescription = Security($_POST["description"]);
  } else
  $inputdescription = "";

  if (isset($_POST["keywords"])) {
    $inputkeywords = Security($_POST["keywords"]);
  } else
  $inputkeywords = "";

  if (isset($_POST["address"])) {
    $inputaddress = Security($_POST["address"]);
  } else
  $inputaddress = "";

  if (isset($_POST["phone"])) {
    $inputphone = Security($_POST["phone"]);
  } else
  $inputphone = "";

  if (isset($_POST["email"])) {
    $inputemail = Security($_POST["email"]);
  } else
  $inputemail = "";


  if ($_FILES["the_file_logo"]["name"] != null) {

    $currentDirectory = $_SERVER['DOCUMENT_ROOT'];
    $uploadDirectory = "/images/icons/";

    $errors = []; // Store errors here

    $fileExtensionsAllowed = ['jpeg','jpg','png']; // These will be the only file extensions allowed 

    $fileNameLog = $_FILES['the_file_logo']['name'];
    $fileSize = $_FILES['the_file_logo']['size'];
    $fileTmpName  = $_FILES['the_file_logo']['tmp_name'];
    $fileType = $_FILES['the_file_logo']['type'];
    $fileExtension = strtolower(end(explode('.',$fileNameLog)));

    $fileNameLogo = generateRandomString() . '.' . $fileExtension;

    $uploadPath = $currentDirectory . $uploadDirectory . basename($fileNameLogo); 

    if (! in_array($fileExtension,$fileExtensionsAllowed)) {
      $errors[] = "This file extension is not allowed. Please upload a JPEG or PNG file";
    }

    if ($fileSize > 4000000) {
      $errors[] = "File exceeds maximum size (4MB)";
    }

    if (empty($errors)) {
      $didUpload = move_uploaded_file($fileTmpName, $uploadPath);

      if ($didUpload) {

      } else {
        echo "An error occurred. Please contact the administrator.";
      }
    } else {
      foreach ($errors as $error) {
        echo $error . "These are the errors" . "\n";
      }
    }

  } else {
    $fileNameLogo = $setting["logo"];
  }



  if ($_FILES["the_file_alt"]["name"] != null) {

    $currentDirectory = $_SERVER['DOCUMENT_ROOT'];
    $uploadDirectory = "/images/icons/";

    $errors = []; // Store errors here

    $fileExtensionsAllowed = ['jpeg','jpg','png']; // These will be the only file extensions allowed 

    $fileNameAl = $_FILES['the_file_alt']['name'];
    $fileSize = $_FILES['the_file_alt']['size'];
    $fileTmpName  = $_FILES['the_file_alt']['tmp_name'];
    $fileType = $_FILES['the_file_alt']['type'];
    $fileExtension = strtolower(end(explode('.',$fileNameAl)));

    $fileNameAlt = generateRandomString() . '.' . $fileExtension;

    $uploadPath = $currentDirectory . $uploadDirectory . basename($fileNameAlt); 

    if (! in_array($fileExtension,$fileExtensionsAllowed)) {
      $errors[] = "This file extension is not allowed. Please upload a JPEG or PNG file";
    }

    if ($fileSize > 4000000) {
      $errors[] = "File exceeds maximum size (4MB)";
    }

    if (empty($errors)) {
      $didUpload = move_uploaded_file($fileTmpName, $uploadPath);

      if ($didUpload) {

      } else {
        echo "An error occurred. Please contact the administrator.";
      }
    } else {
      foreach ($errors as $error) {
        echo $error . "These are the errors" . "\n";
      }
    }

  } else {
    $fileNameAlt = $setting["footimage"];
  }

  $setting??nsertQuery = $dbConnect->prepare("UPDATE settings SET
    title = ?, url = ?, description = ?, keywords = ?, address = ?, phone = ?, email = ?, logo = ?, footimage = ?
    WHERE id = ?");
  $setting??nsertQuery->execute([$inputtitle, $inputurl, $inputdescription, $inputkeywords, $inputaddress, $inputphone, $inputemail, $fileNameLogo, $fileNameAlt, $setting["id"]]);
  $insertControl = $setting??nsertQuery->rowCount();

  header("Location:/chipadmin/panel/settings.php");
  exit();

}


if (array_key_exists('updatethemesettings', $_POST)) {

  $themeQuery = $dbConnect->prepare("SELECT * FROM themesettings WHERE id = ?");
  $themeQuery->execute([$_POST["updatethemesettings"]]);
  $themeNum = $themeQuery->rowCount();
  $theme = $themeQuery->fetch(PDO::FETCH_ASSOC);  

  if (isset($_POST["topbandheader"])) {
    $topbandheader = Security($_POST["topbandheader"]);
  } else
  $topbandheader = "";

  if (isset($_POST["topband"])) {
    $topband = Security($_POST["topband"]);
  } else
  $topband = "";


  $themeInsertQuery = $dbConnect->prepare("UPDATE themesettings SET 
    topbandheader = ?, topband = ? 
    WHERE id = ?");
  $themeInsertQuery->execute([$topbandheader, $topband, $theme["id"]]);
  $insertControl = $themeInsertQuery->rowCount();

  header("Location:/chipadmin/panel/themesettings");
  exit();


}




if (array_key_exists('updatesmtpsettings', $_POST)) {

  $settingQuery = $dbConnect->prepare("SELECT * FROM settings WHERE id = ?");
  $settingQuery->execute([$_POST["updatesmtpsettings"]]);
  $settingNum = $settingQuery->rowCount();
  $setting = $settingQuery->fetch(PDO::FETCH_ASSOC);  

  if (isset($_POST["host"])) {
    $inputhost = Security($_POST["host"]);
  } else
  $inputhost = "";

  if (isset($_POST["user"])) {
    $inputuser = Security($_POST["user"]);
  } else
  $inputuser = "";

  if (isset($_POST["pass"])) {
    $inputpass = Security($_POST["pass"]);
  } else
  $inputpass = "";

  if (isset($_POST["port"])) {
    $inputport = Security($_POST["port"]);
  } else
  $inputport = "";


  $smsetting??nsertQuery = $dbConnect->prepare("UPDATE settings SET
    SMTPhost = ?, SMTPuser = ?, SMTPpass = ?, SMTPport = ?
    WHERE id = ?");
  $smsetting??nsertQuery->execute([$inputhost, $inputuser, $inputpass, $inputport, $setting["id"]]);
  $insertControl = $smsetting??nsertQuery->rowCount();

  header("Location:/chipadmin/panel/smtpsettings.php");
  exit();

}



function generateRandomString($length = 10) {
  $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
  $charactersLength = strlen($characters);
  $randomString = '';
  for ($i = 0; $i < $length; $i++) {
    $randomString .= $characters[rand(0, $charactersLength - 1)];
  }
  return $randomString;
}



if (array_key_exists('newslider', $_POST)) {

  if (isset($_POST["title"])) {
    $inputtitle = Security($_POST["title"]);
  } else
  $inputtitle = "";

  if (isset($_POST["number"])) {
    $inputname = Security($_POST["name"]);
  } else
  $inputname = "";

  if (isset($_POST["link"]) and $_POST["link"] != "") {
    $inputlink = Security($_POST["link"]);
  } else
  $inputlink = NULL;

  $currentDirectory = $_SERVER['DOCUMENT_ROOT'];
  $uploadDirectory = "/images/slider/";

    $errors = []; // Store errors here

    $fileExtensionsAllowed = ['jpeg','jpg','png']; // These will be the only file extensions allowed 

    $fileNam = $_FILES['the_file']['name'];
    $fileSize = $_FILES['the_file']['size'];
    $fileTmpName  = $_FILES['the_file']['tmp_name'];
    $fileType = $_FILES['the_file']['type'];
    $fileExtension = strtolower(end(explode('.',$fileNam)));

    $fileName = generateRandomString() . '.' . $fileExtension;

    $uploadPath = $currentDirectory . $uploadDirectory . basename($fileName); 

    if (! in_array($fileExtension,$fileExtensionsAllowed)) {
      $errors[] = "This file extension is not allowed. Please upload a JPEG or PNG file";
    }

    if ($fileSize > 4000000) {
      $errors[] = "File exceeds maximum size (4MB)";
    }

    if (empty($errors)) {
      $didUpload = move_uploaded_file($fileTmpName, $uploadPath);

      if ($didUpload) {

      } else {
        echo "An error occurred. Please contact the administrator.";
      }
    } else {
      foreach ($errors as $error) {
        echo $error . "These are the errors" . "\n";
      }
    }

    $orderQuery = $dbConnect->prepare("SELECT MAX(number) as ord FROM slider");
    $orderQuery->execute();
    $orderNum = $orderQuery->rowCount();
    $order = $orderQuery->fetch(PDO::FETCH_ASSOC); 

    $number = $order["ord"];      


    $slider??nsertQuery = $dbConnect->prepare("INSERT INTO slider (title, image, link, number, statu) values (?,?,?,?,?)");
    $slider??nsertQuery->execute([$inputtitle, $fileName, $inputlink, $number+1, 1]);
    $insertControl = $slider??nsertQuery->rowCount();

    if ($insertControl > 0) {
      header("Location:/chipadmin/panel/slider.php");
      exit();
    } else {
      echo "error newslid reg HATA KODU: 8793940462322";
    }


  }



  if (array_key_exists('updateslider', $_POST)) {

    $sliderQuery = $dbConnect->prepare("SELECT * FROM slider WHERE id = ?");
    $sliderQuery->execute([$_POST["updateslider"]]);
    $sliderNum = $sliderQuery->rowCount();
    $slider = $sliderQuery->fetch(PDO::FETCH_ASSOC);  

    if (isset($_POST["title"])) {
      $inputtitle = Security($_POST["title"]);
    } else
    $inputtitle = "";

    if (isset($_POST["link"])) {
      $inputlink = Security($_POST["link"]);
    } else
    $inputlink = "";


    if ($_FILES["the_file"]["name"] != null) {

      $currentDirectory = $_SERVER['DOCUMENT_ROOT'];
      $uploadDirectory = "/images/slider/";

    $errors = []; // Store errors here

    $fileExtensionsAllowed = ['jpeg','jpg','png']; // These will be the only file extensions allowed 

    $fileNam = $_FILES['the_file']['name'];
    $fileSize = $_FILES['the_file']['size'];
    $fileTmpName  = $_FILES['the_file']['tmp_name'];
    $fileType = $_FILES['the_file']['type'];
    $fileExtension = strtolower(end(explode('.',$fileNam)));

    $fileName = generateRandomString() . '.' . $fileExtension;

    $uploadPath = $currentDirectory . $uploadDirectory . basename($fileName); 


    if (!in_array($fileExtension,$fileExtensionsAllowed)) {
      $errors[] = "This file extension is not allowed. Please upload a JPEG or PNG file";
    }

    if ($fileSize > 4000000) {
      $errors[] = "File exceeds maximum size (4MB)";
    }

    if (empty($errors)) {
      $didUpload = move_uploaded_file($fileTmpName, $uploadPath);

      if ($didUpload) {

      } else {
        echo "An error occurred. Please contact the administrator.";
      }
    } else {
      foreach ($errors as $error) {
        echo $error . "These are the errors" . "\n";
      }
    }

    
  } else {
    $fileName = $slider["image"];
  }


  $slider??nsertQuery = $dbConnect->prepare("UPDATE slider SET
    title = ?, image = ?, link = ?, statu = ?
    WHERE id = ?");
  $slider??nsertQuery->execute([$inputtitle, $fileName, $inputlink, $slider["statu"], $slider["id"]]);
  $insertControl = $slider??nsertQuery->rowCount();


  header("Location:/chipadmin/panel/slider.php");
  exit();

}



if (array_key_exists('sliderdelete', $_GET)) {

  $sliderQuery = $dbConnect->prepare("SELECT * FROM slider WHERE id = ?");
  $sliderQuery->execute([$_GET["sliderdelete"]]);
  $sliderNum = $sliderQuery->rowCount();
  $slider = $sliderQuery->fetch(PDO::FETCH_ASSOC);  

  if ($sliderNum == 1) {
    $sliderChangeQuery = $dbConnect->prepare("DELETE FROM slider WHERE id = ?");
    $sliderChangeQuery->execute([$_GET["sliderdelete"]]); 

    $sliderChangeQuery2 = $dbConnect->prepare("UPDATE slider SET number = number-1 WHERE number > ?");
    $sliderChangeQuery2->execute([$slider["number"]]);

    header("Location:" . $backurl);
  } else {
    echo "HATA KODU: 342645268885";
  }    

}



if (array_key_exists('sliderstatuchange', $_GET)) {

  $sliderQuery = $dbConnect->prepare("SELECT * FROM slider WHERE id = ?");
  $sliderQuery->execute([$_GET["sliderstatuchange"]]);
  $sliderNum = $sliderQuery->rowCount();
  $slider = $sliderQuery->fetch(PDO::FETCH_ASSOC);  

  if ($sliderNum == 1) {
    $sliderChangeQuery = $dbConnect->prepare("UPDATE slider SET statu = ? 
      WHERE id = ?");
    $sliderChangeQuery->execute([$_GET["statu"], $_GET["sliderstatuchange"]]); 
    header("Location:" . $backurl);
  } else {
    echo "HATA KODU: 492002354856";
  }    

}


if (array_key_exists('sliderorderchange', $_GET)) {

  $sliderQuery = $dbConnect->prepare("SELECT * FROM slider WHERE id = ?");
  $sliderQuery->execute([$_GET["sliderorderchange"]]);
  $sliderNum = $sliderQuery->rowCount();
  $slider = $sliderQuery->fetch(PDO::FETCH_ASSOC);

  $number = $slider["number"];  


  $sliderQueryy = $dbConnect->prepare("SELECT * FROM slider");
  $sliderQueryy->execute();
  $sliderTotal = $sliderQueryy->rowCount();


  if ($sliderNum == 1) {

    if ($_GET["order"] == -1 and $number > 1) {

      $sliderOrderQuery2 = $dbConnect->prepare("UPDATE slider SET number = ? 
        WHERE number = ?");
      $sliderOrderQuery2->execute([$number, $number-1]);        

      $sliderOrderQuery = $dbConnect->prepare("UPDATE slider SET number = ? 
        WHERE id = ?");
      $sliderOrderQuery->execute([$number-1, $slider["id"]]);    

    } elseif ($_GET["order"] == 1 and $number <= $sliderTotal) {

      $sliderOrderQuery2 = $dbConnect->prepare("UPDATE slider SET number = ? 
        WHERE number = ?");
      $sliderOrderQuery2->execute([$number, $number+1]);

      $sliderOrderQuery = $dbConnect->prepare("UPDATE slider SET number = ? 
        WHERE id = ?");
      $sliderOrderQuery->execute([$number+1, $slider["id"]]);    

    }

    header("Location:" . $backurl);
  } else {
    echo "HATA KODU: 129955023387";
  }    

}







setlocale(LC_ALL, 'en_US.UTF8');
function slugit($str, $replace=array(), $delimiter='-') {
  if ( !empty($replace) ) {
    $str = str_replace((array)$replace, ' ', $str);
  }
  $clean = iconv('UTF-8', 'ASCII//TRANSLIT', $str);
  $clean = preg_replace("/[^a-zA-Z0-9\/_|+ -]/", '', $clean);
  $clean = strtolower(trim($clean, '-'));
  $clean = preg_replace("/[\/_|+ -]+/", $delimiter, $clean);
  return $clean;
}

?>