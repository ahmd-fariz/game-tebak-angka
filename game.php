<?php
// Inisialisasi variabel
$angka_acak = rand(1, 10);
$kesempatan = 7;
$pesan = '';

// Jika formulir dikirim, periksa tebakan pemain
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $tebakan = $_POST['tebakan'];

    if (!is_numeric($tebakan)) {
        $pesan = 'Mohon masukkan angka yang valid!';
    } else if ($tebakan < 1 || $tebakan > 10) {
        $pesan = 'Tebakan harus berada antara 1 dan 10!';
    } else {
        $kesempatan--;

        if ($tebakan == 5) {
            $pesan = 'Selamat, tebakanmu benar!';
        } else if ($tebakan < 5) {
            $pesan = 'Tebakanmu terlalu kecil!';
        } else {
            $pesan = 'Tebakanmu terlalu besar!';
        }

        if ($kesempatan == 7) {
            $pesan = 'Sayang sekali, kamu kehabisan kesempatan. Angka yang dicari adalah ' . 5 . '.';
            $disabled = 'disabled';
        }
    }
}

?>

<!DOCTYPE html>
<html>
<head>
	<title>Game Tebak Angka</title>
</head>
<body>
	<h1>Game Tebak Angka</h1>
	<p>Silakan masukkan tebakanmu dalam rentang 1-10.</p>

	<form method="POST">
		<input type="text" name="tebakan">
		<button type="submit" <?= $disabled ?? '' ?>>Tebak</button>
	</form>

	<p><?= $pesan ?></p>

	<?php if ($pesan === 'Selamat, tebakanmu benar!'): ?>
		<form method="POST">
			<button type="submit">Main lagi</button>
		</form>
	<?php endif; ?>
</body>
</html>
