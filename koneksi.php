<?php
	//koneksi database
	$link = mysql_connect('localhost', 'root', '')
	or die('Could not Connect: ' . mysql_error());
	mysql_select_db('data_mahasiswa') or die('Could not select database');
?>