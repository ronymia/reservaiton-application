<?php include "inc/header.php"; ?>
<?php
    spl_autoload_register(function($class){
        
        include "classes/".$class.".php";
    });
?>

<section class="mainleft">
<?php
    $user = new Student();

if(isset($_POST['create'])){
    $name = $_POST['name'];
    $dep = $_POST['dep'];
    $age = $_POST['age'];
    
    $user->setName($name);
    $user->setDep($dep);
    $user->setAge($age);
    
    if($user->insert()){
        echo "<span class='insert'>Data Inserted Successfully...</span>";
    }
    
}
    
if(isset($_POST['update'])){
    $id = $_POST['id'];
    $name = $_POST['name'];
    $dep = $_POST['dep'];
    $age = $_POST['age'];
    
    $user->setName($name);
    $user->setDep($dep);
    $user->setAge($age);
    
    
    
    if($user->update($id)){
        echo "<span class='insert'>Data Updated Successfully...</span>";
    }
    
}  
    
    
?>
<?php
    if(isset ($_GET["action"]) && $_GET["action"]=='delete'){
       $id = (int)$_GET["id"];
       if($user->delete($id)){
           echo "<span class='delete'>Data Deleted Successfully...</span>";
       } 
    }
?>
<?php
    if(isset ($_GET["action"]) && $_GET["action"]=='update'){
       $id = (int)$_GET["id"];
    $result = $user->readById($id);
  
?>

<form action="" method="post">
 <table>
   <input type="hidden" value="<?php echo $result['id'];?>" name="id" />
    <tr>
        <td>Name: </td>
        <td><input type="text" value="<?php echo $result['name'];?>" name="name" required="1"/></td>    
    </tr>

    <tr>
       <td>Department: </td>
        <td><input type="text" value="<?php echo $result['dep'];?>" name="dep" required="1"/></td>
    </tr>

    <tr>
      <td>Age: </td>
        <td><input type="text" value="<?php echo $result['age'];?>" name="age" required="1"/></td>
    </tr>
    <tr>
      <td></td>
        <td>
        <input type="submit" name="update" value="Submit"/>
        <input type="reset" value="Clear"/>
        </td>
    </tr>
  </table>
</form>
<?php } else{
        
     ?>

<form action="" method="post">
 <table>
    <tr>
        <td>Name: </td>
        <td><input type="text" name="name" required="1"/></td>    
    </tr>

    <tr>
       <td>Department: </td>
        <td><input type="text" name="dep" required="1"/></td>
    </tr>

    <tr>
      <td>Age: </td>
        <td><input type="text" name="age" required="1"/></td>
    </tr>
    <tr>
      <td></td>
        <td>
        <input type="submit" name="create" value="Submit"/>
        <input type="reset" value="Clear"/>
        </td>
    </tr>
  </table>
</form>
<?php } ?>
</section>



<section class="mainright">
  <table class="tblone">
    <tr>
        <th>No</th>
        <th>Name</th>
        <th>Department</th>
        <th>Age</th>
        <th>Action</th>
    </tr>
<?php
      $i = 0;
      foreach ($user->readAll() as $key => $value){
         $i++; 
     
?>
    <tr>
        <td><?php echo $i; ?></td>
        <td><?php echo $value['name']; ?></td>
        <td><?php echo $value['dep']; ?></td>
        <td><?php echo $value['age']; ?></td>
        <td>
        <?php echo "<a href='index.php?action=update&id=".$value['id']."'>Edit</a>";?> ||
        <?php echo "<a href='index.php?action=delete&id=".$value['id']."' onClick='return confirm(\"Are you sure to Delete Data..\")'>Delete</a>";?> ||
        </td>
    </tr>
<?php  } ?>
 
  </table>
</section>










































<?php include "inc/footer.php"; ?>