<?php
include("includes/crud.php");
$page=$_GET["page"];
if($page=="" || $page==1)
{
$page1=0;
}
else
{
$page1=($page*5)-5;
}

$sql="SELECT * FROM frnd_det2 order by code desc limit $page1,5";

if(isset($_POST['search1']))
{
$searchitem=mysql_real_escape_string($_POST['searchbox']);
$sql .= " WHERE fname = '{$searchitem}'";
$sql .= " OR gender = '{$searchitem}'";
$sql .= " OR address = '{$searchitem}'";
$sql .= " OR phone = '{$searchitem}'";
$sql .= " OR code = '{$searchitem}'";
}

$rd=mysql_query($sql) or die(mysql_error());
?>
<html>
<head>
<title>Display information</title>
<script>
function validateForm() 
{
var x = document.forms["searchform"]["searchbox"].value;
if (x == null || x == "")
{
alert("Nothing for search");
return false;
}
}
</script>
</head>
<body>
<a href="create.php" title="Add New Frnds">Add New Frnds Details</a></br></br>
<form name="searchform" method="POST" action="d.php" onsubmit="return validateForm()">Search:
<input type="text" name="searchbox" value="">
<input type="submit" name="search1" value="search table">
</form>
<table bgcolor="skyblue" border="1" cellspacing="3" cellpadding="3">
<tr>
<th width="25">frnd id</th>
<th width="120">Friend Name</th>
<th width="120">Gender</th>
<th widht="120">Address</th>
<th width="120">Phone Number</th>
<th width="120">Time</th>
</tr>
<?php
while($ro=mysql_fetch_array($rd))
{
$f1=$ro['code'];
$f2=$ro['fname'];
$f3=$ro['gender'];
$f4=$ro['address'];
$f5=$ro['phone'];
$f6=$ro['time'];  
?>
<tr>
<td><?php echo $f1; ?></td>
<td><?php echo $f2; ?></td>
<td><?php echo $f3; ?></td>
<td><?php echo $f4; ?></td>
<td><?php echo $f5; ?></td>
<td><?php echo date("g:i a F j, Y ", strtotime($ro['time'])) ?></td>
<td><a href="update.php?id=<?php echo $f1 ?>">Edit</a></td>
<td><a href="delete.php?id=<?php echo $f1 ?>">Delete</a></td>
</tr> 
<?php
}
?>
</table>

<?php 
$re=mysql_query("select * from frnd_det");
$co=mysql_num_rows($re);
$a=ceil($co/5);
echo "<br><br>";
for($b=1;$b<=$a;$b++)
{
?>

<a href="d.php?page=<?php echo $b ?>" style="text-decoration:none"><?php echo $b." "; ?></a>
<?php
}
?>
</body>
</html>
