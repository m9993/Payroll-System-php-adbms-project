<?php 
$username='system';
$password='system';
$service='localhost/XE';

$c = oci_pconnect($username, $password, $service); 

// connection
if (!$c) {    
  $e =oci_error();    
  trigger_error('Could not connect to database: '.$e['message'],E_USER_ERROR); 
}else{
  DbCheck();
}



// Check db tables exists or create them
function DbCheck(){

  // users table
  $users="SELECT count(*) count FROM dba_tables where table_name = 'USERS'";
  $a=GetArray($users);
  foreach ($a as $b) {
    $count= $b['COUNT'];
  }
  if ($count<=0){
    $users="create table USERS (u_phone varchar2(30),u_id number(20) CONSTRAINT PK_U_ID_USERS PRIMARY KEY,u_name varchar2(30),u_address varchar2(30),u_dob  varchar2(30))";
    Execute($users);
  }
  // users table


  // login table
  $login="SELECT count(*) count FROM dba_tables where table_name = 'LOGIN'";
  $a=GetArray($login);
  foreach ($a as $b) {
    $count= $b['COUNT'];
  }
  if ($count<=0){
    $login="create table LOGIN(u_id number(20) CONSTRAINT FK_U_ID_LOGIN REFERENCES USERS,u_password varchar2(30),u_email varchar2(30))";
    Execute($login);
  }
  // login table


  // role table
  $role="SELECT count(*) count FROM dba_tables where table_name = 'ROLE'";
  $a=GetArray($role);
  foreach ($a as $b) {
    $count= $b['COUNT'];
  }
  if ($count<=0){
    $role="create table ROLE(u_id number(20) CONSTRAINT FK_U_ID_ROLE REFERENCES USERS,u_role varchar2(30))";
    Execute($role);
  }
  // role table


  // working_point table
  $workingPoint="SELECT count(*) count FROM dba_tables where table_name = 'WORKING_POINT'";
  $a=GetArray($workingPoint);
  foreach ($a as $b) {
    $count= $b['COUNT'];
  }
  if ($count<=0){
    $workingPoint="create table WORKING_POINT(u_id number(20) CONSTRAINT FK_U_ID_WORKING_POINT REFERENCES USERS,w_time number(20),w_complain varchar2(30),w_extrahour number(20),w_date varchar2(30))";
    Execute($workingPoint);
  }
  // working_point table


  // salary table
  $salary="SELECT count(*) count FROM dba_tables where table_name = 'SALARY'";
  $a=GetArray($salary);
  foreach ($a as $b) {
    $count= $b['COUNT'];
  }
  if ($count<=0){
    $salary="create table SALARY(u_id number(20) CONSTRAINT FK_U_ID_SALARY REFERENCES USERS, basicsalary number(20,2), bonus number(20,2), deduction number(20,2))";
    Execute($salary);
  }
  // salary table


  // payment table
  $payment="SELECT count(*) count FROM dba_tables where table_name = 'PAYMENT'";
  $a=GetArray($payment);
  foreach ($a as $b) {
    $count= $b['COUNT'];
  }
  if ($count<=0){
    $payment="create table PAYMENT (u_id number(20) CONSTRAINT FK_U_ID_PAYMENT REFERENCES USERS,incometax number(20,2),hra number(20,2),ma number(20,2),others number(20,2))";
    Execute($payment);
  }
  // payment table


  // payroll table
  $payroll="SELECT count(*) count FROM dba_tables where table_name = 'PAYROLL'";
  $a=GetArray($payroll);
  foreach ($a as $b) {
    $count= $b['COUNT'];
  }
  if ($count<=0){
    $payroll="create table PAYROLL (p_id number(20) CONSTRAINT PK_P_ID_PAYROLL PRIMARY KEY,u_id number(20) CONSTRAINT FK_U_ID_PAYROLL REFERENCES USERS,p_date varchar2(30),totalamount number(20,2))";
    Execute($payroll);
  }
  // payroll table


  // invoice table
  $invoice="SELECT count(*) count FROM dba_tables where table_name = 'INVOICE'";
  $a=GetArray($invoice);
  foreach ($a as $b) {
    $count= $b['COUNT'];
  }
  if ($count<=0){
    $invoice="create table INVOICE (p_id number(20) CONSTRAINT FK_P_ID_PAYROLL REFERENCES PAYROLL,inv_status varchar2(30))";
    Execute($invoice);
  }
  // invoice table
  



}
// Check db tables exists or create them



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

  return $s; //returns values 
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