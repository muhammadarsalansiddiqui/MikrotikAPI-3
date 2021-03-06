<?php
session_start();
use PEAR2\Net\RouterOS;
require_once 'PEAR2/Autoload.php';
if(empty($_SESSION['username'] ) ){
	header("Location:login.php");
}else {
?>
<!DOCTYPE html>
<html>

<head>

	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<title>Mikrotik API V.1</title>

	<!-- Bootstrap CSS -->
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css"
	<link rel="stylesheet" href="assets/demo.css">
	<link rel="stylesheet" href="assets/sidebar-collapse.css">

	<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css">
	<link href='http://fonts.googleapis.com/css?family=Cookie' rel='stylesheet' type='text/css'>


</head>

<body>

	<aside class="sidebar-left-collapse">

		<a href="index.php" class="company-logo"><img src="assets/images/mikrotik.png" height="130px" width="130px"></a>

		<div class="sidebar-links">

			<div class="link-yellow">

				<a href="#">
					<i class="fa fa-keyboard-o"></i>IP Address
				</a>

				<ul class="sub-links">
					<li><a href="addipaddress.php">Tambah IP Address</a></li>
					<li><a href="showipaddress.php">Lihat IP Address</a></li>
				</ul>

			</div>

			<div class="link-yellow">

				<a href="#">
					<i class="fa fa-keyboard-o"></i>IP Route
				</a>

				<ul class="sub-links">
					<li><a href="addiproute.php">Tambah IP Route</a></li>
					<li><a href="showiproute.php">Lihat IP Route</a></li>
				</ul>

			</div>

			<div class="link-yellow">

				<a href="#">
					<i class="fa fa-keyboard-o"></i>IP NAT
				</a>

				<ul class="sub-links">
					<li><a href="addipnat.php">Tambah IP NAT</a></li>
					<li><a href="showipnat.php">Lihat IP NAT</a></li>
				</ul>

			</div>

			<div class="link-yellow">

				<a href="#">
					<i class="fa fa-keyboard-o"></i>DNS
				</a>

				<ul class="sub-links">
					<li><a href="addipdns.php">Tambah IP DNS</a></li>
					<li><a href="showipdns.php">Lihat IP DNS</a></li>
				</ul>

			</div>

			<div class="link-yellow">

			<a href="logout.php">
				<i class="fa fa-keyboard-o"></i>Logout
			</a>

			</div>

		</div>

	</aside>

	<div class="main-content">
				<h1>Daftar IP NAT</h1>
				<br>
		<?php
			$client = new RouterOS\Client($_SESSION["ipaddress"], $_SESSION["username"], $_SESSION["password"]);
			$responses1 = $client->sendSync(new RouterOS\request('/ip/firewall/nat/print'));
			?>

			<table class="table table-bordered table-responsive-lg">
				<thead class="thead-dark">
					<tr>
					<th scope="col">Out Interface</th>
					<th scope="col">Action</th>
					<th scope="col">Chain</th>
					<th scope="col">Aksi</th>
					</tr>
				</thead>
				<tbody>
				<?php foreach($responses1 as $rs1) :?>
					<?php if($rs1->getType() == RouterOS\Response::TYPE_DATA){?>
					<tr>
					<td><?php echo $rs1->getProperty('out-interface'); ?></td>
					<td><?php echo $rs1->getProperty('action'); ?></td>
					<td><?php echo $rs1->getProperty('chain'); ?></td>
					<td>
					<a class="btn btn-danger" href="delipnat.php?id=<?php echo $rs1->getProperty('.id'); ?>" role="button">Hapus</a>
					</td>
					</tr>
					<?php } ?>
			<?php endforeach; ?>
				</tbody>
				</table>
	</div>

	<script src="http://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
	<script>

		$(function () {

			var links = $('.sidebar-links > div');

			links.on('click', function () {

				links.removeClass('selected');
				$(this).addClass('selected');

			});
		});

	</script>

</body>

</html>
	<?php } ?>




