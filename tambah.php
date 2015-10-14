<html>
	<body>
		<a href="view_mahasiswa.php">Lihat Mahasiswa</a>
		<form method="POST" action="mhs.php">
			<table>
				<tr>
					<td>NIM</td>
					<td><input type="text" name="nim" id="nim"></td>
				</tr>

				<tr>
					<td>NAMA</td>
					<td><input type="text" name="nama" id="nama"></td>
				</tr>

				<tr>
					<td>ALAMAT</td>
					<td><input type="text" name="alamat" id="alamat"></td>
				</tr>

				<tr>
					<td>PRODI</td>
					<td><input type="text" name="prodi" id="prodi"></td>
				</tr>

				<tr>
					
					<td><input type="submit" name="submit" value="tambah"></td>
				</tr>
			</table>
		</form>
	</body>
</html>