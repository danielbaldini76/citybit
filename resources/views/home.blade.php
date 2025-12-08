<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Citybit | Monitoraggio ambientale</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600,700" rel="stylesheet" />
    <style>
        :root {
            --color-primary-dark: #10375A;
            --color-primary: #1E4A7A;
            --color-overlay: #245A8B;
            --color-accent: #46D26F;
            --color-text: #FFFFFF;
            --color-subtle: #B9E4FF;
        }

        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            font-family: 'Instrument Sans', ui-sans-serif, system-ui, sans-serif;
            background: radial-gradient(circle at 20% 20%, rgba(36, 90, 139, 0.25), rgba(30, 74, 122, 0.1)),
                linear-gradient(135deg, var(--color-primary-dark), var(--color-primary));
            color: var(--color-text);
        }

        a {
            color: inherit;
            text-decoration: none;
        }

        header {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            z-index: 20;
            backdrop-filter: blur(10px);
            background: rgba(16, 55, 90, 0.85);
            border-bottom: 1px solid rgba(185, 228, 255, 0.1);
        }

        .nav-bar {
            max-width: 1200px;
            margin: 0 auto;
            padding: 1rem 1.5rem;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .logo {
            font-weight: 700;
            letter-spacing: 0.06em;
            font-size: 1.1rem;
        }

        nav ul {
            list-style: none;
            display: flex;
            gap: 1.25rem;
            margin: 0;
            padding: 0;
            align-items: center;
        }

        nav a {
            font-weight: 500;
            color: var(--color-text);
            transition: color 0.2s ease;
        }

        nav a:hover,
        nav a:focus-visible {
            color: var(--color-subtle);
        }

        .lang-select {
            padding: 0.35rem 0.75rem;
            border-radius: 999px;
            background: rgba(36, 90, 139, 0.7);
            border: 1px solid rgba(185, 228, 255, 0.25);
            color: var(--color-text);
            font-weight: 600;
            cursor: pointer;
        }

        main {
            max-width: 1200px;
            margin: 0 auto;
            padding: 7rem 1.5rem 3rem;
            min-height: 100vh;
            display: flex;
            align-items: center;
        }

        .hero {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(320px, 1fr));
            gap: 2.5rem;
            width: 100%;
            align-items: center;
        }

        .hero-text {
            max-width: 560px;
        }

        .tag {
            display: inline-flex;
            align-items: center;
            gap: 0.4rem;
            padding: 0.35rem 0.8rem;
            border-radius: 999px;
            background: rgba(185, 228, 255, 0.1);
            color: var(--color-subtle);
            font-weight: 600;
            letter-spacing: 0.04em;
            text-transform: uppercase;
            font-size: 0.75rem;
        }

        h1 {
            margin: 1rem 0 0.5rem;
            font-size: clamp(2.5rem, 4vw, 3.5rem);
            letter-spacing: 0.08em;
        }

        .subtitle {
            font-size: 1.2rem;
            margin: 0 0 1rem;
            color: var(--color-subtle);
            font-weight: 600;
        }

        .lead {
            color: rgba(255, 255, 255, 0.92);
            line-height: 1.6;
            margin-bottom: 1.5rem;
            font-size: 1rem;
        }

        .actions {
            display: flex;
            flex-wrap: wrap;
            gap: 1rem;
        }

        .btn-primary {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 0.85rem 1.6rem;
            border-radius: 12px;
            background: linear-gradient(135deg, #4de179, var(--color-accent));
            color: #0e2a44;
            font-weight: 700;
            box-shadow: 0 10px 30px rgba(70, 210, 111, 0.35);
            border: none;
            cursor: pointer;
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }

        .btn-primary:hover,
        .btn-primary:focus-visible {
            transform: translateY(-2px);
            box-shadow: 0 16px 36px rgba(70, 210, 111, 0.45);
        }

        .hero-media {
            position: relative;
            background: linear-gradient(135deg, rgba(36, 90, 139, 0.85), rgba(30, 74, 122, 0.9));
            border-radius: 20px;
            padding: 1.4rem;
            box-shadow: 0 16px 50px rgba(0, 0, 0, 0.25);
            overflow: hidden;
        }

        .hero-media img {
            width: 100%;
            border-radius: 14px;
            display: block;
            border: 1px solid rgba(185, 228, 255, 0.35);
            object-fit: cover;
            min-height: 280px;
            background: #0b1d33;
        }

        .heartbeat-line {
            position: absolute;
            inset: 0;
            pointer-events: none;
            display: grid;
            place-items: center;
        }

        .heartbeat-line svg {
            width: 120%;
            max-width: 900px;
            opacity: 0.9;
        }

        .panel-overlay {
            position: absolute;
            inset: 0;
            background: linear-gradient(180deg, rgba(18, 52, 82, 0) 35%, rgba(16, 55, 90, 0.65));
        }

        .floating-card {
            position: absolute;
            bottom: 1.4rem;
            left: 1.4rem;
            padding: 0.9rem 1.1rem;
            border-radius: 12px;
            background: rgba(16, 55, 90, 0.9);
            border: 1px solid rgba(185, 228, 255, 0.25);
            color: var(--color-subtle);
            font-weight: 600;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.3);
        }

        footer {
            text-align: center;
            color: rgba(255, 255, 255, 0.7);
            padding: 1.5rem 1rem 2rem;
            font-size: 0.95rem;
        }

        @media (max-width: 768px) {
            header {
                background: rgba(16, 55, 90, 0.95);
            }

            nav ul {
                gap: 0.85rem;
            }

            main {
                padding-top: 6.5rem;
            }

            .hero-media {
                order: 2;
            }
        }
    </style>
</head>
<body>
    <header>
        <div class="nav-bar">
            <div class="logo">CITYBIT</div>
            <nav aria-label="Main navigation">
                <ul>
                    <li><a href="#">Home</a></li>
                    <li><a href="#soluzione">Soluzione</a></li>
                    <li><a href="#contatti">Contatti</a></li>
                    <li>
                        <select class="lang-select" aria-label="Seleziona lingua">
                            <option>IT</option>
                            <option>EN</option>
                        </select>
                    </li>
                </ul>
            </nav>
        </div>
    </header>

    <main>
        <section class="hero" aria-labelledby="citybit-title">
            <div class="hero-text">
                <span class="tag">Monitoraggio smart</span>
                <h1 id="citybit-title">CITYBIT</h1>
                <p class="subtitle">Monitoraggio della qualità dell’aria e dell’ambiente</p>
                <p class="lead">Una piattaforma cloud che raccoglie e analizza in tempo reale dati ambientali da sensori urbani.
                    Dashboard intuitive, alert predittivi e report dinamici aiutano amministrazioni e cittadini a prendere
                    decisioni consapevoli per una città più sana e resiliente.</p>
                <div class="actions">
                    <button class="btn-primary" type="button">SCOPRI DI PIÙ</button>
                </div>
            </div>

            <div class="hero-media" aria-hidden="true">
                <div class="panel-overlay"></div>
                <!-- Sostituisci l'immagine sottostante con una foto panoramica della città di tua scelta (percorso consigliato: /public/images/citybit-hero.jpg). -->
                <img src="/images/citybit-hero.jpg" alt="Panoramica di skyline urbano con luci serali" loading="lazy">
                <div class="heartbeat-line">
                    <svg viewBox="0 0 1200 320" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M-20 180 H200 L240 140 L270 220 L320 80 L380 240 L440 160 L500 200 L560 120 L640 220 L710 140 L780 210 L850 100 L910 200 L980 160 L1050 210 L1120 140 L1200 170"
                              stroke="var(--color-accent)" stroke-width="7" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                </div>
                <div class="floating-card">Linea vita urbana · Dati aggiornati al minuto</div>
            </div>
        </section>
    </main>

    <footer id="contatti">
        © {{ date('Y') }} Citybit · Soluzioni di monitoraggio ambientale
    </footer>
</body>
</html>
