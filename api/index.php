<?php
	

?>
<!DOCTYPE html>
<html>
<head>
	<title>Developer Api Documentation</title>
	 <meta charset="utf-8">
	  <meta name="viewport" content="width=device-width, initial-scale=1">
	  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
	  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
	  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>

<style type="text/css">
	body{
		font-family:cambria;
	}
</style>
<body>
	<div class="container-fluid">

	<h1>Developer Api Documentation</h1>
	<hr/>

	<ul class="list-group list-group-flush">

	<?php 
	   $i = 1;
	foreach (getall('tbl_apidoc') as $row): ?>

		<!--Add the Following Header Line !-->

		<h5><?php echo $i?>. <b><?php echo(explode('/',$row['routes'])[0]); ?>
	    </b>▬</h5>
	    
	    <!--Add the Following Header Line !-->

		<li class="list-group-item">
		<p style="text-align: justify;"> 
			<b style="font-size:0.9rem;letter-spacing: 2px;">
				<i><?php echo $row['http'];?> <?php echo $row['method'];?></i>
			</b>
		<a href="<?php echo $row['routes']; ?>"><?php echo $row['label']; ?></a>&nbsp;&nbsp;
        <mark style="background-color: #90ee9096;border-radius:7px;">status <?php echo $row['status_code']; ?></mark>
        <code>

 					<mark><?php echo $row['keyname']; ?></mark>

 				</code> 

    	</p>
 		<ul>
 			<li>
 				<span style="letter-spacing: 2px;">Server Response can be xml,json,yml,plain/text,html but json is recommended.</span>
 			</li>
 			<li>Request=<code><mark>{json} wwww-url-encode/ raw data=body</mark></code></li>
 			<li>Response={<code><mark><?php echo $row['response_type']; ?></mark></code>}</li>
 			
       
 			<li>
		        <details>
		        	<summary>
								Description
					</summary>


					<dl>
						<dt>
							<?php echo $row['label']; ?>
						</dt>

					
			 		<dd>
			 			<?php echo $row['description']; ?>
			 		</dd>
		 	</dl>
		        </details>
		     </li>
 		 </ul>

		</li>
	<!-- 	<li>HTTP/1.1 POST<a href="role.php">Admin Role</a> keyname=role,status</li>
		<li>HTTP/1.1 POST<a href="login.php">login</a> keyname=email,password</li>
		<li>HTTP/1.1 POST<a href="signup.php">Signup</a> keyname=role_id,mobile,email,password,status</li> -->
	

	<?php 
	$i++;
	endforeach;
	?>

</ul>

</div>

</body>
</html>
