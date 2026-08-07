<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content="noindex">
    <title>@yield('title') — {{ config('seo.site_name') }}</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700;800&display=swap" rel="stylesheet">

    <style>
        :root {
            --green: #2D9359;
            --green-dark: #1F6B3F;
            --text: #1A1A1A;
            --gray: #6B7280;
            --bg: #F9F7F4;
        }

        * { margin: 0; padding: 0; box-sizing: border-box; }

        body {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 40px 20px;
            font-family: 'Nunito', -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif;
            background: linear-gradient(180deg, #FBF7F0 0%, var(--bg) 100%);
            color: var(--text);
            line-height: 1.6;
        }

        .box { max-width: 560px; text-align: center; }

        .code {
            font-size: 15px;
            font-weight: 700;
            letter-spacing: 2px;
            text-transform: uppercase;
            color: var(--green);
            margin-bottom: 18px;
        }

        h1 {
            font-size: 32px;
            font-weight: 800;
            line-height: 1.25;
            margin-bottom: 16px;
        }

        p {
            font-size: 16.5px;
            color: var(--gray);
            margin-bottom: 32px;
        }

        .actions { display: flex; flex-wrap: wrap; gap: 12px; justify-content: center; }

        .btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            min-height: 50px;
            padding: 14px 30px;
            border-radius: 50px;
            border: 2px solid transparent;
            font-size: 15px;
            font-weight: 700;
            text-decoration: none;
            transition: all 0.2s ease;
        }

        .btn--primary { background: var(--green); border-color: var(--green); color: #fff; }
        .btn--primary:hover { background: var(--green-dark); border-color: var(--green-dark); }

        .btn--outline { border-color: rgba(26, 26, 26, 0.2); color: var(--text); }
        .btn--outline:hover { border-color: var(--green); color: var(--green); }

        @media (max-width: 560px) {
            h1 { font-size: 25px; }
            p { font-size: 15.5px; }
            .actions { flex-direction: column; }
            .btn { width: 100%; }
        }
    </style>
</head>
<body>
<div class="box">
    <p class="code">@yield('code')</p>
    <h1>@yield('title')</h1>
    <p>@yield('message')</p>
    <div class="actions">
        <a href="/" class="btn btn--primary">На главную</a>
        <a href="/contacts" class="btn btn--outline">Связаться с Ассоциацией</a>
    </div>
</div>
</body>
</html>
