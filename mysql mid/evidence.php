<?php 
$db = new mysqli('localhost','root','','company');
if(isset($_POST['btnSubmit'])){
	$mname = $_POST['mname'];
	$contact = $_POST['contact'];
	$db->query(" call add_manufacture('$mname','$contact') ");
}
if(isset($_POST['addProduct'])){
	$pname = $_POST['pname'];
	$price = $_POST['price'];
	$mid = $_POST['manufac'];
	$db->query(" call add_product('$pname','$price','$mid') ");
}
if(isset($_POST['delmanufact'])){
	$mid = $_POST['manufac'];
	$db->query(" delete from manufacturer where id='$mid ' ");
}
?>
<!DOCTYPE html>
<html lang="en" data-theme="light">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Document</title>
	
	<link href="https://cdn.jsdelivr.net/npm/daisyui@4.9.0/dist/full.min.css" rel="stylesheet" type="text/css" />
<script src="https://cdn.tailwindcss.com"></script>
	<style>

	h3{
		text-align:center;
		font-weight:bold;
	}
	</style>
</head>
<body>
<div class="flex justify-around">
<div class="card bg-base-100 shadow-xl p-3">
	<h3 >Manufacturer table</h3>
<form action="#" method="post">
	<table class="table border-separate">
		<tr>
			<td><label for="mname">Name :</label></td>
			<td><input class="input input-bordered input-sm" type="text" name="mname" /></td>
		</tr>
		<tr>
			<td><label for="contact">Contact :</label></td>
			<td><input class="input input-bordered input-sm" type="text" name="contact" /></td>
		</tr>
		<tr> 
			<td></td>
			<td><input class="btn btn-sm bg-green-500 text-[white]" type="submit" name="btnSubmit" value="submit" /></td>
		</tr>
	</table>
</form>
	</div>

<div class="card bg-base-100 shadow-xl p-3">
<h3>Product table</h3>
<form action="#" method="post">
	<table class="table border-separate">
		<tr>
			<td><label for="pname">Name :</label></td>
			<td><input class="input input-bordered input-sm" type="text" name="pname" /></td>
		</tr>
		<tr>
			<td><label for="price">Price :</label></td>
			<td><input class="input input-bordered input-sm" type="text" name="price" /></td>
		</tr>
		<tr>
			<td><label for="manufac">Manufacturer Name</label></td>
			<td>
				<select class="p-2 shadow menu dropdown-content z-[1] bg-base-100 rounded-box inline" name="manufac">
					<?php 
						$manufac = $db->query("select * from manufacturer");
						while(list($_mid,$_mname) = $manufac->fetch_row()){
							echo "<option value='$_mid'>$_mname</option>";
						}
					?>
				</select>
			</td>
		</tr>
		<tr> 
			<td></td>
			<td><input class="btn btn-sm bg-green-500 text-[white]" type="submit" name="addProduct" value="submit" /></td>
		</tr>
	</table>
</form>
</div>
</div>	
<form class="justify-center space-x-3 flex items-center" action="#" method="post">	
			<label for="manufac">Manufacturer</label>		
				<select class="p-2 shadow menu dropdown-content z-[1] bg-base-100 rounded-box inline" name="manufac">
					<?php 
						$manufac = $db->query("select * from manufacturer");
						while(list($_mid,$_mname) = $manufac->fetch_row()){
							echo "<option value='$_mid'>$_mname</option>";
						}
					?>
				</select>
			<input class="btn " type="submit" name="delmanufact" value="delete" />
</form>

<div class="flex flex-col items-center">
<h3>View Product</h3>
<table class="table w-1/2 card bg-base-100 shadow-xl p-5" > 
	<thead>
	<tr>
		<th>ID</th>
		<th>Name</th>
		<th>Price</th>
		<th>Manufacturer</th>
		<th>Contact</th>
	</tr>
	</thead>
	<tbody>
	<?php 
		$product = $db->query(" select * from view_product ");
		while(list($_id,$_name,$_price,$_mname,$_mcont) = $product->fetch_row()){
			echo "<tr> 
					<td>$_id</td>
					<td>$_name</td>
					<td>$_price</td>
					<td>$_mname</td>
					<td>$_mcont</td>
				</tr>";
		}
	
	?>
	</tbody>
	
</table>
</div>
</body>
</html>






