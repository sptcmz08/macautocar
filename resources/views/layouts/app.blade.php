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

<body class="bg-gray-50 text-gray-900 font-sans antialiased">
    <div class="min-h-screen">
        <!-- Top Nav (Simplistic) -->
        <nav class="bg-white border-b border-gray-200 sticky top-0 z-10">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between h-14 items-center">
                    <a href="{{ route('dashboard') }}"
                        class="flex items-center gap-2 text-gray-800 hover:text-blue-600 transition-colors">
                        <svg class="w-6 h-6 text-blue-600" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M8.25 18.75a1.5 1.5 0 0 1-3 0m3 0a1.5 1.5 0 0 0-3 0m3 0h6m-9 0H3.375a1.125 1.125 0 0 1-1.125-1.125V14.25m17.25 4.5a1.5 1.5 0 0 1-3 0m3 0a1.5 1.5 0 0 0-3 0m3 0h1.125c.621 0 1.125-.504 1.125-1.125v-1.5c0-.621-.504-1.125-1.125-1.125H18.75m-7.5-2.25h.008v.008H11.25v-.008ZM12 15h.008v.008H12V15Zm0 2.25h.008v.008H12v-.008ZM9.75 15h.008v.008H9.75V15Zm0 2.25h.008v.008H9.75v-.008ZM7.5 15h.008v.008H7.5V15Zm0 2.25h.008v.008H7.5v-.008Zm6.75-4.5h.008v.008h-.008v-.008Zm0 2.25h.008v.008h-.008V15Zm0 2.25h.008v.008h-.008v-.008Zm2.25-4.5h.008v.008H16.5v-.008Zm0 2.25h.008v.008H16.5V15Z" />
                        </svg>
                        <span class="font-bold text-sm">MacAutoCar</span>
                    </a>
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