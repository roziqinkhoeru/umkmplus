<!DOCTYPE html>
<html>
<head>
    <title>Sertifikat Pembelajaran</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        .container {
            width: 800px;
            margin: 0 auto;
            padding: 20px;
            border: 2px solid #ccc;
        }
        .header {
            text-align: center;
            margin-bottom: 20px;
        }
        .title {
            font-size: 24px;
            font-weight: bold;
            margin-bottom: 10px;
        }
        .subtitle {
            font-size: 18px;
            margin-bottom: 10px;
        }
        .content {
            text-align: justify;
            margin-bottom: 20px;
        }
        .signature {
            text-align: right;
        }
        .name {
            font-weight: bold;
        }
        .date {
            font-style: italic;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <img src="sertifikat-logo.png" alt="Logo" width="150">
            <h2 class="title">SERTIFIKAT PEMBELAJARAN</h2>
            <p class="subtitle">(Diberikan kepada)</p>
            <h3 class="name">{{ $courseEnroll->student->name }}</h3>
        </div>
        <div class="content">
            <p>
                Telah mengikuti kelas {{ $courseEnroll->course->title }} dengan penuh dedikasi dan berhasil menyelesaikan semua modul pembelajaran yang diberikan.
            </p>
            <p>
                Dengan ini, kami menyatakan bahwa {{ $courseEnroll->student->name }} telah memperoleh sertifikat pembelajaran yang diakui dan dihargai.
            </p>
        </div>
        <div class="signature">
            <p>
                <span class="name">Verdian Galang Pratama</span><br>
                CPO of UMKMPlus<br>
                <span class="date">{{ \Carbon\Carbon::now()->format('d F Y') }}</span>
            </p>
        </div>
    </div>
</body>
</html>
