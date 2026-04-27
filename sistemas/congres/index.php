<?php
// Configura��es do arquivo para download
$filename = 'FichaDeCadastroCONGRES.xlsx';
$filePath = __DIR__ . '/downloads/' . $filename;

// Verifica se o download foi solicitado
if (isset($_GET['download']) && file_exists($filePath)) {
    // Inicia o download se o arquivo estiver presente
    header('Content-Description: File Transfer');
    header('Content-Type: application/octet-stream');
    header('Content-Disposition: attachment; filename="' . basename($filename) . '"');
    header('Expires: 0');
    header('Cache-Control: must-revalidate');
    header('Pragma: public');
    header('Content-Length: ' . filesize($filePath));
    readfile($filePath);
    exit;
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Download Automático</title>
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            background-color: #f4f4f4;
            font-family: Arial, sans-serif;
        }
        .container {
            text-align: center;
            padding: 20px;
            border: 2px solid #ccc;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        h1 {
            color: #333;
            font-size: 2rem;
        }
        p {
            font-size: 1rem;
            color: #666;
        }
        a {
            color: #007bff;
            text-decoration: none;
        }
        a:hover {
            text-decoration: underline;
        }
    </style>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Após 3 segundos, redireciona para download.php com parâmetro download=true
            setTimeout(function () {
                window.location.href = window.location.pathname + '?download=true';
            }, 3000);
        });
    </script>
</head>
<body>
    <div class="container">
        <h1>Download Automático</h1>
        <p>Se o download não iniciar automaticamente em 3 segundos, <a href="?download=true">clique aqui</a>.</p>
    </div>
</body>
</html>
