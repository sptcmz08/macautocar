<!DOCTYPE html>
<html lang="th">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>บัญชีส่วนตัว | Personal Finance</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Prompt:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Prompt', sans-serif;
        }

        body {
            min-height: 100vh;
            background: linear-gradient(135deg, #0f0c29 0%, #302b63 50%, #24243e 100%);
            color: #fff;
            padding-bottom: 100px;
        }

        /* Animated Background */
        .bg-animation {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: 0;
            overflow: hidden;
            pointer-events: none;
        }

        .bg-animation::before {
            content: '';
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: radial-gradient(circle at 20% 80%, rgba(120, 119, 198, 0.3) 0%, transparent 50%),
                        radial-gradient(circle at 80% 20%, rgba(255, 119, 198, 0.2) 0%, transparent 50%),
                        radial-gradient(circle at 40% 40%, rgba(120, 219, 255, 0.15) 0%, transparent 40%);
            animation: floatBg 20s ease-in-out infinite;
        }

        @keyframes floatBg {
            0%, 100% { transform: translate(0, 0) rotate(0deg); }
            25% { transform: translate(2%, 2%) rotate(1deg); }
            50% { transform: translate(-1%, 3%) rotate(-1deg); }
            75% { transform: translate(1%, -2%) rotate(0.5deg); }
        }

        /* Header */
        .header {
            position: relative;
            z-index: 10;
            padding: 24px 20px;
            background: linear-gradient(135deg, rgba(139, 92, 246, 0.9) 0%, rgba(236, 72, 153, 0.9) 100%);
            backdrop-filter: blur(20px);
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        }

        .header-content {
            max-width: 500px;
            margin: 0 auto;
            display: flex;
            align-items: center;
            gap: 16px;
        }

        .back-btn {
            width: 44px;
            height: 44px;
            background: rgba(255, 255, 255, 0.2);
            border: none;
            border-radius: 14px;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: all 0.3s ease;
            text-decoration: none;
            color: white;
        }

        .back-btn:hover {
            background: rgba(255, 255, 255, 0.3);
            transform: translateX(-3px);
        }

        .header-icon {
            width: 52px;
            height: 52px;
            background: rgba(255, 255, 255, 0.25);
            border-radius: 16px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 26px;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.2);
        }

        .header-text h1 {
            font-size: 22px;
            font-weight: 700;
            margin-bottom: 2px;
        }

        .header-text p {
            font-size: 13px;
            opacity: 0.85;
        }

        /* Main Content */
        .main-content {
            position: relative;
            z-index: 10;
            max-width: 500px;
            margin: 0 auto;
            padding: 20px;
        }

        /* Summary Cards Container */
        .summary-container {
            display: grid;
            grid-template-columns: 1fr;
            gap: 16px;
            margin-bottom: 24px;
        }

        /* Main Balance Card */
        .balance-card {
            background: linear-gradient(135deg, rgba(255, 255, 255, 0.15) 0%, rgba(255, 255, 255, 0.05) 100%);
            backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.2);
            border-radius: 24px;
            padding: 28px;
            text-align: center;
            position: relative;
            overflow: hidden;
        }

        .balance-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(90deg, #8b5cf6, #ec4899, #f59e0b);
        }

        .balance-label {
            font-size: 14px;
            color: rgba(255, 255, 255, 0.7);
            margin-bottom: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
        }

        .balance-amount {
            font-size: 42px;
            font-weight: 800;
            background: linear-gradient(135deg, #fff 0%, #e0e7ff 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        /* Income/Expense Cards */
        .stats-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 12px;
        }

        .stat-card {
            background: rgba(255, 255, 255, 0.08);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 20px;
            padding: 20px;
            text-align: center;
            transition: all 0.3s ease;
        }

        .stat-card:hover {
            transform: translateY(-4px);
            background: rgba(255, 255, 255, 0.12);
        }

        .stat-card.income {
            border-left: 4px solid #10b981;
        }

        .stat-card.expense {
            border-left: 4px solid #f43f5e;
        }

        .stat-icon {
            width: 48px;
            height: 48px;
            border-radius: 14px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 22px;
            margin: 0 auto 12px;
        }

        .stat-card.income .stat-icon {
            background: linear-gradient(135deg, #10b981 0%, #059669 100%);
            box-shadow: 0 8px 24px rgba(16, 185, 129, 0.4);
        }

        .stat-card.expense .stat-icon {
            background: linear-gradient(135deg, #f43f5e 0%, #e11d48 100%);
            box-shadow: 0 8px 24px rgba(244, 63, 94, 0.4);
        }

        .stat-label {
            font-size: 13px;
            color: rgba(255, 255, 255, 0.6);
            margin-bottom: 6px;
        }

        .stat-amount {
            font-size: 24px;
            font-weight: 700;
        }

        .stat-card.income .stat-amount {
            color: #34d399;
        }

        .stat-card.expense .stat-amount {
            color: #fb7185;
        }

        /* Action Buttons */
        .action-buttons {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 12px;
            margin-bottom: 28px;
        }

        .action-btn {
            padding: 18px 20px;
            border: none;
            border-radius: 18px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        .action-btn::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
            transition: left 0.5s ease;
        }

        .action-btn:hover::before {
            left: 100%;
        }

        .action-btn.income {
            background: linear-gradient(135deg, #10b981 0%, #059669 100%);
            color: white;
            box-shadow: 0 10px 30px rgba(16, 185, 129, 0.4);
        }

        .action-btn.income:hover {
            transform: translateY(-3px);
            box-shadow: 0 15px 40px rgba(16, 185, 129, 0.5);
        }

        .action-btn.expense {
            background: linear-gradient(135deg, #f43f5e 0%, #e11d48 100%);
            color: white;
            box-shadow: 0 10px 30px rgba(244, 63, 94, 0.4);
        }

        .action-btn.expense:hover {
            transform: translateY(-3px);
            box-shadow: 0 15px 40px rgba(244, 63, 94, 0.5);
        }

        /* Section Title */
        .section-title {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 16px;
        }

        .section-title h2 {
            font-size: 18px;
            font-weight: 600;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .section-title h2::before {
            content: '';
            width: 4px;
            height: 20px;
            background: linear-gradient(to bottom, #8b5cf6, #ec4899);
            border-radius: 2px;
        }

        .section-title span {
            font-size: 13px;
            color: rgba(255, 255, 255, 0.5);
        }

        /* Transaction Cards */
        .transaction-list {
            display: flex;
            flex-direction: column;
            gap: 12px;
        }

        .date-group {
            background: rgba(255, 255, 255, 0.08);
            backdrop-filter: blur(15px);
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 20px;
            overflow: hidden;
            transition: all 0.3s ease;
        }

        .date-group:hover {
            background: rgba(255, 255, 255, 0.1);
        }

        .date-header {
            padding: 18px 20px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            cursor: pointer;
            transition: background 0.2s ease;
        }

        .date-header:hover {
            background: rgba(255, 255, 255, 0.05);
        }

        .date-info {
            display: flex;
            align-items: center;
            gap: 14px;
        }

        .date-badge {
            width: 56px;
            height: 56px;
            background: linear-gradient(135deg, #8b5cf6 0%, #7c3aed 100%);
            border-radius: 16px;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            box-shadow: 0 8px 24px rgba(139, 92, 246, 0.4);
        }

        .date-badge .day {
            font-size: 22px;
            font-weight: 700;
            line-height: 1;
        }

        .date-badge .month {
            font-size: 10px;
            text-transform: uppercase;
            opacity: 0.8;
        }

        .date-text h3 {
            font-size: 16px;
            font-weight: 600;
            margin-bottom: 2px;
        }

        .date-text p {
            font-size: 12px;
            color: rgba(255, 255, 255, 0.5);
        }

        .date-summary {
            text-align: right;
            display: flex;
            align-items: center;
            gap: 16px;
        }

        .date-total {
            font-size: 18px;
            font-weight: 700;
        }

        .date-total.positive { color: #34d399; }
        .date-total.negative { color: #fb7185; }

        .date-breakdown {
            display: flex;
            gap: 12px;
            font-size: 12px;
            margin-top: 4px;
        }

        .date-breakdown .income { color: #34d399; }
        .date-breakdown .expense { color: #fb7185; }

        .chevron {
            width: 36px;
            height: 36px;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.3s ease;
        }

        .chevron.open {
            transform: rotate(180deg);
            background: rgba(139, 92, 246, 0.3);
        }

        /* Transaction Items */
        .transaction-items {
            max-height: 0;
            overflow: hidden;
            transition: max-height 0.4s ease;
        }

        .transaction-items.open {
            max-height: 2000px;
        }

        .transaction-item {
            padding: 16px 20px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            border-top: 1px solid rgba(255, 255, 255, 0.05);
            transition: background 0.2s ease;
        }

        .transaction-item:hover {
            background: rgba(255, 255, 255, 0.03);
        }

        .tx-info {
            display: flex;
            align-items: center;
            gap: 14px;
        }

        .tx-icon {
            width: 44px;
            height: 44px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 18px;
        }

        .tx-icon.income {
            background: rgba(16, 185, 129, 0.2);
            color: #34d399;
        }

        .tx-icon.expense {
            background: rgba(244, 63, 94, 0.2);
            color: #fb7185;
        }

        .tx-details h4 {
            font-size: 15px;
            font-weight: 500;
            margin-bottom: 2px;
        }

        .tx-details span {
            font-size: 12px;
            color: rgba(255, 255, 255, 0.4);
        }

        .tx-amount-section {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .tx-amount {
            font-size: 17px;
            font-weight: 700;
        }

        .tx-amount.income { color: #34d399; }
        .tx-amount.expense { color: #fb7185; }

        .delete-btn {
            width: 36px;
            height: 36px;
            background: rgba(244, 63, 94, 0.1);
            border: none;
            border-radius: 10px;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #fb7185;
            transition: all 0.2s ease;
        }

        .delete-btn:hover {
            background: #f43f5e;
            color: white;
            transform: scale(1.1);
        }

        /* Empty State */
        .empty-state {
            background: rgba(255, 255, 255, 0.08);
            backdrop-filter: blur(15px);
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 24px;
            padding: 48px 24px;
            text-align: center;
        }

        .empty-icon {
            width: 80px;
            height: 80px;
            background: linear-gradient(135deg, rgba(139, 92, 246, 0.2) 0%, rgba(236, 72, 153, 0.2) 100%);
            border-radius: 24px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 36px;
            margin: 0 auto 20px;
        }

        .empty-state h3 {
            font-size: 18px;
            font-weight: 600;
            margin-bottom: 8px;
        }

        .empty-state p {
            font-size: 14px;
            color: rgba(255, 255, 255, 0.5);
        }

        /* Bottom Navigation */
        .bottom-nav {
            position: fixed;
            bottom: 0;
            left: 0;
            right: 0;
            padding: 16px 20px 24px;
            background: linear-gradient(to top, rgba(15, 12, 41, 0.98) 0%, rgba(15, 12, 41, 0.9) 100%);
            backdrop-filter: blur(20px);
            border-top: 1px solid rgba(255, 255, 255, 0.1);
            z-index: 100;
        }

        .bottom-nav-content {
            max-width: 500px;
            margin: 0 auto;
        }

        .home-btn {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 12px;
            width: 100%;
            padding: 16px 24px;
            background: linear-gradient(135deg, #8b5cf6 0%, #7c3aed 100%);
            border: none;
            border-radius: 16px;
            color: white;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            text-decoration: none;
            transition: all 0.3s ease;
            box-shadow: 0 10px 30px rgba(139, 92, 246, 0.4);
        }

        .home-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 15px 40px rgba(139, 92, 246, 0.5);
        }

        /* Modal */
        .modal-overlay {
            position: fixed;
            inset: 0;
            background: rgba(0, 0, 0, 0.7);
            backdrop-filter: blur(8px);
            z-index: 200;
            display: none;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }

        .modal-overlay.active {
            display: flex;
        }

        .modal {
            width: 100%;
            max-width: 420px;
            background: linear-gradient(145deg, #1e1b4b 0%, #312e81 100%);
            border: 1px solid rgba(255, 255, 255, 0.15);
            border-radius: 28px;
            overflow: hidden;
            transform: scale(0.9);
            opacity: 0;
            transition: all 0.3s ease;
        }

        .modal-overlay.active .modal {
            transform: scale(1);
            opacity: 1;
        }

        .modal-header {
            padding: 24px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        }

        .modal-title {
            display: flex;
            align-items: center;
            gap: 14px;
        }

        .modal-icon {
            width: 48px;
            height: 48px;
            border-radius: 14px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 22px;
        }

        .modal-icon.income {
            background: linear-gradient(135deg, #10b981 0%, #059669 100%);
            box-shadow: 0 8px 24px rgba(16, 185, 129, 0.4);
        }

        .modal-icon.expense {
            background: linear-gradient(135deg, #f43f5e 0%, #e11d48 100%);
            box-shadow: 0 8px 24px rgba(244, 63, 94, 0.4);
        }

        .modal-title h3 {
            font-size: 20px;
            font-weight: 700;
        }

        .close-btn {
            width: 40px;
            height: 40px;
            background: rgba(255, 255, 255, 0.1);
            border: none;
            border-radius: 12px;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            color: rgba(255, 255, 255, 0.6);
            transition: all 0.2s ease;
        }

        .close-btn:hover {
            background: rgba(255, 255, 255, 0.2);
            color: white;
        }

        .modal-body {
            padding: 24px;
        }

        .type-toggle {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 8px;
            padding: 6px;
            background: rgba(0, 0, 0, 0.3);
            border-radius: 16px;
            margin-bottom: 24px;
        }

        .type-btn {
            padding: 14px;
            border: none;
            border-radius: 12px;
            font-size: 15px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            background: transparent;
            color: rgba(255, 255, 255, 0.5);
        }

        .type-btn.active.income {
            background: linear-gradient(135deg, #10b981 0%, #059669 100%);
            color: white;
            box-shadow: 0 4px 15px rgba(16, 185, 129, 0.4);
        }

        .type-btn.active.expense {
            background: linear-gradient(135deg, #f43f5e 0%, #e11d48 100%);
            color: white;
            box-shadow: 0 4px 15px rgba(244, 63, 94, 0.4);
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            font-size: 14px;
            font-weight: 500;
            color: rgba(255, 255, 255, 0.7);
            margin-bottom: 8px;
        }

        .form-group input {
            width: 100%;
            padding: 16px;
            background: rgba(255, 255, 255, 0.08);
            border: 2px solid rgba(255, 255, 255, 0.1);
            border-radius: 14px;
            color: white;
            font-size: 16px;
            transition: all 0.2s ease;
        }

        .form-group input:focus {
            outline: none;
            border-color: #8b5cf6;
            background: rgba(139, 92, 246, 0.1);
        }

        .form-group input::placeholder {
            color: rgba(255, 255, 255, 0.3);
        }

        .form-buttons {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 12px;
            margin-top: 28px;
        }

        .btn-cancel {
            padding: 16px;
            background: rgba(255, 255, 255, 0.1);
            border: none;
            border-radius: 14px;
            color: white;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.2s ease;
        }

        .btn-cancel:hover {
            background: rgba(255, 255, 255, 0.2);
        }

        .btn-submit {
            padding: 16px;
            background: linear-gradient(135deg, #8b5cf6 0%, #7c3aed 100%);
            border: none;
            border-radius: 14px;
            color: white;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.2s ease;
            box-shadow: 0 8px 24px rgba(139, 92, 246, 0.4);
        }

        .btn-submit:hover {
            transform: translateY(-2px);
            box-shadow: 0 12px 30px rgba(139, 92, 246, 0.5);
        }
    </style>
</head>
<body>
    <div class="bg-animation"></div>

    <!-- Header -->
    <header class="header">
        <div class="header-content">
            <a href="{{ route('dashboard') }}" class="back-btn">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M19 12H5M12 19l-7-7 7-7"/>
                </svg>
            </a>
            <div class="header-icon">💰</div>
            <div class="header-text">
                <h1>บัญชีส่วนตัว</h1>
                <p>Personal Finance Tracker</p>
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <main class="main-content">
        <!-- Summary Section -->
        <div class="summary-container">
            <!-- Balance Card -->
            <div class="balance-card">
                <div class="balance-label">
                    <span>💎</span> ยอดคงเหลือทั้งหมด
                </div>
                <div class="balance-amount">฿{{ number_format($personalBalance, 0) }}</div>
            </div>

            <!-- Stats Grid -->
            <div class="stats-grid">
                <div class="stat-card income">
                    <div class="stat-icon">📈</div>
                    <div class="stat-label">รายรับรวม</div>
                    <div class="stat-amount">฿{{ number_format($personalIncome, 0) }}</div>
                </div>
                <div class="stat-card expense">
                    <div class="stat-icon">📉</div>
                    <div class="stat-label">รายจ่ายรวม</div>
                    <div class="stat-amount">฿{{ number_format($personalExpense, 0) }}</div>
                </div>
            </div>
        </div>

        <!-- Action Buttons -->
        <div class="action-buttons">
            <button class="action-btn income" onclick="openModal('income')">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M12 5v14M5 12h14"/>
                </svg>
                เพิ่มรายรับ
            </button>
            <button class="action-btn expense" onclick="openModal('expense')">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M5 12h14"/>
                </svg>
                เพิ่มรายจ่าย
            </button>
        </div>

        <!-- Section Title -->
        <div class="section-title">
            <h2>รายการทั้งหมด</h2>
            <span>{{ $personalTransactions->count() }} รายการ</span>
        </div>

        <!-- Transaction List -->
        <div class="transaction-list">
            @forelse($groupedByDate as $date => $transactions)
                @php
                    $dateCarbon = \Carbon\Carbon::parse($date);
                    $dayIncome = $transactions->where('type', 'income')->sum('amount');
                    $dayExpense = $transactions->where('type', 'expense')->sum('amount');
                    $dayBalance = $dayIncome - $dayExpense;
                    $uniqueId = 'group_' . str_replace('-', '', $date);
                @endphp

                <div class="date-group">
                    <div class="date-header" onclick="toggleGroup('{{ $uniqueId }}')">
                        <div class="date-info">
                            <div class="date-badge">
                                <span class="day">{{ $dateCarbon->format('d') }}</span>
                                <span class="month">{{ $dateCarbon->translatedFormat('M') }}</span>
                            </div>
                            <div class="date-text">
                                <h3>{{ $dateCarbon->translatedFormat('l') }}</h3>
                                <p>{{ $dateCarbon->copy()->addYears(543)->translatedFormat('d F Y') }}</p>
                            </div>
                        </div>
                        <div class="date-summary">
                            <div>
                                <div class="date-total {{ $dayBalance >= 0 ? 'positive' : 'negative' }}">
                                    {{ $dayBalance >= 0 ? '+' : '' }}฿{{ number_format($dayBalance, 0) }}
                                </div>
                                <div class="date-breakdown">
                                    <span class="income">+{{ number_format($dayIncome, 0) }}</span>
                                    <span class="expense">-{{ number_format($dayExpense, 0) }}</span>
                                </div>
                            </div>
                            <div class="chevron" id="{{ $uniqueId }}_chevron">
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M6 9l6 6 6-6"/>
                                </svg>
                            </div>
                        </div>
                    </div>

                    <div class="transaction-items" id="{{ $uniqueId }}">
                        @foreach($transactions as $tx)
                            <div class="transaction-item">
                                <div class="tx-info">
                                    <div class="tx-icon {{ $tx->type }}">
                                        @if($tx->type == 'income')
                                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                                                <path d="M12 5v14M5 12h14"/>
                                            </svg>
                                        @else
                                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                                                <path d="M5 12h14"/>
                                            </svg>
                                        @endif
                                    </div>
                                    <div class="tx-details">
                                        <h4>{{ $tx->name }}</h4>
                                        <span>{{ $tx->type == 'income' ? 'รายรับ' : 'รายจ่าย' }}</span>
                                    </div>
                                </div>
                                <div class="tx-amount-section">
                                    <span class="tx-amount {{ $tx->type }}">
                                        {{ $tx->type == 'income' ? '+' : '-' }}฿{{ number_format($tx->amount, 0) }}
                                    </span>
                                    <form action="{{ route('personal-transactions.destroy', $tx->id) }}" method="POST" style="margin: 0;" onsubmit="return confirm('ลบรายการนี้?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="delete-btn">
                                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                <path d="M3 6h18M19 6v14a2 2 0 01-2 2H7a2 2 0 01-2-2V6M8 6V4a2 2 0 012-2h4a2 2 0 012 2v2"/>
                                            </svg>
                                        </button>
                                    </form>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @empty
                <div class="empty-state">
                    <div class="empty-icon">📭</div>
                    <h3>ยังไม่มีรายการ</h3>
                    <p>เริ่มบันทึกรายรับ-รายจ่ายของคุณ</p>
                </div>
            @endforelse
        </div>
    </main>

    <!-- Bottom Navigation -->
    <nav class="bottom-nav">
        <div class="bottom-nav-content">
            <a href="{{ route('dashboard') }}" class="home-btn">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M3 9l9-7 9 7v11a2 2 0 01-2 2H5a2 2 0 01-2-2z"/>
                    <polyline points="9,22 9,12 15,12 15,22"/>
                </svg>
                กลับหน้าหลัก
            </a>
        </div>
    </nav>

    <!-- Modal -->
    <div class="modal-overlay" id="modal">
        <div class="modal">
            <div class="modal-header">
                <div class="modal-title">
                    <div class="modal-icon income" id="modalIcon">💵</div>
                    <h3 id="modalTitle">เพิ่มรายรับ</h3>
                </div>
                <button class="close-btn" onclick="closeModal()">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M18 6L6 18M6 6l12 12"/>
                    </svg>
                </button>
            </div>
            <form action="{{ route('personal-transactions.store') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="type-toggle">
                        <button type="button" class="type-btn active income" id="btnIncome" onclick="setType('income')">📈 รายรับ</button>
                        <button type="button" class="type-btn" id="btnExpense" onclick="setType('expense')">💸 รายจ่าย</button>
                    </div>
                    <input type="hidden" name="type" id="typeInput" value="income">

                    <div class="form-group">
                        <label>📅 วันที่</label>
                        <input type="date" name="date" value="{{ date('Y-m-d') }}" required>
                    </div>

                    <div class="form-group">
                        <label>📝 ชื่อรายการ</label>
                        <input type="text" name="name" placeholder="เช่น เงินเดือน, ค่าอาหาร" required>
                    </div>

                    <div class="form-group">
                        <label>💰 จำนวนเงิน (บาท)</label>
                        <input type="number" name="amount" placeholder="0" required style="font-size: 24px; font-weight: 700;">
                    </div>

                    <div class="form-buttons">
                        <button type="button" class="btn-cancel" onclick="closeModal()">ยกเลิก</button>
                        <button type="submit" class="btn-submit">บันทึก</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <script>
        function toggleGroup(id) {
            const items = document.getElementById(id);
            const chevron = document.getElementById(id + '_chevron');
            items.classList.toggle('open');
            chevron.classList.toggle('open');
        }

        function openModal(type) {
            document.getElementById('modal').classList.add('active');
            setType(type);
        }

        function closeModal() {
            document.getElementById('modal').classList.remove('active');
        }

        function setType(type) {
            const btnIncome = document.getElementById('btnIncome');
            const btnExpense = document.getElementById('btnExpense');
            const modalIcon = document.getElementById('modalIcon');
            const modalTitle = document.getElementById('modalTitle');
            const typeInput = document.getElementById('typeInput');

            typeInput.value = type;

            if (type === 'income') {
                btnIncome.className = 'type-btn active income';
                btnExpense.className = 'type-btn';
                modalIcon.className = 'modal-icon income';
                modalIcon.textContent = '💵';
                modalTitle.textContent = 'เพิ่มรายรับ';
            } else {
                btnExpense.className = 'type-btn active expense';
                btnIncome.className = 'type-btn';
                modalIcon.className = 'modal-icon expense';
                modalIcon.textContent = '💸';
                modalTitle.textContent = 'เพิ่มรายจ่าย';
            }
        }

        // Close modal on backdrop click
        document.getElementById('modal').addEventListener('click', function(e) {
            if (e.target === this) closeModal();
        });
    </script>
</body>
</html>