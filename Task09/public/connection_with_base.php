<?php
try {
	$pdo = new PDO('sqlite:../data/salon.db');
} catch (PDOException $e) {
	die('Database connect error: ' . $e->getMessage());
}
