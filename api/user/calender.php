<?php
session_start();
include('../includes/db.php');

$result = mysqli_query($conn,"SELECT booking_date,status FROM booking");
?>

<!DOCTYPE html>
<html>
<head>

<title>Booking Calendar</title>

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">

<style>

.booked{
background-color:red;
color:white;
}

.pending{
background-color:orange;
color:white;
}

.available{
background-color:green;
color:white;
}

</style>

</head>

<body>
	<nav class="navbar navbar-dark bg-dark">

	<div class="container">

	<a class="navbar-brand"></a>

	<div>
	<a href="user_dashboard.php" class=" btn btn-light">Back</a>	
	
	</div>

	</div>

	</nav>	

<div class="container mt-5">

<h2 class="text-center">Hall Booking Calendar</h2>

<table class="table table-bordered text-center">

<tr class="table-dark">
<th>Date</th>
<th>Status</th>
</tr>

<?php

while($row=mysqli_fetch_assoc($result))
{

$status=$row['status'];

if($status=="Approved")
$class="booked";

elseif($status=="Pending")
$class="pending";

else
$class="available";

?>

<tr>

<td><?php echo $row['booking_date']; ?></td>

<td class="<?php echo $class; ?>">
<?php echo $status; ?>
</td>

</tr>

<?php
}
?>

</table>

</div>

</body>
</html>