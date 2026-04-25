<!doctype html>
<html lang="es">
<head>
    <title>Registrarse – Obet's Store</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600&family=Playfair+Display:ital,wght@0,400;0,600;0,700;1,400&display=swap" rel="stylesheet">

    <style>
        :root {
            --primary-color: #8A9A86;
            --primary-dark: #6C7A68;
            --accent-color: #D4A373;
            --bg-gradient-start: #A3B18A;
            --bg-gradient-end: #E9EFE6;
            --text-dark: #333333;
        }

        * { box-sizing: border-box; }

        body {
            background: linear-gradient(135deg, var(--bg-gradient-start) 0%, var(--bg-gradient-end) 100%);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            font-family: 'Inter', sans-serif;
            color: var(--text-dark);
        }

        h1, h2, h3, .navbar-brand-custom {
            font-family: 'Playfair Display', serif;
        }

        .store-nav { padding: 1rem 0; }

        .navbar-brand-custom {
            color: white;
            font-size: 1.4rem;
            font-weight: 800;
            text-decoration: none;
            letter-spacing: -0.5px;
        }
        .navbar-brand-custom:hover { color: rgba(255,255,255,0.85); }

        .btn-nav {
            background: rgba(255,255,255,0.18);
            backdrop-filter: blur(6px);
            border: 1.5px solid rgba(255,255,255,0.4);
            color: white;
            border-radius: 25px;
            padding: 0.4rem 1.1rem;
            font-size: 0.88rem;
            font-weight: 600;
            text-decoration: none;
            transition: all 0.25s;
        }
        .btn-nav:hover {
            background: rgba(255,255,255,0.35);
            color: white;
        }

        .auth-wrapper {
            flex: 1;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 2rem 1rem 4rem;
        }

        .auth-card {
            background: white;
            border-radius: 20px;
            box-shadow: 0 20px 60px rgba(0,0,0,0.25);
            padding: 2.5rem 2.8rem;
            width: 100%;
            max-width: 460px;
            animation: fadeUp 0.5s ease;
        }

        @keyframes fadeUp {
            from { opacity: 0; transform: translateY(30px); }
            to   { opacity: 1; transform: translateY(0); }
        }

        .auth-icon {
            width: 64px;
            height: 64px;
            background: var(--primary-color);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 1rem;
            font-size: 1.7rem;
            color: white;
            box-shadow: 0 4px 15px rgba(138,154,134,0.3);
        }

        .auth-title {
            text-align: center;
            font-size: 1.55rem;
            font-weight: 800;
            color: #2d2d2d;
            margin-bottom: 0.25rem;
        }

        .auth-subtitle {
            text-align: center;
            font-size: 0.88rem;
            color: #888;
            margin-bottom: 1.8rem;
        }

        .input-group-custom {
            position: relative;
            margin-bottom: 1.1rem;
        }

        .input-group-custom .input-icon {
            position: absolute;
            left: 14px;
            top: 50%;
            transform: translateY(-50%);
            color: var(--primary-color);
            font-size: 1rem;
            pointer-events: none;
        }

        .input-group-custom input {
            width: 100%;
            padding: 0.75rem 1rem 0.75rem 2.6rem;
            border: 2px solid #e8e8e8;
            border-radius: 12px;
            font-size: 0.95rem;
            outline: none;
            transition: border 0.25s, box-shadow 0.25s;
            background: #fafafa;
        }

        .input-group-custom input:focus {
            border-color: var(--primary-color);
            background: white;
            box-shadow: 0 0 0 4px rgba(138,154,134,0.12);
        }

        .input-group-custom input.is-invalid {
            border-color: #dc3545;
        }

        .input-group-custom .invalid-feedback {
            display: block;
            font-size: 0.8rem;
            color: #dc3545;
            margin-top: 4px;
            padding-left: 4px;
        }

        .input-label {
            font-size: 0.82rem;
            font-weight: 700;
            color: #555;
            margin-bottom: 5px;
            display: block;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .btn-submit {
            width: 100%;
            background: var(--primary-color);
            border: none;
            color: white;
            padding: 0.8rem;
            border-radius: 30px;
            font-size: 1rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s;
            margin-top: 0.4rem;
        }

        .btn-submit:hover {
            transform: translateY(-2px);
            background: var(--primary-dark);
            box-shadow: 0 8px 25px rgba(138,154,134,0.45);
        }

        .btn-submit:active { transform: translateY(0); }
        .btn-submit:disabled { opacity: 0.7; cursor: not-allowed; transform: none; }

        .auth-footer {
            text-align: center;
            margin-top: 1.4rem;
            font-size: 0.88rem;
            color: #888;
        }

        .auth-footer a {
            color: var(--primary-dark);
            font-weight: 600;
            text-decoration: none;
        }

        .auth-footer a:hover { text-decoration: underline; color: var(--primary-color); }
    </style>
</head>
<body>
    <nav class="store-nav">
        <div class="container d-flex align-items-center justify-content-between">
            <a class="navbar-brand-custom" href="/">
                <i class="bi bi-shop me-1"></i> Obet's Store
            </a>
            <div class="d-flex gap-2">
                <a href="{{ route('login') }}" class="btn-nav">
                    <i class="bi bi-box-arrow-in-right me-1"></i> Iniciar Sesión
                </a>
                <a href="{{ route('register') }}" class="btn-nav">
                    <i class="bi bi-person-plus me-1"></i> Registrarse
                </a>
            </div>
        </div>
    </nav>

    <div class="auth-wrapper">
        <div class="auth-card">
            <div class="auth-icon">
                <i class="bi bi-person-plus"></i>
            </div>
            <h1 class="auth-title">Crear una cuenta</h1>
            <p class="auth-subtitle">Completa el formulario para unirte a Obet's Store</p>

            <form method="POST" action="{{ route('register') }}" id="register-form">
                @csrf

                {{-- Name --}}
                <label class="input-label" for="name">Nombre completo</label>
                <div class="input-group-custom">
                    <i class="bi bi-person input-icon"></i>
                    <input
                        id="name" type="text" name="name"
                        value="{{ old('name') }}"
                        required autocomplete="name" autofocus
                        class="{{ $errors->has('name') ? 'is-invalid' : '' }}"
                        placeholder="Tu nombre"
                    >
                    @error('name')
                        <span class="invalid-feedback"><strong>{{ $message }}</strong></span>
                    @enderror
                </div>

                {{-- Email --}}
                <label class="input-label" for="email">Correo electrónico</label>
                <div class="input-group-custom">
                    <i class="bi bi-envelope input-icon"></i>
                    <input
                        id="email" type="email" name="email"
                        value="{{ old('email') }}"
                        required autocomplete="email"
                        class="{{ $errors->has('email') ? 'is-invalid' : '' }}"
                        placeholder="tucorreo@ejemplo.com"
                    >
                    @error('email')
                        <span class="invalid-feedback"><strong>{{ $message }}</strong></span>
                    @enderror
                </div>

                {{-- Password --}}
                <label class="input-label" for="password">Contraseña</label>
                <div class="input-group-custom">
                    <i class="bi bi-lock input-icon"></i>
                    <input
                        id="password" type="password" name="password"
                        required autocomplete="new-password"
                        class="{{ $errors->has('password') ? 'is-invalid' : '' }}"
                        placeholder="Mínimo 8 caracteres"
                    >
                    @error('password')
                        <span class="invalid-feedback"><strong>{{ $message }}</strong></span>
                    @enderror
                </div>

                {{-- Confirm Password --}}
                <label class="input-label" for="password-confirm">Confirmar contraseña</label>
                <div class="input-group-custom">
                    <i class="bi bi-lock-fill input-icon"></i>
                    <input
                        id="password-confirm" type="password" name="password_confirmation"
                        required autocomplete="new-password"
                        placeholder="Repite tu contraseña"
                    >
                </div>

                <button type="submit" id="register-button" class="btn-submit">
                    <span id="button-text"><i class="bi bi-person-check me-2"></i>Crear cuenta</span>
                    <span id="button-spinner" class="spinner-border spinner-border-sm d-none" role="status" aria-hidden="true"></span>
                </button>
            </form>

            <p class="auth-footer">
                ¿Ya tienes una cuenta?
                <a href="{{ route('login') }}">Inicia sesión aquí</a>
            </p>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const form   = document.getElementById('register-form');
            const btn    = document.getElementById('register-button');
            const text   = document.getElementById('button-text');
            const spinner = document.getElementById('button-spinner');

            form.addEventListener('submit', function (e) {
                if (btn.disabled) { e.preventDefault(); return; }
                btn.disabled = true;
                text.innerHTML = 'Registrando...';
                spinner.classList.remove('d-none');
                btn.classList.add('disabled');
            });
        });
    </script>
</body>
</html>
