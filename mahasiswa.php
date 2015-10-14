<?php

//1. koneksi database
$konek = mysql_connect("localhost", "root", "");
$db = mysql_select_db("mahasiswa");
if($konek){
	echo("koneksi berhasil <br>");
}else{
	echo("koneksi tidak berhasil <br>");
}

if($db){
	echo("db available <br>");
}else{
	echo("db not found <br>");
}

//2. query database
$query = "select * from mahasiswa";
	$hasil = mysql_query($query);

	$datamahasiswa = array();

	while ($data = mysql_fetch_array($hasil)) {
		$datamahasiswa [] = array('nim' => $data['nim'],
		'nama' => $data['nama'],
		'alamat' => $data['alamat'],
		'prodi' => $data['prodi']);
		//echo $data['nim'];
	}

//3. parsing data XML
	$document = new DOMDocument();
		$document->formatOutput = true;
		$root = $document->createElement("data");
		$document->appendChild($root);
		foreach ($datamahasiswa as $mahasiswa) {
			$block = $document->createElement("mahasiswa");

			//create element nim
			$nim = $document->createElement("nim");
			//create element untuk membuat element baru
			$nim->appendChild($document->createTextNode($mahasiswa['nim']));
			//createTextNode untuk menampilkan isi/value
			$block->appendChild($nim);
			//appendchild untuk mempersiapkan nilai dari element diatasnya

			//create element nama
			$nama = $document->createElement("nama");
			$nama->appendchild($document->createTextNode($mahasiswa['nama']));
			$block->appendchild($nama);

			//create element alamat
			$alamat = $document->createElement("alamat");
			$alamat->appendchild($document->createTextNode($mahasiswa['alamat']));
			$block->appendchild($alamat);

			//create element prodi
			$prodi = $document->createElement("prodi");
			$prodi->appendchild($document->createTextNode($mahasiswa['prodi']));
			$block->appendchild($prodi);

			$root->appendchild($block);
		}

//4. menyimpan data dalam bentuk file XML
	$generateXML = $document->save("mahasiswa.xml");
	if($generateXML){
		echo("berhasil di generate <br>");
	}else{
		echo("gagal <br>");
	}

//5. membaca file xml
	//membuka file
	$url = "http://localhost/tugassit5/mahasiswa.xml";
	$client = curl_init($url);
	curl_setopt($client, CURLOPT_RETURNTRANSFER, 1);
	$response = curl_exec($client);
	curl_close($client);
	//membaca file
	$result = mysql_query($query) or die ('Query Failed: '.mysql_error());
	echo "<data>";
	while ($line = mysql_fetch_array($result, MYSQL_ASSOC)) {
		/*echo "<mahasiswa>";
		foreach ($line as $key => $col_value) {
			echo "<$key>$col_value</$key>";
		}
			echo "</mahasiswa>";*/
	}
		echo "</data>";

//6. ditampilkan dalam bentuk html
		$datamahasiswaxml = simplexml_load_string($response);
		//print_r($datamahasiswaxml);
			//perulangan
			echo "
				<table border='1'>
					<tr>
						<td>NIM</td>
						<td>NAMA</td>
						<td>ALAMAT</td>
						<td>PRODI</td>
					</tr>";
			foreach ($datamahasiswaxml -> mahasiswa as $mahasiswa) {
						echo "
						<tr>
							<td>".$mahasiswa->nim."</td>
							<td>".$mahasiswa->nama."</td>
							<td>".$mahasiswa->alamat."</td>
							<td>".$mahasiswa->prodi."</td>
						</tr>";
					}
			echo "</table>"		
?>