<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'NoteNest') }}</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Caveat:wght@400;600&family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet"/>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
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
        .auth-wrap{
            position:relative;z-index:2;
            background:rgba(255,255,255,0.07);
            backdrop-filter:blur(24px);-webkit-backdrop-filter:blur(24px);
            border:1px solid rgba(255,255,255,0.13);
            border-radius:28px;
            padding:44px 40px 40px;
            width:100%;max-width:420px;
            box-shadow:0 36px 72px rgba(0,0,0,0.5),inset 0 1px 0 rgba(255,255,255,0.08);
        }
        .auth-logo{
            font-family:'Caveat',cursive;
            font-size:42px;font-weight:600;
            color:#fff;text-align:center;
            line-height:1;letter-spacing:-0.5px;
            margin-bottom:4px;
        }
        .auth-logo span{color:#fbbf24;}
        .auth-sub{
            text-align:center;
            color:rgba(255,255,255,0.45);
            font-size:13px;margin-bottom:30px;
        }
        /* Labels */
        .auth-wrap label{
            display:block;
            color:rgba(255,255,255,0.8) !important;
            font-size:13px;font-weight:500;
            margin-bottom:5px;
        }
        /* Inputs */
        .auth-wrap input[type=text],
        .auth-wrap input[type=email],
        .auth-wrap input[type=password]{
            width:100%;
            padding:11px 14px;
            background:rgba(255,255,255,0.09);
            border:1px solid rgba(255,255,255,0.18);
            border-radius:10px;
            color:#fff;
            font-size:14px;
            font-family:'Inter',sans-serif;
            outline:none;
            transition:border-color 0.2s,background 0.2s;
        }
        .auth-wrap input[type=text]:focus,
        .auth-wrap input[type=email]:focus,
        .auth-wrap input[type=password]:focus{
            border-color:#fbbf24;
            background:rgba(255,255,255,0.14);
        }
        .auth-wrap input::placeholder{color:rgba(255,255,255,0.3);}
        /* Checkbox */
        .auth-wrap input[type=checkbox]{accent-color:#fbbf24;}
        .auth-wrap input[type=checkbox] + span,
        .auth-wrap .text-gray-600,
        .auth-wrap span.text-gray-600{color:rgba(255,255,255,0.6) !important;}
        /* Error messages */
        .auth-wrap ul.text-sm,
        .auth-wrap .text-red-600{color:#fca5a5 !important;font-size:12px;margin-top:4px;}
        /* Links */
        .auth-wrap a.text-gray-600,
        .auth-wrap a.underline{
            color:rgba(255,255,255,0.55) !important;
            font-size:13px;text-decoration:none;
            transition:color 0.2s;
        }
        .auth-wrap a.text-gray-600:hover,
        .auth-wrap a.underline:hover{color:#fbbf24 !important;}
        /* Primary submit button */
        .auth-wrap button[type=submit]{
            background:linear-gradient(135deg,#fbbf24,#f59e0b) !important;
            color:#1e1b4b !important;
            font-weight:700 !important;
            font-size:14px !important;
            padding:11px 26px !important;
            border-radius:10px !important;
            border:none !important;
            cursor:pointer;
            font-family:'Inter',sans-serif;
            box-shadow:0 4px 16px rgba(251,191,36,0.35);
            transition:transform 0.15s,box-shadow 0.15s;
            text-transform:none !important;
            letter-spacing:0 !important;
        }
        .auth-wrap button[type=submit]:hover{
            transform:translateY(-1px);
            box-shadow:0 8px 22px rgba(251,191,36,0.45);
        }
        /* Session status flash */
        .auth-wrap .text-green-600{
            background:rgba(16,185,129,0.15) !important;
            border:1px solid rgba(16,185,129,0.3);
            color:#6ee7b7 !important;
            border-radius:8px;
            padding:10px 14px;
            font-size:13px;
            display:block;
        }
        /* Hint paragraphs (verify email, confirm password) */
        .auth-wrap .text-gray-600.text-sm,
        .auth-wrap div.mb-4.text-sm.text-gray-600{
            color:rgba(255,255,255,0.55) !important;
            font-size:13px;line-height:1.6;margin-bottom:20px;
        }
        /* Logout plain button on verify page */
        .auth-wrap button.underline{
            background:transparent !important;
            border:none !important;
            box-shadow:none !important;
            color:rgba(255,255,255,0.5) !important;
            font-size:13px !important;
            font-weight:400 !important;
            padding:0 !important;
            text-decoration:underline;
            cursor:pointer;
        }
        .auth-wrap button.underline:hover{color:#fbbf24 !important;}
        @media(max-width:480px){
            .auth-wrap{padding:36px 20px 32px;}
            .auth-logo{font-size:36px;}
        }
    </style>
</head>
<body>
    <div class="auth-wrap">
        <div class="auth-logo">Note<span>Nest</span></div>
        <p class="auth-sub">Your thoughts, beautifully organised.</p>
        {{ $slot }}
    </div>
</body>
</html>