<html>
	<head>
		<title> View Data Bukti</title>
	</head>
	<body>
		<?php
			//include "koneksi.php";
			//resource
			$url = 'http://localhost/tugasSit5/mhs.php';

			//mengambil data string dari resources
			$client = curl_init($url);
			curl_setopt($client, CURLOPT_RETURNTRANSFER, 1);
			$response = curl_exec($client);
			curl_close($client);

			$datamahasiswaxml = simplexml_load_string($response);

			echo "<table border = '1'>
					<tr>
						<td>NIM</td>
						<td>NAMA</td>
						<td>ALAMAT</td>
						<td>PRODI</td>
					</tr>";
			foreach ($datamahasiswaxml->mahasiswa as $mahasiswa) {
				echo "
					<tr>
						<td>".$mahasiswa->nim."</td>
						<td>".$mahasiswa->nama."</td>
						<td>".$mahasiswa->alamat."</td>
						<td>".$mahasiswa->prodi."</td>
					</tr>
					";
			}
			echo "</table>";
		?>
	</body>	
</html>