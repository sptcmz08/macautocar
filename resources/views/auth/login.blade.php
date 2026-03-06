<!DOCTYPE html>
<html lang="th">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>เข้าสู่ระบบ — ระบบบัญชี</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Sarabun:wght@300;400;500;600;700;800&display=swap"
        rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body {
            font-family: 'Sarabun', sans-serif;
        }

        .login-bg {
            background: linear-gradient(135deg, #0f172a 0%, #1e293b 50%, #334155 100%);
            min-height: 100vh;
        }

        .glass-card {
            background: rgba(255, 255, 255, 0.06);
            backdrop-filter: blur(24px);
            -webkit-backdrop-filter: blur(24px);
            border: 1px solid rgba(255, 255, 255, 0.1);
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.3);
        }

        .input-dark {
            background: rgba(255, 255, 255, 0.08);
            border: 1px solid rgba(255, 255, 255, 0.15);
            color: white;
            transition: all 0.3s ease;
        }

        .input-dark:focus {
            background: rgba(255, 255, 255, 0.12);
            border-color: rgba(59, 130, 246, 0.6);
            box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.15);
            outline: none;
        }

        .input-dark::placeholder {
            color: rgba(255, 255, 255, 0.35);
        }

        .btn-login {
            background: linear-gradient(135deg, #3b82f6 0%, #2563eb 50%, #1d4ed8 100%);
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(59, 130, 246, 0.3);
        }

        .btn-login:hover {
            background: linear-gradient(135deg, #60a5fa 0%, #3b82f6 50%, #2563eb 100%);
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(59, 130, 246, 0.4);
        }

        .car-icon {
            animation: float 3s ease-in-out infinite;
        }

        @keyframes float {

            0%,
            100% {
                transform: translateY(0px);
            }

            50% {
                transform: translateY(-8px);
            }
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .animate-fade-in {
            animation: fadeInUp 0.6s ease-out forwards;
        }

        .animate-fade-in-delay {
            animation: fadeInUp 0.6s ease-out 0.15s forwards;
            opacity: 0;
        }

        .animate-fade-in-delay-2 {
            animation: fadeInUp 0.6s ease-out 0.3s forwards;
            opacity: 0;
        }

        .error-box {
            background: rgba(239, 68, 68, 0.12);
            border: 1px solid rgba(239, 68, 68, 0.3);
        }
    </style>
</head>

<body class="login-bg flex items-center justify-center p-4">
    <div class="w-full max-w-sm">
        {{-- Logo / Title --}}
        <div class="text-center mb-8 animate-fade-in">
            <div class="car-icon inline-flex items-center justify-center w-20 h-20 rounded-2xl glass-card mb-4">
                <svg class="w-10 h-10 text-blue-400" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M8.25 18.75a1.5 1.5 0 0 1-3 0m3 0a1.5 1.5 0 0 0-3 0m3 0h6m-9 0H3.375a1.125 1.125 0 0 1-1.125-1.125V14.25m17.25 4.5a1.5 1.5 0 0 1-3 0m3 0a1.5 1.5 0 0 0-3 0m3 0h1.125c.621 0 1.125-.504 1.125-1.125v-1.5c0-.621-.504-1.125-1.125-1.125H18.75m-7.5-2.25h.008v.008H11.25v-.008ZM12 15h.008v.008H12V15Zm0 2.25h.008v.008H12v-.008ZM9.75 15h.008v.008H9.75V15Zm0 2.25h.008v.008H9.75v-.008ZM7.5 15h.008v.008H7.5V15Zm0 2.25h.008v.008H7.5v-.008Zm6.75-4.5h.008v.008h-.008v-.008Zm0 2.25h.008v.008h-.008V15Zm0 2.25h.008v.008h-.008v-.008Zm2.25-4.5h.008v.008H16.5v-.008Zm0 2.25h.008v.008H16.5V15Z" />
                </svg>
            </div>
            <h1 class="text-2xl font-bold text-white tracking-tight">ระบบบัญชีรถ</h1>
            <p class="text-slate-400 text-sm mt-1">MacAutoCar Management</p>
        </div>

        {{-- Login Card --}}
        <div class="glass-card rounded-2xl p-6 animate-fade-in-delay">
            @if ($errors->any())
                <div class="error-box mb-4 px-4 py-3 rounded-xl text-sm text-red-300">
                    @foreach ($errors->all() as $error)
                        <p>{{ $error }}</p>
                    @endforeach
                </div>
            @endif

            <form method="POST" action="{{ route('login') }}">
                @csrf

                <div class="mb-4">
                    <label class="block text-slate-300 text-sm font-medium mb-2">ชื่อผู้ใช้</label>
                    <input type="text" name="username" value="{{ old('username') }}" required autofocus
                        placeholder="กรอกชื่อผู้ใช้" class="input-dark w-full px-4 py-3 rounded-xl text-sm">
                </div>

                <div class="mb-5">
                    <label class="block text-slate-300 text-sm font-medium mb-2">รหัสผ่าน</label>
                    <input type="password" name="password" required placeholder="กรอกรหัสผ่าน"
                        class="input-dark w-full px-4 py-3 rounded-xl text-sm">
                </div>

                <div class="flex items-center justify-between mb-5">
                    <label class="flex items-center gap-2 cursor-pointer">
                        <input type="checkbox" name="remember"
                            class="w-4 h-4 rounded border-slate-600 bg-slate-700 text-blue-500 focus:ring-blue-500/30">
                        <span class="text-slate-400 text-sm">จดจำฉัน</span>
                    </label>
                </div>

                <button type="submit" class="btn-login w-full py-3.5 rounded-xl text-white font-semibold text-sm">
                    <span class="flex items-center justify-center gap-2">
                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M15.75 9V5.25A2.25 2.25 0 0 0 13.5 3h-6a2.25 2.25 0 0 0-2.25 2.25v13.5A2.25 2.25 0 0 0 7.5 21h6a2.25 2.25 0 0 0 2.25-2.25V15m3 0 3-3m0 0-3-3m3 3H9" />
                        </svg>
                        เข้าสู่ระบบ
                    </span>
                </button>
            </form>
        </div>

        <p class="text-center text-slate-500 text-xs mt-6 animate-fade-in-delay-2">
            &copy; {{ date('Y') }} MacAutoCar — All rights reserved.
        </p>
    </div>
</body>

</html>