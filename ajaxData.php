<?php
session_start();
include_once('../../../wp-config.php');
include_once('../../../wp-load.php');



if(isset($_POST["country_id"]) && !empty($_POST["country_id"])){
     global $wpdb;
     $sqlquery  = $wpdb->get_results("SELECT * FROM states WHERE country_id = ".$_POST['country_id']." AND status = 1 ORDER BY state_name ASC");
     ?>
      <?php
       foreach ($sqlquery as  $value) {
        ?>
        <option value="<?php echo $value->state_id; ?>" <?php if($value->state_id == $_SESSION['filterserch']['state']){ echo 'selected'; } ?>><?php echo $value->state_name; ?></option>
        <?php
       }
       ?>
     <?php

}

if(isset($_POST["state_id"]) && !empty($_POST["state_id"])){
     global $wpdb;
     $sqlquery  = $wpdb->get_results("SELECT * FROM cities WHERE state_id = ".$_POST['state_id']." AND status = 1 ORDER BY city_name ASC");
     ?>
      <?php
       foreach ($sqlquery as  $value) {
        ?>
        <option value="<?php echo $value->city_id; ?>" <?php if($value->city_id == $_SESSION['filterserch']['city']){ echo 'selected'; } ?>><?php echo $value->city_name; ?></option>
        <?php
       }
       ?>
     <?php

}


if(isset($_POST["radioValue"]) && !empty($_POST["radioValue"])){
 $radioValue = $_POST["radioValue"];


   global $wpdb;
     $sqlquery  = $wpdb->get_results("SELECT * FROM states WHERE country_id = ".$radioValue." AND status = 1 ORDER BY state_name ASC");
     $radioValue1 = $sqlquery['0']->state_id;
     $sqlquery114  = $wpdb->get_results("SELECT * FROM cities WHERE state_id = ".$radioValue1." AND status = 1 ORDER BY city_name ASC");
     $radioValue2 = $sqlquery114['0']->city_id;



//print_r($sqlquery);



  $_SESSION["countrycode"] = $radioValue;
  //$_SESSION["statecode"] = $radioValue1;
  //$_SESSION["citycode"] = $radioValue2;

  $_SESSION["countrycode44444"] = 1;


  
}
if(isset($_POST["ucity"]) && !empty($_POST["ucity"])){
  $radioValue = $_POST["ucity"];
 

 $sqlquery114  = $wpdb->get_results("SELECT * FROM cities WHERE state_id = ".$radioValue." AND status = 1 ORDER BY city_name ASC");
$radioValue2 = $sqlquery114['0']->city_id;



  $_SESSION["statecode"] = $radioValue;
  //$_SESSION["citycode"] = $radioValue2;
 $_SESSION["countrycode44444"] = 1;



  
}
if(isset($_POST["ucity11"]) && !empty($_POST["ucity11"])){
  $radioValue = $_POST["ucity11"];
  $_SESSION["citycode"] = $radioValue;
   $_SESSION["countrycode44444"] = 1;
  
}

?>
