{{-- Standalone Admin Login Page for OD Sports --}}
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login | OD Sports</title>
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700;800&display=swap" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        :root {
            --primary: #0d6efd;
            --dark: #0f0f0f;
            --card-bg: rgba(255, 255, 255, 0.05);
            --text-main: #ffffff;
            --text-muted: #b0b0b0;
            --font-main: 'Inter', sans-serif;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: var(--font-main);
            background-color: var(--dark);
            color: var(--text-main);
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }

        .login-card {
            width: 100%;
            max-width: 420px;
            background: var(--card-bg);
            backdrop-filter: blur(15px);
            -webkit-backdrop-filter: blur(15px);
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 20px;
            padding: 3rem;
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.5);
        }

        .branding {
            text-align: center;
            margin-bottom: 2.5rem;
        }

        .branding .logo-text {
            font-size: 2.2rem;
            font-weight: 800;
            margin-bottom: 0.2rem;
            letter-spacing: -1px;
        }

        .branding .subtitle {
            font-size: 0.85rem;
            color: var(--text-muted);
            text-transform: uppercase;
            letter-spacing: 2px;
        }

        .form-group {
            margin-bottom: 1.5rem;
            position: relative;
        }

        .form-group i {
            position: absolute;
            left: 1rem;
            top: 50%;
            transform: translateY(-50%);
            color: var(--text-muted);
            font-size: 1rem;
        }

        .form-control {
            width: 100%;
            background: rgba(0, 0, 0, 0.3);
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 10px;
            padding: 0.9rem 1rem 0.9rem 2.8rem;
            color: white;
            font-size: 1rem;
            transition: all 0.3s ease;
        }

        .form-control:focus {
            outline: none;
            border-color: var(--primary);
            box-shadow: 0 0 0 4px rgba(13, 110, 253, 0.15);
        }

        .btn-login {
            width: 100%;
            background-color: var(--primary);
            color: white;
            border: none;
            border-radius: 10px;
            padding: 1rem;
            font-size: 1rem;
            font-weight: 700;
            cursor: pointer;
            transition: all 0.3s ease;
            margin-top: 0.5rem;
        }

        .btn-login:hover {
            background-color: #0b5ed7;
            transform: translateY(-1px);
        }

        .alert-error {
            background: rgba(220, 53, 69, 0.1);
            border: 1px solid rgba(220, 53, 69, 0.2);
            color: #ea868f;
            padding: 0.8rem;
            border-radius: 8px;
            margin-bottom: 1.5rem;
            font-size: 0.9rem;
            text-align: center;
        }

        .footer-link {
            text-align: center;
            margin-top: 2rem;
        }

        .footer-link a {
            color: var(--text-muted);
            text-decoration: none;
            font-size: 0.85rem;
            transition: color 0.3s;
        }

        .footer-link a:hover {
            color: var(--primary);
        }
    </style>
</head>
<body>

    <div class="login-card">
        <div class="branding">
            <div class="logo-text">OD Sports</div>
            <div class="subtitle">Admin Control Panel</div>
        </div>

        @if ($errors->any())
            <div class="alert-error">
                {{ $errors->first() }}
            </div>
        @endif

        <form action="{{ route('public.admin-login') }}" method="POST">
            @csrf
            <div class="form-group">
                <i class="fas fa-envelope"></i>
                <input type="email" name="email" class="form-control" placeholder="Admin Email" value="{{ old('email') }}" required autofocus>
            </div>

            <div class="form-group">
                <i class="fas fa-lock"></i>
                <input type="password" name="password" class="form-control" placeholder="Password" required>
            </div>

            <div class="form-group" style="display: flex; align-items: center; gap: 8px; margin-bottom: 2rem;">
                <input type="checkbox" name="remember" id="remember" style="accent-color: var(--primary);">
                <label for="remember" style="font-size: 0.85rem; color: var(--text-muted); cursor: pointer;">Remember Me</label>
            </div>

            <button type="submit" class="btn-login">
                Access Dashboard
            </button>
        </form>

        <div class="footer-link">
            <a href="{{ url('/login') }}"><i class="fas fa-arrow-left"></i> Back to Site</a>
        </div>
    </div>

</body>
</html>
