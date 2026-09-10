# Dashboard de Criptomonedas

Aplicación web sencilla desarrollada en PHP cuyo propósito es conectarse mediante `cURL` a una API externa de criptomonedas y mostrar los precios actuales de varias monedas en dólares estadounidenses (USD) y euros (EUR).

El proyecto utiliza la API pública de [CoinGecko](https://www.coingecko.com/) para obtener los datos y muestra gráficos interactivos de Bitcoin y Solana mediante widgets de [TradingView](https://www.tradingview.com/).

## Características

- Consulta de precios en tiempo real desde CoinGecko.
- Conversión de la respuesta JSON a un array asociativo de PHP.
- Visualización de precios en USD y EUR.
- Criptomonedas consultadas:
  - Bitcoin (BTC)
  - Ethereum (ETH)
  - Solana (SOL)
  - Sui (SUI)
  - Dogecoin (DOGE)
  - Cardano (ADA)
- Mensaje de error cuando la API no responde con HTTP 200.
- Actualización automática de la página cada 3 minutos para reducir el riesgo de alcanzar el límite de peticiones de la API.
- Gráficos interactivos de los pares `BINANCE:BTCUSD` y `BINANCE:SOLUSD`.
- Diseño adaptable con HTML y CSS integrados en el archivo PHP.

## Tecnologías utilizadas

- PHP
- cURL
- HTML5
- CSS3
- JSON
- API REST de CoinGecko
- Widget JavaScript de TradingView

## Estructura del proyecto

```text
api_cripto/
├── api_cripto.php   # Código de la aplicación y la interfaz visual
└── README.md        # Documentación del proyecto
```

## Requisitos

- PHP 7.4 o superior.
- Extensión `cURL` habilitada en PHP.
- Conexión a Internet.
- Navegador web actualizado.

No es necesario instalar dependencias mediante Composer o npm.

## Instalación y ejecución

1. Clona o descarga el proyecto.
2. Comprueba que la extensión cURL esté habilitada:

   ```bash
   php -m | grep curl
   ```

3. Desde la carpeta del proyecto, inicia el servidor integrado de PHP:

   ```bash
   php -S localhost:8000
   ```

4. Abre la siguiente dirección en el navegador:

   ```text
   http://localhost:8000/api_cripto.php
   ```

También puede ejecutarse colocando la carpeta dentro de un servidor web compatible con PHP, como Apache o Nginx con PHP configurado.

## Funcionamiento

1. El archivo define la URL de la API de CoinGecko con las monedas y divisas solicitadas.
2. Se inicializa una sesión de `cURL` y se configura para devolver la respuesta como texto.
3. Se realiza la petición HTTP y se obtiene el código de estado.
4. Si la respuesta es correcta, se interpreta el JSON mediante `json_decode()`.
5. Los precios disponibles se muestran en tarjetas individuales.
6. Si existe un error de conexión o la API devuelve otro código HTTP, se muestra un mensaje indicando el código recibido.
7. TradingView carga los gráficos de Bitcoin y Solana desde su script externo.

## Endpoint utilizado

```text
https://api.coingecko.com/api/v3/simple/price?ids=bitcoin,ethereum,solana,sui,dogecoin,cardano&vs_currencies=usd,eur
```

La API devuelve una estructura similar a esta:

```json
{
  "bitcoin": {
    "usd": 65000,
    "eur": 60000
  }
}
```

Los valores reales cambian según la cotización del mercado en el momento de la consulta.

## Consideraciones

- La disponibilidad y el límite de peticiones dependen de CoinGecko.
- TradingView se carga desde un recurso externo, por lo que los gráficos requieren conexión a Internet.
- Este proyecto tiene fines educativos y de demostración. Los precios mostrados no deben utilizarse como asesoramiento financiero.
