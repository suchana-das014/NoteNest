<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>NoteNest</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Caveat:wght@400;600&family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet"/>
    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @endif
    <style>
        *{box-sizing:border-box;margin:0;padding:0;}
        body{
            font-family:'Inter',sans-serif;
            min-height:100vh;
            display:flex;align-items:center;justify-content:center;
            background:linear-gradient(135deg,#0f0c29 0%,#302b63 50%,#24243e 100%);
            padding:24px;
            position:relative;overflow:hidden;
        }
        body::before{
            content:'';position:fixed;
            width:550px;height:550px;border-radius:50%;
            background:radial-gradient(circle,rgba(139,92,246,0.25),transparent 65%);
            top:-180px;left:-160px;pointer-events:none;
        }
        body::after{
            content:'';position:fixed;
            width:450px;height:450px;border-radius:50%;
            background:radial-gradient(circle,rgba(251,191,36,0.15),transparent 65%);
            bottom:-140px;right:-120px;pointer-events:none;
        }
        .card{
            position:relative;z-index:2;
            background:rgba(255,255,255,0.06);
            backdrop-filter:blur(24px);-webkit-backdrop-filter:blur(24px);
            border:1px solid rgba(255,255,255,0.12);
            border-radius:28px;
            padding:52px 48px 48px;
            max-width:440px;width:100%;
            text-align:center;
            box-shadow:0 40px 80px rgba(0,0,0,0.5),inset 0 1px 0 rgba(255,255,255,0.08);
        }
        .logo{
            font-family:'Caveat',cursive;
            font-size:58px;font-weight:600;
            color:#fff;line-height:1;letter-spacing:-1px;
            margin-bottom:10px;
        }
        .logo span{color:#fbbf24;}
        .tagline{
            color:rgba(255,255,255,0.5);
            font-size:15px;font-weight:400;
            margin-bottom:40px;line-height:1.5;
        }
        .btn{
            display:block;width:100%;
            padding:14px 20px;border-radius:14px;
            font-size:16px;font-weight:700;
            font-family:'Inter',sans-serif;
            text-decoration:none;text-align:center;
            cursor:pointer;border:none;
            transition:transform 0.18s,box-shadow 0.18s;
        }
        .btn:hover{transform:translateY(-2px);}
        .btn:active{transform:translateY(0);}
        .btn-primary{
            background:linear-gradient(135deg,#fbbf24,#f59e0b);
            color:#1e1b4b;
            box-shadow:0 6px 20px rgba(251,191,36,0.4);
            margin-bottom:12px;
        }
        .btn-primary:hover{box-shadow:0 10px 28px rgba(251,191,36,0.5);}
        .btn-secondary{
            background:rgba(255,255,255,0.08);
            color:#fff;
            border:1px solid rgba(255,255,255,0.2);
            box-shadow:0 4px 14px rgba(0,0,0,0.2);
        }
        .btn-secondary:hover{background:rgba(255,255,255,0.14);}
        .footer{margin-top:32px;color:rgba(255,255,255,0.2);font-size:12px;}
        @media(max-width:480px){
            .card{padding:40px 24px 36px;}
            .logo{font-size:46px;}
        }
    </style>
</head>
<body>
<div class="card">
    <div class="logo">Note<span>Nest</span></div>
    <p class="tagline">Your thoughts, beautifully organised.<br>Simple, fast, and always with you.</p>

    @auth
        <a href="{{ url('/notes') }}" class="btn btn-primary">Go to My Notes →</a>
    @else
        <a href="{{ route('login') }}" class="btn btn-primary">Log In</a>
        @if(Route::has('register'))
            <a href="{{ route('register') }}" class="btn btn-secondary">Create an Account</a>
        @endif
    @endauth

    <p class="footer">© {{ date('Y') }} NoteNest. All rights reserved.</p>
</div>
</body>
</html>