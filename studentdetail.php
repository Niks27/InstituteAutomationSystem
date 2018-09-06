<?php	
	require_once("crud6.php");
	if(isset($_POST['submit']) && $_POST['submit'] == "Insert")
	{
		$crudobj = new crud;
		$crudobj->insert($_POST);
		$id = $crudobj->id;
		
		header("location:viewresult.php?id=$id");
	}
?>

<!DOCTYPE html>
	<head>
		<link rel="stylesheet" type="text/css" href="css\bootstrap.min.css">
		<script type="text/javascript" src="http://code.jquery.com/jquery-2.2.3.min.js"></script>	
		<script type="text/javascript" src="js/jquery.validate.min.js"></script>	
	</head>

	<title> Student Information </title>
	<body>
		<div class="pull-right">
		<a href="studentlist1.php" class="btn btn-primary" style="margin top: 15px;"> Manage Student </a>
		</div>

		<form action="" method="POST" enctype="multipart/form-data" id="user">
			<h4 class=text-center> Student Personal Information </h4>
			<div class="form-group clearfix">
				<div class="col-sm-4">
					<label class="label-control"> First Name </label>
					<input type="text" name="fname" class="form-control" id="firstname">
					<p id="p1"></p>
				</div>

				<div class="col-sm-4">
					<label class="label-control"> Last Name </label>
					<input type="text" name="lname" class="form-control" id="lastname">
					<p id="p2"></p>
				</div>		

				<div class="col-sm-4">
					<label class="label-control"> Address </label>
					<input type="textfield" name="address" class="form-control" id="address">
					<p id="p3"></p>
				</div>		
			</div>

			<div class="form-group clearfix">
				<div class="col-sm-4">
					<label class="label-control"> Birth Date </label>
					<input type="date" name="dob" class="form-control" id="birth_date">
					<p id="p4"></p>
				</div>

				<div class="col-sm-4">
					<label class="label-control"> Age </label>
					<input type="number" name="age" class="form-control" id="student_age">
					<p id="p5"></p>
				</div>

				<div class="col-sm-4">
					<label class="label-control"> Mobile </label>
					<input type="number" name="mobile" class="form-control" id="mobile">
					<p id="p6"></p>
				</div>
			</div>

			<div class="form-group clearfix">
				<div class="col-sm-4" style="margin-top:40px;">
					<label class="label-control"> Gender </label>
					<input type="radio" name="gender" value="Male" checked> Male
					<input type="radio" name="gender" value="Female"> Female
				</div>

				<div class="col-sm-4">
					<label class="label-control"> Batch </label>
					<select class="form-control" name="batch">
						<option value="Multi_OS"> Multi-OS </option>
						<option value="PPA"> Pre-Placement Activity </option>
						<option value="Logic_Building"> Logic Building </option>
						<option value="Unix"> Unix Internals </option>
						<option value="Web_Development"> Web Development </option>
					</select>
				</div>

				<div class="col-sm-4">
					<label class="label-control"> Fees </label>
					<input type="text" name="fees" class="form-control" id="fees">
					<p id="p7"></p>
				</div>

				<div class="col-sm-4">
					<label class="label-control"> Profile Picture </label>
					<input type="file" name="profilepic">
				</div>
			</div>

			<div class="form-group clearfix text-center">
				<input type="submit" name="submit" value="Insert" style="margin-top:15px;" onclick="return validate();">
			</div>
		</form>
	</body>
</html>

<script type="text/javascript">

function validate()
{
	var name_regex = /^[a-zA-Z]+$/;
	var add_regex = /^[0-9a-zA-Z]+$/;
	var fees_regex = /^\d+$/;
	var ph = /^[789][0-9]{9}$/;
	var fname = $('#firstname').val();
	var lname = $('#lastname').val();
	var address = $('#address').val();
	var fees = $('#fees').val();
	var mobile = $('#mobile').val();
	var age = $('#student_age').val();
	var birth_date = $('#birth_date').val();
	var flag = 0;

	document.getElementById("p1").innerHTML = "";
	document.getElementById("p2").innerHTML = "";
	document.getElementById("p3").innerHTML = "";
	document.getElementById("p4").innerHTML = "";
	document.getElementById("p5").innerHTML = "";
	document.getElementById("p6").innerHTML = "";
	document.getElementById("p7").innerHTML = "";

	if(fname == "")
	{
		$('#p1').text("*First Name cannot be empty*");
		$('#firstname').focus();
		flag = 1;
	}

	else if(!fname.match(name_regex))
	{
		$('#p1').text("*First Name must contain only alphabets*");
		$('#firstname').focus();
		flag = 1;
	}

	else if(lname == "")
	{
		$('#p2').text("*Last Name cannot be empty*");
		$('#lastname').focus();
		flag = 1;
	}

	else if(!lname.match(name_regex))
	{
		$('#p2').text("*Last Name must contain only alphabets*");
		$('#lastname').focus();
		flag = 1;
	}

	else if(address == "")
	{
		$('#p3').text("*Address cannot be empty*");
		$('#address').focus();
		flag = 1;
	}

	else if(!address.match(add_regex))
	{
		$('#p3').text("*Address must contain only alphabets or numbers*");
		$('#address').focus();
		flag = 1;
	}

	else if(fees == "")
	{
		$('#p7').text("*Fees cannot be empty*");
		$('#fees').focus();
		flag = 1;
	}

	else if(!fees.match(fees_regex))
	{
		$('#p7').text("*Fees must contain only numbers*");
		$('#fees').focus();
		flag = 1;
	}

	else if(mobile == "")
	{
		$('#p6').text("*Mobile cannot be empty*");
		$('#mobile').focus();
		flag = 1;
	}

	else if(!mobile.match(ph))
	{
		$('#p6').text("*Mobile must contain only numbers*");
		$('#mobile').focus();
		flag = 1;
	}

	else if(age == "")
	{
		$('#p5').text("*Age cannot be empty*");
		$('#age').focus();
		flag = 1;
	}

	else if(!age.match(fees_regex))
	{
		$('#p5').text("*Age must contain only numbers*");
		$('#age').focus();
		flag = 1;
	}

	else if(birth_date == "")
	{
		$('#p4').text("*Birth Date cannot be empty*");
		flag = 1;
	}

	if(flag == 1)
	{
		return false;
	}

	else
	{
		return true;
	}
}

</script>