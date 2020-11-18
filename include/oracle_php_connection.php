<?php 
$username='system';
$password='system';
$service='localhost/XE';

$c = oci_pconnect($username, $password, $service); 

// connection
if (!$c) {    
  $e =oci_error();    
  trigger_error('Could not connect to database: '.$e['message'],E_USER_ERROR); 
} 



function Execute($query){

  $c=$GLOBALS['c'];
  $s = oci_parse($c, $query); 
  if (!$s){    
    $e = oci_error($c);
    trigger_error('Could not parse statement: '. $e['message'], E_USER_ERROR); 
  }

  $r = oci_execute($s); 
  if(!$r){    
    $e = oci_error($s);
    return $r; //returns false
    trigger_error('Could not execute statement:'. $e['message'], E_USER_ERROR); 
  }

  return $s; //returns values(it is true) 
}



function GetArray($query){

  $array=[];
  $s=Execute($query);
  while ($row = oci_fetch_array($s, OCI_BOTH)) {

      /* OCI_BOTH returns an array with both associative and numeric indices. This is the same as OCI_ASSOC + OCI_NUM and is the default behavior
      For associative array index name must be same as Oracle db column name (case sensitive)
      echo $row['ENAME'];----------------------OR---------------------- echo $row[1]; */

      // echo $row['ENAME'];
      // echo "<br>";
     $array[]=$row;
  }
  return $array;

}



/*
$a=GetArray('select * from customer');
foreach ($a as $b) { ?>
  <h4><?php echo $b['CUSTOMER_NAME'];?></h4>

<?php
}*/




/*
if(Execute("update customer set customer_name='smith' where CUSTOMER_STREET='a'")){
  echo "<script>alert('DONE!!!!!!!!!!!!!');</script>";
}

else {
  echo "<script>alert('FAILED!!!!!!!!!');</script>"; 
}
*/

?>