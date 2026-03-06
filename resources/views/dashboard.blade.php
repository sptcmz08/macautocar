<!DOCTYPE html>
<html lang="th">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>CarStock Master</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Sarabun:wght@300;400;500;600;700&display=swap"
        rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['Sarabun', 'sans-serif'],
                    },
                }
            }
        }
    </script>
    <style>
        :root {
            --primary: #3b82f6;
            --primary-dark: #1e40af;
            --accent: #f59e0b;
            --success: #10b981;
            --danger: #ef4444;
        }

        body {
            font-family: 'Sarabun', sans-serif;
            background: linear-gradient(135deg, #f0f4f8 0%, #e2e8f0 100%);
            min-height: 100vh;
        }

        .glass {
            background: rgba(255, 255, 255, 0.85);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            border: 1px solid rgba(255, 255, 255, 0.3);
        }

        .premium-shadow {
            box-shadow: 0 10px 40px -10px rgba(0, 0, 0, 0.15), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
        }

        .stat-card {
            background: linear-gradient(145deg, rgba(255, 255, 255, 0.9) 0%, rgba(248, 250, 252, 0.9) 100%);
            border-radius: 16px;
            padding: 16px;
            position: relative;
            overflow: hidden;
            transition: all 0.3s ease;
        }

        .stat-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 20px 40px -15px rgba(0, 0, 0, 0.2);
        }

        .stat-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(90deg, var(--primary), var(--accent));
            border-radius: 16px 16px 0 0;
        }

        .premium-header {
            background: linear-gradient(135deg, #1e293b 0%, #0f172a 50%, #1e293b 100%);
            position: relative;
            overflow: hidden;
        }

        .premium-header::before {
            content: '';
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: radial-gradient(circle, rgba(59, 130, 246, 0.08) 0%, transparent 50%);
            animation: pulse-bg 15s ease-in-out infinite;
        }

        @keyframes pulse-bg {

            0%,
            100% {
                transform: translate(0, 0) scale(1);
            }

            50% {
                transform: translate(-10%, -10%) scale(1.1);
            }
        }

        .glow-text {
            text-shadow: 0 0 20px rgba(59, 130, 246, 0.5);
        }

        .btn-premium {
            background: linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%);
            color: white;
            padding: 10px 20px;
            border-radius: 12px;
            font-weight: 600;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(59, 130, 246, 0.3);
        }

        .btn-premium:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(59, 130, 246, 0.4);
        }

        .tab-btn {
            padding: 10px 18px;
            border-radius: 10px;
            font-weight: 500;
            transition: all 0.2s ease;
            background: white;
            color: #64748b;
            border: 1px solid #e2e8f0;
        }

        .tab-btn:hover {
            background: #f8fafc;
            border-color: #cbd5e1;
        }

        .tab-btn.active {
            background: linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%);
            color: white;
            border-color: transparent;
            box-shadow: 0 4px 12px rgba(59, 130, 246, 0.3);
        }

        .premium-table {
            border-radius: 16px;
            overflow: hidden;
        }

        .premium-table thead {
            background: linear-gradient(135deg, #f8fafc 0%, #f1f5f9 100%);
        }

        .premium-table tbody tr {
            transition: all 0.2s ease;
        }

        .premium-table tbody tr:hover {
            background: linear-gradient(90deg, rgba(59, 130, 246, 0.05) 0%, transparent 100%);
        }

        .modal-premium {
            background: rgba(15, 23, 42, 0.8);
            backdrop-filter: blur(8px);
        }

        .modal-content-premium {
            background: linear-gradient(145deg, #ffffff 0%, #f8fafc 100%);
            border-radius: 24px;
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
        }

        .input-premium {
            background: #f8fafc;
            border: 2px solid #e2e8f0;
            border-radius: 12px;
            padding: 12px 16px;
            transition: all 0.2s ease;
        }

        .input-premium:focus {
            border-color: var(--primary);
            box-shadow: 0 0 0 4px rgba(59, 130, 246, 0.1);
            outline: none;
        }

        .floating-btn {
            position: fixed;
            bottom: 24px;
            right: 24px;
            position: fixed;
            bottom: 24px;
            right: 24px;
            width: 56px;
            height: 56px;
            border-radius: 16px;
            background: linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%);
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 8px 30px rgba(59, 130, 246, 0.4);
            transition: all 0.3s ease;
            z-index: 40;
        }

        .floating-btn:hover {
            transform: scale(1.1) rotate(90deg);
        }

        /* ========== PREMIUM UI ENHANCEMENTS ========== */

        /* Animated gradient border */
        .rainbow-border {
            position: relative;
            background: linear-gradient(white, white) padding-box,
                linear-gradient(135deg, #667eea, #764ba2, #f093fb, #f5576c, #4facfe, #667eea) border-box;
            border: 2px solid transparent;
            background-size: 100% 100%, 300% 300%;
            animation: gradient-shift 8s ease infinite;
        }

        @keyframes gradient-shift {

            0%,
            100% {
                background-position: 0% 50%, 0% 50%;
            }

            50% {
                background-position: 100% 50%, 100% 50%;
            }
        }

        /* Aurora glow effect */
        .aurora-glow {
            position: relative;
        }

        .aurora-glow::after {
            content: '';
            position: absolute;
            inset: -2px;
            background: linear-gradient(45deg, #12c2e9, #c471ed, #f64f59);
            border-radius: inherit;
            filter: blur(15px);
            opacity: 0.3;
            z-index: -1;
            transition: opacity 0.3s ease;
        }

        .aurora-glow:hover::after {
            opacity: 0.5;
        }

        /* Floating animation */
        .float-animation {
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

        /* Shimmer effect */
        .shimmer {
            position: relative;
            overflow: hidden;
        }

        .shimmer::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.4), transparent);
            animation: shimmer 2s infinite;
        }

        @keyframes shimmer {
            100% {
                left: 100%;
            }
        }

        /* Premium stat cards with unique colors */
        .stat-premium {
            background: white;
            border-radius: 20px;
            padding: 20px;
            position: relative;
            overflow: hidden;
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
        }

        .stat-premium:hover {
            transform: translateY(-5px) scale(1.02);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.15);
        }

        .stat-premium::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 5px;
            border-radius: 20px 20px 0 0;
        }

        .stat-blue::before {
            background: linear-gradient(90deg, #3b82f6, #60a5fa);
        }

        .stat-green::before {
            background: linear-gradient(90deg, #10b981, #34d399);
        }

        .stat-orange::before {
            background: linear-gradient(90deg, #f59e0b, #fbbf24);
        }

        .stat-purple::before {
            background: linear-gradient(90deg, #8b5cf6, #a78bfa);
        }

        .stat-pink::before {
            background: linear-gradient(90deg, #ec4899, #f472b6);
        }

        /* Premium table rows */
        .table-row-premium {
            background: white;
            transition: all 0.3s ease;
            border-left: 4px solid transparent;
        }

        .table-row-premium:hover {
            background: linear-gradient(90deg, rgba(59, 130, 246, 0.08) 0%, rgba(59, 130, 246, 0.02) 100%);
            border-left-color: #3b82f6;
            transform: scale(1.005);
        }

        /* Number counter animation */
        .counter {
            display: inline-block;
            animation: count-up 0.8s ease-out forwards;
        }

        @keyframes count-up {
            from {
                opacity: 0;
                transform: translateY(10px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Pill badges */
        .badge-pill {
            padding: 4px 12px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
            display: inline-flex;
            align-items: center;
            gap: 4px;
        }

        .badge-success {
            background: linear-gradient(135deg, #d1fae5, #a7f3d0);
            color: #065f46;
        }

        .badge-warning {
            background: linear-gradient(135deg, #fef3c7, #fde68a);
            color: #92400e;
        }

        .badge-danger {
            background: linear-gradient(135deg, #fee2e2, #fecaca);
            color: #991b1b;
        }

        .badge-info {
            background: linear-gradient(135deg, #dbeafe, #bfdbfe);
            color: #1e40af;
        }

        /* Section dividers */
        .section-divider {
            height: 2px;
            background: linear-gradient(90deg, transparent, #e2e8f0, transparent);
            margin: 24px 0;
        }

        /* Glassmorphism cards */
        .glass-card {
            background: rgba(255, 255, 255, 0.7);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.8);
            border-radius: 24px;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);
        }

        /* Icon containers */
        .icon-box {
            width: 48px;
            height: 48px;
            border-radius: 14px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 22px;
        }

        .icon-blue {
            background: linear-gradient(135deg, #dbeafe, #bfdbfe);
        }

        .icon-green {
            background: linear-gradient(135deg, #d1fae5, #a7f3d0);
        }

        .icon-orange {
            background: linear-gradient(135deg, #fed7aa, #fdba74);
        }

        .icon-purple {
            background: linear-gradient(135deg, #e9d5ff, #d8b4fe);
        }

        .icon-pink {
            background: linear-gradient(135deg, #fce7f3, #fbcfe8);
        }

        /* ========================================
           COMPREHENSIVE RESPONSIVE DESIGN
           ======================================== */

        /* Touch-friendly interactions for mobile/tablet */
        @media (hover: none) and (pointer: coarse) {

            .stat-card:hover,
            .glass:hover,
            button:hover,
            a:hover {
                transform: none !important;
            }

            button,
            a,
            .clickable {
                min-height: 44px;
                min-width: 44px;
            }
        }

        /* Extra Small devices (phones, less than 375px) */
        @media (max-width: 374px) {

            .stat-card,
            .stat-premium,
            .glass {
                padding: 10px;
            }

            .text-2xl {
                font-size: 1.25rem !important;
            }

            .text-xl {
                font-size: 1.1rem !important;
            }

            .text-lg {
                font-size: 1rem !important;
            }

            .tab-btn {
                padding: 6px 8px;
                font-size: 11px;
            }

            .gap-3 {
                gap: 0.5rem !important;
            }

            .gap-2 {
                gap: 0.375rem !important;
            }

            .px-4,
            .px-6 {
                padding-left: 0.5rem !important;
                padding-right: 0.5rem !important;
            }
        }

        /* Small devices (phones, 375px to 640px) */
        @media (max-width: 640px) {
            .stat-card {
                padding: 12px;
            }

            .tab-btn {
                padding: 8px 12px;
                font-size: 12px;
            }

            .stat-premium {
                padding: 14px;
            }

            /* Header adjustments */
            .premium-header {
                padding-top: 1.5rem !important;
                padding-bottom: 2rem !important;
            }

            .premium-header h1 {
                font-size: 1.25rem !important;
            }

            /* Table responsive - horizontal scroll */
            .table-responsive {
                overflow-x: auto;
                -webkit-overflow-scrolling: touch;
            }

            .table-responsive table {
                min-width: 600px;
            }

            /* Stack action buttons on small screens */
            .action-buttons {
                flex-direction: column;
                gap: 4px !important;
            }

            .action-buttons button,
            .action-buttons form {
                width: 100%;
            }

            /* Modal fullscreen on mobile */
            .modal-content {
                width: 95% !important;
                max-width: none !important;
                margin: 10px auto !important;
            }

            /* Reduce padding in modals */
            .modal-content .p-4,
            .modal-content .p-5,
            .modal-content .p-6 {
                padding: 12px !important;
            }

            /* Form inputs larger for touch */
            input[type="text"],
            input[type="number"],
            input[type="date"],
            input[type="email"],
            input[type="tel"],
            select,
            textarea {
                font-size: 16px !important;
                /* Prevents zoom on iOS */
                padding: 12px !important;
                min-height: 44px;
            }

            /* Larger buttons for touch */
            button,
            .btn {
                padding: 10px 16px !important;
                font-size: 14px !important;
                min-height: 44px;
            }

            /* Grid adjustments */
            .grid-cols-7 {
                grid-template-columns: repeat(2, minmax(0, 1fr)) !important;
            }

            .grid-cols-4 {
                grid-template-columns: repeat(2, minmax(0, 1fr)) !important;
            }

            .grid-cols-3 {
                grid-template-columns: repeat(1, minmax(0, 1fr)) !important;
            }

            /* Hide less important columns on mobile */
            .hide-mobile {
                display: none !important;
            }
        }

        /* Medium devices (tablets, iPad mini, 641px to 768px) */
        @media (min-width: 641px) and (max-width: 768px) {

            .stat-card,
            .stat-premium {
                padding: 14px;
            }

            .tab-btn {
                padding: 10px 16px;
                font-size: 13px;
            }

            .grid-cols-7 {
                grid-template-columns: repeat(3, minmax(0, 1fr)) !important;
            }

            .grid-cols-4 {
                grid-template-columns: repeat(2, minmax(0, 1fr)) !important;
            }

            .modal-content {
                width: 90% !important;
                max-width: 500px !important;
            }

            .table-responsive table {
                min-width: 100%;
            }
        }

        /* Large tablets (iPad, iPad Pro portrait, 769px to 1024px) */
        @media (min-width: 769px) and (max-width: 1024px) {

            .stat-card,
            .stat-premium {
                padding: 16px;
            }

            .tab-btn {
                padding: 12px 20px;
                font-size: 14px;
            }

            .grid-cols-7 {
                grid-template-columns: repeat(4, minmax(0, 1fr)) !important;
            }

            .modal-content {
                width: 85% !important;
                max-width: 550px !important;
            }
        }

        /* Desktop and larger (1025px and up) */
        @media (min-width: 1025px) {
            .modal-content {
                max-width: 450px !important;
            }
        }

        /* iPad Pro landscape and large tablets (1024px to 1366px) */
        @media (min-width: 1024px) and (max-width: 1366px) {
            .max-w-5xl {
                max-width: 95% !important;
            }
        }

        /* Landscape orientation fixes */
        @media (orientation: landscape) and (max-height: 500px) {
            .premium-header {
                padding-top: 1rem !important;
                padding-bottom: 1.5rem !important;
            }

            .modal-content {
                max-height: 90vh;
                overflow-y: auto;
            }
        }

        /* Print styles */
        @media print {
            .premium-header {
                background: #1e293b !important;
            }

            .no-print {
                display: none !important;
            }

            .stat-card,
            .glass {
                box-shadow: none !important;
                border: 1px solid #ddd !important;
            }
        }

        /* Safe area padding for notched devices (iPhone X+) */
        .premium-header {
            padding-left: max(1rem, env(safe-area-inset-left));
            padding-right: max(1rem, env(safe-area-inset-right));
        }

        body {
            padding-bottom: env(safe-area-inset-bottom);
        }

        /* Smooth scrolling for all devices */
        html {
            scroll-behavior: smooth;
        }

        /* Better tap highlighting for mobile */
        * {
            -webkit-tap-highlight-color: rgba(59, 130, 246, 0.2);
        }

        /* Prevent text selection on buttons */
        button,
        .btn,
        .tab-btn {
            -webkit-user-select: none;
            user-select: none;
        }
    </style>
</head>

<body class="text-gray-900">

    <!-- Premium Dark Header -->
    <div class="premium-header text-white pt-8 pb-12 px-4 relative">
        <div class="max-w-5xl mx-auto relative z-10">
            <!-- Logo & Title -->
            <div class="flex items-center justify-between mb-6">
                <div class="flex items-center gap-3">
                    <div
                        class="w-12 h-12 bg-gradient-to-br from-blue-500 to-blue-700 rounded-xl flex items-center justify-center shadow-lg">
                        <span class="text-2xl">🚗</span>
                    </div>
                    <div>
                        <h1 class="text-2xl font-bold glow-text">CarStock Master</h1>
                        <p class="text-xs text-blue-300/70">ระบบจัดการสต็อกรถอัจฉริยะ</p>
                    </div>
                </div>
                <div class="flex items-center gap-2">
                    <a href="{{ route('reports') }}"
                        class="p-2 rounded-lg bg-white/10 hover:bg-white/20 transition-colors" title="รายงาน">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="w-5 h-5">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M3 13.125C3 12.504 3.504 12 4.125 12h2.25c.621 0 1.125.504 1.125 1.125v6.75C7.5 20.496 6.996 21 6.375 21h-2.25A1.125 1.125 0 0 1 3 19.875v-6.75ZM9.75 8.625c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125v11.25c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 0 1-1.125-1.125V8.625ZM16.5 4.125c0-.621.504-1.125 1.125-1.125h2.25C20.496 3 21 3.504 21 4.125v15.75c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 0 1-1.125-1.125V4.125Z" />
                        </svg>
                    </a>
                    <a href="{{ route('trash') }}"
                        class="p-2 rounded-lg bg-white/10 hover:bg-white/20 transition-colors" title="ถังขยะ">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="w-5 h-5">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                        </svg>
                    </a>
                    <a href="{{ route('year-end.show') }}"
                        class="p-2 rounded-lg bg-gradient-to-r from-orange-500 to-red-500 hover:from-orange-600 hover:to-red-600 transition-colors shadow-lg"
                        title="Reset ปีใหม่">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="w-5 h-5">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M16.023 9.348h4.992v-.001M2.985 19.644v-4.992m0 0h4.992m-4.993 0l3.181 3.183a8.25 8.25 0 0013.803-3.7M4.031 9.865a8.25 8.25 0 0113.803-3.7l3.181 3.182m0-4.991v4.99" />
                        </svg>
                    </a>
                    <button onclick="openSettingModal()"
                        class="p-2 rounded-lg bg-white/10 hover:bg-white/20 transition-colors" title="ตั้งค่า">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="w-5 h-5">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M9.594 3.94c.09-.542.56-.94 1.11-.94h2.593c.55 0 1.02.398 1.11.94l.213 1.281c.063.374.313.686.645.87.074.04.147.083.22.127.325.196.72.257 1.075.124l1.217-.456a1.125 1.125 0 0 1 1.37.49l1.296 2.247a1.125 1.125 0 0 1-.26 1.431l-1.003.827c-.293.241-.438.613-.43.992a7.723 7.723 0 0 1 0 .255c-.008.378.137.75.43.991l1.004.827c.424.35.534.955.26 1.43l-1.298 2.247a1.125 1.125 0 0 1-1.369.491l-1.217-.456c-.355-.133-.75-.072-1.076.124a6.47 6.47 0 0 1-.22.128c-.331.183-.581.495-.644.869l-.213 1.281c-.09.543-.56.94-1.11.94h-2.594c-.55 0-1.019-.398-1.11-.94l-.213-1.281c-.062-.374-.312-.686-.644-.87a6.52 6.52 0 0 1-.22-.127c-.325-.196-.72-.257-1.076-.124l-1.217.456a1.125 1.125 0 0 1-1.369-.49l-1.297-2.247a1.125 1.125 0 0 1 .26-1.431l1.004-.827c.292-.24.437-.613.43-.991a6.932 6.932 0 0 1 0-.255c.007-.38-.138-.751-.43-.992l-1.004-.827a1.125 1.125 0 0 1-.26-1.43l1.297-2.247a1.125 1.125 0 0 1 1.37-.491l1.216.456c.356.133.751.072 1.076-.124.072-.044.146-.086.22-.128.332-.183.582-.495.644-.869l.214-1.28Z" />
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                        </svg>
                    </button>
                </div>
            </div>

            <!-- Stats Grid - Premium Glassmorphism -->
            <div class="grid grid-cols-2 md:grid-cols-7 gap-3">
                <div
                    class="glass rounded-2xl p-4 text-center hover:scale-105 transition-all duration-300 border border-emerald-200/30">
                    <p class="text-xs text-gray-600 mb-1 font-medium">💵 ยอดเงินคงเหลือ</p>
                    <p class="text-lg md:text-xl font-bold text-emerald-600 counter">
                        ฿{{ number_format($cashOnHand, 0) }}</p>
                </div>
                <div
                    class="glass rounded-2xl p-4 text-center hover:scale-105 transition-all duration-300 border border-amber-200/30">
                    <p class="text-xs text-gray-600 mb-1 font-medium">📈 กำไรสะสม</p>
                    <p class="text-lg md:text-xl font-bold text-amber-600 counter">
                        ฿{{ number_format($accumulatedProfit, 0) }}</p>
                </div>
                <div
                    class="glass rounded-2xl p-4 text-center hover:scale-105 transition-all duration-300 border border-blue-200/30">
                    <p class="text-xs text-gray-600 mb-1 font-medium">🚗 สต็อกรถ</p>
                    <p class="text-lg md:text-xl font-bold text-blue-600 counter">
                        ฿{{ number_format($stockCarsValue, 0) }}</p>
                </div>
                <div
                    class="glass rounded-2xl p-4 text-center hover:scale-105 transition-all duration-300 border border-cyan-200/30">
                    <p class="text-xs text-gray-600 mb-1 font-medium">🔧 อะไหล่</p>
                    <p class="text-lg md:text-xl font-bold text-cyan-600 counter">฿{{ number_format($partsValue, 0) }}
                    </p>
                </div>
                <div
                    class="glass rounded-2xl p-4 text-center hover:scale-105 transition-all duration-300 border border-orange-200/30">
                    <p class="text-xs text-gray-600 mb-1 font-medium">💰 ทุนอื่นๆ</p>
                    <p class="text-lg md:text-xl font-bold text-orange-600 counter">
                        ฿{{ number_format($capitalExpensesActiveTotal, 0) }}
                    </p>
                </div>
                <a href="{{ route('personal.account') }}"
                    class="glass rounded-2xl p-4 text-center hover:scale-105 transition-all duration-300 border border-purple-200/30 cursor-pointer hover:bg-white/95 block">
                    <p class="text-xs text-gray-600 mb-1 font-medium">💳 ส่วนตัวคงเหลือ</p>
                    <p
                        class="text-lg md:text-xl font-bold counter {{ $personalBalance >= 0 ? 'text-emerald-600' : 'text-red-600' }}">
                        ฿{{ number_format($personalBalance, 0) }}</p>
                </a>
                <div
                    class="glass rounded-2xl p-4 text-center hover:scale-105 transition-all duration-300 border border-green-200/30">
                    <p class="text-xs text-gray-600 mb-1 font-medium">🚙 รถในสต็อก</p>
                    <p class="text-lg md:text-xl font-bold text-green-600 counter">{{ $carsInStock }} <span
                            class="text-sm font-normal">คัน</span></p>
                    @if($branches->count() > 0)
                        <div class="flex flex-wrap justify-center gap-1 mt-2">
                            @foreach($branches as $branch)
                                @php
                                    $branchCarCount = $cars->where('status', 'stock')->where('branch_id', $branch->id)->count();
                                @endphp
                                @if($branchCarCount > 0)
                                    <span class="px-2 py-0.5 rounded-full text-xs font-medium"
                                        style="background-color: {{ $branch->color }}20; color: {{ $branch->color }}">
                                        {{ $branch->name }}: {{ $branchCarCount }}
                                    </span>
                                @endif
                            @endforeach
                            @php
                                $noBranchCount = $cars->where('status', 'stock')->whereNull('branch_id')->count();
                            @endphp
                            @if($noBranchCount > 0)
                                <span class="px-2 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-500">
                                    ไม่มีสาขา: {{ $noBranchCount }}
                                </span>
                            @endif
                        </div>
                    @endif
                </div>
            </div>

            <!-- Total Assets & Breakdown - Full Width -->
            <div class="mt-4 space-y-2">
                <!-- Total Assets -->
                <div class="bg-gradient-to-r from-blue-600/20 to-purple-600/20 rounded-2xl p-4 border border-white/10">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm text-blue-200">สินทรัพย์รวม (ทุน+กำไร)</p>
                            <p class="text-2xl md:text-3xl font-bold text-white">฿{{ number_format($totalAssets, 0) }}
                            </p>
                        </div>
                        <div class="flex items-center gap-2 text-sm text-white/60">
                            <span>ทุนตั้งต้น ปี {{ $setting->year }}</span>
                            <span
                                class="bg-white/20 px-3 py-1 rounded-full">฿{{ number_format($setting->initial_capital, 0) }}</span>
                        </div>
                    </div>
                </div>

                <!-- Deduction Breakdown -->
                <div class="bg-gradient-to-r from-slate-700/80 to-slate-800/80 rounded-xl p-3 text-white/90 text-sm">
                    <div class="grid grid-cols-2 md:grid-cols-5 gap-2 text-center">
                        <div class="bg-white/10 rounded-lg p-2">
                            <p class="text-xs text-white/60">สินทรัพย์รวม</p>
                            <p class="font-bold text-white">฿{{ number_format($totalAssets, 0) }}</p>
                        </div>
                        <div class="bg-red-500/20 rounded-lg p-2">
                            <p class="text-xs text-red-200">(-) สต็อกรถ</p>
                            <p class="font-bold text-red-300">฿{{ number_format($stockCarsValue, 0) }}</p>
                        </div>
                        <div class="bg-red-500/20 rounded-lg p-2">
                            <p class="text-xs text-red-200">(-) อะไหล่</p>
                            <p class="font-bold text-red-300">฿{{ number_format($partsValue, 0) }}</p>
                        </div>
                        <div class="bg-red-500/20 rounded-lg p-2">
                            <p class="text-xs text-red-200">(-) ทุนอื่นๆ</p>
                            <p class="font-bold text-red-300">฿{{ number_format($capitalExpensesActiveTotal, 0) }}</p>
                        </div>
                        <div class="bg-emerald-500/20 rounded-lg p-2">
                            <p class="text-xs text-emerald-200">(=) เงินคงเหลือ</p>
                            <p class="font-bold text-emerald-300">฿{{ number_format($cashOnHand, 0) }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Quick Stats Cards (Floating) -Premium Design -->
    <div class="max-w-7xl mx-auto px-4 -mt-6 relative z-20">
        <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
            <!-- Notes Card -->
            <div class="stat-premium stat-purple cursor-pointer group" onclick="openNotesModal()">
                <div class="flex items-center gap-3 mb-3">
                    <div class="icon-box icon-purple group-hover:scale-110 transition-transform">📝</div>
                    <p class="text-sm text-gray-600 font-semibold">โน้ต</p>
                </div>
                <div>
                    <p class="text-2xl font-bold text-gray-800 counter" id="notesCountCard">0 <span
                            class="text-xs font-normal text-gray-400">รายการ</span></p>
                    <p class="text-xs text-purple-500 mt-1 font-medium">คลิกเพื่อดูโน้ต →</p>
                </div>
            </div>

            <!-- Setting Cost -->
            <div class="stat-premium stat-blue cursor-pointer group" onclick="openSettingModal()">
                <div class="flex justify-between items-start mb-3">
                    <div class="flex items-center gap-2">
                        <div class="icon-box icon-blue group-hover:scale-110 transition-transform">⚙️</div>
                        <p class="text-sm text-gray-600 font-semibold">ทุนตั้งต้น</p>
                    </div>
                </div>
                <div class="flex justify-between items-end">
                    <p class="text-2xl font-bold text-gray-800 counter">
                        ฿{{ number_format($setting->initial_capital, 0) }}</p>
                    <span class="badge-pill badge-info group-hover:scale-105 transition-transform">แก้ไข</span>
                </div>
            </div>

            <!-- Cash Remaining -->
            <div class="stat-premium stat-orange shimmer">
                <div class="flex items-center gap-3 mb-3">
                    <div class="icon-box icon-orange">💰</div>
                    <p class="text-sm text-gray-600 font-semibold">เงินคงเหลือ</p>
                </div>
                <p class="text-2xl font-bold text-amber-600 counter">฿{{ number_format($cashOnHand, 0) }}</p>
            </div>

            <!-- Profit/Target Card -->
            <a href="{{ route('profit.details') }}" class="stat-premium stat-pink group">
                <div class="flex justify-between items-center mb-3">
                    <div class="flex items-center gap-2">
                        <div class="icon-box icon-pink group-hover:scale-110 transition-transform">📊</div>
                        <p class="text-sm text-gray-600 font-semibold">กำไร/เป้าหมาย</p>
                    </div>
                    <span class="badge-pill badge-danger">{{ number_format(min($progressPercent, 100), 0) }}%</span>
                </div>
                <p class="text-2xl font-bold text-pink-600 counter">฿{{ number_format($accumulatedProfit, 0) }}</p>
                <!-- Target Progress Bar -->
                <div class="w-full bg-gray-100 rounded-full h-2 mt-3 overflow-hidden">
                    <div class="bg-gradient-to-r from-pink-500 to-rose-500 h-2 rounded-full transition-all duration-1000"
                        style="width: {{ min($progressPercent, 100) }}%"></div>
                </div>
                <p class="text-xs text-gray-400 mt-2 text-right">จากเป้า
                    ฿{{ number_format($targetProfit / 1000000, 1) }}M</p>
            </a>

        </div>

        <!-- Personal Account Card - Full Width Below -->
        <div class="mt-4">
            <a href="{{ route('personal.account') }}" class="stat-premium stat-purple cursor-pointer group block">
                <div class="flex items-center justify-between">
                    <div class="flex items-center gap-4">
                        <div class="icon-box icon-purple group-hover:scale-110 transition-transform">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                                class="w-6 h-6 text-purple-600">
                                <path fill-rule="evenodd"
                                    d="M7.5 6a4.5 4.5 0 119 0 4.5 4.5 0 01-9 0zM3.751 20.105a8.25 8.25 0 0116.498 0 .75.75 0 01-.437.695A18.683 18.683 0 0112 22.5c-2.786 0-5.433-.608-7.812-1.7a.75.75 0 01-.437-.695z"
                                    clip-rule="evenodd" />
                            </svg>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500 font-medium">บัญชีส่วนตัว</p>
                            <p
                                class="text-2xl font-bold counter {{ $personalBalance >= 0 ? 'text-emerald-600' : 'text-red-600' }}">
                                ฿{{ number_format($personalBalance, 0) }}</p>
                        </div>
                    </div>
                    <span class="badge-pill badge-info group-hover:scale-105 transition-transform">ดูรายละเอียด →</span>
                </div>
            </a>
        </div>
    </div>

    <!-- Tabs & Main Content -->
    <div class="max-w-7xl mx-auto px-4 mt-6 pb-8">
        @if(session('success'))
            <!-- Premium Success Modal -->
            <div id="successOverlay"
                class="fixed inset-0 bg-black/60 backdrop-blur-sm z-[100] flex items-center justify-center opacity-0 transition-all duration-500">
                <div id="successModal"
                    class="bg-white rounded-3xl shadow-[0_25px_60px_-15px_rgba(0,0,0,0.3)] p-8 w-[90%] max-w-sm transform scale-90 opacity-0 transition-all duration-500 ease-out">
                    <!-- Animated Success Icon -->
                    <div class="flex justify-center mb-6">
                        <div class="relative">
                            <!-- Outer Ring Animation -->
                            <div id="successRing"
                                class="absolute inset-0 w-20 h-20 rounded-full border-4 border-emerald-400 opacity-0 animate-ping">
                            </div>
                            <!-- Gradient Circle -->
                            <div
                                class="w-20 h-20 bg-gradient-to-br from-emerald-400 via-green-500 to-teal-600 rounded-full flex items-center justify-center shadow-lg shadow-emerald-200">
                                <!-- Animated Checkmark -->
                                <svg id="checkSvg" class="w-10 h-10 text-white" viewBox="0 0 24 24" fill="none"
                                    stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round">
                                    <path id="checkPath" d="M4 12l5 5L20 7"
                                        style="stroke-dasharray: 30; stroke-dashoffset: 30;"></path>
                                </svg>
                            </div>
                        </div>
                    </div>

                    <!-- Content -->
                    <div class="text-center mb-6">
                        <h4
                            class="text-2xl font-bold bg-gradient-to-r from-emerald-600 to-teal-600 bg-clip-text text-transparent mb-2">
                            สำเร็จ!</h4>
                        <p class="text-gray-500 text-sm leading-relaxed">{{ session('success') }}</p>
                    </div>

                    <!-- Modern Progress Bar -->
                    <div class="w-full bg-gray-100 rounded-full h-2 overflow-hidden mb-6 shadow-inner">
                        <div id="toastProgress"
                            class="bg-gradient-to-r from-emerald-400 via-green-500 to-teal-500 h-2 rounded-full transition-all duration-100 ease-linear"
                            style="width: 100%"></div>
                    </div>

                    <!-- Glossy Button -->
                    <button onclick="closeToast()"
                        class="w-full bg-gradient-to-r from-emerald-500 via-green-500 to-teal-500 hover:from-emerald-600 hover:via-green-600 hover:to-teal-600 text-white font-semibold py-3.5 rounded-2xl transition-all duration-300 shadow-lg shadow-emerald-200 hover:shadow-xl hover:shadow-emerald-300 hover:-translate-y-0.5 active:translate-y-0">
                        <span class="flex items-center justify-center gap-2">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7">
                                </path>
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

                .animate-check {
                    animation: checkDraw 0.4s ease-out 0.3s forwards;
                }

                .animate-modal {
                    animation: modalBounce 0.5s ease-out forwards;
                }

                .animate-ring {
                    animation: ringPulse 1.5s ease-in-out infinite;
                }
            </style>

            <script>
                document.addEventListener('DOMContentLoaded', function () {
                    const overlay = document.getElementById('successOverlay');
                    const modal = document.getElementById('successModal');
                    const progress = document.getElementById('toastProgress');
                    const checkPath = document.getElementById('checkPath');
                    const successRing = document.getElementById('successRing');

                    // Show modal with fancy animation
                    setTimeout(() => {
                        overlay.classList.remove('opacity-0');
                        overlay.classList.add('opacity-100');
                        modal.classList.remove('scale-90', 'opacity-0');
                        modal.classList.add('animate-modal');

                        // Animate checkmark
                        checkPath.style.animation = 'checkDraw 0.4s ease-out 0.3s forwards';

                        // Start ring animation
                        successRing.classList.remove('opacity-0', 'animate-ping');
                        successRing.classList.add('animate-ring', 'opacity-60');
                    }, 50);

                    // Progress bar countdown (4 seconds)
                    let width = 100;
                    const interval = setInterval(() => {
                        width -= 2.5;
                        progress.style.width = width + '%';
                        if (width <= 0) {
                            clearInterval(interval);
                            closeToast();
                        }
                    }, 100);

                    // Close function
                    window.closeToast = function () {
                        modal.style.transform = 'scale(0.9)';
                        modal.style.opacity = '0';
                        overlay.classList.remove('opacity-100');
                        overlay.classList.add('opacity-0');
                        setTimeout(() => {
                            overlay.remove();
                        }, 400);
                    };

                    // Close on overlay click
                    overlay.addEventListener('click', function (e) {
                        if (e.target === overlay) {
                            closeToast();
                        }
                    });
                });
            </script>
        @endif

        <div class="flex items-center justify-between mb-4">
            <div class="flex gap-4 border-b-2 border-blue-500 pb-1">
                <span class="text-sm font-medium text-blue-600" id="sectionTitle">📋 รายการรถและสต็อก</span>
            </div>
            <div class="flex gap-2">
                <button id="btnAddCar" onclick="document.getElementById('addCarModal').classList.remove('hidden')"
                    class="bg-blue-500 hover:bg-blue-600 text-white text-sm font-medium py-2 px-4 rounded-lg flex items-center gap-1 transition-colors">
                    <span>+</span> รับรถเข้า
                </button>
                <a href="{{ route('branches.index') }}" id="btnManageBranch"
                    class="bg-gray-500 hover:bg-gray-600 text-white text-sm font-medium py-2 px-4 rounded-lg flex items-center gap-1 transition-colors">
                    🏢 สาขา
                </a>
                <button id="btnAddPart" onclick="document.getElementById('addPartModal').classList.remove('hidden')"
                    class="hidden bg-blue-500 hover:bg-blue-600 text-white text-sm font-medium py-2 px-4 rounded-lg flex items-center gap-1 transition-colors">
                    <span>+</span> เพิ่มอะไหล่
                </button>
                <button id="btnAddExpense"
                    onclick="document.getElementById('addExpenseModal').classList.remove('hidden')"
                    class="hidden bg-orange-500 hover:bg-orange-600 text-white text-sm font-medium py-2 px-4 rounded-lg flex items-center gap-1 transition-colors">
                    <span>+</span> รายจ่ายทุน
                </button>
                <button id="btnAddPersonal" onclick="openPersonalModal('income')"
                    class="hidden bg-purple-500 hover:bg-purple-600 text-white text-sm font-medium py-2 px-4 rounded-lg flex items-center gap-1 transition-colors">
                    <span>+</span> เพิ่มรายการ
                </button>
            </div>
        </div>

        <!-- Status Filter Tabs - Mobile Compact Design -->
        <div class="flex gap-1.5 mb-4 overflow-x-auto pb-2 -mx-1 px-1">
            <button onclick="switchTab('car', 'all')" id="tabAll"
                class="tab-item px-2.5 py-1.5 text-xs font-bold rounded-lg bg-blue-600 text-white shadow ring-1 ring-blue-600 whitespace-nowrap flex items-center gap-1 transition-all">
                📋 ทั้งหมด
            </button>
            <button onclick="switchTab('car', 'stock')" id="tabStock"
                class="tab-item px-2.5 py-1.5 text-xs font-bold rounded-lg bg-green-100 text-green-800 border border-green-400 whitespace-nowrap flex items-center gap-1 transition-all">
                🚗 รถสต็อก
            </button>
            <button onclick="switchTab('part', 'all')" id="tabParts"
                class="tab-item px-2.5 py-1.5 text-xs font-bold rounded-lg bg-cyan-100 text-cyan-800 border border-cyan-400 whitespace-nowrap flex items-center gap-1 transition-all">
                🔧 อะไหล่
            </button>
            <button onclick="switchTab('expense', 'all')" id="tabExpenses"
                class="tab-item px-2.5 py-1.5 text-xs font-bold rounded-lg bg-orange-100 text-orange-800 border border-orange-400 whitespace-nowrap flex items-center gap-1 transition-all">
                💰 ทุนอื่นๆ
            </button>

            <!-- Link to Profit Page (Visible when Sold tab is active, handled by JS or just always visible as an option?) -->
            <!-- Let's put it next to the tabs or inside the content area. Putting it here might be crowded. -->
            <!-- User said "Click in -> Do accounting". Let's add a button that appears or is highlighted. -->
            <a href="{{ route('profit.details') }}" id="btnAccountCheck"
                class="hidden ml-auto px-4 py-2 text-sm font-bold text-white bg-purple-600 rounded-lg hover:bg-purple-700 shadow flex items-center gap-2">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                    stroke="currentColor" class="w-4 h-4">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z" />
                </svg>
                ไปหน้าบัญชี/สรุปกำไร
            </a>
        </div>

        <!-- Search -Premium -->
        <div class="mb-5 relative">
            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                <svg class="h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                    fill="currentColor">
                    <path fill-rule="evenodd"
                        d="M9 3.5a5.5 5.5 0 100 11 5.5 5.5 0 000-11zM2 9a7 7 0 1112.452 4.391l3.328 3.329a.75.75 0 11-1.06 1.06l-3.329-3.328A7 7 0 012 9z"
                        clip-rule="evenodd" />
                </svg>
            </div>
            <input type="text" placeholder="🔍 ค้นหารุ่น, ทะเบียน, หมายเหตุ..."
                class="w-full bg-white/90 backdrop-blur-sm border-2 border-gray-200 rounded-2xl pl-12 pr-4 py-3 text-sm focus:outline-none focus:ring-4 focus:ring-blue-100 focus:border-blue-400 transition-all duration-300 shadow-sm hover:shadow-md"
                id="searchInput" oninput="filterTable()">
        </div>

        <!-- Car List Table - Premium Design -->
        <div id="carSection">
            <div class="glass-card overflow-x-auto table-responsive">
                <table class="min-w-full" id="carTable">
                    <thead class="bg-gradient-to-r from-slate-100 to-gray-100">
                        <tr>
                            <th
                                class="px-4 py-4 text-center text-xs font-bold text-slate-700 uppercase tracking-wider whitespace-nowrap w-12">
                                ลำดับ</th>
                            <th
                                class="px-4 py-4 text-center text-xs font-bold text-slate-700 uppercase tracking-wider whitespace-nowrap w-16">
                                รูป</th>
                            <th
                                class="px-4 py-4 text-left text-xs font-bold text-slate-700 uppercase tracking-wider whitespace-nowrap">
                                รายละเอียดรายการ</th>
                            <th
                                class="px-4 py-4 text-center text-xs font-bold text-slate-700 uppercase tracking-wider whitespace-nowrap">
                                ทะเบียน / ประเภท</th>
                            <th
                                class="px-4 py-4 text-center text-xs font-bold text-slate-700 uppercase tracking-wider whitespace-nowrap">
                                ทุนซื้อ/จ่าย</th>
                            <th
                                class="px-4 py-4 text-center text-xs font-bold text-slate-700 uppercase tracking-wider whitespace-nowrap">
                                ปรับสภาพ</th>
                            <th
                                class="px-4 py-4 text-center text-xs font-bold text-slate-700 uppercase tracking-wider whitespace-nowrap">
                                ยอดรวม</th>
                            <th
                                class="px-4 py-4 text-center text-xs font-bold text-slate-700 uppercase tracking-wider whitespace-nowrap">
                                ราคาตั้งขาย</th>
                            <th
                                class="px-4 py-4 text-center text-xs font-bold text-emerald-600 uppercase tracking-wider whitespace-nowrap">
                                คาดการณ์กำไร</th>
                            <th
                                class="px-4 py-4 text-center text-xs font-bold text-slate-700 uppercase tracking-wider whitespace-nowrap">
                                สาขา</th>
                            <th
                                class="px-4 py-4 text-center text-xs font-bold text-slate-700 uppercase tracking-wider whitespace-nowrap">
                                จัดการ</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-50">
                        @forelse($cars as $index => $car)
                            @php
                                $refurbCost = $car->refurbishments->sum('amount');
                                $totalCost = $car->total_cost;
                                $expectedProfit = $car->status == 'sold'
                                    ? ($car->sold_price - $totalCost)
                                    : ($car->selling_price ? ($car->selling_price - $totalCost) : 0);
                                $displayPrice = $car->status == 'sold' ? $car->sold_price : $car->selling_price;
                                $firstImage = $car->images->first();
                            @endphp
                            <tr data-status="{{ $car->status }}"
                                data-is-profit-stock="{{ $car->is_profit_stock ? '1' : '0' }}"
                                class="table-row-premium hover:bg-blue-50/50 transition-all duration-200">

                                <!-- 1. Order -->
                                <td class="px-4 py-4 text-center text-slate-600 font-medium whitespace-nowrap"
                                    onclick="openEditModal({{ $car->id }})">
                                    {{ $index + 1 }}
                                </td>

                                <!-- 2. Image -->
                                <td class="px-2 py-3 text-center">
                                    @if($car->images->count() > 0)
                                        <div class="relative cursor-pointer"
                                            onclick="event.stopPropagation(); openGallery({{ $car->images->pluck('path')->map(fn($p) => '/img/' . $p)->toJson() }})">
                                            <img src="{{ '/img/' . $firstImage->path }}" alt="Car Image"
                                                class="w-16 h-16 object-cover rounded-xl shadow-sm hover:scale-110 transition-transform">
                                            @if($car->images->count() > 1)
                                                <span
                                                    class="absolute -top-1 -right-1 bg-blue-500 text-white text-[10px] font-bold px-1.5 py-0.5 rounded-full">{{ $car->images->count() }}</span>
                                            @endif
                                        </div>
                                    @else
                                        <div class="w-16 h-16 bg-gray-100 rounded-xl flex items-center justify-center text-gray-400 cursor-pointer"
                                            onclick="event.stopPropagation(); openEditModal({{ $car->id }})">
                                            <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                                    d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z">
                                                </path>
                                            </svg>
                                        </div>
                                    @endif
                                </td>

                                <!-- 3. Details -->
                                <td class="px-4 py-3 cursor-pointer" onclick="openEditModal({{ $car->id }})">
                                    <div class="flex items-center gap-1">
                                        <div class="text-sm font-bold text-slate-800">{{ $car->brand }} {{ $car->model }}
                                        </div>
                                        <button
                                            onclick="event.stopPropagation(); toggleRefurbForm({{ $car->id }}); openEditModal({{ $car->id }})"
                                            class="text-blue-500 hover:text-blue-700" title="เพิ่มค่าใช้จ่าย">
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"
                                                class="w-4 h-4">
                                                <path
                                                    d="M10.75 4.75a.75.75 0 00-1.5 0v4.5h-4.5a.75.75 0 000 1.5h4.5v4.5a.75.75 0 001.5 0v-4.5h4.5a.75.75 0 000-1.5h-4.5v-4.5z" />
                                            </svg>
                                        </button>
                                    </div>
                                    <div class="text-xs text-gray-500 mt-1 leading-relaxed">
                                        <span class="inline-flex items-center gap-1">
                                            <span class="w-2 h-2 rounded-full inline-block"
                                                style="background: {{ $car->color == 'ขาว' ? '#e5e7eb' : ($car->color == 'ดำ' ? '#374151' : ($car->color == 'เทา' ? '#9ca3af' : ($car->color == 'เงิน' ? '#d1d5db' : ($car->color == 'น้ำเงิน' ? '#3b82f6' : ($car->color == 'แดง' ? '#ef4444' : '#f59e0b'))))) }}; border: 1px solid #d1d5db;"></span>
                                            {{ $car->color }}
                                        </span>
                                        @if($car->transmission)
                                            · {{ $car->transmission == 'A' ? 'ออโต้' : 'เกียร์ธรรมดา' }}
                                        @endif
                                    </div>
                                    @if($car->license_plate)
                                        <div class="text-xs text-blue-500 font-medium mt-0.5">🔖 {{ $car->license_plate }}</div>
                                    @endif
                                    @if($car->notes)
                                        <div class="text-xs text-amber-600 font-medium mt-0.5">📝 {{ $car->notes }}</div>
                                    @endif
                                </td>

                                <!-- 3. License -->
                                <td class="px-4 py-4 text-center text-sm text-slate-600 cursor-pointer whitespace-nowrap"
                                    onclick="openEditModal({{ $car->id }})">
                                    {{ $car->license_plate ?: '-' }}
                                </td>

                                <!-- 4. Purchase Price -->
                                <td class="px-4 py-4 text-center text-sm font-medium text-slate-700 whitespace-nowrap">
                                    ฿{{ number_format($car->purchase_price, 0) }}
                                </td>

                                <!-- 5. Refurb Cost -->
                                <td class="px-4 py-4 text-center text-sm font-medium text-slate-700 whitespace-nowrap">
                                    ฿{{ number_format($refurbCost, 0) }}
                                </td>

                                <!-- 6. Total Cost -->
                                <td class="px-4 py-4 text-center text-sm font-bold text-slate-800 whitespace-nowrap">
                                    ฿{{ number_format($totalCost, 0) }}
                                </td>

                                <!-- 7. Selling Price -->
                                <td class="px-4 py-4 text-center text-sm font-bold text-blue-600 whitespace-nowrap">
                                    {{ $displayPrice ? '฿' . number_format($displayPrice, 0) : '-' }}
                                </td>

                                <!-- 8. Profit -->
                                <td class="px-4 py-4 text-center text-sm font-bold text-green-600 whitespace-nowrap">
                                    {{ $expectedProfit != 0 ? '฿' . number_format($expectedProfit, 0) : '-' }}
                                </td>

                                <!-- 9. Branch -->
                                <td class="px-2 py-4 text-center whitespace-nowrap cursor-pointer"
                                    onclick="openEditModal({{ $car->id }})">
                                    <div class="flex items-center justify-center gap-1 px-2 py-1 rounded-full text-xs font-medium hover:bg-gray-100 transition inline-flex"
                                        style="{{ $car->branch ? 'background-color: ' . $car->branch->color . '20; color: ' . $car->branch->color : '' }}">
                                        @if($car->branch)
                                            <span class="w-2 h-2 rounded-full"
                                                style="background-color: {{ $car->branch->color }}"></span>
                                            <span>{{ $car->branch->name }}</span>
                                        @else
                                            <span class="text-gray-400">+ สาขา</span>
                                        @endif
                                    </div>
                                </td>

                                <!-- 10. Management -->
                                <td class="px-4 py-4 text-center whitespace-nowrap">
                                    @if($car->status == 'stock')
                                        <div class="flex items-center justify-center gap-2">
                                            <button type="button"
                                                onclick="openSellModal({{ $car->id }}, {{ $car->total_cost }}, {{ $car->selling_price ?? 'null' }})"
                                                class="text-sm font-medium text-blue-500 hover:text-blue-700 hover:underline">
                                                ปิดขาย
                                            </button>
                                            <form action="{{ route('cars.destroy', $car) }}" method="POST"
                                                onclick="event.stopPropagation()"
                                                onsubmit="return confirm('ยืนยันการลบรถคันนี้? ข้อมูลจะถูกย้ายไปถังขยะ');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-gray-400 hover:text-red-500 p-1" title="ลบ">
                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                        stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                                                    </svg>
                                                </button>
                                            </form>
                                        </div>
                                    @else
                                        <div class="flex items-center justify-center gap-2">
                                            <span class="text-sm font-medium text-blue-400">ขายแล้ว</span>
                                            <form action="{{ route('cars.destroy', $car) }}" method="POST"
                                                onclick="event.stopPropagation()"
                                                onsubmit="return confirm('ยืนยันการลบรถคันนี้?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-gray-400 hover:text-red-500 p-1" title="ลบ">
                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                        stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                                                    </svg>
                                                </button>
                                            </form>
                                        </div>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="10" class="px-4 py-8 text-center text-gray-400">ยังไม่มีข้อมูลรถ กด "+
                                    รับรถเข้า" เพื่อเพิ่ม</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            {{-- Pagination Controls --}}
            <div id="carPagination"
                class="flex items-center justify-between px-4 py-3 bg-white border-t border-gray-100 rounded-b-2xl">
                <div class="text-sm text-gray-500">
                    แสดง <span id="pagShowFrom">0</span>-<span id="pagShowTo">0</span> จาก <span id="pagTotal">0</span>
                    รายการ
                </div>
                <div class="flex items-center gap-1" id="pagButtons"></div>
            </div>
        </div>

        <script>
                                            (fun                          ction() {
            const ITEMS_PER_PAGE = 10;
            let currentPage = 1;
            let isPaginating = false;

            function getAllDataRows() {
                const tbody = document.querySelector('#carTable tbody');
                if (!tbody) return [];
                return Array.from(tbody.querySelectorAll('tr[data-status]'));
            }

            function renderPagination() {
                isPaginating = true;
                const allRows = getAllDataRows();
                const visibleRows = allRows.filter(r => !r.classList.contains('search-hidden') && !r.classList.contains('filter-hidden'));
                const totalVisible = visibleRows.length;
                const totalPages = Math.ceil(totalVisible / ITEMS_PER_PAGE);
                if (currentPage > totalPages) currentPage = totalPages || 1;

                // Show/hide rows
                let visibleIndex = 0;
                allRows.forEach(row => {
                    if (row.classList.contains('search-hidden') || row.classList.contains('filter-hidden')) {
                        row.style.display = 'none';
                        return;
                    }
                    visibleIndex++;
                    const page = Math.ceil(visibleIndex / ITEMS_PER_PAGE);
                    row.style.display = (page === currentPage) ? '' : 'none';
                });

                // Update info
                const from = totalVisible > 0 ? ((currentPage - 1) * ITEMS_PER_PAGE) + 1 : 0;
                const to = Math.min(currentPage * ITEMS_PER_PAGE, totalVisible);
                document.getElementById('pagShowFrom').textContent = from;
                document.getElementById('pagShowTo').textContent = to;
                document.getElementById('pagTotal').textContent = totalVisible;

                // Render buttons
                const btnContainer = document.getElementById('pagButtons');
                btnContainer.innerHTML = '';

                if (totalPages <= 1) {
                    isPaginating = false;
                    return;
                }

                const btnClass = 'px-3 py-1.5 text-sm rounded-lg transition-all duration-200 font-medium';
                const activeClass = btnClass + ' bg-blue-500 text-white shadow-md';
                const normalClass = btnClass + ' bg-gray-100 text-gray-600 hover:bg-gray-200';

                // Prev
                const prev = document.createElement('button');
                prev.type = 'button';
                prev.innerHTML = '←';
                prev.className = currentPage === 1 ? btnClass + ' text-gray-300 cursor-not-allowed' : normalClass;
                prev.disabled = currentPage === 1;
                prev.onclick = (e) => { e.preventDefault(); if (currentPage > 1) { currentPage--; renderPagination(); } };
                btnContainer.appendChild(prev);

                // Page numbers
                for (let i = 1; i <= totalPages; i++) {
                    if (totalPages > 7 && i > 3 && i < totalPages - 1 && Math.abs(i - currentPage) > 1) {
                        if (i === 4 || i === totalPages - 2) {
                            const dots = document.createElement('span');
                            dots.textContent = '...';
                            dots.className = 'px-2 text-gray-400 text-sm';
                            btnContainer.appendChild(dots);
                        }
                        continue;
                    }
                    const btn = document.createElement('button');
                    btn.type = 'button';
                    btn.textContent = i;
                    btn.className = i === currentPage ? activeClass : normalClass;
                    btn.onclick = ((p) => (e) => { e.preventDefault(); currentPage = p; renderPagination(); })(i);
                    btnContainer.appendChild(btn);
                }

                // Next
                const next = document.createElement('button');
                next.type = 'button';
                next.innerHTML = '→';
                next.className = currentPage === totalPages ? btnClass + ' text-gray-300 cursor-not-allowed' : normalClass;
                next.disabled = currentPage === totalPages;
                next.onclick = (e) => { e.preventDefault(); if (currentPage < totalPages) { currentPage++; renderPagination(); } };
                btnContainer.appendChild(next);

                setTimeout(() => { isPaginating = false; }, 100);
            }

            // Expose globally for filter/search integration
            window.carPaginationRender = function() {
                currentPage = 1;
                renderPagination();
            };

            // Initial render
            document.addEventListener('DOMContentLoaded', () => {
                setTimeout(renderPagination, 200);
            });
        })();
        </script>
        <div id="partSection" class="hidden">
            <div class="bg-white shadow rounded-lg overflow-x-auto table-responsive">
                <table class="min-w-full divide-y divide-gray-200" id="partTable">
                    <thead class="bg-gray-50">
                        <tr>
                            <th
                                class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider w-12">
                                ลำดับ</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                ชื่อรายการ</th>
                            <th
                                class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                                ราคาต่อหน่วย</th>
                            <th
                                class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                                จำนวน</th>
                            <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">
                                มูลค่ารวม</th>
                            <th
                                class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                                จัดการ</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @forelse($parts as $index => $part)
                            <tr class="hover:bg-gray-50">
                                <td class="px-6 py-4 whitespace-nowrap text-center text-gray-500 text-sm">
                                    {{ $index + 1 }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="text-sm font-medium text-gray-900">{{ $part->name }}</span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-center">
                                    <span class="text-sm text-gray-500">฿{{ number_format($part->unit_price, 0) }}</span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-center">
                                    <span
                                        class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $part->quantity > 0 ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                        {{ number_format($part->quantity) }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-right">
                                    <span
                                        class="text-sm font-bold text-blue-600">฿{{ number_format($part->quantity * $part->unit_price, 0) }}</span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-center text-sm font-medium">
                                    <div class="flex items-center justify-center gap-2">
                                        <button onclick="usePart({{ $part }})"
                                            class="bg-blue-100 hover:bg-blue-200 text-blue-700 p-2 rounded-lg transition-colors group relative"
                                            title="นำไปใช้">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M11.42 15.17L17.25 21A2.652 2.652 0 0021 17.25l-5.877-5.877M11.42 15.17l2.496-3.03c.317-.384.74-.626 1.208-.766M11.42 15.17l-4.655 5.653a2.548 2.548 0 11-3.586-3.586l6.837-5.63m5.108-.233c.55-.164 1.163-.188 1.743-.14a4.5 4.5 0 004.486-6.336l-3.276 3.277a3.004 3.004 0 01-2.25-2.25l3.276-3.276a4.5 4.5 0 00-6.336 4.486c.091 1.076-.071 2.264-.904 2.95l-.102.085m-1.745 1.437L5.909 7.5H4.5L2.25 3.75l1.5-1.5L7.5 4.5v1.409l4.26 4.26m-1.745 1.437l1.745-1.437m6.615 8.206L15.75 15.75M4.867 19.125h.008v.008h-.008v-.008z" />
                                            </svg>
                                        </button>
                                        <button onclick="editPart({{ $part }})"
                                            class="bg-yellow-100 hover:bg-yellow-200 text-yellow-700 p-2 rounded-lg transition-colors"
                                            title="แก้ไข">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" />
                                            </svg>
                                        </button>
                                        <form action="{{ route('parts.destroy', $part) }}" method="POST"
                                            class="inline-block" onsubmit="return confirm('ยืนยันลบรายการนี้?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class="bg-red-100 hover:bg-red-200 text-red-700 p-2 rounded-lg transition-colors"
                                                title="ลบ">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                    stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                                                </svg>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="px-6 py-10 text-center text-gray-400">
                                    ยังไม่มีรายการอะไหล่ในสต็อก
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Expenses List Table (Hidden by default) -->
        <div id="expenseSection" class="hidden">
            <div class="bg-white shadow rounded-lg overflow-x-auto table-responsive">
                <table class="min-w-full divide-y divide-gray-200" id="expenseTable">
                    <thead class="bg-gradient-to-r from-slate-50 to-blue-50/50">
                        <tr>
                            <th
                                class="px-4 py-4 text-center text-xs font-bold text-slate-700 uppercase tracking-wider w-16">
                                ลำดับ</th>
                            <th class="px-4 py-4 text-left text-xs font-bold text-slate-700 uppercase tracking-wider">
                                วันที่</th>
                            <th class="px-4 py-4 text-left text-xs font-bold text-slate-700 uppercase tracking-wider">
                                รายการ</th>
                            <th class="px-4 py-4 text-right text-xs font-bold text-slate-700 uppercase tracking-wider">
                                จำนวนเงิน</th>
                            <th class="px-4 py-4 text-right text-xs font-bold text-slate-700 uppercase tracking-wider">
                                รับคืนแล้ว</th>
                            <th class="px-4 py-4 text-right text-xs font-bold text-slate-700 uppercase tracking-wider">
                                คงเหลือ</th>
                            <th class="px-4 py-4 text-center text-xs font-bold text-slate-700 uppercase tracking-wider">
                                จัดการ</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @php
                            $increaseExpenses = $capitalExpenses->where('transaction_type', 'increase');
                        @endphp
                        @forelse($increaseExpenses as $index => $expense)
                            @php
                                $isSold = ($expense->status ?? 'active') === 'sold';
                                $decreasesSum = $capitalExpenses->where('parent_id', $expense->id)->sum('amount');
                                $remaining = $expense->amount - $decreasesSum;
                            @endphp
                            <tr class="hover:bg-blue-50/30 transition {{ $isSold ? 'bg-gray-50 opacity-60' : '' }}">
                                <td class="px-4 py-4 whitespace-nowrap text-center text-gray-500 text-sm">
                                    {{ $index + 1 }}
                                </td>
                                <td class="px-4 py-4 whitespace-nowrap text-sm text-gray-700">
                                    {{ \Carbon\Carbon::parse($expense->date)->addYears(543)->format('d/m/Y') }}
                                </td>
                                <td class="px-4 py-4">
                                    <div class="text-sm font-bold text-gray-800">{{ $expense->name }}</div>
                                    @if($expense->description)
                                        <div class="text-xs text-gray-500">{{ Str::limit($expense->description, 50) }}</div>
                                    @endif
                                    @if($isSold)
                                        <span
                                            class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium bg-purple-100 text-purple-700 mt-1">
                                            ปิดขายแล้ว @if($expense->sold_price) | ขาย
                                            ฿{{ number_format($expense->sold_price, 0) }} @endif
                                        </span>
                                    @endif
                                </td>
                                <td class="px-4 py-4 whitespace-nowrap text-right">
                                    <span
                                        class="text-sm font-bold text-orange-600">฿{{ number_format($expense->amount, 0) }}</span>
                                </td>
                                <td class="px-4 py-4 whitespace-nowrap text-right">
                                    @if($decreasesSum > 0)
                                        <span
                                            class="text-sm font-bold text-emerald-600">฿{{ number_format($decreasesSum, 0) }}</span>
                                    @else
                                        <span class="text-sm text-gray-400">-</span>
                                    @endif
                                </td>
                                <td class="px-4 py-4 whitespace-nowrap text-right">
                                    @if($isSold)
                                        <span class="text-sm text-gray-400">-</span>
                                    @else
                                        <span
                                            class="text-sm font-bold {{ $remaining > 0 ? 'text-blue-600' : 'text-emerald-600' }}">
                                            ฿{{ number_format($remaining, 0) }}
                                        </span>
                                    @endif
                                </td>
                                <td class="px-4 py-4 whitespace-nowrap text-center text-sm font-medium">
                                    <div class="flex items-center justify-center gap-1 flex-wrap">
                                        @if(!$isSold)
                                            <button
                                                onclick="openCapitalTransactionModal({{ $expense->id }}, '{{ addslashes($expense->name) }}', {{ $expense->amount }}, {{ $decreasesSum }}, {{ $remaining }})"
                                                class="bg-blue-500 hover:bg-blue-600 text-white px-2 py-1 rounded text-xs font-medium">
                                                เพิ่ม/ลดทุน
                                            </button>
                                            <button
                                                onclick="openExpenseSellModal({{ $expense->id }}, '{{ addslashes($expense->name) }}', {{ $remaining }})"
                                                class="bg-purple-500 hover:bg-purple-600 text-white px-2 py-1 rounded text-xs font-medium">
                                                ปิดขาย
                                            </button>
                                        @endif
                                        <button
                                            onclick="editExpense({{ $expense->id }}, '{{ addslashes($expense->name) }}', '{{ $expense->date->format('Y-m-d') }}', {{ $expense->amount }}, '{{ addslashes(str_replace(["\r\n", "\r", "\n"], ' ', $expense->description ?? '')) }}', 'increase', '{{ $expense->image ?? '' }}')"
                                                class="bg-amber-500 hover:bg-amber-600 text-white px-2 py-1 rounded text-xs font-medium">
                                                แก้ไข
                                            </button>
                                            <form action="{{ route('capital-expenses.destroy', $expense->id) }}" method="POST"
                                                class="inline-block" onsubmit="return confirm('ยืนยันลบรายการนี้?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                    class="bg-red-500 hover:bg-red-600 text-white px-2 py-1 rounded text-xs font-medium">
                                                    ลบ
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="px-6 py-10 text-center text-gray-400">
                                    ยังไม่มีรายการทุนอื่นๆ
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                    <tfoot class="bg-gradient-to-r from-slate-100 to-blue-50 font-bold">
                        <tr>
                            <td colspan="5" class="px-4 py-3 text-right text-gray-600">รวมคงเหลือ</td>
                            <td class="px-4 py-3 text-right text-blue-600 text-lg">
                                ฿{{ number_format($capitalExpensesActiveTotal, 0) }}</td>
                            <td></td>
                        </tr>
                    </tfoot>
                </table>
            </div>

            <!-- Sold Capital Expenses Section -->
            @php
                $soldExpenses = $capitalExpenses->where('status', 'sold')->where('transaction_type', 'increase');
            @endphp
            @if($soldExpenses->count() > 0)
                <div class="mt-6 bg-white shadow rounded-lg overflow-x-auto table-responsive">
                    <div class="bg-gradient-to-r from-purple-50 to-indigo-50 px-4 py-3 border-b">
                        <h3 class="text-sm font-bold text-purple-800 flex items-center gap-2">
                            <span>💰</span> รายการทุนอื่นๆที่ขายแล้ว ({{ $soldExpenses->count() }} รายการ)
                        </h3>
                    </div>
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-purple-50/50">
                            <tr>
                                <th
                                    class="px-4 py-3 text-center text-xs font-bold text-slate-700 uppercase tracking-wider w-12">
                                    #</th>
                                <th class="px-4 py-3 text-left text-xs font-bold text-slate-700 uppercase tracking-wider">
                                    วันที่ขาย</th>
                                <th class="px-4 py-3 text-left text-xs font-bold text-slate-700 uppercase tracking-wider">
                                    รายการ</th>
                                <th class="px-4 py-3 text-right text-xs font-bold text-slate-700 uppercase tracking-wider">
                                    ทุน</th>
                                <th class="px-4 py-3 text-right text-xs font-bold text-slate-700 uppercase tracking-wider">
                                    ราคาขาย</th>
                                <th
                                    class="px-4 py-3 text-right text-xs font-bold text-emerald-600 uppercase tracking-wider">
                                    กำไร/ขาดทุน</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach($soldExpenses as $index => $expense)
                                @php
                                    $decreasesSum = $capitalExpenses->where('parent_id', $expense->id)->sum('amount');
                                    $remainingCost = $expense->amount - $decreasesSum;
                                    $profit = ($expense->sold_price ?? 0) - $remainingCost;
                                @endphp
                                <tr class="hover:bg-purple-50/30">
                                    <td class="px-4 py-3 whitespace-nowrap text-center text-gray-500 text-sm">
                                        {{ $index + 1 }}
                                    </td>
                                    <td class="px-4 py-3 whitespace-nowrap text-sm text-gray-700">
                                        {{ $expense->sold_date ? \Carbon\Carbon::parse($expense->sold_date)->addYears(543)->format('d/m/Y') : '-' }}
                                    </td>
                                    <td class="px-4 py-3">
                                        <div class="text-sm font-medium text-gray-900">{{ $expense->name }}</div>
                                        @if($expense->description)
                                            <div class="text-xs text-gray-500">{{ Str::limit($expense->description, 40) }}</div>
                                        @endif
                                    </td>
                                    <td class="px-4 py-3 whitespace-nowrap text-right">
                                        <span class="text-sm text-gray-600">฿{{ number_format($remainingCost, 0) }}</span>
                                    </td>
                                    <td class="px-4 py-3 whitespace-nowrap text-right">
                                        <span
                                            class="text-sm font-bold text-purple-600">฿{{ number_format($expense->sold_price ?? 0, 0) }}</span>
                                    </td>
                                    <td class="px-4 py-3 whitespace-nowrap text-right">
                                        <span
                                            class="text-sm font-bold {{ $profit >= 0 ? 'text-emerald-600' : 'text-red-600' }}">
                                            {{ $profit >= 0 ? '+' : '' }}฿{{ number_format($profit, 0) }}
                                        </span>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                        <tfoot class="bg-purple-50 font-bold">
                            <tr>
                                <td colspan="5" class="px-4 py-3 text-right text-gray-600">รวมกำไรจากทุนอื่นๆ</td>
                                <td class="px-4 py-3 text-right">
                                    @php
                                        $totalSoldProfit = 0;
                                        foreach ($soldExpenses as $exp) {
                                            $dec = $capitalExpenses->where('parent_id', $exp->id)->sum('amount');
                                            $rem = $exp->amount - $dec;
                                            $totalSoldProfit += (($exp->sold_price ?? 0) - $rem);
                                        }
                                    @endphp
                                    <span class="{{ $totalSoldProfit >= 0 ? 'text-emerald-600' : 'text-red-600' }}">
                                        {{ $totalSoldProfit >= 0 ? '+' : '' }}฿{{ number_format($totalSoldProfit, 0) }}
                                    </span>
                                </td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            @endif
        </div>

        <!-- Personal Transactions Section (Hidden by default) -->
        <div id="personalSection" class="hidden">
            <div class="space-y-4">
                @php
                    // Group transactions by Date
                    $groupedTransactions = $personalTransactions->groupBy(function ($item) {
                        return \Carbon\Carbon::parse($item->date)->format('Y-m-d');
                    });
                @endphp

                @forelse($groupedTransactions as $date => $transactions)
                    @php
                        $dayIncome = $transactions->where('type', 'income')->sum('amount');
                        $dayExpense = $transactions->where('type', 'expense')->sum('amount');
                        $dayNet = $dayIncome - $dayExpense;
                    @endphp
                    <div class="bg-white shadow rounded-lg overflow-hidden">
                        <!-- Daily Header -->
                        <div class="bg-gray-50 px-6 py-3 border-b flex justify-between items-center cursor-pointer hover:bg-gray-100 transition-colors"
                            onclick="toggleDailyGroup('{{ $date }}')">
                            <div class="flex items-center gap-2">
                                <span class="bg-gray-200 rounded-full p-1 text-gray-600 transition-transform duration-200"
                                    id="icon-{{ $date }}">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                                        stroke="currentColor" class="w-4 h-4">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                                    </svg>
                                </span>
                                <span class="text-sm font-bold text-gray-700">
                                    {{ \Carbon\Carbon::parse($date)->addYears(543)->translatedFormat('d F Y') }}
                                </span>
                                <span class="text-xs text-gray-500">({{ $transactions->count() }} รายการ)</span>
                            </div>
                            <div class="flex items-center gap-4 text-sm">
                                <span class="text-emerald-600 hidden md:inline">รับ:
                                    +฿{{ number_format($dayIncome, 0) }}</span>
                                <span class="text-red-500 hidden md:inline">จ่าย:
                                    -฿{{ number_format($dayExpense, 0) }}</span>
                                <span class="font-bold {{ $dayNet >= 0 ? 'text-emerald-600' : 'text-red-600' }}">
                                    สุทธิ: ฿{{ number_format($dayNet, 0) }}
                                </span>
                            </div>
                        </div>

                        <!-- Transactions List -->
                        <div id="daily-{{ $date }}" class="hidden">
                            <table class="min-w-full divide-y divide-gray-100">
                                <tbody class="divide-y divide-gray-100">
                                    @foreach($transactions as $transaction)
                                        <tr class="hover:bg-gray-50">
                                            <td class="px-6 py-3 whitespace-nowrap text-center">
                                                @if($transaction->type == 'income')
                                                    <span
                                                        class="inline-block px-2 py-1 bg-emerald-100 text-emerald-700 text-xs font-bold rounded-lg border border-emerald-200">รายรับ</span>
                                                @else
                                                    <span
                                                        class="inline-block px-2 py-1 bg-red-100 text-red-700 text-xs font-bold rounded-lg border border-red-200">รายจ่าย</span>
                                                @endif
                                            </td>
                                            <td class="px-6 py-3 whitespace-nowrap">
                                                <p class="text-sm font-medium text-gray-900">{{ $transaction->name }}</p>
                                            </td>
                                            <td class="px-6 py-3 whitespace-nowrap text-right">
                                                <span
                                                    class="text-sm font-bold {{ $transaction->type == 'income' ? 'text-emerald-600' : 'text-red-600' }}">
                                                    {{ $transaction->type == 'income' ? '+' : '-' }}฿{{ number_format($transaction->amount, 0) }}
                                                </span>
                                            </td>
                                            <td class="px-6 py-3 whitespace-nowrap text-center w-20">
                                                <form action="{{ route('personal-transactions.destroy', $transaction->id) }}"
                                                    method="POST" onsubmit="return confirm('ยืนยันการลบรายการนี้?');">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit"
                                                        class="text-gray-400 hover:text-red-500 transition-colors">
                                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                            stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                                                        </svg>
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                @empty
                    <div class="bg-white rounded-lg shadow p-8 text-center">
                        <div
                            class="w-16 h-16 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4 text-gray-400">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor" class="w-8 h-8">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z" />
                            </svg>
                        </div>
                        <h3 class="text-lg font-medium text-gray-900">ยังไม่มีรายการบันทึก</h3>
                        <p class="text-gray-500 mt-1">กดปุ่ม "+ เพิ่มรายการ" เพื่อเริ่มบันทึกรายรับ-รายจ่าย</p>
                    </div>
                @endforelse
            </div>
        </div>

        <!-- Sell Car Modal -->
        <div id="sellCarModal"
            class="fixed inset-0 bg-black bg-opacity-50 hidden z-50 flex items-center justify-center">
            <div class="bg-white rounded-lg w-full max-w-md p-6">
                <h3 class="text-xl font-bold mb-4">ปิดการขาย</h3>
                <form id="sellCarForm" action="" method="POST">
                    @csrf
                    <input type="hidden" name="sold_price" id="finalSoldPrice">

                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2">ต้นทุนรวม (ซื้อ + ปรับสภาพ)</label>
                        <input type="text" id="displayTotalCost" readonly
                            class="w-full bg-gray-100 border rounded px-3 py-2 text-gray-600">
                    </div>

                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2">ราคาขายจริง</label>
                        <input type="number" id="inputSoldPrice"
                            class="w-full border rounded px-3 py-2 focus:ring-2 focus:ring-blue-500"
                            placeholder="ระบุราคาขาย">
                    </div>

                    <div class="mb-6">
                        <label class="block text-gray-700 text-sm font-bold mb-2">กำไรโดยประมาณ</label>
                        <div id="displayProfit" class="text-2xl font-bold text-green-600">฿0</div>
                    </div>

                    <div class="flex justify-end gap-2">
                        <button type="button" onclick="document.getElementById('sellCarModal').classList.add('hidden')"
                            class="px-4 py-2 bg-gray-200 text-gray-800 rounded hover:bg-gray-300">ยกเลิก</button>
                        <button type="button" onclick="submitSellForm()"
                            class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">ยืนยันปิดการขาย</button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Add Part Modal -->
        <div id="addPartModal"
            class="fixed inset-0 bg-gray-800 bg-opacity-75 overflow-y-auto h-full w-full hidden z-50 flex items-start justify-center pt-10">
            <div class="bg-white rounded-lg shadow-xl w-full max-w-sm mx-4">
                <div class="p-4 border-b flex justify-between items-center">
                    <h3 class="text-lg font-bold">เพิ่มอะไหล่ใหม่</h3>
                    <button onclick="document.getElementById('addPartModal').classList.add('hidden')"
                        class="text-gray-400 hover:text-gray-600">&times;</button>
                </div>
                <form action="{{ route('parts.store') }}" method="POST" class="p-4 space-y-4">
                    @csrf
                    <div>
                        <label class="block text-xs font-medium text-gray-700 mb-1">ชื่ออะไหล่</label>
                        <input type="text" name="name"
                            class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm"
                            placeholder="เช่น ยาง Dunlop, ล้อแม็ก" required>
                    </div>
                    <div class="grid grid-cols-2 gap-3">
                        <div>
                            <label class="block text-xs font-medium text-gray-700 mb-1">ราคาต่อหน่วย</label>
                            <input type="number" name="unit_price"
                                class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm" placeholder="0"
                                required>
                        </div>
                        <div>
                            <label class="block text-xs font-medium text-gray-700 mb-1">จำนวนตั้งต้น</label>
                            <input type="number" name="quantity"
                                class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm" placeholder="1"
                                required>
                        </div>
                    </div>
                    <div class="flex gap-3 pt-2">
                        <button type="button" onclick="document.getElementById('addPartModal').classList.add('hidden')"
                            class="flex-1 bg-gray-200 hover:bg-gray-300 text-gray-800 font-medium py-2.5 rounded-lg">ยกเลิก</button>
                        <button type="submit"
                            class="flex-1 bg-blue-500 hover:bg-blue-600 text-white font-medium py-2.5 rounded-lg">บันทึก</button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Add Expense Modal -->
        <div id="addExpenseModal"
            class="fixed inset-0 bg-gray-800 bg-opacity-75 overflow-y-auto h-full w-full hidden z-50 flex items-start justify-center pt-10">
            <div class="bg-white rounded-lg shadow-xl w-full max-w-sm mx-4">
                <div class="p-4 border-b flex justify-between items-center bg-orange-50">
                    <h3 class="text-lg font-bold text-orange-800">บันทึกรายจ่ายทุนอื่นๆ</h3>
                    <button onclick="document.getElementById('addExpenseModal').classList.add('hidden')"
                        class="text-gray-400 hover:text-gray-600">&times;</button>
                </div>
                <form action="{{ route('capital-expenses.store') }}" method="POST" enctype="multipart/form-data"
                    class="p-4 space-y-4">
                    @csrf
                    <div>
                        <label class="block text-xs font-medium text-gray-700 mb-1">ชื่อรายการ</label>
                        <input type="text" name="name"
                            class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm"
                            placeholder="เช่น ซื้อที่ดิน, รับจำนำ" required>
                    </div>
                    <div>
                        <label class="block text-xs font-medium text-gray-700 mb-1">วันที่</label>
                        <input type="date" name="date"
                            class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm"
                            value="{{ date('Y-m-d') }}" required>
                    </div>

                    <!-- Transaction Type Toggle (Feature 7) -->
                    <div>
                        <label class="block text-xs font-medium text-gray-700 mb-2">ประเภทรายการ</label>
                        <div class="flex gap-2" id="transactionTypeToggle">
                            <input type="hidden" name="transaction_type" id="transactionTypeInput" value="increase">
                            <button type="button" id="btnIncrease" onclick="selectTransactionType('increase')"
                                class="flex-1 text-center py-2.5 px-4 rounded-lg border-2 cursor-pointer transition-all font-medium text-sm bg-emerald-500 text-white border-emerald-500 shadow-md">
                                <span class="text-base">📈</span> เพิ่มทุน
                            </button>
                            <button type="button" id="btnDecrease" onclick="selectTransactionType('decrease')"
                                class="flex-1 text-center py-2.5 px-4 rounded-lg border-2 cursor-pointer transition-all font-medium text-sm bg-gray-100 text-gray-600 border-gray-200 hover:border-red-300">
                                <span class="text-base">📉</span> ลดทุน (รับงวด)
                            </button>
                        </div>
                    </div>
                    <div class="border-t pt-4 pb-2">
                        <div class="flex justify-between items-center mb-2">
                            <label class="text-xs font-medium text-gray-700">รายการย่อย (เพื่อคำนวณยอดรวม)</label>
                            <button type="button" onclick="toggleExpenseSubItemForm()"
                                class="text-blue-500 text-xs font-medium hover:underline">+ เพิ่มรายการ</button>
                        </div>

                        <!-- Inline Form (Hidden by default) -->
                        <div id="expenseSubItemForm" class="hidden bg-blue-50 p-3 rounded-lg mb-3">
                            <div class="grid grid-cols-3 gap-2 mb-2">
                                <input type="text" id="subItemName"
                                    class="col-span-2 border border-blue-200 rounded px-3 py-2 text-sm focus:ring-blue-500 focus:border-blue-500"
                                    placeholder="รายการ เช่น ค่าโอน">
                                <input type="number" id="subItemAmount"
                                    class="border border-blue-200 rounded px-3 py-2 text-sm focus:ring-blue-500 focus:border-blue-500"
                                    placeholder="จำนวนเงิน">
                            </div>
                            <div class="flex gap-2">
                                <button type="button" onclick="toggleExpenseSubItemForm()"
                                    class="flex-1 bg-gray-200 hover:bg-gray-300 text-gray-700 text-sm py-2 rounded transition-colors">ยกเลิก</button>
                                <button type="button" onclick="addExpenseSubItem()"
                                    class="flex-1 bg-blue-500 hover:bg-blue-600 text-white text-sm py-2 rounded transition-colors shadow-sm">เพิ่ม</button>
                            </div>
                        </div>

                        <!-- List of items -->
                        <div id="subItemsList" class="space-y-1 mb-3 hidden">
                            <!-- Items will be added here via JS -->
                        </div>
                    </div>

                    <div>
                        <label class="block text-xs font-medium text-gray-700 mb-1">จำนวนเงินรวม (บาท)</label>
                        <input type="number" name="amount" id="expenseTotalAmount"
                            class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm bg-gray-50 mb-1"
                            placeholder="0" readonly>
                        <p class="text-xs text-gray-400">* คำนวณจากรายการย่อย</p>
                    </div>
                    <div>
                        <label class="block text-xs font-medium text-gray-700 mb-1">รายละเอียดเพิ่มเติม</label>
                        <textarea name="description" id="expenseDescription"
                            class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm" rows="3"></textarea>
                    </div>
                    <!-- Image Upload for Expense -->
                    <div>
                        <label class="block text-xs font-medium text-gray-700 mb-1">📷 รูปภาพ (ไม่บังคับ)</label>
                        <input type="file" name="image" accept="image/*"
                            onchange="previewSingleImage(this, 'expenseImagePreview')"
                            class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm file:mr-3 file:py-1 file:px-3 file:rounded file:border-0 file:text-sm file:bg-orange-50 file:text-orange-700 hover:file:bg-orange-100">
                        <div id="expenseImagePreview" class="mt-2"></div>
                    </div>

                    <div class="flex gap-3 pt-2">
                        <button type="button" onclick="resetExpenseModal()"
                            class="flex-1 bg-gray-200 hover:bg-gray-300 text-gray-800 font-medium py-2.5 rounded-lg">ยกเลิก</button>
                        <button type="submit"
                            class="flex-1 bg-orange-500 hover:bg-orange-600 text-white font-medium py-2.5 rounded-lg">บันทึก</button>
                    </div>
                </form>

                <script>
                    let expenseSubItems = [];

                    function toggleExpenseSubItemForm() {
                        const form = document.getElementById('expenseSubItemForm');
                        form.classList.toggle('hidden');
                        if (!form.classList.contains('hidden')) {
                            document.getElementById('subItemName').focus();
                        } else {
                            // Clear inputs when closed
                            document.getElementById('subItemName').value = '';
                            document.getElementById('subItemAmount').value = '';
                        }
                    }

                    function addExpenseSubItem() {
                        const nameInput = document.getElementById('subItemName');
                        const amountInput = document.getElementById('subItemAmount');
                        const name = nameInput.value.trim();
                        const amount = parseFloat(amountInput.value);

                        if (!name || isNaN(amount)) {
                            alert('กรุณากรอกชื่อรายการและจำนวนเงินให้ถูกต้อง');
                            return;
                        }

                        expenseSubItems.push({ name, amount });

                        // Clear inputs and close form (optional, keeping open for multiple adds might be better but user screenshot implies simple add)
                        // Let's keep it open to allow adding multiple quickly, or close?
                        // "Refurbishment" usually allows adding multiple.
                        // I'll clear fields and focus name for next entry
                        nameInput.value = '';
                        amountInput.value = '';
                        nameInput.focus();

                        updateExpenseUI();
                    }

                    function removeExpenseSubItem(index) {
                        expenseSubItems.splice(index, 1);
                        updateExpenseUI();
                    }

                    function updateExpenseUI() {
                        const listEl = document.getElementById('subItemsList');
                        const totalEl = document.getElementById('expenseTotalAmount');
                        const descEl = document.getElementById('expenseDescription');

                        // Update List
                        listEl.innerHTML = '';
                        let total = 0;
                        let descText = "";

                        if (expenseSubItems.length > 0) {
                            listEl.classList.remove('hidden');
                            expenseSubItems.forEach((item, index) => {
                                total += item.amount;
                                descText += `${index + 1}. ${item.name}: ${item.amount.toLocaleString()} บาท\n`;

                                const row = document.createElement('div');
                                row.className = 'flex justify-between items-center bg-gray-50 px-3 py-2 rounded border border-gray-100 text-xs';
                                row.innerHTML = `
                                    <span class="font-medium text-gray-700">${item.name}</span>
                                    <div class="flex items-center gap-3">
                                        <span class="text-orange-600 font-bold">฿${item.amount.toLocaleString()}</span>
                                        <button type="button" onclick="removeExpenseSubItem(${index})" class="text-gray-400 hover:text-red-500 transition-colors">
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-4 h-4">
                                                <path fill-rule="evenodd" d="M8.75 1A2.75 2.75 0 006 3.75v.443c-.795.077-1.584.176-2.365.298a.75.75 0 10.23 1.482l.149-.022.841 10.518A2.75 2.75 0 007.596 19h4.807a2.75 2.75 0 002.742-2.53l.841-10.52.149.023a.75.75 0 00.23-1.482A41.03 41.03 0 0014 4.193V3.75A2.75 2.75 0 0011.25 1h-2.5zM10 4c.84 0 1.673.025 2.5.075V3.75c0-.69-.56-1.25-1.25-1.25h-2.5c-.69 0-1.25.56-1.25 1.25v.325C8.327 4.025 9.16 4 10 4zM8.58 7.72a.75.75 0 00-1.5.06l.3 7.5a.75.75 0 101.5-.06l-.3-7.5zm4.34.06a.75.75 0 10-1.5-.06l-.3 7.5a.75.75 0 101.5.06l.3-7.5z" clip-rule="evenodd" />
                                            </svg>
                                        </button>
                                    </div>
                                `;
                                listEl.appendChild(row);
                            });
                        } else {
                            listEl.classList.add('hidden');
                        }

                        // Update Total
                        totalEl.value = total;

                        if (descText) {
                            descEl.value = "รายละเอียดรายการ:\n" + descText;
                        } else {
                            descEl.value = "";
                        }
                    }

                    // --- Edit Expense Sub-items Logic ---
                    let editExpenseSubItems = [];

                    window.toggleEditExpenseSubItemForm = function () {
                        const form = document.getElementById('editExpenseSubItemForm');
                        form.classList.toggle('hidden');
                        if (!form.classList.contains('hidden')) {
                            document.getElementById('editSubItemName').focus();
                        }
                    }

                    function addEditExpenseSubItem() {
                        const nameInput = document.getElementById('editSubItemName');
                        const amountInput = document.getElementById('editSubItemAmount');
                        const totalEl = document.getElementById('editExpenseAmount');
                        const descEl = document.getElementById('editExpenseDescription');

                        const name = nameInput.value.trim();
                        const amount = parseFloat(amountInput.value);

                        if (!name || isNaN(amount)) {
                            alert('กรุณากรอกชื่อรายการและจำนวนเงินให้ถูกต้อง');
                            return;
                        }

                        // Add to list
                        editExpenseSubItems.push({ name, amount });

                        // Clear inputs
                        nameInput.value = '';
                        amountInput.value = '';
                        nameInput.focus();

                        updateEditExpenseUI();
                    }

                    function removeEditExpenseSubItem(index) {
                        editExpenseSubItems.splice(index, 1);
                        updateEditExpenseUI();
                    }

                    function updateEditExpenseUI() {
                        const listEl = document.getElementById('editSubItemsList');
                        const totalEl = document.getElementById('editExpenseAmount');
                        const descEl = document.getElementById('editExpenseDescription');

                        // 1. Calculate current total from input (base) + new items?
                        // Issue: In edit mode, we might want to just APPEND to description and ADD to total.
                        // But if user edits total manually? 
                        // Let's assume: Base total is whatever is currently in the input (user can edit it).
                        // Adding a sub-item ADDS to that value.
                        // Wait, in "Add Mode", total is READONLY if items exist.
                        // In "Edit Mode", we are essentially "adding more" to existing.
                        // Let's make it simple: We just append text to description and add logic to calculate total IS TRICKY if we don't track previous items.
                        // EASIER APPROACH for Edit:
                        // Just act as a calculator helper. 
                        // When adding an item:
                        // 1. Add amount to the total input value.
                        // 2. Append text to description.
                        // 3. Show item in a temporary list (so user sees what they added just now).

                        // BUT, if we want same "Re-calculate" logic, we need to know ALL items. We don't have them in JS variable from DB.
                        // So, let's implement the "Calculator Helper" approach requested: "Allows adding sub-items" implying "Adding MORE".

                        // RE-READ REQUIREMENT: "In edit expense... add sub-items... deleting added data".
                        // User wants to manage it like a list. But we don't store it as a list in DB, only as text.
                        // So we can't fully "Manage" old items unless we parse the text.
                        // COMPROMISE: We only manage NEWLY ADDED items in this session. 
                        // If user wants to delete old items, they edit the description/amount manually.
                        // The new items will be appended.

                        // Actually, let's make it cleaner:
                        // When adding a sub-item in Edit Mode:
                        // 1. Update the Total Input (current value + new amount).
                        // 2. Append to Description Input (current value + new line).
                        // 3. Render the item in the list for visualization (allow removing it which reverses the effect).

                    }

                    // Updated Add Function for Edit Mode to reflect "Live Update" approach
                    window.addEditExpenseSubItem = function () {
                        const nameInput = document.getElementById('editSubItemName');
                        const amountInput = document.getElementById('editSubItemAmount');
                        const totalEl = document.getElementById('editExpenseAmount');
                        const descEl = document.getElementById('editExpenseDescription');

                        const name = nameInput.value.trim();
                        const amount = parseFloat(amountInput.value);

                        if (!name || isNaN(amount)) return;

                        // Update Total
                        let currentTotal = parseFloat(totalEl.value) || 0;
                        totalEl.value = currentTotal + amount;

                        // Update Description
                        let currentDesc = descEl.value;
                        let newItemText = `${name}: ${amount.toLocaleString()} บาท`;
                        if (currentDesc) {
                            descEl.value = currentDesc + "\n" + newItemText;
                        } else {
                            descEl.value = "รายละเอียดรายการ:\n" + newItemText;
                        }

                        // Add to visual list (for undo purposes)
                        editExpenseSubItems.push({ name, amount });
                        renderEditSubItems();

                        nameInput.value = '';
                        amountInput.value = '';
                        nameInput.focus();
                    }

                    window.removeEditExpenseSubItem = function (index) {
                        const item = editExpenseSubItems[index];
                        const totalEl = document.getElementById('editExpenseAmount');
                        const descEl = document.getElementById('editExpenseDescription');

                        // Revert Total
                        let currentTotal = parseFloat(totalEl.value) || 0;
                        totalEl.value = currentTotal - item.amount;

                        // Revert Description (Try to find and remove string)
                        let currentDesc = descEl.value;
                        let itemString = `${item.name}: ${item.amount.toLocaleString()} บาท`;

                        // Simple replace (might be risky if duplicate text, but best effort)
                        if (currentDesc.includes(itemString)) {
                            // Try to remove with newline
                            descEl.value = currentDesc.replace('\n' + itemString, '').replace(itemString + '\n', '').replace(itemString, '');
                        }

                        editExpenseSubItems.splice(index, 1);
                        renderEditSubItems();
                    }

                    window.renderEditSubItems = function () {
                        const listEl = document.getElementById('editSubItemsList');
                        listEl.innerHTML = '';

                        if (editExpenseSubItems.length > 0) {
                            listEl.classList.remove('hidden');
                            editExpenseSubItems.forEach((item, index) => {
                                const row = document.createElement('div');
                                row.className = 'flex justify-between items-center bg-yellow-50 px-3 py-2 rounded border border-yellow-100 text-xs';
                                row.innerHTML = `
                                    <span class="font-medium text-gray-700">${item.name}</span>
                                    <div class="flex items-center gap-3">
                                        <span class="text-orange-600 font-bold">+฿${item.amount.toLocaleString()}</span>
                                        <button type="button" onclick="removeEditExpenseSubItem(${index})" class="text-gray-400 hover:text-red-500 transition-colors">
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-4 h-4">
                                                <path fill-rule="evenodd" d="M8.75 1A2.75 2.75 0 006 3.75v.443c-.795.077-1.584.176-2.365.298a.75.75 0 10.23 1.482l.149-.022.841 10.518A2.75 2.75 0 007.596 19h4.807a2.75 2.75 0 002.742-2.53l.841-10.52.149.023a.75.75 0 00.23-1.482A41.03 41.03 0 0014 4.193V3.75A2.75 2.75 0 0011.25 1h-2.5zM10 4c.84 0 1.673.025 2.5.075V3.75c0-.69-.56-1.25-1.25-1.25h-2.5c-.69 0-1.25.56-1.25 1.25v.325C8.327 4.025 9.16 4 10 4zM8.58 7.72a.75.75 0 00-1.5.06l.3 7.5a.75.75 0 101.5-.06l-.3-7.5zm4.34.06a.75.75 0 10-1.5-.06l-.3 7.5a.75.75 0 101.5.06l.3-7.5z" clip-rule="evenodd" />
                                            </svg>
                                        </button>
                                    </div>
                                `;
                                listEl.appendChild(row);
                            });
                        } else {
                            listEl.classList.add('hidden');
                        }
                    }

                    function resetExpenseModal() {
                        document.getElementById('addExpenseModal').classList.add('hidden');
                        // Reset items
                        expenseSubItems = [];
                        updateExpenseUI();
                        document.getElementById('subItemName').value = '';
                        document.getElementById('subItemAmount').value = '';
                        document.getElementById('expenseSubItemForm').classList.add('hidden'); // Ensure form is hidden

                        const totalEl = document.getElementById('expenseTotalAmount');
                        if (expenseSubItems.length === 0) {
                            totalEl.readOnly = false;
                            totalEl.classList.remove('bg-gray-50');
                        } else {
                            totalEl.readOnly = true;
                            totalEl.classList.add('bg-gray-50');
                        }
                    }

                    // Override the updateUI to handle the readonly toggle
                    const originalUpdateInternal = updateExpenseUI;
                    updateExpenseUI = function () {
                        // Copy paste logic or reuse?
                        // I'll rewrite the function inside the block cleanly.
                        const listEl = document.getElementById('subItemsList');
                        const totalEl = document.getElementById('expenseTotalAmount');
                        const descEl = document.getElementById('expenseDescription');

                        listEl.innerHTML = '';
                        let total = 0;
                        let descText = "";

                        if (expenseSubItems.length > 0) {
                            listEl.classList.remove('hidden');
                            expenseSubItems.forEach((item, index) => {
                                total += item.amount;
                                descText += `${index + 1}. ${item.name}: ${item.amount.toLocaleString()} บาท\n`;

                                const row = document.createElement('div');
                                row.className = 'flex justify-between items-center bg-gray-50 px-3 py-2 rounded border border-gray-100';
                                row.innerHTML = `
                                    <span class="text-sm font-medium text-gray-700">${index + 1}. ${item.name}</span>
                                    <div class="flex items-center gap-3">
                                        <span class="text-sm text-gray-600">${item.amount.toLocaleString()}</span>
                                        <button type="button" onclick="removeExpenseSubItem(${index})" class="text-red-400 hover:text-red-600">
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-4 h-4">
                                                <path d="M6.28 5.22a.75.75 0 00-1.06 1.06L8.94 10l-3.72 3.72a.75.75 0 101.06 1.06L10 11.06l3.72 3.72a.75.75 0 101.06-1.06L11.06 10l3.72-3.72a.75.75 0 00-1.06-1.06L10 8.94 6.28 5.22z" />
                                            </svg>
                                        </button>
                                    </div>
                                `;
                                listEl.appendChild(row);
                            });

                            totalEl.value = total;
                            totalEl.readOnly = true;
                            totalEl.classList.add('bg-gray-50');
                            descEl.value = "รายละเอียดรายการ:\n" + descText;

                        } else {
                            listEl.classList.add('hidden');
                            // If no items, do not force 0, let user type? 
                            // But my updateUI is called on add/remove. 
                            // If I remove last item, it sets total to 0. 
                            // That's fine. User can then type new value.
                            totalEl.value = total > 0 ? total : '';
                            totalEl.readOnly = false;
                            totalEl.classList.remove('bg-gray-50');
                            descEl.value = '';
                        }
                    }
                </script>
            </div>
        </div>

        <!-- Edit Expense Modal -->
        <div id="editExpenseModal"
            class="fixed inset-0 bg-gray-800 bg-opacity-75 overflow-y-auto h-full w-full hidden z-50 flex items-start justify-center pt-10">
            <div class="bg-white rounded-lg shadow-xl w-full max-w-sm mx-4 modal-content">
                <div class="p-4 border-b flex justify-between items-center bg-yellow-50">
                    <h3 class="text-lg font-bold text-yellow-800">แก้ไขรายจ่ายทุนอื่นๆ</h3>
                    <button onclick="document.getElementById('editExpenseModal').classList.add('hidden')"
                        class="text-gray-400 hover:text-gray-600">&times;</button>
                </div>
                <form id="editExpenseForm" method="POST" enctype="multipart/form-data" class="p-4 space-y-4">
                    @csrf
                    @method('PUT')
                    <div>
                        <label class="block text-xs font-medium text-gray-700 mb-1">ชื่อรายการ</label>
                        <input type="text" name="name" id="editExpenseName"
                            class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm" required>
                    </div>
                    <div>
                        <label class="block text-xs font-medium text-gray-700 mb-1">วันที่</label>
                        <input type="date" name="date" id="editExpenseDate"
                            class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm" required>
                    </div>

                    <!-- Transaction Type Toggle for Edit -->
                    <div>
                        <label class="block text-xs font-medium text-gray-700 mb-2">ประเภทรายการ</label>
                        <div class="flex gap-2">
                            <input type="hidden" name="transaction_type" id="editTransactionTypeInput" value="increase">
                            <button type="button" id="editBtnIncrease" onclick="selectEditTransactionType('increase')"
                                class="flex-1 text-center py-2.5 px-4 rounded-lg border-2 cursor-pointer transition-all font-medium text-sm bg-emerald-500 text-white border-emerald-500 shadow-md">
                                <span class="text-base">📈</span> เพิ่มทุน
                            </button>
                            <button type="button" id="editBtnDecrease" onclick="selectEditTransactionType('decrease')"
                                class="flex-1 text-center py-2.5 px-4 rounded-lg border-2 cursor-pointer transition-all font-medium text-sm bg-gray-100 text-gray-600 border-gray-200 hover:border-red-300">
                                <span class="text-base">📉</span> ลดทุน (รับงวด)
                            </button>
                        </div>
                    </div>

                    <!-- Hidden amount field - auto-calculated from sub-items -->
                    <input type="hidden" name="amount" id="editExpenseAmount" value="0">

                    <div class="border-t pt-4 pb-2">
                        <div class="flex justify-between items-center mb-2">
                            <label class="text-xs font-medium text-gray-700">รายการย่อย (เพิ่มใหม่)</label>
                            <button type="button"
                                onclick="document.getElementById('editExpenseSubItemForm').classList.toggle('hidden')"
                                class="text-yellow-600 text-xs font-medium hover:underline">+ เพิ่มรายการ</button>
                        </div>
                        <!-- Inline Form -->
                        <div id="editExpenseSubItemForm" class="hidden bg-yellow-50 p-3 rounded-lg mb-3">
                            <div class="grid grid-cols-3 gap-2 mb-2">
                                <input type="text" id="editSubItemName"
                                    class="col-span-2 border border-yellow-200 rounded px-3 py-2 text-sm focus:ring-yellow-500 focus:border-yellow-500"
                                    placeholder="รายการ">
                                <input type="number" id="editSubItemAmount"
                                    class="border border-yellow-200 rounded px-3 py-2 text-sm focus:ring-yellow-500 focus:border-yellow-500"
                                    placeholder="จำนวนเงิน">
                            </div>
                            <div class="flex gap-2">
                                <button type="button" onclick="toggleEditExpenseSubItemForm()"
                                    class="flex-1 bg-gray-200 hover:bg-gray-300 text-gray-700 text-sm py-2 rounded transition-colors">ยกเลิก</button>
                                <button type="button" onclick="addEditExpenseSubItem()"
                                    class="flex-1 bg-blue-600 hover:bg-blue-700 text-white text-sm py-2 rounded transition-colors shadow-sm">เพิ่ม</button>
                            </div>
                        </div>

                        <!-- List of NEW items only in edit mode -->
                        <div id="editSubItemsList" class="space-y-1 mb-3 hidden"></div>
                    </div>
                    <div>
                        <label class="block text-xs font-medium text-gray-700 mb-1">รายละเอียดเพิ่มเติม (ถ้ามี)</label>
                        <textarea name="description" id="editExpenseDescription"
                            class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm" rows="2"></textarea>
                    </div>

                    <!-- Image Upload for Edit Expense -->
                    <div>
                        <label class="block text-xs font-medium text-gray-700 mb-1">📷 รูปภาพ</label>
                        <div id="editExpenseCurrentImage" class="mb-2 hidden">
                            <div class="relative inline-block">
                                <img id="editExpenseCurrentImageSrc" src="" alt="" class="w-24 h-24 object-cover rounded-lg border">
                                <span class="text-xs text-gray-400 block mt-1">รูปปัจจุบัน</span>
                            </div>
                        </div>
                        <input type="file" name="image" accept="image/*"
                            onchange="previewSingleImage(this, 'editExpenseImagePreview')"
                            class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm file:mr-3 file:py-1 file:px-3 file:rounded file:border-0 file:text-sm file:bg-yellow-50 file:text-yellow-700 hover:file:bg-yellow-100">
                        <div id="editExpenseImagePreview" class="mt-2"></div>
                    </div>

                    <div class="flex gap-3 pt-2">
                        <button type="button"
                            onclick="document.getElementById('editExpenseModal').classList.add('hidden')"
                            class="flex-1 bg-gray-200 hover:bg-gray-300 text-gray-800 font-medium py-2.5 rounded-lg">ยกเลิก</button>
                        <button type="submit"
                            class="flex-1 bg-blue-600 hover:bg-blue-700 text-white font-medium py-2.5 rounded-lg">บันทึกแก้ไข</button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Capital Transaction Modal (เพิ่ม/ลดทุน) -->
        <div id="capitalTransactionModal"
            class="fixed inset-0 bg-gray-800 bg-opacity-75 overflow-y-auto h-full w-full hidden z-50 flex items-start justify-center pt-10">
            <div class="bg-white rounded-lg shadow-xl w-full max-w-sm mx-4 modal-content">
                <div class="p-4 border-b flex justify-between items-center bg-blue-50">
                    <h3 class="text-lg font-bold text-blue-800">บันทึกรายการ: <span id="capitalTxName"></span></h3>
                    <button onclick="closeCapitalTransactionModal()"
                        class="text-gray-400 hover:text-gray-600">&times;</button>
                </div>
                <form id="capitalTransactionForm" method="POST" action="{{ route('capital-expenses.store') }}"
                    class="p-4 space-y-4">
                    @csrf
                    <input type="hidden" name="parent_id" id="capitalTxParentId">

                    <!-- Current Balance Display -->
                    <div class="bg-gray-50 rounded-lg p-3 text-sm">
                        <div class="flex justify-between mb-1">
                            <span class="text-gray-600">ทุนตั้งต้น:</span>
                            <span class="font-bold text-orange-600" id="capitalTxOriginal">฿0</span>
                        </div>
                        <div class="flex justify-between mb-1">
                            <span class="text-gray-600">รับคืนแล้ว:</span>
                            <span class="font-bold text-emerald-600" id="capitalTxReturned">฿0</span>
                        </div>
                        <div class="flex justify-between border-t pt-1">
                            <span class="text-gray-700 font-medium">คงเหลือ:</span>
                            <span class="font-bold text-blue-600" id="capitalTxRemaining">฿0</span>
                        </div>
                    </div>

                    <!-- Transaction Type -->
                    <div>
                        <label class="block text-xs font-medium text-gray-700 mb-2">ประเภท</label>
                        <div class="flex gap-2">
                            <input type="hidden" name="transaction_type" id="capitalTxType" value="decrease">
                            <button type="button" id="btnCapitalIncrease" onclick="selectCapitalTxType('increase')"
                                class="flex-1 text-center py-2.5 px-4 rounded-lg border-2 cursor-pointer transition-all font-medium text-sm bg-gray-100 text-gray-600 border-gray-200 hover:border-emerald-300">
                                <span class="text-base">📈</span> เพิ่มทุน
                            </button>
                            <button type="button" id="btnCapitalDecrease" onclick="selectCapitalTxType('decrease')"
                                class="flex-1 text-center py-2.5 px-4 rounded-lg border-2 cursor-pointer transition-all font-medium text-sm bg-emerald-500 text-white border-emerald-500 shadow-md">
                                <span class="text-base">📉</span> รับคืน
                            </button>
                        </div>
                    </div>

                    <!-- Amount -->
                    <div>
                        <label class="block text-xs font-medium text-gray-700 mb-1">จำนวนเงิน (บาท)</label>
                        <input type="number" name="amount" id="capitalTxAmount"
                            class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm text-right text-lg font-bold"
                            required min="0" step="0.01" placeholder="0">
                    </div>

                    <!-- Date -->
                    <div>
                        <label class="block text-xs font-medium text-gray-700 mb-1">วันที่</label>
                        <input type="date" name="date" id="capitalTxDate"
                            class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm" required>
                    </div>

                    <!-- Note -->
                    <div>
                        <label class="block text-xs font-medium text-gray-700 mb-1">หมายเหตุ (ถ้ามี)</label>
                        <input type="text" name="description" id="capitalTxNote"
                            class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm"
                            placeholder="เช่น จ่ายงวดที่ 1">
                    </div>

                    <!-- Hidden name field (auto-generated) -->
                    <input type="hidden" name="name" id="capitalTxItemName">

                    <div class="flex gap-3 pt-2">
                        <button type="button" onclick="closeCapitalTransactionModal()"
                            class="flex-1 bg-gray-200 hover:bg-gray-300 text-gray-800 font-medium py-2.5 rounded-lg">ยกเลิก</button>
                        <button type="submit"
                            class="flex-1 bg-blue-600 hover:bg-blue-700 text-white font-medium py-2.5 rounded-lg">บันทึก</button>
                    </div>
                </form>
            </div>
        </div>

        <script>
            // Capital Transaction Modal Functions
            var capitalTxParentName = '';

            function openCapitalTransactionModal(id, name, original, returned, remaining) {
                capitalTxParentName = name;
                document.getElementById('capitalTxName').textContent = name;
                document.getElementById('capitalTxParentId').value = id;
                document.getElementById('capitalTxOriginal').textContent = '฿' + original.toLocaleString();
                document.getElementById('capitalTxReturned').textContent = '฿' + returned.toLocaleString();
                document.getElementById('capitalTxRemaining').textContent = '฿' + remaining.toLocaleString();

                // Set today's date
                var today = new Date().toISOString().split('T')[0];
                document.getElementById('capitalTxDate').value = today;

                // Default to decrease (รับคืน)
                selectCapitalTxType('decrease');

                // Reset form
                document.getElementById('capitalTxAmount').value = '';
                document.getElementById('capitalTxNote').value = '';

                document.getElementById('capitalTransactionModal').classList.remove('hidden');
                document.getElementById('capitalTxAmount').focus();
            }

            function closeCapitalTransactionModal() {
                document.getElementById('capitalTransactionModal').classList.add('hidden');
            }

            function selectCapitalTxType(type) {
                document.getElementById('capitalTxType').value = type;
                var btnIncrease = document.getElementById('btnCapitalIncrease');
                var btnDecrease = document.getElementById('btnCapitalDecrease');

                if (type === 'increase') {
                    btnIncrease.className = 'flex-1 text-center py-2.5 px-4 rounded-lg border-2 cursor-pointer transition-all font-medium text-sm bg-emerald-500 text-white border-emerald-500 shadow-md';
                    btnDecrease.className = 'flex-1 text-center py-2.5 px-4 rounded-lg border-2 cursor-pointer transition-all font-medium text-sm bg-gray-100 text-gray-600 border-gray-200 hover:border-emerald-300';
                    document.getElementById('capitalTxItemName').value = capitalTxParentName + ' - เพิ่มทุน';
                } else {
                    btnDecrease.className = 'flex-1 text-center py-2.5 px-4 rounded-lg border-2 cursor-pointer transition-all font-medium text-sm bg-emerald-500 text-white border-emerald-500 shadow-md';
                    btnIncrease.className = 'flex-1 text-center py-2.5 px-4 rounded-lg border-2 cursor-pointer transition-all font-medium text-sm bg-gray-100 text-gray-600 border-gray-200 hover:border-emerald-300';
                    document.getElementById('capitalTxItemName').value = capitalTxParentName + ' - รับคืน';
                }
            }
        </script>

        <script>
            // Edit Expense Sub-items - Global Functions
            var editExpenseSubItems = [];

            function toggleEditExpenseSubItemForm() {
                var form = document.getElementById('editExpenseSubItemForm');
                if (form) {
                    form.classList.toggle('hidden');
                    if (!form.classList.contains('hidden')) {
                        document.getElementById('editSubItemName').focus();
                    }
                }
            }

            function addEditExpenseSubItem() {
                var nameInput = document.getElementById('editSubItemName');
                var amountInput = document.getElementById('editSubItemAmount');
                var descEl = document.getElementById('editExpenseDescription');

                var name = nameInput.value.trim();
                var amount = parseFloat(amountInput.value);

                if (!name || isNaN(amount)) return;

                var currentDesc = descEl.value;
                var newItemText = name + ': ' + amount.toLocaleString() + ' บาท';
                if (currentDesc) {
                    descEl.value = currentDesc + '\n' + newItemText;
                } else {
                    descEl.value = 'รายละเอียดรายการ:\n' + newItemText;
                }

                editExpenseSubItems.push({ name: name, amount: amount });
                updateEditExpenseTotal();
                renderEditSubItems();

                nameInput.value = '';
                amountInput.value = '';
                nameInput.focus();
            }

            function updateEditExpenseTotal() {
                var total = 0;
                for (var i = 0; i < editExpenseSubItems.length; i++) {
                    total += editExpenseSubItems[i].amount;
                }
                var hiddenField = document.getElementById('editExpenseAmount');
                var transactionType = document.getElementById('editTransactionTypeInput').value;

                if (hiddenField) {
                    // Get original amount
                    var originalAmount = parseFloat(hiddenField.getAttribute('data-original') || hiddenField.value) || 0;

                    // If decrease type, subtract new sub-items from original
                    // If increase type, add new sub-items to original
                    if (transactionType === 'decrease') {
                        hiddenField.value = originalAmount - total;
                    } else {
                        hiddenField.value = originalAmount + total;
                    }
                }
            }

            function removeEditExpenseSubItem(index) {
                var item = editExpenseSubItems[index];
                var descEl = document.getElementById('editExpenseDescription');

                var currentDesc = descEl.value;
                var itemString = item.name + ': ' + item.amount.toLocaleString() + ' บาท';
                if (currentDesc.indexOf(itemString) !== -1) {
                    descEl.value = currentDesc.replace('\n' + itemString, '').replace(itemString + '\n', '').replace(itemString, '');
                }

                editExpenseSubItems.splice(index, 1);
                updateEditExpenseTotal();
                renderEditSubItems();
            }

            function renderEditSubItems() {
                var listEl = document.getElementById('editSubItemsList');
                listEl.innerHTML = '';

                if (editExpenseSubItems.length > 0) {
                    listEl.classList.remove('hidden');
                    for (var i = 0; i < editExpenseSubItems.length; i++) {
                        var item = editExpenseSubItems[i];
                        var row = document.createElement('div');
                        row.className = 'flex justify-between items-center bg-yellow-50 px-3 py-2 rounded border border-yellow-100 text-xs';
                        row.innerHTML = '<span class="font-medium text-gray-700">' + item.name + '</span>' +
                            '<div class="flex items-center gap-3">' +
                            '<span class="text-orange-600 font-bold">+฿' + item.amount.toLocaleString() + '</span>' +
                            '<button type="button" onclick="removeEditExpenseSubItem(' + i + ')" class="text-gray-400 hover:text-red-500">&times;</button>' +
                            '</div>';
                        listEl.appendChild(row);
                    }
                } else {
                    listEl.classList.add('hidden');
                }
            }
            function selectEditTransactionType(type) {
                document.getElementById('editTransactionTypeInput').value = type;
                var btnIncrease = document.getElementById('editBtnIncrease');
                var btnDecrease = document.getElementById('editBtnDecrease');

                if (type === 'increase') {
                    btnIncrease.className = 'flex-1 text-center py-2.5 px-4 rounded-lg border-2 cursor-pointer transition-all font-medium text-sm bg-emerald-500 text-white border-emerald-500 shadow-md';
                    btnDecrease.className = 'flex-1 text-center py-2.5 px-4 rounded-lg border-2 cursor-pointer transition-all font-medium text-sm bg-gray-100 text-gray-600 border-gray-200 hover:border-red-300';
                } else {
                    btnDecrease.className = 'flex-1 text-center py-2.5 px-4 rounded-lg border-2 cursor-pointer transition-all font-medium text-sm bg-red-500 text-white border-red-500 shadow-md';
                    btnIncrease.className = 'flex-1 text-center py-2.5 px-4 rounded-lg border-2 cursor-pointer transition-all font-medium text-sm bg-gray-100 text-gray-600 border-gray-200 hover:border-emerald-300';
                }
            }
        </script>

        <!-- Add Payment Modal (for capital expense partial payment) -->
        <div id="addPaymentModal"
            class="fixed inset-0 bg-gray-800 bg-opacity-75 overflow-y-auto h-full w-full hidden z-50 flex items-start justify-center pt-10">
            <div class="bg-white rounded-lg shadow-xl w-full max-w-sm mx-4">
                <div class="p-4 border-b flex justify-between items-center bg-emerald-50">
                    <h3 class="text-lg font-bold text-emerald-800">📉 บันทึกรับคืนเงินต้น</h3>
                    <button onclick="closeAddPaymentModal()" class="text-gray-400 hover:text-gray-600">&times;</button>
                </div>
                <form action="{{ route('capital-expenses.store') }}" method="POST" class="p-4 space-y-4">
                    @csrf
                    <input type="hidden" name="transaction_type" value="decrease">
                    <input type="hidden" name="parent_id" id="paymentParentId">

                    <div class="bg-gray-50 rounded-lg p-3">
                        <p class="text-sm text-gray-600 mb-1">รายการ:</p>
                        <p class="font-bold text-gray-800" id="paymentExpenseName">-</p>
                        <div class="grid grid-cols-3 gap-2 mt-2 text-xs">
                            <div>
                                <p class="text-gray-500">ทุนตั้งต้น</p>
                                <p class="font-semibold text-orange-600" id="paymentOriginal">฿0</p>
                            </div>
                            <div>
                                <p class="text-gray-500">รับคืนแล้ว</p>
                                <p class="font-semibold text-emerald-600" id="paymentPaid">฿0</p>
                            </div>
                            <div>
                                <p class="text-gray-500">คงเหลือ</p>
                                <p class="font-semibold text-purple-600" id="paymentRemaining">฿0</p>
                            </div>
                        </div>
                    </div>

                    <input type="hidden" name="name" id="paymentNameInput">

                    <div>
                        <label class="block text-xs font-medium text-gray-700 mb-1">วันที่รับคืน</label>
                        <input type="date" name="date" id="paymentDate"
                            class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm" required>
                    </div>
                    <div>
                        <label class="block text-xs font-medium text-gray-700 mb-1">จำนวนเงินที่รับคืน (บาท)</label>
                        <input type="number" name="amount" id="paymentAmount"
                            class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm text-lg font-bold text-emerald-600"
                            placeholder="0" required min="1">
                        <p class="text-xs text-gray-400 mt-1">* ใส่จำนวนเงินต้นที่เขาจ่ายมา</p>
                    </div>
                    <div>
                        <label class="block text-xs font-medium text-gray-700 mb-1">หมายเหตุ (ถ้ามี)</label>
                        <input type="text" name="description"
                            class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm"
                            placeholder="เช่น งวดที่ 1, รับคืนบางส่วน">
                    </div>
                    <div class="flex gap-3 pt-2">
                        <button type="button" onclick="closeAddPaymentModal()"
                            class="flex-1 bg-gray-200 hover:bg-gray-300 text-gray-800 font-medium py-2.5 rounded-lg">ยกเลิก</button>
                        <button type="submit"
                            class="flex-1 bg-emerald-500 hover:bg-emerald-600 text-white font-medium py-2.5 rounded-lg">บันทึก</button>
                    </div>
                </form>
            </div>
        </div>

        <script>
            function openAddPaymentModal(expenseId, name, originalAmount, paidAmount, remainingAmount) {
                document.getElementById('paymentParentId').value = expenseId;
                document.getElementById('paymentExpenseName').textContent = name;
                document.getElementById('paymentNameInput').value = 'รับคืน: ' + name;
                document.getElementById('paymentOriginal').textContent = '฿' + originalAmount.toLocaleString();
                document.getElementById('paymentPaid').textContent = '฿' + paidAmount.toLocaleString();
                document.getElementById('paymentRemaining').textContent = '฿' + remainingAmount.toLocaleString();
                document.getElementById('paymentAmount').max = remainingAmount;
                document.getElementById('paymentAmount').placeholder = remainingAmount.toLocaleString();
                document.getElementById('paymentDate').value = new Date().toISOString().split('T')[0];
                document.getElementById('addPaymentModal').classList.remove('hidden');
            }

            function closeAddPaymentModal() {
                document.getElementById('addPaymentModal').classList.add('hidden');
            }
        </script>

        <!-- Add Personal Transaction Modal -->
        <div id="addPersonalTransactionModal"
            class="fixed inset-0 bg-gray-800 bg-opacity-75 overflow-y-auto h-full w-full hidden z-50 flex items-start justify-center pt-10">
            <div class="bg-white rounded-lg shadow-xl w-full max-w-sm mx-4">
                <div class="p-4 border-b flex justify-between items-center bg-purple-50">
                    <h3 class="text-lg font-bold text-purple-800" id="personalModalTitle">บันทึกรายรับ-รายจ่าย</h3>
                    <button onclick="document.getElementById('addPersonalTransactionModal').classList.add('hidden')"
                        class="text-gray-400 hover:text-gray-600">&times;</button>
                </div>
                <form action="{{ route('personal-transactions.store') }}" method="POST" class="p-4 space-y-4">
                    @csrf
                    <!-- Type Selector -->
                    <div class="grid grid-cols-2 gap-2 p-1 bg-gray-100 rounded-lg">
                        <label class="cursor-pointer" onclick="updatePersonalTheme('income')">
                            <input type="radio" name="type" value="income" class="sr-only" checked>
                            <div id="btnSelectIncome"
                                class="py-2 text-center rounded-md text-sm font-medium transition-all bg-green-600 text-white shadow"
                                style="background-color: #16a34a; color: white;">
                                📈 รายรับ
                            </div>
                        </label>
                        <label class="cursor-pointer" onclick="updatePersonalTheme('expense')">
                            <input type="radio" name="type" value="expense" class="sr-only">
                            <div id="btnSelectExpense"
                                class="py-2 text-center rounded-md text-sm font-medium transition-all text-gray-500 hover:bg-gray-200"
                                style="background-color: transparent; color: #6b7280;">
                                💸 รายจ่าย
                            </div>
                        </label>
                    </div>

                    <input type="hidden" id="personalTransactionType" value="income">

                    <div>
                        <label class="block text-xs font-medium text-gray-700 mb-1">วันที่</label>
                        <input type="date" name="date"
                            class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm"
                            value="{{ date('Y-m-d') }}" required>
                    </div>
                    <div>
                        <label class="block text-xs font-medium text-gray-700 mb-1">ชื่อรายการ</label>
                        <input type="text" name="name"
                            class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm"
                            placeholder="เช่น เงินเดือน, ค่าอาหาร" required>
                    </div>
                    <div>
                        <label class="block text-xs font-medium text-gray-700 mb-1">จำนวนเงิน (บาท)</label>
                        <input type="number" name="amount"
                            class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm" placeholder="0" required>
                    </div>
                    <div class="flex gap-3 pt-2">
                        <button type="button"
                            onclick="document.getElementById('addPersonalTransactionModal').classList.add('hidden')"
                            class="flex-1 bg-gray-200 hover:bg-gray-300 text-gray-800 font-medium py-2.5 rounded-lg">ยกเลิก</button>
                        <button type="submit"
                            class="flex-1 bg-purple-600 hover:bg-purple-700 text-white font-medium py-2.5 rounded-lg transition-colors"
                            id="btnPersonalSubmit">บันทึก</button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Use Part Modal -->
        <div id="usePartModal"
            class="fixed inset-0 bg-gray-800 bg-opacity-75 overflow-y-auto h-full w-full hidden z-50 flex items-start justify-center pt-10">
            <div class="bg-white rounded-lg shadow-xl w-full max-w-sm mx-4">
                <div class="p-4 border-b flex justify-between items-center bg-blue-50">
                    <h3 class="text-lg font-bold text-blue-800">นำอะไหล่ไปใช้</h3>
                    <button onclick="document.getElementById('usePartModal').classList.add('hidden')"
                        class="text-gray-400 hover:text-gray-600">&times;</button>
                </div>
                <form id="usePartForm" method="POST" class="p-4 space-y-4">
                    @csrf
                    <div>
                        <label class="block text-xs font-medium text-gray-600 mb-1">รายการอะไหล่</label>
                        <input type="text" id="usePartName"
                            class="w-full bg-gray-100 border border-gray-200 rounded-lg px-3 py-2 text-sm text-gray-500"
                            readonly>
                    </div>
                    <div>
                        <label class="block text-xs font-medium text-gray-700 mb-1">เลือกรถที่จะนำไปใส่</label>
                        <select name="car_id" class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm"
                            required>
                            <option value="">-- เลือกรถ --</option>
                            @foreach($cars->where('status', 'stock') as $car)
                                <option value="{{ $car->id }}">{{ $car->brand }} {{ $car->model }}
                                    ({{ $car->license_plate ?: 'ไม่มีทะเบียน' }})</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label class="block text-xs font-medium text-gray-700 mb-1">จำนวนที่ใช้ (ชิ้น)</label>
                        <input type="number" name="quantity" id="useQuantity"
                            class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm" min="1" value="1"
                            required>
                        <p class="text-xs text-gray-400 mt-1">คงเหลือ: <span id="maxQuantity">0</span> ชิ้น</p>
                    </div>
                    <div class="flex gap-3 pt-2">
                        <button type="button" onclick="document.getElementById('usePartModal').classList.add('hidden')"
                            class="flex-1 bg-gray-200 hover:bg-gray-300 text-gray-800 font-medium py-2.5 rounded-lg">ยกเลิก</button>
                        <button type="submit"
                            class="flex-1 bg-blue-500 hover:bg-blue-600 text-white font-medium py-2.5 rounded-lg">บันทึกการใช้</button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Edit Part Modal -->
        <div id="editPartModal"
            class="fixed inset-0 bg-gray-800 bg-opacity-75 overflow-y-auto h-full w-full hidden z-50 flex items-start justify-center pt-10">
            <div class="bg-white rounded-lg shadow-xl w-full max-w-sm mx-4">
                <div class="p-4 border-b flex justify-between items-center">
                    <h3 class="text-lg font-bold">แก้ไขข้อมูลอะไหล่</h3>
                    <button onclick="document.getElementById('editPartModal').classList.add('hidden')"
                        class="text-gray-400 hover:text-gray-600">&times;</button>
                </div>
                <form id="editPartForm" method="POST" class="p-4 space-y-4">
                    @csrf
                    @method('PUT')
                    <div>
                        <label class="block text-xs font-medium text-gray-700 mb-1">ชื่ออะไหล่</label>
                        <input type="text" name="name" id="editPartNameInput"
                            class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm" required>
                    </div>
                    <div class="grid grid-cols-2 gap-3">
                        <div>
                            <label class="block text-xs font-medium text-gray-700 mb-1">ราคาต่อหน่วย</label>
                            <input type="number" name="unit_price" id="editPartPriceInput"
                                class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm" required>
                        </div>
                        <div>
                            <label class="block text-xs font-medium text-gray-700 mb-1">จำนวนคงเหลือ</label>
                            <input type="number" name="quantity" id="editPartQuantityInput"
                                class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm" required>
                        </div>
                    </div>
                    <div class="flex gap-3 pt-2">
                        <button type="button" onclick="document.getElementById('editPartModal').classList.add('hidden')"
                            class="flex-1 bg-gray-200 hover:bg-gray-300 text-gray-800 font-medium py-2.5 rounded-lg">ยกเลิก</button>
                        <button type="submit"
                            class="flex-1 bg-blue-500 hover:bg-blue-600 text-white font-medium py-2.5 rounded-lg">บันทึก</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div id="addCarModal" class="fixed inset-0 bg-gray-800 bg-opacity-75 overflow-y-auto h-full w-full hidden z-50"
        style="-webkit-overflow-scrolling: touch;">
        <div class="flex items-start justify-center min-h-full py-6 px-4">
            <div class="bg-white rounded-lg shadow-xl w-full max-w-md">
                <div class="p-4 border-b flex justify-between items-center bg-white rounded-t-lg">
                    <h3 class="text-lg font-bold">รับรถเข้าสต็อก</h3>
                    <button onclick="document.getElementById('addCarModal').classList.add('hidden')"
                        class="text-gray-400 hover:text-gray-600">&times;</button>
                </div>
                <form action="{{ route('cars.store') }}" method="POST" enctype="multipart/form-data"
                    class="p-4 space-y-4">
                    @csrf
                    <div class="grid grid-cols-2 gap-3">
                        <div>
                            <label class="block text-xs font-medium text-gray-700 mb-1">ยี่ห้อ</label>
                            <input type="text" name="brand"
                                class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm" placeholder="Toyota"
                                required>
                        </div>
                        <div>
                            <label class="block text-xs font-medium text-gray-700 mb-1">รุ่น</label>
                            <input type="text" name="model"
                                class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm"
                                placeholder="Corolla Altis 2.4V" required>
                        </div>
                    </div>
                    <div class="grid grid-cols-3 gap-3">
                        <div>
                            <label class="block text-xs font-medium text-gray-700 mb-1">ปี</label>
                            <input type="text" name="year"
                                class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm" placeholder="2020"
                                required>
                        </div>
                        <div>
                            <label class="block text-xs font-medium text-gray-700 mb-1">สี</label>
                            <input type="text" name="color"
                                class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm" placeholder="สีเงิน"
                                required>
                        </div>
                        <div>
                            <label class="block text-xs font-medium text-gray-700 mb-1">ทะเบียน</label>
                            <input type="text" name="license_plate" id="addLicensePlate"
                                value="{{ old('license_plate') }}"
                                class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm @error('license_plate') border-red-500 @enderror"
                                placeholder="5กกท-1961">
                            <p id="addLicensePlateError" class="text-red-500 text-xs mt-1 hidden"></p>
                            @error('license_plate')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                    <div>
                        <label class="block text-xs font-medium text-gray-700 mb-1">วันที่ซื้อ</label>
                        <input type="date" name="purchase_date"
                            class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm" required>
                    </div>
                    <div class="grid grid-cols-2 gap-3">
                        <div>
                            <label class="block text-xs font-medium text-gray-700 mb-1">ราคาซื้อ (บาท)</label>
                            <input type="number" name="purchase_price"
                                class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm" placeholder="500000"
                                required>
                        </div>
                        <div>
                            <label class="block text-xs font-medium text-gray-700 mb-1">ราคาตั้งขาย (บาท)</label>
                            <input type="number" name="selling_price"
                                class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm" placeholder="550000">
                        </div>
                    </div>

                    <div class="mb-4">
                        <label class="block text-xs font-medium text-gray-700 mb-2">ประเภทเกียร์</label>
                        <div class="flex gap-2">
                            <label class="flex-1">
                                <input type="radio" name="transmission" value="M" class="peer hidden" checked>
                                <div
                                    class="peer-checked:bg-blue-500 peer-checked:text-white peer-checked:border-blue-500 text-center py-2.5 px-4 rounded-lg border-2 border-gray-200 cursor-pointer hover:border-blue-300 transition-all font-medium">
                                    <span class="text-lg">⚙️</span> Manual (M)
                                </div>
                            </label>
                            <label class="flex-1">
                                <input type="radio" name="transmission" value="Auto" class="peer hidden">
                                <div
                                    class="peer-checked:bg-blue-500 peer-checked:text-white peer-checked:border-blue-500 text-center py-2.5 px-4 rounded-lg border-2 border-gray-200 cursor-pointer hover:border-blue-300 transition-all font-medium">
                                    <span class="text-lg">🅰️</span> Auto
                                </div>
                            </label>
                        </div>
                    </div>

                    <!-- Notes -->
                    <div>
                        <label class="block text-xs font-medium text-gray-700 mb-1">📝 หมายเหตุ</label>
                        <input type="text" name="notes"
                            class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm"
                            placeholder="เช่น ตอนเดียวเจ๊พัช, รถลูกค้าฝาก">
                    </div>

                    <!-- Branch Selection -->
                    <div>
                        <label class="block text-xs font-medium text-gray-700 mb-1">🏢 สาขา</label>
                        <select name="branch_id" class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm">
                            <option value="">-- ไม่ระบุสาขา --</option>
                            @foreach($branches as $branch)
                                <option value="{{ $branch->id }}">{{ $branch->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Image Upload Section -->
                    <div>
                        <label class="block text-xs font-medium text-gray-700 mb-1">รูปภาพรถ (เลือกได้หลายรูป)</label>
                        <input type="file" name="images[]" id="addCarImages" multiple accept="image/*"
                            onchange="previewAddCarImages(this)"
                            class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm file:mr-3 file:py-1 file:px-3 file:rounded file:border-0 file:text-sm file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">
                        <p class="text-xs text-gray-400 mt-1">รองรับไฟล์: JPG, PNG, GIF (ไม่จำกัดขนาด)</p>
                        <div id="addCarImagePreview" class="grid grid-cols-4 gap-2 mt-2"></div>
                    </div>

                    <div class="flex gap-3 pt-2">
                        <button type="button" onclick="document.getElementById('addCarModal').classList.add('hidden')"
                            class="flex-1 bg-gray-200 hover:bg-gray-300 text-gray-800 font-medium py-2.5 rounded-lg">ยกเลิก</button>
                        <button type="submit"
                            class="flex-1 bg-blue-500 hover:bg-blue-600 text-white font-medium py-2.5 rounded-lg">บันทึก</button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Notes Modal (iPhone-Style Dark Theme) -->
        <div id="notesModal" class="fixed inset-0 overflow-hidden h-full w-full hidden z-50">

            <!-- List View -->
            <div id="notesListView" class="h-full w-full" style="background-color: #000000;">
                <!-- Header -->
                <div class="sticky top-0 z-10" style="background-color: #000000;">
                    <div class="flex items-center justify-between px-4 pt-4 pb-2">
                        <button onclick="document.getElementById('notesModal').classList.add('hidden')"
                            class="text-amber-400 hover:text-amber-300 text-sm font-medium flex items-center gap-1">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                                stroke="currentColor" class="w-5 h-5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5L8.25 12l7.5-7.5" />
                            </svg>
                            กลับ
                        </button>
                        <button onclick="createNewNote()"
                            class="w-10 h-10 rounded-full flex items-center justify-center hover:bg-gray-800 transition-colors">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                                stroke="currentColor" class="w-6 h-6 text-amber-400">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" />
                            </svg>
                        </button>
                    </div>
                    <h1 class="text-3xl font-bold text-white px-4 pb-3">โน้ต</h1>
                </div>

                <!-- Notes List -->
                <div class="px-4 pb-20 overflow-y-auto" style="max-height: calc(100vh - 120px);" id="notesList">
                    <div class="text-center py-16" id="notesEmpty">
                        <span class="text-6xl block mb-4">📝</span>
                        <p class="text-gray-500 text-lg">ยังไม่มีโน้ต</p>
                        <p class="text-gray-600 text-sm mt-2">กดปุ่ม ✏️ เพื่อสร้างโน้ตใหม่</p>
                    </div>
                </div>
            </div>

            <!-- Detail View -->
            <div id="notesDetailView" class="h-full w-full hidden" style="background-color: #000000;">
                <!-- Header -->
                <div class="sticky top-0 z-10 px-4 pt-4 pb-2 flex items-center justify-between"
                    style="background-color: #000000;">
                    <button onclick="goBackToNotesList()"
                        class="text-amber-400 hover:text-amber-300 text-sm font-medium flex items-center gap-1">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                            stroke="currentColor" class="w-5 h-5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5L8.25 12l7.5-7.5" />
                        </svg>
                        โน้ต
                    </button>
                    <div class="flex items-center gap-2">
                        <button onclick="deleteCurrentNote()"
                            class="p-2 rounded-lg hover:bg-gray-800 transition-colors">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                                stroke="currentColor" class="w-5 h-5 text-red-400">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                            </svg>
                        </button>
                    </div>
                </div>

                <!-- Note Content -->
                <div class="px-4 pb-20 overflow-y-auto" style="max-height: calc(100vh - 80px);">
                    <input type="hidden" id="currentNoteId">
                    <input type="text" id="noteDetailTitle" placeholder="ชื่อโน้ต..."
                        class="w-full bg-transparent text-2xl font-bold text-amber-400 placeholder-gray-600 border-none outline-none py-2"
                        oninput="autoSaveNote()">
                    <textarea id="noteDetailContent" placeholder="เขียนเนื้อหาที่นี่..."
                        class="w-full bg-transparent text-white placeholder-gray-600 border-none outline-none resize-none text-base leading-relaxed"
                        style="min-height: 60vh;" oninput="autoSaveNote(); autoResizeTextarea(this);"></textarea>
                    <p id="noteDetailDate" class="text-gray-600 text-xs mt-4"></p>
                </div>
            </div>
        </div>

        <script>
            // Notes Local Storage Functions (iPhone-Style)
            const NOTES_KEY = 'carstock_notes';
            let autoSaveTimeout = null;

            function getNotes() {
                const notes = localStorage.getItem(NOTES_KEY);
                if (!notes) return [];

                // Migrate old notes format if needed
                const parsed = JSON.parse(notes);
                return parsed.map(note => {
                    if (note.text && !note.title) {
                        // Old format: convert text to title
                        return {
                            id: note.id,
                            title: note.text,
                            content: '',
                            createdAt: note.createdAt,
                            updatedAt: note.updatedAt || note.createdAt
                        };
                    }
                    return note;
                });
            }

            function saveNotes(notes) {
                localStorage.setItem(NOTES_KEY, JSON.stringify(notes));
                updateNotesCount();
            }

            function createNewNote() {
                const notes = getNotes();
                const newNote = {
                    id: Date.now(),
                    title: '',
                    content: '',
                    createdAt: new Date().toISOString(),
                    updatedAt: new Date().toISOString()
                };
                notes.unshift(newNote);
                saveNotes(notes);
                openNoteDetail(newNote.id);
            }

            function openNoteDetail(id) {
                const notes = getNotes();
                const note = notes.find(n => n.id === id);
                if (!note) return;

                document.getElementById('currentNoteId').value = id;
                document.getElementById('noteDetailTitle').value = note.title || '';
                document.getElementById('noteDetailContent').value = note.content || '';

                const date = new Date(note.updatedAt || note.createdAt);
                const thaiDate = date.toLocaleDateString('th-TH', {
                    day: 'numeric',
                    month: 'long',
                    year: 'numeric',
                    hour: '2-digit',
                    minute: '2-digit'
                });
                document.getElementById('noteDetailDate').textContent = 'แก้ไขล่าสุด: ' + thaiDate;

                document.getElementById('notesListView').classList.add('hidden');
                document.getElementById('notesDetailView').classList.remove('hidden');

                // Focus on title if empty, otherwise content
                if (!note.title) {
                    document.getElementById('noteDetailTitle').focus();
                } else {
                    document.getElementById('noteDetailContent').focus();
                }

                // Auto resize textarea
                setTimeout(() => {
                    autoResizeTextarea(document.getElementById('noteDetailContent'));
                }, 100);
            }

            function goBackToNotesList() {
                // Save current note first
                saveCurrentNote();

                // Remove empty notes
                const notes = getNotes().filter(n => n.title.trim() || n.content.trim());
                saveNotes(notes);

                document.getElementById('notesListView').classList.remove('hidden');
                document.getElementById('notesDetailView').classList.add('hidden');
                renderNotes();
            }

            function saveCurrentNote() {
                const id = parseInt(document.getElementById('currentNoteId').value);
                if (!id) return;

                const title = document.getElementById('noteDetailTitle').value.trim();
                const content = document.getElementById('noteDetailContent').value.trim();

                const notes = getNotes();
                const noteIndex = notes.findIndex(n => n.id === id);
                if (noteIndex !== -1) {
                    notes[noteIndex].title = title;
                    notes[noteIndex].content = content;
                    notes[noteIndex].updatedAt = new Date().toISOString();
                    saveNotes(notes);
                }
            }

            function autoSaveNote() {
                if (autoSaveTimeout) clearTimeout(autoSaveTimeout);
                autoSaveTimeout = setTimeout(() => {
                    saveCurrentNote();
                }, 500);
            }

            function deleteCurrentNote() {
                const id = parseInt(document.getElementById('currentNoteId').value);
                if (!id) return;

                if (confirm('ลบโน้ตนี้?')) {
                    const notes = getNotes().filter(n => n.id !== id);
                    saveNotes(notes);
                    goBackToNotesList();
                }
            }

            function deleteNote(id, event) {
                event.stopPropagation();
                if (confirm('ลบโน้ตนี้?')) {
                    const noteElement = document.querySelector(`[data-note-id="${id}"]`);
                    if (noteElement) {
                        noteElement.style.transition = 'all 0.3s ease-out';
                        noteElement.style.transform = 'translateX(100%)';
                        noteElement.style.opacity = '0';
                        setTimeout(() => {
                            const notes = getNotes().filter(n => n.id !== id);
                            saveNotes(notes);
                            renderNotes();
                        }, 300);
                    }
                }
            }

            function renderNotes() {
                const notes = getNotes();
                const container = document.getElementById('notesList');
                const emptyState = document.getElementById('notesEmpty');

                if (notes.length === 0) {
                    container.innerHTML = `
                    <div class="text-center py-16" id="notesEmpty">
                        <span class="text-6xl block mb-4">📝</span>
                        <p class="text-gray-500 text-lg">ยังไม่มีโน้ต</p>
                        <p class="text-gray-600 text-sm mt-2">กดปุ่ม ✏️ เพื่อสร้างโน้ตใหม่</p>
                    </div>
                `;
                    return;
                }

                container.innerHTML = notes.map(note => {
                    const date = new Date(note.updatedAt || note.createdAt);
                    const thaiDate = date.toLocaleDateString('th-TH', { day: 'numeric', month: 'short', year: '2-digit' });
                    const title = note.title || 'โน้ตใหม่';
                    const preview = note.content ? note.content.split('\n')[0].substring(0, 50) : 'ไม่มีข้อความเพิ่มเติม';

                    return `
                    <div data-note-id="${note.id}" 
                        onclick="openNoteDetail(${note.id})"
                        class="py-4 border-b cursor-pointer hover:bg-gray-900/50 transition-colors -mx-4 px-4"
                        style="border-color: #2C2C2E;">
                        <div class="flex justify-between items-start">
                            <div class="flex-1 min-w-0">
                                <p class="text-white font-semibold text-base truncate">${escapeHtml(title)}</p>
                                <p class="text-gray-500 text-sm mt-1">
                                    <span class="text-gray-400">${thaiDate}</span>
                                    <span class="ml-2 text-gray-600">${escapeHtml(preview)}${note.content && note.content.length > 50 ? '...' : ''}</span>
                                </p>
                            </div>
                            <button onclick="deleteNote(${note.id}, event)" 
                                class="ml-3 p-2 text-gray-600 hover:text-red-400 rounded-lg transition-colors flex-shrink-0">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                                </svg>
                            </button>
                        </div>
                    </div>
                `;
                }).join('');
            }

            function autoResizeTextarea(textarea) {
                textarea.style.height = 'auto';
                textarea.style.height = Math.max(textarea.scrollHeight, window.innerHeight * 0.6) + 'px';
            }

            function escapeHtml(text) {
                const div = document.createElement('div');
                div.textContent = text;
                return div.innerHTML;
            }

            function updateNotesCount() {
                const count = getNotes().length;
                const headerEl = document.getElementById('notesCountHeader');
                const headerEl2 = document.getElementById('notesCountHeader2');
                const cardEl = document.getElementById('notesCountCard');
                if (headerEl) headerEl.textContent = count + ' รายการ';
                if (headerEl2) headerEl2.textContent = count + ' รายการ';
                if (cardEl) cardEl.innerHTML = count + ' <span class="text-xs font-normal text-gray-400">รายการ</span>';
            }

            // Ensure we're showing list view when modal opens
            function openNotesModal() {
                document.getElementById('notesModal').classList.remove('hidden');
                document.getElementById('notesListView').classList.remove('hidden');
                document.getElementById('notesDetailView').classList.add('hidden');
                renderNotes();
            }

            // Initialize notes on page load
            document.addEventListener('DOMContentLoaded', function () {
                renderNotes();
                updateNotesCount();
            });
        </script>

        <!-- Personal Account Modal (Premium Redesign) -->
        <div id="personalAccountModal"
            class="fixed inset-0 bg-gray-900/95 backdrop-blur-sm overflow-y-auto h-full w-full hidden z-50">
            <div class="min-h-screen">
                <!-- Premium Header -->
                <div
                    class="bg-gradient-to-br from-purple-600 via-indigo-600 to-blue-700 text-white py-8 px-4 relative overflow-hidden">
                    <!-- Background decorations -->
                    <div
                        class="absolute inset-0 bg-[url('data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iMjAwIiBoZWlnaHQ9IjIwMCIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIj48ZGVmcz48cGF0dGVybiBpZD0iYSIgcGF0dGVyblVuaXRzPSJ1c2VyU3BhY2VPblVzZSIgd2lkdGg9IjQwIiBoZWlnaHQ9IjQwIj48cGF0aCBkPSJNMCAyMGgyMHYyMEgwem0yMC0yMGgyMHYyMEgyMHoiIGZpbGw9InJnYmEoMjU1LDI1NSwyNTUsMC4wMykiLz48L3BhdHRlcm4+PC9kZWZzPjxyZWN0IHdpZHRoPSIxMDAlIiBoZWlnaHQ9IjEwMCUiIGZpbGw9InVybCgjYSkiLz48L3N2Zz4=')] opacity-50">
                    </div>

                    <div class="max-w-2xl mx-auto relative">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center gap-4">
                                <div
                                    class="w-14 h-14 bg-white/20 backdrop-blur rounded-2xl flex items-center justify-center shadow-lg">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                                        class="w-8 h-8">
                                        <path fill-rule="evenodd"
                                            d="M7.5 6a4.5 4.5 0 119 0 4.5 4.5 0 01-9 0zM3.751 20.105a8.25 8.25 0 0116.498 0 .75.75 0 01-.437.695A18.683 18.683 0 0112 22.5c-2.786 0-5.433-.608-7.812-1.7a.75.75 0 01-.437-.695z"
                                            clip-rule="evenodd" />
                                    </svg>
                                </div>
                                <div>
                                    <h2 class="text-2xl font-bold">บัญชีส่วนตัว</h2>
                                    <p class="text-purple-200 text-sm">📊 รายรับ-รายจ่ายส่วนตัว</p>
                                </div>
                            </div>
                            <button onclick="document.getElementById('personalAccountModal').classList.add('hidden')"
                                class="p-3 hover:bg-white/20 rounded-xl transition-all duration-200 hover:scale-110">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="2.5" stroke="currentColor" class="w-6 h-6">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Summary Cards - Floating -->
                <div class="max-w-2xl mx-auto px-4 -mt-6 relative z-10">
                    <div class="bg-white rounded-3xl shadow-2xl p-6 grid grid-cols-3 gap-4">
                        <div class="text-center p-3 rounded-2xl bg-gradient-to-br from-gray-50 to-gray-100">
                            <p class="text-xs text-gray-500 font-medium mb-1">💰 ยอดคงเหลือ</p>
                            <p
                                class="text-2xl font-bold {{ $personalBalance >= 0 ? 'text-emerald-600' : 'text-red-600' }}">
                                ฿{{ number_format($personalBalance, 0) }}</p>
                        </div>
                        <div class="text-center p-3 rounded-2xl bg-gradient-to-br from-emerald-50 to-green-100">
                            <p class="text-xs text-emerald-600 font-medium mb-1">📈 รายรับรวม</p>
                            <p class="text-2xl font-bold text-emerald-600">
                                ฿{{ number_format($personalTransactions->where('type', 'income')->sum('amount'), 0) }}
                            </p>
                        </div>
                        <div class="text-center p-3 rounded-2xl bg-gradient-to-br from-red-50 to-rose-100">
                            <p class="text-xs text-red-500 font-medium mb-1">📉 รายจ่ายรวม</p>
                            <p class="text-2xl font-bold text-red-500">
                                ฿{{ number_format($personalTransactions->where('type', 'expense')->sum('amount'), 0) }}
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Add Transaction Buttons -->
                <div class="max-w-2xl mx-auto px-4 mt-4">
                    <div class="flex gap-3">
                        <button
                            onclick="document.getElementById('personalAccountModal').classList.add('hidden'); openPersonalModal('income');"
                            class="flex-1 bg-gradient-to-r from-emerald-500 to-green-600 hover:from-emerald-600 hover:to-green-700 text-white font-bold py-4 rounded-2xl flex items-center justify-center gap-2 shadow-lg shadow-emerald-200 hover:shadow-xl transition-all duration-300 hover:-translate-y-1">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5"
                                stroke="currentColor" class="w-5 h-5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                            </svg>
                            รายรับ
                        </button>
                        <button
                            onclick="document.getElementById('personalAccountModal').classList.add('hidden'); openPersonalModal('expense');"
                            class="flex-1 bg-gradient-to-r from-red-500 to-rose-600 hover:from-red-600 hover:to-rose-700 text-white font-bold py-4 rounded-2xl flex items-center justify-center gap-2 shadow-lg shadow-red-200 hover:shadow-xl transition-all duration-300 hover:-translate-y-1">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5"
                                stroke="currentColor" class="w-5 h-5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M5 12h14" />
                            </svg>
                            รายจ่าย
                        </button>
                    </div>
                </div>

                <!-- Transaction List - Grouped by Date -->
                <div class="max-w-2xl mx-auto px-4 mt-6 pb-8">
                    @php
                        // Group transactions by date
                        $groupedByDate = $personalTransactions->sortByDesc('date')->groupBy(function ($item) {
                            return \Carbon\Carbon::parse($item->date)->format('Y-m-d');
                        });
                    @endphp

                    @forelse($groupedByDate as $date => $transactions)
                        @php
                            $dateCarbon = \Carbon\Carbon::parse($date);
                            $dayIncome = $transactions->where('type', 'income')->sum('amount');
                            $dayExpense = $transactions->where('type', 'expense')->sum('amount');
                            $dayBalance = $dayIncome - $dayExpense;
                            $uniqueId = 'day_' . str_replace('-', '', $date);
                        @endphp

                        <!-- Date Group Card -->
                        <div class="bg-white rounded-2xl shadow-lg mb-4 overflow-hidden">
                            <!-- Date Header - Clickable Accordion -->
                            <button onclick="toggleDateGroup('{{ $uniqueId }}')"
                                class="w-full p-4 flex items-center justify-between hover:bg-gray-50 transition-colors">
                                <div class="flex items-center gap-4">
                                    <!-- Date Badge -->
                                    <div
                                        class="w-14 h-14 bg-gradient-to-br from-indigo-500 to-purple-600 rounded-2xl flex flex-col items-center justify-center text-white shadow-lg">
                                        <span class="text-xl font-bold leading-none">{{ $dateCarbon->format('d') }}</span>
                                        <span
                                            class="text-[10px] uppercase tracking-wide">{{ $dateCarbon->translatedFormat('M') }}</span>
                                    </div>
                                    <div class="text-left">
                                        <p class="font-bold text-gray-800">{{ $dateCarbon->translatedFormat('l') }}</p>
                                        <p class="text-xs text-gray-400">
                                            {{ $dateCarbon->addYears(543)->translatedFormat('d F Y') }}
                                        </p>
                                    </div>
                                </div>
                                <div class="flex items-center gap-4">
                                    <!-- Daily Summary -->
                                    <div class="text-right">
                                        <p
                                            class="text-sm font-bold {{ $dayBalance >= 0 ? 'text-emerald-600' : 'text-red-600' }}">
                                            {{ $dayBalance >= 0 ? '+' : '' }}฿{{ number_format($dayBalance, 0) }}
                                        </p>
                                        <div class="flex gap-2 text-xs">
                                            <span class="text-emerald-500">+{{ number_format($dayIncome, 0) }}</span>
                                            <span class="text-red-400">-{{ number_format($dayExpense, 0) }}</span>
                                        </div>
                                    </div>
                                    <!-- Chevron -->
                                    <svg id="{{ $uniqueId }}_chevron" xmlns="http://www.w3.org/2000/svg" fill="none"
                                        viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                                        class="w-5 h-5 text-gray-400 transition-transform duration-300">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
                                    </svg>
                                </div>
                            </button>

                            <!-- Transaction Details - Collapsible -->
                            <div id="{{ $uniqueId }}" class="hidden border-t border-gray-100">
                                @foreach($transactions as $tx)
                                    <div
                                        class="px-4 py-3 flex justify-between items-center hover:bg-gray-50 transition-colors {{ !$loop->last ? 'border-b border-gray-50' : '' }}">
                                        <div class="flex items-center gap-3">
                                            <div
                                                class="w-10 h-10 rounded-xl flex items-center justify-center {{ $tx->type == 'income' ? 'bg-emerald-100 text-emerald-600' : 'bg-red-100 text-red-600' }}">
                                                @if($tx->type == 'income')
                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                        stroke-width="2" stroke="currentColor" class="w-5 h-5">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            d="M12 4.5v15m7.5-7.5h-15" />
                                                    </svg>
                                                @else
                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                        stroke-width="2" stroke="currentColor" class="w-5 h-5">
                                                        <path stroke-linecap="round" stroke-linejoin="round" d="M5 12h14" />
                                                    </svg>
                                                @endif
                                            </div>
                                            <p class="font-medium text-gray-800">{{ $tx->name }}</p>
                                        </div>
                                        <div class="flex items-center gap-3">
                                            <span
                                                class="font-bold text-lg {{ $tx->type == 'income' ? 'text-emerald-600' : 'text-red-600' }}">
                                                {{ $tx->type == 'income' ? '+' : '-' }}฿{{ number_format($tx->amount, 0) }}
                                            </span>
                                            <form action="{{ route('personal-transactions.destroy', $tx->id) }}" method="POST"
                                                onsubmit="return confirm('ลบรายการนี้?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                    class="p-2 text-gray-400 hover:text-white hover:bg-red-500 rounded-lg transition-all">
                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                        stroke-width="2" stroke="currentColor" class="w-4 h-4">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                                                    </svg>
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @empty
                        <div class="bg-white rounded-2xl shadow-xl py-16 text-center">
                            <span class="text-6xl block mb-4">📭</span>
                            <p class="text-gray-500 font-medium">ยังไม่มีรายการ</p>
                            <p class="text-gray-400 text-sm mt-1">เริ่มบันทึกรายรับ-รายจ่ายของคุณ</p>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>

        <script>
            function toggleDateGroup(id) {
                const content = document.getElementById(id);
                const chevron = document.getElementById(id + '_chevron');

                if (content.classList.contains('hidden')) {
                    content.classList.remove('hidden');
                    content.style.maxHeight = content.scrollHeight + 'px';
                    chevron.style.transform = 'rotate(180deg)';
                } else {
                    content.classList.add('hidden');
                    content.style.maxHeight = '0';
                    chevron.style.transform = 'rotate(0deg)';
                }
            }
        </script>

        <!-- Setting Modal -->
        <div id="settingModal"
            class="fixed inset-0 bg-gray-800 bg-opacity-75 overflow-y-auto h-full w-full hidden z-[9999] items-start justify-center pt-10">
            <div class="bg-white rounded-lg shadow-xl w-full max-w-sm mx-4">
                <div class="p-4 border-b flex justify-between items-center">
                    <h3 class="text-lg font-bold">ตั้งค่าทุนเริ่มต้น</h3>
                    <button
                        onclick="closeSettingModal()"
                    class="text-gray-400 hover:text-gray-600">&times;</button>
            </div>
            <form action="{{ route('settings.update') }}" method="POST" class="p-4 space-y-4">
                @csrf
                <div>
                    <label class="block text-xs font-medium text-gray-700 mb-1">ปี พ.ศ.</label>
                    <input type="number" name="year" value="{{ $setting->year }}"
                        class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm" required>
                </div>
                <div>
                    <label class="block text-xs font-medium text-gray-700 mb-1">ทุนตั้งต้น (บาท)</label>
                    <input type="number" name="initial_capital" value="{{ $setting->initial_capital }}"
                        class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm" required>
                </div>
                <div>
                    <label class="block text-xs font-medium text-gray-700 mb-1">เป้าหมายกำไร (บาท)</label>
                    <input type="number" name="target_profit" value="{{ $setting->target_profit ?? 1000000 }}"
                        class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm" required>
                </div>
                <div class="flex gap-3 pt-2">
                    <button type="button" onclick="closeSettingModal()"
                        class="flex-1 bg-gray-200 hover:bg-gray-300 text-gray-800 font-medium py-2.5 rounded-lg">ยกเลิก</button>
                    <button type="submit"
                        class="flex-1 bg-blue-500 hover:bg-blue-600 text-white font-medium py-2.5 rounded-lg">บันทึก</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Car Edit Modals (one for each car) -->
    @foreach($cars as $car)
        @php 
                                                                                                    $totalCost = $car->total_cost;
            $expectedProfit = $car->selling_price ? ($car->selling_price - $totalCost) : 0;
        @endphp
        <div id="editCarModal{{ $car->id }}"
            class="fixed inset-0 bg-gray-800 bg-opacity-75 overflow-y-auto h-full w-full hidden z-50" style="-webkit-overflow-scrolling: touch;">
            <div class="flex items-start justify-center min-h-full py-6 px-4">
            <div class="bg-white rounded-lg shadow-xl w-full max-w-md">
                <div class="p-4 border-b flex justify-between items-center bg-white rounded-t-lg">
                    <h3 class="text-lg font-bold">แก้ไขข้อมูลรถ: {{ $car->brand }} {{ $car->model }}</h3>
                    <button onclick="closeEditModal({{ $car->id }})"
                        class="text-gray-400 hover:text-gray-600 text-2xl">&times;</button>
                </div>
                <form action="{{ route('cars.update', $car) }}" method="POST" enctype="multipart/form-data" class="p-4 space-y-4">
                    @csrf
                    @method('PUT')

                    <!-- Images Gallery with Delete -->
                    <div class="border-b pb-4">
                        <div class="flex justify-between items-center mb-2">
                            <label class="block text-xs font-medium text-gray-500">รูปภาพรถ ({{ $car->images->count() }} รูป)</label>
                        </div>
                        @if($car->images->count() > 0)
                            <div class="grid grid-cols-3 gap-2 mb-3">
                                @foreach($car->images as $image)
                                    <div class="relative group">
                                        <img src="{{ asset('img/' . $image->path) }}" alt="Car Image" class="w-full h-20 object-cover rounded">
                                        <button type="button" onclick="deleteImage({{ $image->id }})" 
                                            class="absolute top-1 right-1 bg-red-500 text-white rounded-full w-5 h-5 text-xs opacity-0 group-hover:opacity-100 transition-opacity">✕</button>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <p class="text-xs text-gray-400 text-center py-2 mb-2">ยังไม่มีรูปภาพ</p>
                        @endif

                        <!-- Add More Images -->
                        <input type="file" name="images[]" multiple accept="image/*"
                            class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm file:mr-3 file:py-1 file:px-3 file:rounded file:border-0 file:text-sm file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">
                        <p class="text-xs text-gray-400 mt-1">เลือกรูปเพิ่มเติม (JPG, PNG, GIF สูงสุด 5MB)</p>
                    </div>

                    <div>
                        <label class="block text-xs font-medium text-gray-500 mb-1">สีรถ</label>
                        <input type="text" name="color" value="{{ $car->color }}"
                            class="w-full bg-gray-100 border border-gray-200 rounded-lg px-4 py-3 text-sm">
                    </div>

                    <div>
                        <label class="block text-xs font-medium text-gray-500 mb-1">เลขทะเบียน</label>
                        <input type="text" name="license_plate" id="editLicensePlate{{ $car->id }}" value="{{ old('license_plate', $car->license_plate) }}"
                            class="w-full bg-gray-100 border border-gray-200 rounded-lg px-4 py-3 text-sm @error('license_plate') border-red-500 @enderror">
                        <p id="editLicensePlateError{{ $car->id }}" class="text-red-500 text-xs mt-1 hidden"></p>
                        @error('license_plate')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-xs font-medium text-gray-500 mb-1">วันที่ซื้อเข้ามา</label>
                        <input type="date" name="purchase_date" value="{{ $car->purchase_date?->format('Y-m-d') }}"
                            class="w-full bg-gray-100 border border-gray-200 rounded-lg px-4 py-3 text-sm text-center">
                    </div>

                    <div>
                        <label class="block text-xs font-medium text-blue-600 mb-1">ราคาที่ซื้อมา</label>
                        <input type="number" name="purchase_price" value="{{ $car->purchase_price }}"
                            class="w-full bg-gray-100 border border-gray-200 rounded-lg px-4 py-3 text-lg text-blue-600 font-bold">
                    </div>

                    <div>
                        <label class="block text-xs font-medium text-blue-600 mb-1">ราคาตั้งขาย</label>
                        <input type="number" name="selling_price" value="{{ $car->selling_price }}"
                            class="w-full bg-gray-100 border border-gray-200 rounded-lg px-4 py-3 text-lg text-blue-600 font-bold">
                    </div>

                    <!-- Branch Selection -->
                    <div>
                        <label class="block text-xs font-medium text-gray-500 mb-1">🏢 สาขา</label>
                        <select name="branch_id" class="w-full bg-gray-100 border border-gray-200 rounded-lg px-4 py-3 text-sm">
                            <option value="">-- ไม่ระบุสาขา --</option>
                            @foreach($branches as $branch)
                                <option value="{{ $branch->id }}" {{ $car->branch_id == $branch->id ? 'selected' : '' }}>{{ $branch->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Notes -->
                    <div>
                        <label class="block text-xs font-medium text-gray-500 mb-1">📝 หมายเหตุ</label>
                        <input type="text" name="notes" value="{{ $car->notes }}"
                            class="w-full bg-gray-100 border border-gray-200 rounded-lg px-4 py-3 text-sm"
                            placeholder="เช่น ตอนเดียวเจ๊พัช, รถลูกค้าฝาก">
                    </div>

                    <!-- Refurbishment Items Section -->
                    <div class="border-t pt-4">
                        <div class="flex justify-between items-center mb-2">
                            <span class="text-sm text-gray-500">รายการปรับสภาพ</span>
                            <button type="button" onclick="toggleRefurbForm({{ $car->id }})" class="text-blue-500 text-sm font-medium">+ เพิ่มรายการ</button>
                        </div>

                        <!-- Inline Add Refurbishment Form (Hidden by default) -->
                        <div id="refurbForm{{ $car->id }}" class="hidden bg-blue-50 p-3 rounded-lg mb-3">
                            <div class="grid grid-cols-2 gap-2 mb-2">
                                <input type="text" id="refurbName{{ $car->id }}" class="border border-gray-300 rounded px-3 py-2 text-sm" placeholder="รายการ เช่น ทาสี">
                                <input type="number" id="refurbAmount{{ $car->id }}" class="border border-gray-300 rounded px-3 py-2 text-sm" placeholder="จำนวนเงิน">
                            </div>
                            <div class="flex gap-2">
                                <button type="button" onclick="toggleRefurbForm({{ $car->id }})" class="flex-1 bg-gray-200 hover:bg-gray-300 text-gray-700 text-sm py-2 rounded">ยกเลิก</button>
                                <button type="button" onclick="submitRefurb({{ $car->id }})" class="flex-1 bg-blue-500 hover:bg-blue-600 text-white text-sm py-2 rounded">เพิ่ม</button>
                            </div>
                        </div>

                        @if($car->refurbishments->count() > 0)
                            <div class="space-y-2">
                                @foreach($car->refurbishments as $item)
                                    <div class="flex justify-between items-center bg-gray-50 px-3 py-2 rounded group">
                                        <span class="text-sm">{{ $item->name }}</span>
                                        <div class="flex items-center gap-3">
                                            <span class="text-sm text-orange-600 font-medium">฿{{ number_format($item->amount, 0) }}</span>
                                            <form action="{{ route('refurbishments.destroy', $item->id) }}" method="POST" onsubmit="return confirm('ลบรายการนี้?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-gray-400 hover:text-red-500 opacity-0 group-hover:opacity-100 transition-opacity">
                                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-4 h-4">
                                                        <path fill-rule="evenodd" d="M8.75 1A2.75 2.75 0 006 3.75v.443c-.795.077-1.584.176-2.365.298a.75.75 0 10.23 1.482l.149-.022.841 10.518A2.75 2.75 0 007.596 19h4.807a2.75 2.75 0 002.742-2.53l.841-10.52.149.023a.75.75 0 00.23-1.482A41.03 41.03 0 0014 4.193V3.75A2.75 2.75 0 0011.25 1h-2.5zM10 4c.84 0 1.673.025 2.5.075V3.75c0-.69-.56-1.25-1.25-1.25h-2.5c-.69 0-1.25.56-1.25 1.25v.325C8.327 4.025 9.16 4 10 4zM8.58 7.72a.75.75 0 00-1.5.06l.3 7.5a.75.75 0 101.5-.06l-.3-7.5zm4.34.06a.75.75 0 10-1.5-.06l-.3 7.5a.75.75 0 101.5.06l.3-7.5z" clip-rule="evenodd" />
                                                    </svg>
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <p id="noRefurbMsg{{ $car->id }}" class="text-xs text-gray-400 text-center py-2">ยังไม่มีรายการปรับสภาพ</p>
                        @endif
                    </div>

                    <!-- Total Cost -->
                    <div class="bg-blue-50 px-4 py-3 rounded-lg">
                        <div class="flex justify-between items-center">
                            <span class="font-medium">ต้นทุนรวม</span>
                            <span class="text-xl font-bold text-blue-700">฿{{ number_format($totalCost, 0) }}</span>
                        </div>
                    </div>

                    @if($car->status == 'stock')
                            <!-- Expected Profit (for stock cars) -->
                            <div class="bg-{{ $expectedProfit >= 0 ? 'green' : 'red' }}-50 px-4 py-3 rounded-lg">
                                <div class="flex justify-between items-center">
                                    <span class="font-medium">กำไรคาดการณ์</span>
                                    <span class="text-xl font-bold text-{{ $expectedProfit >= 0 ? 'green' : 'red' }}-700">฿{{ number_format($expectedProfit, 0) }}</span>
                                </div>
                            </div>

                            <!-- Action Buttons -->
                            <div class="flex gap-3 pt-2">
                                <button type="button" onclick="closeEditModal({{ $car->id }})"
                                    class="flex-1 bg-gray-200 hover:bg-gray-300 text-gray-800 font-medium py-3 rounded-lg">ยกเลิก</button>
                                <button type="submit"
                                    class="flex-1 bg-blue-500 hover:bg-blue-600 text-white font-medium py-3 rounded-lg">บันทึกข้อมูล</button>
                            </div>
                        </form>
                    @else
                            <!-- Actual Profit (for sold cars) -->
                            @php $actualProfit = $car->sold_price - $totalCost; @endphp
                            <div class="bg-purple-50 px-4 py-3 rounded-lg">
                                <div class="flex justify-between items-center">
                                    <span class="font-medium">ราคาขายจริง</span>
                                    <span class="text-xl font-bold text-purple-700">฿{{ number_format($car->sold_price, 0) }}</span>
                                </div>
                            </div>
                            <div class="bg-{{ $actualProfit >= 0 ? 'green' : 'red' }}-100 px-4 py-3 rounded-lg border-2 border-{{ $actualProfit >= 0 ? 'green' : 'red' }}-300">
                                <div class="flex justify-between items-center">
                                    <span class="font-bold text-{{ $actualProfit >= 0 ? 'green' : 'red' }}-800">💰 กำไรจริง</span>
                                    <span class="text-2xl font-bold text-{{ $actualProfit >= 0 ? 'green' : 'red' }}-700">฿{{ number_format($actualProfit, 0) }}</span>
                                </div>
                            </div>

                            <!-- Action Buttons for sold -->
                            <div class="flex gap-3 pt-2">
                                <button type="button" onclick="closeEditModal({{ $car->id }})"
                                    class="flex-1 bg-gray-200 hover:bg-gray-300 text-gray-800 font-medium py-3 rounded-lg">ปิด</button>
                                <button type="submit"
                                    class="flex-1 bg-blue-500 hover:bg-blue-600 text-white font-medium py-3 rounded-lg">บันทึกข้อมูล</button>
                            </div>
                        </form>
                    @endif
            </div>
            </div>
        </div>
    @endforeach

    <!-- Hidden form for refurbishment submission -->
    <form id="refurbSubmitForm" method="POST" class="hidden">
        @csrf
        <input type="hidden" name="name" id="refurbSubmitName">
        <input type="hidden" name="amount" id="refurbSubmitAmount">
    </form>

    <!-- Hidden form for image deletion -->
    <form id="imageDeleteForm" method="POST" class="hidden">
        @csrf
        @method('DELETE')
    </form>

    <!-- Gallery Modal -->
    <div id="galleryModal" class="fixed inset-0 bg-neutral-900/95 backdrop-blur-sm z-50 hidden flex items-center justify-center">
        <button onclick="closeGallery()" class="absolute top-6 right-6 text-white/50 hover:text-white transition-colors z-50">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-10 h-10">
                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
            </svg>
        </button>
        
        <button onclick="changeGalleryImage(-1)" class="absolute left-4 top-1/2 transform -translate-y-1/2 text-white/70 hover:text-white transition-colors p-2 rounded-full hover:bg-white/10 z-50 hidden md:block">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-12 h-12">
                <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
            </svg>
        </button>
        
        <div class="max-w-7xl max-h-[90vh] w-full px-4 md:px-16 flex flex-col items-center justify-center" id="galleryContainer">
            <img id="galleryImage" src="" alt="Gallery Image" class="max-h-[85vh] max-w-full object-contain shadow-2xl rounded-lg">
            <div id="galleryCounter" class="text-white/60 mt-4 text-lg font-medium tracking-wider"></div>
        </div>
        
        <button onclick="changeGalleryImage(1)" class="absolute right-4 top-1/2 transform -translate-y-1/2 text-white/70 hover:text-white transition-colors p-2 rounded-full hover:bg-white/10 z-50 hidden md:block">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-12 h-12">
                <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
            </svg>
        </button>
    </div>

    <script>
        var galleryImages = [];
        var currentGalleryIndex = 0;
        var touchStartX = 0;
        var touchEndX = 0;

        // Branch Dropdown Functions
        function toggleBranchDropdown(carId) {
            // Close all other dropdowns
            document.querySelectorAll('[id^="branchDropdown-"]').forEach(el => {
                if (el.id !== 'branchDropdown-' + carId) {
                    el.classList.add('hidden');
                }
            });
            
            const dropdown = document.getElementById('branchDropdown-' + carId);
            dropdown.classList.toggle('hidden');
        }

        function updateCarBranch(carId, branchId) {
            fetch(`/cars/${carId}/branch`, {
                method: 'PUT',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Accept': 'application/json'
                },
                body: JSON.stringify({ branch_id: branchId })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    // Reload page to reflect changes
                    window.location.reload();
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('เกิดข้อผิดพลาดในการอัพเดทสาขา');
            });
            
            // Close dropdown
            document.getElementById('branchDropdown-' + carId).classList.add('hidden');
        }

        // Close dropdowns when clicking outside
        document.addEventListener('click', function(e) {
            if (!e.target.closest('.branch-dropdown-container')) {
                document.querySelectorAll('[id^="branchDropdown-"]').forEach(el => {
                    el.classList.add('hidden');
                });
            }
        });

        // Validate image file size (max 2MB per file)
        function validateImageSize(input) {
            const maxSize = 2 * 1024 * 1024; // 2MB in bytes
            const errorElement = document.getElementById('addCarImageError');
            let hasError = false;
            
            if (input.files) {
                for (let i = 0; i < input.files.length; i++) {
                    if (input.files[i].size > maxSize) {
                        hasError = true;
                        break;
                    }
                }
            }
            
            if (hasError) {
                errorElement.textContent = 'รูปภาพบางไฟล์มีขนาดใหญ่เกิน 2MB กรุณาเลือกรูปที่เล็กกว่า';
                errorElement.classList.remove('hidden');
                input.value = ''; // Clear the selection
            } else {
                errorElement.classList.add('hidden');
            }
        }

        function openGallery(images) {
            if (!images || images.length === 0) return;
            
            galleryImages = images;
            currentGalleryIndex = 0;
            updateGalleryImage();
            
            var m = document.getElementById('galleryModal');
            document.body.appendChild(m);
            m.classList.remove('hidden');
            m.style.cssText = 'display:flex !important; position:fixed !important; top:0 !important; left:0 !important; right:0 !important; bottom:0 !important; z-index:99999 !important; background:rgba(23,23,23,0.95); backdrop-filter:blur(4px); align-items:center; justify-content:center;';
            
            // Add keydown listener for arrow keys
            document.addEventListener('keydown', handleGalleryKeys);
            
            // Add touch listeners
            var galleryContainer = document.getElementById('galleryContainer');
            galleryContainer.addEventListener('touchstart', handleTouchStart);
            galleryContainer.addEventListener('touchend', handleTouchEnd);
        }

        function closeGallery() {
            var m = document.getElementById('galleryModal');
            m.style.cssText = 'display:none !important;';
            m.classList.add('hidden');
            document.removeEventListener('keydown', handleGalleryKeys);
            var galleryContainer = document.getElementById('galleryContainer');
            galleryContainer.removeEventListener('touchstart', handleTouchStart);
            galleryContainer.removeEventListener('touchend', handleTouchEnd);
        }

        function handleTouchStart(e) {
            touchStartX = e.changedTouches[0].screenX;
        }

        function handleTouchEnd(e) {
            touchEndX = e.changedTouches[0].screenX;
            handleSwipe();
        }

        function handleSwipe() {
            if (touchEndX < touchStartX - 50) {
                // Swipe Left -> Next
                changeGalleryImage(1);
            }
            if (touchEndX > touchStartX + 50) {
                // Swipe Right -> Prev
                changeGalleryImage(-1);
            }
        }

        function handleGalleryKeys(e) {
            if (e.key === 'ArrowLeft') changeGalleryImage(-1);
            if (e.key === 'ArrowRight') changeGalleryImage(1);
            if (e.key === 'Escape') closeGallery();
        }

        function changeGalleryImage(direction) {
            currentGalleryIndex += direction;
            
            if (currentGalleryIndex >= galleryImages.length) currentGalleryIndex = 0;
            if (currentGalleryIndex < 0) currentGalleryIndex = galleryImages.length - 1;
            
            updateGalleryImage();
        }

        function switchTab(type, status) {
            // Define styles for each tab (active = solid bg + ring, inactive = pastel bg + colored border)
            const tabConfig = {
                'tabAll': { 
                    active: 'bg-blue-600 text-white shadow-lg ring-2 ring-blue-600 ring-offset-2 font-bold',
                    inactive: 'bg-blue-100 text-blue-800 border-2 border-blue-400 shadow-sm font-bold hover:bg-blue-200'
                },
                'tabStock': { 
                    active: 'bg-green-600 text-white shadow-lg ring-2 ring-green-600 ring-offset-2 font-bold',
                    inactive: 'bg-green-100 text-green-800 border-2 border-green-400 shadow-sm font-bold hover:bg-green-200'
                },
                'tabParts': { 
                    active: 'bg-cyan-600 text-white shadow-lg ring-2 ring-cyan-600 ring-offset-2 font-bold',
                    inactive: 'bg-cyan-100 text-cyan-800 border-2 border-cyan-400 shadow-sm font-bold hover:bg-cyan-200'
                },
                'tabExpenses': { 
                    active: 'bg-orange-600 text-white shadow-lg ring-2 ring-orange-600 ring-offset-2 font-bold',
                    inactive: 'bg-orange-100 text-orange-800 border-2 border-orange-400 shadow-sm font-bold hover:bg-orange-200'
                },
                'tabPersonal': { 
                    active: 'bg-purple-600 text-white shadow-lg ring-2 ring-purple-600 ring-offset-2 font-bold',
                    inactive: 'bg-purple-100 text-purple-800 border-2 border-purple-400 shadow-sm font-bold hover:bg-purple-200'
                }
            };
            
            // All possible classes to remove (comprehensive list)
            const removeClasses = [
                // Backgrounds
                'bg-blue-600', 'bg-green-600', 'bg-cyan-600', 'bg-orange-600', 'bg-purple-600',
                'bg-blue-100', 'bg-green-100', 'bg-cyan-100', 'bg-orange-100', 'bg-purple-100', 'bg-white',
                // Text colors
                'text-white', 'text-blue-700', 'text-green-700', 'text-cyan-700', 'text-orange-700', 'text-purple-700',
                'text-blue-800', 'text-green-800', 'text-cyan-800', 'text-orange-800', 'text-purple-800',
                // Shadows
                'shadow-lg', 'shadow-sm', 'shadow-md',
                // Ring
                'ring-2', 'ring-blue-600', 'ring-green-600', 'ring-cyan-600', 'ring-orange-600', 'ring-purple-600', 'ring-offset-2',
                // Borders
                'border-2', 'border-blue-400', 'border-green-400', 'border-cyan-400', 'border-orange-400', 'border-purple-400',
                // Font
                'font-bold', 'font-semibold'
            ];
            
            // Determine active tab
            let activeBtnId = 'tabAll';
            if (type === 'car') {
                activeBtnId = status === 'stock' ? 'tabStock' : 'tabAll';
            } else if (type === 'personal') {
                activeBtnId = 'tabPersonal';
            } else if (type === 'part') {
                activeBtnId = 'tabParts';
            } else if (type === 'expense') {
                activeBtnId = 'tabExpenses';
            }

            // Apply styles
            Object.keys(tabConfig).forEach(id => {
                const btn = document.getElementById(id);
                if (btn) {
                    // Remove all possible styling classes
                    btn.classList.remove(...removeClasses);
                    // Add new style
                    const style = id === activeBtnId ? tabConfig[id].active : tabConfig[id].inactive;
                    btn.classList.add(...style.split(' '));
                }
            });

            // Hide all sections
            const carSection = document.getElementById('carSection');
            const partSection = document.getElementById('partSection');
            const expenseSection = document.getElementById('expenseSection');
            const personalSection = document.getElementById('personalSection');
            
            carSection.classList.add('hidden');
            partSection.classList.add('hidden');
            if(expenseSection) expenseSection.classList.add('hidden');
            if(personalSection) personalSection.classList.add('hidden');

            // Hide/Show Add Buttons
            const btnAddCar = document.getElementById('btnAddCar');
            const btnAddPart = document.getElementById('btnAddPart');
            const btnAddExpense = document.getElementById('btnAddExpense');
            
            btnAddCar.classList.add('hidden');
            btnAddPart.classList.add('hidden');
            btnAddPart.classList.add('hidden');
            const btnAddPersonal = document.getElementById('btnAddPersonal');
            if(btnAddPersonal) btnAddPersonal.classList.add('hidden');
            if(btnAddExpense) btnAddExpense.classList.add('hidden');

            if (type === 'part') {
                partSection.classList.remove('hidden');
                btnAddPart.classList.remove('hidden');
            } else if (type === 'expense') {
                if(expenseSection) expenseSection.classList.remove('hidden');
                if(btnAddExpense) btnAddExpense.classList.remove('hidden');
            } else if (type === 'personal') {
                if(personalSection) personalSection.classList.remove('hidden');
                if(btnAddPersonal) btnAddPersonal.classList.remove('hidden');
            } else {
                carSection.classList.remove('hidden');
                if (status === 'stock' || status === 'all' || status === 'profit') {
                    btnAddCar.classList.remove('hidden');
                }
                
                // Filter Car Table
                const rows = document.querySelectorAll('#carTable tbody tr');
                rows.forEach(row => {
                    const rowStatus = row.getAttribute('data-status');
                    const isProfitStock = row.getAttribute('data-is-profit-stock') === '1';

                    if (status === 'all') {
                        row.classList.remove('hidden');
                    } else if (status === 'profit') {
                        // Special filter for Profit Stock
                        if (rowStatus === 'stock' && isProfitStock) {
                             row.classList.remove('hidden');
                        } else {
                             row.classList.add('hidden');
                        }
                    } else if (rowStatus === status) {
                        row.classList.remove('hidden');
                    } else {
                        row.classList.add('hidden');
                    }
                });
            }
        }

        // Parts Management Functions
        function usePart(part) {
            document.getElementById('usePartForm').action = '/parts/' + part.id + '/use';
            document.getElementById('usePartName').value = part.name;
            document.getElementById('useQuantity').max = part.quantity;
            document.getElementById('maxQuantity').innerText = part.quantity;
            document.getElementById('usePartModal').classList.remove('hidden');
        }

        function editPart(part) {
            document.getElementById('editPartForm').action = '/parts/' + part.id;
            document.getElementById('editPartNameInput').value = part.name;
            document.getElementById('editPartPriceInput').value = part.unit_price;
            document.getElementById('editPartQuantityInput').value = part.quantity;
            document.getElementById('editPartModal').classList.remove('hidden');
        }

        function editExpense(id, name, dateStr, amount, description, transactionType, imagePath) {
            console.log('editExpense called with id:', id, 'amount:', amount);
            
            document.getElementById('editExpenseForm').action = '/capital-expenses/' + id;
            document.getElementById('editExpenseName').value = name;
            
            // Format date to YYYY-MM-DD for input type="date"
            let date = new Date(dateStr);
            let formattedDate = date.toISOString().split('T')[0];
            document.getElementById('editExpenseDate').value = formattedDate;
            
            document.getElementById('editExpenseDescription').value = description || '';
            
            // Set transaction type
            if (typeof selectEditTransactionType === 'function') {
                selectEditTransactionType(transactionType || 'increase');
            }
            
            // Reset sub-items list
            if (typeof editExpenseSubItems !== 'undefined') {
                editExpenseSubItems = [];
                if (typeof renderEditSubItems === 'function') {
                    renderEditSubItems();
                }
            }

            // Show existing image
            var currentImgDiv = document.getElementById('editExpenseCurrentImage');
            if (imagePath && imagePath !== '') {
                document.getElementById('editExpenseCurrentImageSrc').src = '/img/' + imagePath;
                currentImgDiv.classList.remove('hidden');
            } else {
                currentImgDiv.classList.add('hidden');
            }
            document.getElementById('editExpenseImagePreview').innerHTML = '';
            
            // Show modal FIRST
            document.getElementById('editExpenseModal').classList.remove('hidden');
            
            // Set amount with data-original for sub-item calculations
            var amountField = document.getElementById('editExpenseAmount');
            amountField.value = amount;
            amountField.setAttribute('data-original', amount);
        }

        function updateGalleryImage() {
            var img = document.getElementById('galleryImage');
            img.src = galleryImages[currentGalleryIndex];
            
            var counter = document.getElementById('galleryCounter');
            counter.innerText = (currentGalleryIndex + 1) + ' / ' + galleryImages.length;
        }

        // Image Preview Functions
        function previewAddCarImages(input) {
            var preview = document.getElementById('addCarImagePreview');
            preview.innerHTML = '';
            if (!input.files || input.files.length === 0) return;
            
            for (var i = 0; i < input.files.length; i++) {
                (function(file) {
                    var reader = new FileReader();
                    reader.onload = function(e) {
                        var div = document.createElement('div');
                        div.className = 'relative group';
                        div.innerHTML = '<img src="' + e.target.result + '" class="w-full h-16 object-cover rounded-lg border border-gray-200 shadow-sm">' +
                            '<div class="absolute bottom-0 left-0 right-0 bg-black/50 text-white text-center text-[10px] py-0.5 rounded-b-lg truncate px-1">' + file.name + '</div>';
                        preview.appendChild(div);
                    };
                    reader.readAsDataURL(file);
                })(input.files[i]);
            }
        }

        function previewSingleImage(input, previewId) {
            var preview = document.getElementById(previewId);
            preview.innerHTML = '';
            if (!input.files || !input.files[0]) return;
            
            var reader = new FileReader();
            reader.onload = function(e) {
                preview.innerHTML = '<div class="relative inline-block">' +
                    '<img src="' + e.target.result + '" class="w-24 h-24 object-cover rounded-lg border border-gray-200 shadow-sm">' +
                    '<span class="text-xs text-blue-500 block mt-1">รูปใหม่</span></div>';
            };
            reader.readAsDataURL(input.files[0]);
        }

        function toggleRefurbForm(carId) {
            var form = document.getElementById('refurbForm' + carId);
            if (form.classList.contains('hidden')) {
                form.classList.remove('hidden');
            } else {
                form.classList.add('hidden');
            }
        }

        function submitRefurb(carId) {
            var name = document.getElementById('refurbName' + carId).value;
            var amount = document.getElementById('refurbAmount' + carId).value;
            
            if (!name || !amount) {
                alert('กรุณากรอกข้อมูลให้ครบ');
                return;
            }

            var form = document.getElementById('refurbSubmitForm');
            form.action = '/cars/' + carId + '/refurbishments';
            document.getElementById('refurbSubmitName').value = name;
            document.getElementById('refurbSubmitAmount').value = amount;
            form.submit();
        }

        function deleteImage(imageId) {
            if (confirm('ต้องการลบรูปภาพนี้หรือไม่?')) {
                var form = document.getElementById('imageDeleteForm');
                form.action = '/car-images/' + imageId;
                form.submit();
            }
        }

        function filterTable() {
            const searchInput = document.getElementById('searchInput').value.toLowerCase();
            
            // Determine active table
            const isPartTab = !document.getElementById('partSection').classList.contains('hidden');
            const isPersonalTab = !document.getElementById('personalSection').classList.contains('hidden');
            const isExpenseTab = !document.getElementById('expenseSection').classList.contains('hidden');
            
            let tableId = 'carTable';
            if (isPartTab) tableId = 'partTable';
            else if (isPersonalTab) tableId = 'personalTable';
            else if (isExpenseTab) tableId = 'expenseTable';

            const rows = document.querySelectorAll(`#${tableId} tbody tr`);

            rows.forEach(row => {
                const text = row.innerText.toLowerCase();
                
                let shouldBeVisible = text.includes(searchInput);

                // For cars, we also need to respect the current status filter
                if (tableId === 'carTable') {
                    const rowStatus = row.getAttribute('data-status');
                    
                    // Determine current active status tab
                    const tabAllActive = document.getElementById('tabAll').classList.contains('bg-blue-500');
                    const tabStockActive = document.getElementById('tabStock').classList.contains('bg-green-500');
                    
                    if (!tabAllActive) { 
                        if (tabStockActive && rowStatus !== 'stock') {
                            shouldBeVisible = false;
                        }
                    }
                }

                if (shouldBeVisible) {
                     row.classList.remove('hidden');
                     row.style.display = ''; // Reset inline style if any
                } else {
                    row.classList.add('hidden');
                    row.style.display = 'none'; // Explicitly hide
                }
            });
        }
        
        function openPersonalModal(type) {
            document.getElementById('personalTransactionType').value = type;
            const title = type === 'income' ? 'บันทึกรายรับ' : 'บันทึกรายจ่าย';
            document.getElementById('personalModalTitle').innerText = title;
            
            // Sync UI manually
            updatePersonalTheme(type);
            
            document.getElementById('addPersonalTransactionModal').classList.remove('hidden');
        }

        function updatePersonalTheme(type) {
            // Type can be a string ('income'/'expense') or the radio element itself (legacy support, though we replaced onclick)
            // But since we put onclick="updatePersonalTheme('income')" on the label, type is a string.
            if (typeof type !== 'string') {
                 type = type.value;
            }

            const btnSubmit = document.getElementById('btnPersonalSubmit');
            const btnIncome = document.getElementById('btnSelectIncome');
            const btnExpense = document.getElementById('btnSelectExpense');
            const radioIncome = document.querySelector('input[name="type"][value="income"]');
            const radioExpense = document.querySelector('input[name="type"][value="expense"]');

            if (type === 'income') {
                // Set Radio
                radioIncome.checked = true;
                
                // Set Button Styles
                btnIncome.className = 'py-2 text-center rounded-md text-sm font-medium transition-all bg-green-600 text-white shadow';
                btnIncome.style.cssText = 'background-color: #16a34a; color: white;';
                
                btnExpense.className = 'py-2 text-center rounded-md text-sm font-medium transition-all text-gray-500 hover:bg-gray-200';
                btnExpense.style.cssText = 'background-color: transparent; color: #6b7280;';
                
                // Submit Button Theme
                btnSubmit.classList.remove('bg-red-600', 'hover:bg-red-700');
                btnSubmit.classList.add('bg-green-600', 'hover:bg-green-700');
                btnSubmit.style.backgroundColor = '#16a34a'; // Force Green
                
                // Set Hidden Input for Title/Logic if needed
                document.getElementById('personalTransactionType').value = 'income';
                
            } else {
                // Set Radio
                radioExpense.checked = true;
                
                // Set Button Styles
                btnIncome.className = 'py-2 text-center rounded-md text-sm font-medium transition-all text-gray-500 hover:bg-gray-200';
                btnIncome.style.cssText = 'background-color: transparent; color: #6b7280;';
                
                btnExpense.className = 'py-2 text-center rounded-md text-sm font-medium transition-all bg-red-600 text-white shadow';
                btnExpense.style.cssText = 'background-color: #dc2626; color: white;';
                
                // Submit Button Theme
                btnSubmit.classList.remove('bg-green-600', 'hover:bg-green-700');
                btnSubmit.classList.add('bg-red-600', 'hover:bg-red-700');
                btnSubmit.style.backgroundColor = '#dc2626'; // Force Red
                
                // Set Hidden Input
                document.getElementById('personalTransactionType').value = 'expense';
            }
        }

        // Auto-switch to Parts tab if URL has ?tab=parts
        document.addEventListener('DOMContentLoaded', function() {
            const urlParams = new URLSearchParams(window.location.search);
            const activeTab = urlParams.get('tab');
            if (activeTab === 'parts') {
                switchTab('part', 'all');
            } else {
                switchTab('car', 'stock');
            }
        });
        
        // Auto-open Add Car Modal if there are errors
        @if($errors->any())
            alert('มีข้อผิดพลาดในข้อมูลที่กรอก: \n' + {!! json_encode(implode('\n', $errors->all())) !!});
            @if($errors->has('brand') || $errors->has('model') || $errors->has('year'))
                 document.getElementById('addCarModal').classList.remove('hidden');
            @endif
        @endif

        // Real-time license plate validation
        function setupLicensePlateValidation(inputId, errorId, excludeId = null) {
            const input = document.getElementById(inputId);
            const errorElement = document.getElementById(errorId);
            let timeout = null;

            if (!input) return;

            input.addEventListener('input', function() {
                const licensePlate = this.value;
                
                // Clear previous timeout
                if (timeout) clearTimeout(timeout);

                // Clear JS error
                errorElement.innerText = '';
                errorElement.classList.add('hidden');
                
                // Clear Backend Error (if exists as a sibling p tag)
                const siblingError = input.parentNode.querySelector('p:not([id="' + errorId + '"])');
                if (siblingError) siblingError.style.display = 'none';

                input.classList.remove('border-red-500');

                if (!licensePlate) return;

                // Set new timeout to check after user stops typing
                timeout = setTimeout(function() {
                    fetch('{{ route("cars.checkLicensePlate") }}', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        body: JSON.stringify({
                            license_plate: licensePlate,
                            exclude_id: excludeId
                        })
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.exists) {
                            errorElement.innerText = 'เลขทะเบียนนี้มีในระบบแล้ว';
                            errorElement.classList.remove('hidden');
                            errorElement.classList.remove('text-red-500'); // Remove red text
                            errorElement.classList.add('text-black'); // Add black text per request
                            input.classList.add('border-red-500'); // Ensure red border
                        }
                    });
                }, 500); // Wait 500ms
            });
        }

        // Sell Car Modal Logic
        let currentSellCost = 0;

        function openSellModal(carId, totalCost, defaultPrice) {
            currentSellCost = totalCost;
            
            // Set Form Action
            const form = document.getElementById('sellCarForm');
            form.action = '/cars/' + carId + '/sold';
            
            // Set Display Values
            document.getElementById('displayTotalCost').value = new Intl.NumberFormat().format(totalCost);
            
            const initialPrice = defaultPrice || totalCost; // Default to cost if no selling price
            const inputPrice = document.getElementById('inputSoldPrice');
            inputPrice.value = initialPrice;
            
            // Calc initial profit
            calculateProfit(initialPrice);

            // Show Modal
            document.getElementById('sellCarModal').classList.remove('hidden');
            // Small delay to ensure modal is visible before focusing
            setTimeout(() => inputPrice.focus(), 100);
        }

        document.getElementById('inputSoldPrice').addEventListener('input', function() {
            calculateProfit(this.value);
        });

        function calculateProfit(price) {
            const profit = price - currentSellCost;
            const display = document.getElementById('displayProfit');
            display.innerText = '฿' + new Intl.NumberFormat().format(profit);
            
            if(profit >= 0) {
                display.classList.remove('text-red-600');
                display.classList.add('text-green-600');
            } else {
                display.classList.remove('text-green-600');
                display.classList.add('text-red-600');
            }
        }

        function submitSellForm() {
            const price = document.getElementById('inputSoldPrice').value;
            if(!price) { alert('กรุณาระบุราคาขาย'); return; }
            document.getElementById('finalSoldPrice').value = price;
            document.getElementById('sellCarForm').submit();
        }

        // Setup validation for Add Modal
        // Note: We need to add IDs to the inputs first!
        document.addEventListener('DOMContentLoaded', function() {
            setupLicensePlateValidation('addLicensePlate', 'addLicensePlateError');
            
            // For Edit Modals, we iterate over all cars
            @foreach($cars as $car)
                setupLicensePlateValidation('editLicensePlate{{ $car->id }}', 'editLicensePlateError{{ $car->id }}', {{ $car->id }});
            @endforeach
        });

        function openEditModal(carId) {
            var m = document.getElementById('editCarModal' + carId);
            if (!m) { alert('editCarModal' + carId + ' not found!'); return; }
            // Move to body to escape any stacking context
            document.body.appendChild(m);
            // Remove hidden class
            m.classList.remove('hidden');
            // Force display with inline styles to override everything
            m.style.cssText = 'display:block !important; position:fixed !important; top:0 !important; left:0 !important; right:0 !important; bottom:0 !important; z-index:99999 !important; background:rgba(31,41,55,0.75); overflow-y:auto !important; height:100% !important; width:100% !important; -webkit-overflow-scrolling:touch;';
        }

        function closeEditModal(carId) {
            var m = document.getElementById('editCarModal' + carId);
            if (!m) return;
            m.style.cssText = 'display:none !important;';
            m.classList.add('hidden');
        }

        function toggleDailyGroup(date) {
            const list = document.getElementById('daily-' + date);
            const icon = document.getElementById('icon-' + date);
            
            if (list.classList.contains('hidden')) {
                list.classList.remove('hidden');
                icon.style.transform = 'rotate(180deg)';
                icon.classList.add('bg-blue-100', 'text-blue-600');
                icon.classList.remove('bg-gray-200', 'text-gray-600');
            } else {
                list.classList.add('hidden');
                icon.style.transform = 'rotate(0deg)';
                icon.classList.remove('bg-blue-100', 'text-blue-600');
                icon.classList.add('bg-gray-200', 'text-gray-600');
            }
        }

        // ========== Feature 6: Auto-format Money Inputs ==========
        function formatNumberWithCommas(value) {
            // Remove any existing commas and non-numeric characters except decimal
            const numericValue = value.replace(/[^0-9.]/g, '');
            // Split by decimal point
            const parts = numericValue.split('.');
            // Add commas to the integer part
            parts[0] = parts[0].replace(/\B(?=(\d{3})+(?!\d))/g, ',');
            return parts.join('.');
        }

        function setupMoneyInputs() {
            // Select all number inputs that should be formatted
            const moneyInputs = document.querySelectorAll('input[type="number"], input.money-input');
            
            moneyInputs.forEach(input => {
                // Skip if already setup
                if (input.dataset.moneySetup) return;
                input.dataset.moneySetup = 'true';
                
                // Create a display input overlay
                const wrapper = document.createElement('div');
                wrapper.className = 'relative';
                wrapper.style.display = 'contents';
                
                // Create formatted display
                const display = document.createElement('input');
                display.type = 'text';
                display.inputMode = 'numeric';
                display.className = input.className;
                display.placeholder = input.placeholder;
                display.required = input.required;
                display.id = input.id ? input.id + '_display' : '';
                
                // Copy initial value if any
                if (input.value) {
                    display.value = formatNumberWithCommas(input.value);
                }
                
                // Hide original input but keep it in DOM for form submission
                input.style.display = 'none';
                input.removeAttribute('required'); // Remove required from hidden
                
                // Insert display after input
                input.parentNode.insertBefore(display, input.nextSibling);
                
                // Sync display to hidden input
                display.addEventListener('input', function(e) {
                    let rawValue = this.value.replace(/,/g, '');
                    // Remove non-numeric except decimal
                    rawValue = rawValue.replace(/[^0-9.]/g, '');
                    // Update hidden input with raw value
                    input.value = rawValue;
                    // Update display with formatted value
                    this.value = formatNumberWithCommas(rawValue);
                    
                    // Auto-calculate profit when inputSoldPrice changes
                    if (input.id === 'inputSoldPrice' && typeof calculateProfit === 'function') {
                        calculateProfit(rawValue);
                    }
                });
                
                // Handle focus - select all
                display.addEventListener('focus', function() {
                    this.select();
                });
            });
        }

        // Initialize on page load
        document.addEventListener('DOMContentLoaded', function() {
            setupMoneyInputs();
            
            // Also setup for dynamically opened modals
            const observer = new MutationObserver(function(mutations) {
                mutations.forEach(function(mutation) {
                    if (mutation.type === 'attributes' && mutation.attributeName === 'class') {
                        const target = mutation.target;
                        if (target.classList.contains('fixed') && !target.classList.contains('hidden')) {
                            // Modal was shown, setup money inputs inside
                            setTimeout(setupMoneyInputs, 100);
                        }
                    }
                });
            });
            
            // Observe modals
            document.querySelectorAll('[id*="Modal"]').forEach(modal => {
                observer.observe(modal, { attributes: true });
            });
        });

        // ========== Feature 8: Close Sale for Capital Expenses ==========
        function openExpenseSellModal(expenseId, name, originalAmount) {
            // Create modal dynamically if it doesn't exist
            let modal = document.getElementById('expenseSellModal');
            if (!modal) {
                modal = document.createElement('div');
                modal.id = 'expenseSellModal';
                modal.className = 'fixed inset-0 bg-black bg-opacity-50 z-50 flex items-center justify-center';
                modal.innerHTML = `
                    <div class="bg-white rounded-lg w-full max-w-md p-6 mx-4">
                        <h3 class="text-xl font-bold mb-4 text-purple-700">💰 ปิดขายรายการทุน</h3>
                        <form id="expenseSellForm" method="POST">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <div class="mb-4">
                                <label class="block text-gray-700 text-sm font-bold mb-2">รายการ</label>
                                <p id="expenseSellName" class="text-lg font-medium text-gray-800"></p>
                            </div>
                            <div class="mb-4">
                                <label class="block text-gray-700 text-sm font-bold mb-2">ต้นทุนเดิม</label>
                                <p id="expenseSellOriginal" class="text-lg font-bold text-orange-600"></p>
                            </div>
                            <div class="mb-4">
                                <label class="block text-gray-700 text-sm font-bold mb-2">ราคาขาย/รับคืน</label>
                                <input type="number" name="sold_price" id="expenseSellPrice" class="w-full border rounded px-3 py-2 focus:ring-2 focus:ring-purple-500" placeholder="ระบุจำนวนเงินที่ได้รับ" required>
                            </div>
                            <div class="mb-6">
                                <label class="block text-gray-700 text-sm font-bold mb-2">กำไร/ขาดทุน</label>
                                <div id="expenseSellProfit" class="text-2xl font-bold text-green-600">฿0</div>
                            </div>
                            <div class="flex justify-end gap-2">
                                <button type="button" onclick="closeExpenseSellModal()" class="px-4 py-2 bg-gray-200 text-gray-800 rounded hover:bg-gray-300">ยกเลิก</button>
                                <button type="submit" class="px-4 py-2 bg-purple-600 text-white rounded hover:bg-purple-700">ยืนยันปิดขาย</button>
                            </div>
                        </form>
                    </div>
                `;
                document.body.appendChild(modal);
                
                // Setup profit calculation
                document.getElementById('expenseSellPrice').addEventListener('input', function() {
                    const soldPrice = parseFloat(this.value) || 0;
                    const original = parseFloat(document.getElementById('expenseSellOriginal').dataset.amount) || 0;
                    const profit = soldPrice - original;
                    const profitEl = document.getElementById('expenseSellProfit');
                    profitEl.textContent = (profit >= 0 ? '+' : '') + '฿' + profit.toLocaleString();
                    profitEl.className = 'text-2xl font-bold ' + (profit >= 0 ? 'text-green-600' : 'text-red-600');
                });
            }
            
            // Populate modal
            document.getElementById('expenseSellForm').action = '/capital-expenses/' + expenseId + '/sold';
            document.getElementById('expenseSellName').textContent = name;
            document.getElementById('expenseSellOriginal').textContent = '฿' + originalAmount.toLocaleString();
            document.getElementById('expenseSellOriginal').dataset.amount = originalAmount;
            document.getElementById('expenseSellPrice').value = '';
            document.getElementById('expenseSellProfit').textContent = '฿0';
            
            modal.classList.remove('hidden');
        }
        
        function closeExpenseSellModal() {
            document.getElementById('expenseSellModal').classList.add('hidden');
        }

        // Feature 7: Transaction Type Toggle
        function selectTransactionType(type) {
            const btnIncrease = document.getElementById('btnIncrease');
            const btnDecrease = document.getElementById('btnDecrease');
            const input = document.getElementById('transactionTypeInput');
            
            if (type === 'increase') {
                input.value = 'increase';
                // Active: Green
                btnIncrease.className = 'flex-1 text-center py-2.5 px-4 rounded-lg border-2 cursor-pointer transition-all font-medium text-sm bg-emerald-500 text-white border-emerald-500 shadow-md';
                // Inactive: Gray
                btnDecrease.className = 'flex-1 text-center py-2.5 px-4 rounded-lg border-2 cursor-pointer transition-all font-medium text-sm bg-gray-100 text-gray-600 border-gray-200 hover:border-red-300';
            } else {
                input.value = 'decrease';
                // Inactive: Gray
                btnIncrease.className = 'flex-1 text-center py-2.5 px-4 rounded-lg border-2 cursor-pointer transition-all font-medium text-sm bg-gray-100 text-gray-600 border-gray-200 hover:border-emerald-300';
                // Active: Red
                btnDecrease.className = 'flex-1 text-center py-2.5 px-4 rounded-lg border-2 cursor-pointer transition-all font-medium text-sm bg-red-500 text-white border-red-500 shadow-md';
            }
        }

    </script>

    <script>
        function openSettingModal() {
            var m = document.getElementById('settingModal');
            if (!m) { alert('settingModal not found!'); return; }
            // Move to body to escape any stacking context
            document.body.appendChild(m);
            // Remove hidden class
            m.classList.remove('hidden');
            // Force display with inline styles to override everything
            m.style.cssText = 'display:flex !important; position:fixed !important; top:0 !important; left:0 !important; right:0 !important; bottom:0 !important; z-index:99999 !important; align-items:flex-start; justify-content:center; padding-top:2.5rem; background:rgba(31,41,55,0.75); overflow-y:auto; height:100%; width:100%;';
        }

        function closeSettingModal() {
            var m = document.getElementById('settingModal');
            if (!m) return;
            m.style.cssText = 'display:none !important;';
            m.classList.add('hidden');
        }
    </script>

</body>

</html>