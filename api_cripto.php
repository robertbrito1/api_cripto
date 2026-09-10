<?php
// 1. URL de la API de CoinGecko
$url = "https://api.coingecko.com/api/v3/simple/price?ids=bitcoin,ethereum,solana,sui,dogecoin,cardano&vs_currencies=usd,eur";

// 2. Inicializar cURL
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_USERAGENT, "MiBotCryptoPHP/1.0");

// 3. Ejecutar la petición
$response = curl_exec($ch);
$httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
curl_close($ch);

$data = [];
$error = false;

if ($httpCode === 200 && $response) {
    $data = json_decode($response, true);
} else {
    $error = true;
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="refresh" content="180"> <!-- Recarga cada 3 minutos para evitar bloqueos (Error 429) -->
    <title>Dashboard Criptomonedas</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #0f172a;
            color: #f8fafc;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            margin: 0;
        }
        .container {
            background-color: #1e293b;
            padding: 30px;
            border-radius: 16px;
            box-shadow: 0 10px 25px rgba(0,0,0,0.5);
            width: 100%;
            max-width: 450px;
        }
        h1 {
            text-align: center;
            color: #38bdf8;
            font-size: 26px;
            margin-top: 0;
            margin-bottom: 25px;
        }
        .crypto-card {
            background: #334155;
            border-left: 6px solid;
            border-radius: 10px;
            padding: 20px;
            margin-bottom: 15px;
            transition: transform 0.2s, box-shadow 0.2s;
        }
        .crypto-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 6px 12px rgba(0,0,0,0.3);
        }
        .btc { border-color: #f59e0b; } /* Naranja */
        .eth { border-color: #818cf8; } /* Azul violeta */
        .sol { border-color: #34d399; } /* Verde agua */
        
        .crypto-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 15px;
        }
        .crypto-name {
            font-size: 20px;
            font-weight: bold;
            margin: 0;
        }
        .price-row {
            display: flex;
            justify-content: space-between;
            margin-bottom: 8px;
            font-size: 16px;
            color: #cbd5e1;
            background: rgba(0,0,0,0.2);
            padding: 8px 12px;
            border-radius: 6px;
        }
        .price-row:last-child {
            margin-bottom: 0;
        }
        .price-value {
            font-weight: bold;
            color: #ffffff;
            font-family: monospace;
            font-size: 17px;
        }
        .error-msg {
            background-color: #ef4444;
            color: white;
            padding: 15px;
            border-radius: 8px;
            text-align: center;
            font-weight: bold;
        }
        .cardano { border-color: #3b82f6; } 
        .dogecoin { border-color: #f59e0b; } 
        .sui { border-color: #6366f1; } 
    </style>
</head>
<body>

    <div class="container">
        <h1>📊 Dashboard Cripto</h1>

        <?php if ($error): ?>
            <div class="error-msg">❌ Error al conectar con la API (Código: <?= $httpCode ?>)</div>
        <?php else: ?>
            
            <?php if (isset($data['bitcoin'])): ?>
            <div class="crypto-card btc">
                <div class="crypto-header">
                    <h2 class="crypto-name">Bitcoin (BTC)</h2>
                    <span>🟠</span>
                </div>
                <div class="price-row">
                    <span>Dólares (USD)</span>
                    <span class="price-value">$<?= number_format($data['bitcoin']['usd'], 2) ?></span>
                </div>
                <div class="price-row">
                    <span>Euros (EUR)</span>
                    <span class="price-value">€<?= number_format($data['bitcoin']['eur'], 2) ?></span>
                </div>
            </div>
            <?php endif; ?>

            <?php if (isset($data['ethereum'])): ?>
            <div class="crypto-card eth">
                <div class="crypto-header">
                    <h2 class="crypto-name">Ethereum (ETH)</h2>
                    <span>🔷</span>
                </div>
                <div class="price-row">
                    <span>Dólares (USD)</span>
                    <span class="price-value">$<?= number_format($data['ethereum']['usd'], 2) ?></span>
                </div>
                <div class="price-row">
                    <span>Euros (EUR)</span>
                    <span class="price-value">€<?= number_format($data['ethereum']['eur'], 2) ?></span>
                </div>
            </div>
            <?php endif; ?>

            <?php if (isset($data['solana'])): ?>
            <div class="crypto-card sol">
                <div class="crypto-header">
                    <h2 class="crypto-name">Solana (SOL)</h2>
                    <span>☀️</span>
                </div>
                <div class="price-row">
                    <span>Dólares (USD)</span>
                    <span class="price-value">$<?= number_format($data['solana']['usd'], 2) ?></span>
                </div>
                <div class="price-row">
                    <span>Euros (EUR)</span>
                    <span class="price-value">€<?= number_format($data['solana']['eur'], 2) ?></span>
                </div>
            </div>
            <?php endif; ?>
            <?php if (isset($data['sui'])): ?>
            <div class="crypto-card sui">
                <div class="crypto-header">
                    <h2 class="crypto-name">sui</h2>
                    <span>🐕</span>
                </div>
                <div class="price-row">
                    <span>Dólares (USD)</span>
                    <span class="price-value">$<?= number_format($data['sui']['usd'], 2) ?></span>
                </div>
                <div class="price-row">
                    <span>Euros (EUR)</span>
                    <span class="price-value">€<?= number_format($data['sui']['eur'], 2) ?></span>
                </div>
            </div>
            <?php endif; ?>
             <?php if (isset($data['dogecoin'])): ?>
            <div class="crypto-card dogecoin">
                <div class="crypto-header">
                    <h2 class="crypto-name">doge</h2>
                    <span>🐕</span>
                </div>
                <div class="price-row">
                    <span>Dólares (USD)</span>
                    <span class="price-value">$<?= number_format($data['dogecoin']['usd'], 2) ?></span>
                </div>
                <div class="price-row">
                    <span>Euros (EUR)</span>
                    <span class="price-value">€<?= number_format($data['dogecoin']['eur'], 2) ?></span>
                </div>
            </div>
            <?php endif; ?>
             <?php if (isset($data['cardano'])): ?>
            <div class="crypto-card cardano">
                <div class="crypto-header">
                    <h2 class="crypto-name">cardano</h2>
                    <span>🐕</span>
                </div>
                <div class="price-row">
                    <span>Dólares (USD)</span>
                    <span class="price-value">$<?= number_format($data['cardano']['usd'], 2) ?></span>
                </div>
                <div class="price-row">
                    <span>Euros (EUR)</span>
                    <span class="price-value">€<?= number_format($data['cardano']['eur'], 2) ?></span>
                </div>
            </div>
            <?php endif; ?>

        <?php endif; ?>

        <!-- WIDGET DE TRADINGVIEW -->
        <h3 style="color: #cbd5e1; text-align: center; margin-top: 30px;">Análisis Gráfico (BTC)</h3>
        <div style="margin-top: 10px; border-radius: 10px; overflow: hidden; height: 350px; border: 2px solid #334155;">
            <div class="tradingview-widget-container" style="height: 100%; width: 100%;">
              <div id="tradingview_btc" style="height: 100%; width: 100%;"></div>
              <script type="text/javascript" src="https://s3.tradingview.com/tv.js"></script>
              <script type="text/javascript">
              new TradingView.widget({
                  "autosize": true,
                  "symbol": "BINANCE:BTCUSD",
                  "interval": "1",
                  "timezone": "Etc/UTC",
                  "theme": "dark",
                  "style": "1",
                  "locale": "es",
                  "enable_publishing": false,
                  "backgroundColor": "#1e293b",
                  "gridColor": "#334155",
                  "hide_top_toolbar": false,
                  "hide_legend": false,
                  "save_image": false,
                  "container_id": "tradingview_btc"
              });
              
              </script>
              
            </div>
        </div>
         <h3 style="color: #cbd5e1; text-align: center; margin-top: 30px;">Análisis Gráfico (SOL)</h3>
        <div style="margin-top: 10px; border-radius: 10px; overflow: hidden; height: 350px; border: 2px solid #334155;">
            <div class="tradingview-widget-container" style="height: 100%; width: 100%;">
              <div id="tradingview_sol" style="height: 100%; width: 100%;"></div>
              <script type="text/javascript" src="https://s3.tradingview.com/tv.js"></script>
              <script type="text/javascript">
              new TradingView.widget({
                  "autosize": true,
                  "symbol": "BINANCE:SOLUSD",
                  "interval": "1",
                  "timezone": "Etc/UTC",
                  "theme": "dark",
                  "style": "1",
                  "locale": "es",
                  "enable_publishing": false,
                  "backgroundColor": "#1e293b",
                  "gridColor": "#334155",
                  "hide_top_toolbar": false,
                  "hide_legend": false,
                  "save_image": false,
                  "container_id": "tradingview_sol"
              });
              
              </script>
              
            </div>
        </div>

    </div>

</body>
</html>
