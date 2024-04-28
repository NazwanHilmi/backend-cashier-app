<!DOCTYPE html>
<html>
<head>
    <title>Pesan dari Formulir Kontak</title>
</head>
<body>
    <h2>Detail Pesan:</h2>
    <p><strong>Nama:</strong> {{ $data['name'] }}</p>
    <p><strong>Email:</strong> {{ $data['email'] }}</p>
    <p><strong>Pesan:</strong> {{ $data['message'] }}</p>
</body>
</html>
