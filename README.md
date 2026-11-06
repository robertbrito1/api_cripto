# 📈 Dashboard de Criptomonedas (PHP + API REST)

![PHP](https://img.shields.io/badge/PHP-777BB4?style=for-the-badge&logo=php&logoColor=white)
![cURL](https://img.shields.io/badge/cURL-073551?style=for-the-badge&logo=curl&logoColor=white)
![CoinGecko](https://img.shields.io/badge/API-CoinGecko-8DC63F?style=for-the-badge)

Página hecha en **PHP** que consulta una **API REST externa** con cURL y muestra el precio actual de varias criptomonedas en dólares y euros, junto a gráficos en tiempo real.

## 💡 Por qué lo hice

Es un proyecto personal, fuera de clase. Quería aprender a **integrar una API de terceros** en una aplicación: hacer la petición HTTP, comprobar la respuesta, convertir el JSON y pintar los datos. Elegí la API pública de **CoinGecko** porque es gratuita, no pide registro y la usan muchas plataformas de criptomonedas.

## ✨ Funcionalidades

- Precio actual de **Bitcoin, Ethereum, Solana, Sui, Dogecoin y Cardano** en **USD** y **EUR**.
- Gráficos interactivos de BTC/USD y SOL/USD con widgets de **TradingView**.
- **Gestión de errores:** si la API no responde con `HTTP 200`, se muestra un mensaje con el código recibido en lugar de romper la página.
- Recarga automática cada **3 minutos** para no superar el límite de peticiones de la API (error `429 Too Many Requests`).
- Diseño adaptable a móvil.

## 🧠 Lo que aprendí

- Hacer peticiones HTTP desde el servidor con **cURL** (`curl_init`, `curl_setopt`, `curl_exec`).
- Leer el **código de estado HTTP** (`curl_getinfo`) antes de usar la respuesta.
- Convertir JSON en arrays asociativos de PHP con `json_decode($response, true)`.
- Dar formato a los números con `number_format()`.
- Que las APIs gratuitas tienen **rate limit**, y cómo diseñar la página para respetarlo.

## ⚙️ Cómo funciona

```
Navegador ──► api_cripto.php ──cURL──► API CoinGecko
                    │                       │
                    ◄────── JSON ───────────┘
                    │
             json_decode() → tarjetas HTML con los precios
```

Endpoint utilizado:

```
GET https://api.coingecko.com/api/v3/simple/price?ids=bitcoin,ethereum,solana,sui,dogecoin,cardano&vs_currencies=usd,eur
```

Respuesta (ejemplo):

```json
{ "bitcoin": { "usd": 65000, "eur": 60000 } }
```

## 🚀 Ejecutarlo en local

Requisitos: PHP 7.4 o superior con la extensión cURL activada.

```bash
git clone https://github.com/robertbrito1/api_cripto.git
cd api_cripto
php -S localhost:8000
```

Abre `http://localhost:8000/api_cripto.php`.

## 🔜 Próximas mejoras

- [ ] Rehacerlo con **Next.js**: obtener los datos en el servidor con caché (`revalidate`) en lugar de recargar la página.
- [ ] Generar las tarjetas con un bucle en lugar de repetir el HTML de cada moneda.
- [ ] Separar la lógica (petición a la API) de la vista (HTML/CSS).

> Proyecto con fines educativos. Los precios no son asesoramiento financiero.

## 👤 Autor

**Robert Brito** · [GitHub](https://github.com/robertbrito1) · [LinkedIn](https://www.linkedin.com/in/robertbrito/)
