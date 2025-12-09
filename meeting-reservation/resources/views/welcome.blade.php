<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Sistem Reservasi Ruang Rapat</title>
    
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, sans-serif;
            background: linear-gradient(135deg, #0f2027 0%, #203a43 50%, #2c5364 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }

        .container {
            max-width: 900px;
            width: 100%;
        }

        .card {
            background: white;
            border-radius: 16px;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
            overflow: hidden;
        }

        header {
            background: linear-gradient(135deg, #1e3c72 0%, #2a5298 100%);
            color: white;
            padding: 60px 40px;
            text-align: center;
        }

        header h1 {
            font-size: 32px;
            font-weight: 700;
            margin-bottom: 12px;
            letter-spacing: -0.5px;
        }

        header p {
            font-size: 16px;
            opacity: 0.95;
            font-weight: 400;
        }

        main {
            padding: 50px 40px;
        }

        .features {
            margin-bottom: 40px;
        }

        .features h2 {
            font-size: 24px;
            color: #2c3e50;
            margin-bottom: 24px;
            font-weight: 600;
        }

        .features ul {
            list-style: none;
        }

        .features li {
            padding: 16px 0;
            border-bottom: 1px solid #e9ecef;
            color: #495057;
            font-size: 15px;
            line-height: 1.6;
            padding-left: 28px;
            position: relative;
        }

        .features li:last-child {
            border-bottom: none;
        }

        .features li::before {
            content: "✓";
            position: absolute;
            left: 0;
            color: #2a5298;
            font-weight: bold;
            font-size: 18px;
        }

        .cta-buttons {
            display: flex;
            gap: 16px;
            justify-content: center;
            margin-top: 40px;
        }

        .btn {
            padding: 14px 32px;
            border-radius: 8px;
            text-decoration: none;
            font-size: 15px;
            font-weight: 600;
            transition: all 0.3s ease;
            display: inline-block;
        }

        .btn-primary {
            background: linear-gradient(135deg, #1e3c72 0%, #2a5298 100%);
            color: white;
            box-shadow: 0 4px 12px rgba(30, 60, 114, 0.4);
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 16px rgba(30, 60, 114, 0.5);
        }

        .btn-secondary {
            background: white;
            color: #1e3c72;
            border: 2px solid #1e3c72;
        }

        .btn-secondary:hover {
            background: #1e3c72;
            color: white;
            transform: translateY(-2px);
        }

        @media (max-width: 768px) {
            header {
                padding: 40px 30px;
            }

            header h1 {
                font-size: 26px;
            }

            header p {
                font-size: 14px;
            }

            main {
                padding: 40px 30px;
            }

            .features h2 {
                font-size: 20px;
            }

            .cta-buttons {
                flex-direction: column;
            }

            .btn {
                width: 100%;
                text-align: center;
            }
        }

        @media (max-width: 480px) {
            header {
                padding: 30px 20px;
            }

            header h1 {
                font-size: 22px;
            }

            main {
                padding: 30px 20px;
            }

            .features li {
                font-size: 14px;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="card">
            <header>
                <h1>Sistem Reservasi Ruang Rapat</h1>
                <p>Solusi mudah untuk mengelola jadwal pertemuan Anda</p>
            </header>
            
            <main>
                <section class="features">
                    <h2>Fitur Utama</h2>
                    <ul>
                        <li>Cek ketersediaan ruang secara real-time</li>
                        <li>Pesan ruang rapat dalam jam kerja (08:00 - 17:00)</li>
                        <li>Kelola riwayat reservasi dan pembatalan dengan mudah</li>
                    </ul>
                </section>

                <section class="cta-buttons">
                    <a href="/login" class="btn btn-primary">Masuk</a>
                    <a href="/register" class="btn btn-secondary">Daftar Sekarang</a>
                </section>
            </main>
        </div>
    </div>
</body>
</html>