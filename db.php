<?php
$dbconnect = mysqli_connect('localhost', 'root', '', 'employeemanagement');

if (isset($_POST['insert'])) {
    print_r($_POST);
    $name = $_POST['emp_name'];
    $age = $_POST['emp_age'];
    $gender = $_POST['emp_gender'];
    $desig = $_POST['emp_desig'];
    $email = $_POST['emp_email'];
    $pswd = $_POST['emp_pswd'];
    $sql = "INSERT into emp_dtls(emp_name,emp_age,emp_gender,emp_desig,emp_email,emp_pswd)values('$name','$age','$gender','$desig','$email','$pswd')";
    // echo $sql;
    if (mysqli_query($dbconnect, $sql)) {
        echo 'Inserted';
    } else {
        echo 'Failed';
    }
    ;
} elseif (isset($_GET['fetch'])) {

    $sql = "SELECT * from emp_dtls";
    $exc = mysqli_query($dbconnect, $sql);
    $length = mysqli_num_rows($exc);
    if($length>0){
        while($row=mysqli_fetch_assoc($exc)){
            $d[]=$row;
        }
    }
    echo json_encode($d);
 
} 
elseif(isset($_POST['delete'])){
    $id=$_POST['id'];
    $sql="DELETE from emp_dtls where emp_id=$id";
    echo $sql;
    $exc=mysqli_query($dbconnect,$sql);
    if($exc){
        echo"deleted successfully";
    }else{
        echo"Failed to delete";
    }
}elseif(isset($_POST['edit'])){
    $id=$_POST['id'];
    $sql="SELECT * from emp_dtls where emp_id=$id";
    $result=mysqli_query($dbconnect,$sql);
    while($rows=mysqli_fetch_assoc($result)){
        $d[]=$rows;
    }
    echo json_encode($d);

}
elseif(isset($_POST['update'])){
    $id=$_POST['emp_id'];
    $name=$_POST['emp_name'];
    $age=$_POST['emp_age'];
    $gender=$_POST['emp_gender'];
    $desig=$_POST['emp_desig'];
    $email=$_POST['emp_email'];
    $pswd=$_POST['emp_pswd'];

    $sql="UPDATE emp_dtls set emp_name='$name',emp_age=$age,emp_gender='$gender',emp_desig='$desig',emp_email='$email',emp_pswd='$pswd' where emp_id='$id'";
    // echo $sql;
    $result=mysqli_query($dbconnect,$sql);
    if($result){
        echo"Updated successfully";
    }else{
        echo"Update failed";
    }
}
