<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>ระบบบัญชี</title>
    <!-- Google Fonts: Sarabun -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Sarabun:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800&display=swap"
        rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        body {
            font-family: 'Sarabun', sans-serif;
        }
    </style>
</head>

<body class="bg-gray-50 text-gray-900 font-sans antialiased pb-20"> <!-- Added pb-20 for bottom nav -->
    <div class="min-h-screen">
        <!-- Top Nav (Simplistic) -->
        <nav class="bg-white border-b border-gray-200 sticky top-0 z-10">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between h-14 items-center">
                    <div class="flex items-center gap-4">
                        <button class="text-gray-500"><svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
                            </svg></button>
                    </div>
                    <div class="flex items-center gap-3 text-gray-500">
                        <span class="text-sm text-gray-600 font-medium">{{ Auth::user()->name }}</span>
                        <form method="POST" action="{{ route('logout') }}" class="inline">
                            @csrf
                            <button type="submit"
                                class="flex items-center gap-1 text-red-500 hover:text-red-700 text-sm font-medium transition-colors">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M15.75 9V5.25A2.25 2.25 0 0 0 13.5 3h-6a2.25 2.25 0 0 0-2.25 2.25v13.5A2.25 2.25 0 0 0 7.5 21h6a2.25 2.25 0 0 0 2.25-2.25V15m3 0 3-3m0 0-3-3m3 3H9" />
                                </svg>
                                ออก
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </nav>

        <main class="py-4">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                @if(session('success'))
                    <!-- Premium Success Modal -->
                    <div id="successOverlay"
                        class="fixed inset-0 bg-black/60 backdrop-blur-sm z-[100] flex items-center justify-center opacity-0 transition-all duration-500">
                        <div id="successModal"
                            class="bg-white rounded-3xl shadow-[0_25px_60px_-15px_rgba(0,0,0,0.3)] p-8 w-[90%] max-w-sm transform scale-90 opacity-0 transition-all duration-500 ease-out">
                            <div class="flex justify-center mb-6">
                                <div class="relative">
                                    <div id="successRing"
                                        class="absolute inset-0 w-20 h-20 rounded-full border-4 border-emerald-400 opacity-0">
                                    </div>
                                    <div
                                        class="w-20 h-20 bg-gradient-to-br from-emerald-400 via-green-500 to-teal-600 rounded-full flex items-center justify-center shadow-lg shadow-emerald-200">
                                        <svg class="w-10 h-10 text-white" viewBox="0 0 24 24" fill="none"
                                            stroke="currentColor" stroke-width="3" stroke-linecap="round"
                                            stroke-linejoin="round">
                                            <path id="checkPath" d="M4 12l5 5L20 7"
                                                style="stroke-dasharray: 30; stroke-dashoffset: 30;"></path>
                                        </svg>
                                    </div>
                                </div>
                            </div>
                            <div class="text-center mb-6">
                                <h4
                                    class="text-2xl font-bold bg-gradient-to-r from-emerald-600 to-teal-600 bg-clip-text text-transparent mb-2">
                                    สำเร็จ!</h4>
                                <p class="text-gray-500 text-sm leading-relaxed">{{ session('success') }}</p>
                            </div>
                            <div class="w-full bg-gray-100 rounded-full h-2 overflow-hidden mb-6 shadow-inner">
                                <div id="toastProgress"
                                    class="bg-gradient-to-r from-emerald-400 via-green-500 to-teal-500 h-2 rounded-full"
                                    style="width: 100%"></div>
                            </div>
                            <button onclick="closeToast()"
                                class="w-full bg-gradient-to-r from-emerald-500 via-green-500 to-teal-500 hover:from-emerald-600 hover:via-green-600 hover:to-teal-600 text-white font-semibold py-3.5 rounded-2xl transition-all duration-300 shadow-lg shadow-emerald-200 hover:shadow-xl hover:-translate-y-0.5">
                                <span class="flex items-center justify-center gap-2">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M5 13l4 4L19 7"></path>
                                    </svg>
                                    ตกลง
                                </span>
                            </button>
                        </div>
                    </div>
                    <style>
                        @keyframes checkDraw {
                            to {
                                stroke-dashoffset: 0;
                            }
                        }

                        @keyframes modalBounce {
                            0% {
                                transform: scale(0.8);
                                opacity: 0;
                            }

                            50% {
                                transform: scale(1.02);
                            }

                            100% {
                                transform: scale(1);
                                opacity: 1;
                            }
                        }

                        @keyframes ringPulse {

                            0%,
                            100% {
                                transform: scale(1);
                                opacity: 0.6;
                            }

                            50% {
                                transform: scale(1.3);
                                opacity: 0;
                            }
                        }
                    </style>
                    <script>
                        document.addEventListener('DOMContentLoaded', function () {
                            const overlay = document.getElementById('successOverlay');
                            const modal = document.getElementById('successModal');
                            const progress = document.getElementById('toastProgress');
                            const checkPath = document.getElementById('checkPath');
                            const successRing = document.getElementById('successRing');
                            setTimeout(() => {
                                overlay.classList.remove('opacity-0'); overlay.classList.add('opacity-100');
                                modal.classList.remove('scale-90', 'opacity-0'); modal.style.animation = 'modalBounce 0.5s ease-out forwards';
                                checkPath.style.animation = 'checkDraw 0.4s ease-out 0.3s forwards';
                                successRing.style.animation = 'ringPulse 1.5s ease-in-out infinite';
                            }, 50);
                            let width = 100;
                            const interval = setInterval(() => { width -= 2.5; progress.style.width = width + '%'; if (width <= 0) { clearInterval(interval); closeToast(); } }, 100);
                            window.closeToast = function () {
                                modal.style.transform = 'scale(0.9)'; modal.style.opacity = '0';
                                overlay.classList.remove('opacity-100'); overlay.classList.add('opacity-0');
                                setTimeout(() => { overlay.remove(); }, 400);
                            };
                            overlay.addEventListener('click', function (e) { if (e.target === overlay) closeToast(); });
                        });
                    </script>
                @endif

                @if($errors->any())
                    <div class="mb-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative text-sm"
                        role="alert">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                @yield('content')
            </div>
        </main>

        <!-- Bottom Navigation -->
        <div
            class="fixed bottom-0 left-0 w-full bg-white border-t border-gray-200 h-16 flex justify-around items-center text-xs text-gray-500 z-50">
            <a href="{{ route('dashboard') }}"
                class="flex flex-col items-center gap-1 {{ request()->routeIs('dashboard') ? 'text-blue-600' : '' }}">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M3.75 6A2.25 2.25 0 0 1 6 3.75h2.25A2.25 2.25 0 0 1 10.5 6v2.25a2.25 2.25 0 0 1-2.25 2.25H6a2.25 2.25 0 0 1-2.25-2.25V6ZM3.75 15.75A2.25 2.25 0 0 1 6 13.5h2.25a2.25 2.25 0 0 1 2.25 2.25V18a2.25 2.25 0 0 1-2.25 2.25H6A2.25 2.25 0 0 1 3.75 18v-2.25ZM13.5 6a2.25 2.25 0 0 1 2.25-2.25H18A2.25 2.25 0 0 1 20.25 6v2.25A2.25 2.25 0 0 1 18 10.5h-2.25a2.25 2.25 0 0 1-2.25-2.25V6ZM13.5 15.75a2.25 2.25 0 0 1 2.25-2.25H18a2.25 2.25 0 0 1 2.25 2.25V18A2.25 2.25 0 0 1 18 20.25h-2.25A2.25 2.25 0 0 1 13.5 18v-2.25Z" />
                </svg>
                <span>หน้าหลัก</span>
            </a>
            <a href="#" class="flex flex-col items-center gap-1">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m2.25 0H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9Z" />
                </svg>
                <span>รายการรถ</span>
            </a>
            <a href="#" class="flex flex-col items-center gap-1">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M3 13.125C3 12.504 3.504 12 4.125 12h2.25c.621 0 1.125.504 1.125 1.125v6.75C7.5 20.496 6.996 21 6.375 21h-2.25A1.125 1.125 0 0 1 3 19.875v-6.75ZM9.75 8.625c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125v11.25c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 0 1-1.125-1.125V8.625ZM16.5 4.125c0-.621.504-1.125 1.125-1.125h2.25C20.496 3 21 3.504 21 4.125v15.75c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 0 1-1.125-1.125V4.125Z" />
                </svg>
                <span>ค่าใช้จ่าย</span>
            </a>
            <a href="#" class="flex flex-col items-center gap-1">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M10.343 3.94c.09-.542.56-.94 1.11-.94h1.093c.55 0 1.02.398 1.11.94l.149.894c.07.424.384.764.78.93.398.164.855.142 1.205-.108l.737-.527a1.125 1.125 0 0 1 1.45.12l.773.774c.39.389.44 1.002.12 1.45l-.527.737c-.25.35-.272.806-.107 1.204.165.397.505.71.93.78l.893.15c.543.09.94.56.94 1.109v1.094c0 .55-.397 1.02-.94 1.11l-.893.149c-.425.07-.765.383-.93.78-.165.398-.143.854.107 1.204l.527.738c.32.447.269 1.06-.12 1.45l-.774.773a1.125 1.125 0 0 1-1.45.12l-.737-.527c-.35-.25-.806-.272-1.204-.107-.397.165-.71.505-.78.93l-.15.894c-.09.543-.56.94-1.11.94h-1.094c-.55 0-1.019-.398-1.11-.94l-.148-.894c-.071-.424-.384-.764-.781-.93-.398-.164-.854-.142-1.204.108l-.738.527c-.447.32-1.06.269-1.45-.12l-.773-.774a1.125 1.125 0 0 1-.12-1.45l.527-.737c.25-.35.273-.806.108-1.204-.165-.397-.505-.71-.93-.78l-.894-.15c-.542-.09-.94-.56-.94-1.109v-1.094c0-.55.398-1.02.94-1.11l.894-.149c.424-.07.765-.383.93-.78.165-.398.143-.854-.107-1.204l-.527-.738a1.125 1.125 0 0 1 .12-1.45l.773-.773a1.125 1.125 0 0 1 1.45-.12l.737.527c.35.25.807.272 1.204.107.397-.165.71-.505.781-.93l.15-.894Z" />
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                </svg>
                <span>ปรับสภาพ</span>
            </a>
        </div>
    </div>

    <!-- Global Money Formatting Script (Feature 6) -->
    <script>
        function formatNumberWithCommas(value) {
            const numericValue = value.replace(/[^0-9.]/g, '');
            const parts = numericValue.split('.');
            parts[0] = parts[0].replace(/\B(?=(\d{3})+(?!\d))/g, ',');
            return parts.join('.');
        }

        function setupMoneyInputs() {
            const moneyInputs = document.querySelectorAll('input[type="number"]');

            moneyInputs.forEach(input => {
                if (input.dataset.moneySetup) return;
                input.dataset.moneySetup = 'true';

                const display = document.createElement('input');
                display.type = 'text';
                display.inputMode = 'numeric';
                display.className = input.className;
                display.placeholder = input.placeholder;
                display.required = input.required;
                display.id = input.id ? input.id + '_display' : '';

                if (input.value) {
                    display.value = formatNumberWithCommas(input.value);
                }

                input.style.display = 'none';
                input.removeAttribute('required');
                input.parentNode.insertBefore(display, input.nextSibling);

                display.addEventListener('input', function (e) {
                    let rawValue = this.value.replace(/,/g, '').replace(/[^0-9.]/g, '');
                    input.value = rawValue;
                    this.value = formatNumberWithCommas(rawValue);
                });

                display.addEventListener('focus', function () { this.select(); });
            });
        }

        document.addEventListener('DOMContentLoaded', setupMoneyInputs);

        // Observe for dynamically opened modals
        const observer = new MutationObserver(mutations => {
            mutations.forEach(mutation => {
                if (mutation.type === 'attributes' && mutation.attributeName === 'class') {
                    if (!mutation.target.classList.contains('hidden')) {
                        setTimeout(setupMoneyInputs, 100);
                    }
                }
            });
        });
        document.querySelectorAll('[id*="Modal"]').forEach(modal => {
            observer.observe(modal, { attributes: true });
        });
    </script>
</body>

</html>