<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>AI Helpdesk | IntelliDesk</title>

    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: "Segoe UI", Arial, sans-serif;
            background: #f5f8f6;
            color: #20352a;
            min-height: 100vh;
        }

        .layout {
            display: flex;
            min-height: 100vh;
        }

        .sidebar {
            width: 245px;
            background: #ffffff;
            border-right: 1px solid #e2ebe5;
            padding: 28px 18px;
            flex-shrink: 0;
        }

        .brand {
            display: flex;
            align-items: center;
            gap: 11px;
            margin-bottom: 38px;
            padding: 0 8px;
        }

        .brand-icon {
            width: 42px;
            height: 42px;
            background: #16834a;
            color: white;
            display: grid;
            place-items: center;
            border-radius: 12px;
            font-size: 22px;
        }

        .brand h2 {
            font-size: 20px;
            color: #176c40;
        }

        .brand p {
            font-size: 11px;
            color: #829187;
            margin-top: 3px;
        }

        .nav-label {
            color: #94a198;
            font-size: 10px;
            font-weight: 700;
            letter-spacing: 1.3px;
            margin: 25px 10px 12px;
        }

        .nav-link {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 12px;
            margin-bottom: 5px;
            border-radius: 9px;
            color: #607067;
            text-decoration: none;
            font-size: 13px;
            transition: .2s;
        }

        .nav-link:hover,
        .nav-link.active {
            background: #e9f6ed;
            color: #167442;
        }

        .nav-link.active {
            font-weight: 700;
        }

        .main {
            flex: 1;
            min-width: 0;
            padding: 30px 36px;
        }

        .topbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 15px;
            margin-bottom: 30px;
        }

        .topbar h1 {
            font-size: 25px;
            color: #20352a;
        }

        .topbar p {
            color: #7c8b81;
            font-size: 13px;
            margin-top: 7px;
        }

        .profile {
            background: white;
            border: 1px solid #e2ebe5;
            border-radius: 12px;
            padding: 10px 15px;
            font-size: 13px;
            color: #526459;
        }

        .hero {
            background: linear-gradient(120deg, #176c40, #23965a);
            border-radius: 18px;
            padding: 30px;
            color: white;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 20px;
            margin-bottom: 24px;
        }

        .hero h2 {
            font-size: 24px;
            margin-bottom: 10px;
        }

        .hero p {
            font-size: 13px;
            line-height: 1.8;
            color: #e1f3e7;
            max-width: 570px;
        }

        .hero-icon {
            width: 76px;
            height: 76px;
            border-radius: 20px;
            background: #ffffff20;
            display: grid;
            place-items: center;
            font-size: 39px;
            flex-shrink: 0;
        }

        .content-grid {
            display: grid;
            grid-template-columns: minmax(0, 1fr) 280px;
            gap: 22px;
            align-items: start;
        }

        .chat-card,
        .side-card {
            background: white;
            border: 1px solid #e3ebe5;
            border-radius: 15px;
            overflow: hidden;
        }

        .chat-header {
            padding: 20px;
            border-bottom: 1px solid #edf1ee;
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .bot-avatar {
            width: 43px;
            height: 43px;
            display: grid;
            place-items: center;
            border-radius: 13px;
            background: #e6f5eb;
            font-size: 23px;
        }

        .chat-header h3 {
            font-size: 15px;
            margin-bottom: 5px;
        }

        .chat-header > div:nth-child(2) {
            min-width: 0;
        }

        .clear-btn {
            margin-left: auto;
            flex-shrink: 0;
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 9px 11px;
            border: 1px solid #dce8df;
            border-radius: 9px;
            background: #ffffff;
            color: #52705c;
            font-size: 12px;
            cursor: pointer;
            transition: .2s;
        }

        .clear-btn:hover {
            border-color: #92cba5;
            background: #f2faf4;
            color: #167442;
        }

        .clear-btn:focus-visible,
        .send-btn:focus-visible,
        .topic:focus-visible {
            outline: 3px solid #23965a55;
            outline-offset: 2px;
        }

        .send-btn:disabled,
        .input-row input:disabled,
        .clear-btn:disabled {
            opacity: .65;
            cursor: not-allowed;
        }

        .online {
            color: #178348;
            font-size: 11px;
        }

        .online::before {
            content: "";
            display: inline-block;
            width: 7px;
            height: 7px;
            border-radius: 50%;
            background: #21a45d;
            margin-right: 6px;
        }

        .messages {
            height: 310px;
            padding: 22px;
            overflow-y: auto;
            display: flex;
            flex-direction: column;
            gap: 15px;
            background: #fcfdfc;
        }

        .message {
            max-width: 85%;
            padding: 12px 15px;
            border-radius: 12px;
            font-size: 13px;
            line-height: 1.7;
            overflow-wrap: anywhere;
        }

        .bot-message {
            align-self: flex-start;
            background: #edf5ef;
            color: #344c3c;
            border-bottom-left-radius: 3px;
        }

        .user-message {
            align-self: flex-end;
            background: #18834a;
            color: white;
            border-bottom-right-radius: 3px;
        }

        .chat-form {
            padding: 17px;
            border-top: 1px solid #edf1ee;
        }

        .input-row {
            display: flex;
            gap: 10px;
        }

        .input-row input {
            flex: 1;
            min-width: 0;
            border: 1px solid #dce6df;
            border-radius: 10px;
            padding: 13px;
            font-size: 13px;
            outline: none;
        }

        .input-row input:focus {
            border-color: #23965a;
            box-shadow: 0 0 0 3px #23965a15;
        }

        .send-btn {
            border: none;
            background: #18834a;
            color: white;
            border-radius: 10px;
            padding: 0 20px;
            cursor: pointer;
            font-weight: 600;
        }

        .send-btn:hover {
            background: #126b3b;
        }

        .hint {
            font-size: 11px;
            color: #98a49b;
            margin-top: 12px;
        }

        .side-card {
            padding: 20px;
            margin-bottom: 18px;
        }

        .side-card h3 {
            font-size: 15px;
            margin-bottom: 16px;
        }

        .topic {
            display: block;
            width: 100%;
            text-align: left;
            padding: 12px;
            margin-bottom: 9px;
            border: 1px solid #e7eee8;
            border-radius: 9px;
            background: #fff;
            color: #536459;
            font-size: 12px;
            cursor: pointer;
        }

        .topic:hover {
            border-color: #92cba5;
            background: #f2faf4;
            color: #167442;
        }

        .topic span {
            margin-right: 8px;
        }

        .notice {
            background: #f0f8f2;
            border-radius: 10px;
            padding: 14px;
            font-size: 12px;
            line-height: 1.8;
            color: #55705e;
        }

        .notice strong {
            display: block;
            color: #176c40;
            margin-bottom: 5px;
        }

        .footer {
            text-align: center;
            color: #9aa79e;
            font-size: 11px;
            margin-top: 25px;
        }

        @media (max-width: 1000px) {
            .content-grid {
                grid-template-columns: 1fr;
            }

            .sidebar {
                width: 205px;
            }
        }

        @media (max-width: 650px) {
            .chat-header {
                padding: 15px;
                gap: 9px;
            }

            .clear-btn {
                padding: 8px;
            }

            .clear-btn span {
                display: none;
            }

            .layout {
                display: block;
            }

            .sidebar {
                width: 100%;
                padding: 18px;
                border-right: none;
                border-bottom: 1px solid #e2ebe5;
            }

            .brand {
                margin-bottom: 18px;
            }

            .nav-label {
                margin-top: 15px;
            }

            .main {
                padding: 22px 15px;
            }

            .topbar {
                align-items: flex-start;
                flex-direction: column;
            }

            .hero {
                padding: 23px;
            }

            .hero h2 {
                font-size: 20px;
            }

            .hero-icon {
                display: none;
            }

            .messages {
                height: 300px;
                padding: 15px;
            }

            .input-row {
                flex-wrap: wrap;
            }

            .input-row input {
                flex-basis: 100%;
            }

            .send-btn {
                padding: 12px 20px;
            }
        }
    </style>
</head>

<body>
<div class="layout">

    <aside class="sidebar">
        <div class="brand">
            <div class="brand-icon">I</div>
            <div>
                <h2>IntelliDesk</h2>
                <p>Office Management System</p>
            </div>
        </div>

        <div class="nav-label">MAIN MENU</div>

        <a class="nav-link" href="{{ route('dashboard') }}">
            <span>▦</span> Dashboard
        </a>

        <a class="nav-link" href="{{ route('employees.index') }}">
            <span>♙</span> Employees
        </a>

        <a class="nav-link" href="{{ route('attendance.index') }}">
            <span>◷</span> Attendance
        </a>

        <a class="nav-link" href="{{ route('reports.attendance') }}">
            <span>▤</span> Attendance Reports
        </a>

        <div class="nav-label">WORKPLACE TOOLS</div>

        <a class="nav-link active" href="{{ url('/helpdesk') }}">
            <span>✦</span> AI Helpdesk
        </a>

        <div class="nav-label">ACCOUNT</div>

        <a class="nav-link" href="#"
           onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
            <span>⇥</span> Logout
        </a>

        <form id="logout-form" action="{{ route('logout') }}"
              method="POST" style="display:none;">
            @csrf
        </form>
    </aside>

    <main class="main">
        <header class="topbar">
            <div>
                <h1>AI Office Helpdesk</h1>
                <p>Get help with office procedures and IntelliDesk features.</p>
            </div>

            <div class="profile">
                👤 {{ auth()->user()->name ?? 'Employee' }}
            </div>
        </header>

        <section class="hero">
            <div>
                <h2>Your workplace assistant 🤖</h2>
                <p>
                    Welcome to IntelliDesk AI Helpdesk. Ask questions about
                    attendance, employee management, reports, and common
                    office procedures.
                </p>
            </div>
            <div class="hero-icon">✦</div>
        </section>

        <div class="content-grid">
            <section class="chat-card">
                <div class="chat-header">
                    <div class="bot-avatar">🤖</div>
                    <div>
                        <h3>IntelliDesk Assistant</h3>
                        <div class="online" id="assistant-status">AI assistant ready</div>
                    </div>
                    <button class="clear-btn" id="clear-chat" type="button" title="Clear conversation">
                        ↺ <span>Clear chat</span>
                    </button>
                </div>

                <div class="messages" id="messages" aria-live="polite">
                    <div class="message bot-message">
                        Hello, {{ auth()->user()->name ?? 'there' }}! 👋
                        <br>
                        I'm the IntelliDesk Helpdesk Assistant. You can ask
                        me about attendance, employees, reports, or how to
                        use the system.
                        <br><br>
                        Choose a suggested question or type your own below.
                    </div>
                </div>

                <form class="chat-form" id="chat-form">
                    <div class="input-row">
                        <input
                            type="text"
                            id="question"
                            placeholder="Ask a question about your workplace..."
                            autocomplete="off"
                            maxlength="1000"
                            required
                        >
                        <button class="send-btn" type="submit">Send ➤</button>
                    </div>
                    <p class="hint">
                        Powered by your local IntelliDesk assistant. Avoid entering passwords or other sensitive information.
                    </p>
                </form>
            </section>

            <aside>
                <div class="side-card">
                    <h3>Suggested Questions</h3>

                    <button class="topic" type="button"
                        data-question="How do I check in for attendance?">
                        <span>◷</span> How do I check in?
                    </button>

                    <button class="topic" type="button"
                        data-question="How do I view attendance reports?">
                        <span>▤</span> Attendance reports
                    </button>

                    <button class="topic" type="button"
                        data-question="How can I add a new employee?">
                        <span>♙</span> Add a new employee
                    </button>

                    <button class="topic" type="button"
                        data-question="How do I export an Excel report?">
                        <span>▧</span> Export Excel report
                    </button>

                    <button class="topic" type="button"
                        data-question="What can I do in IntelliDesk?">
                        <span>✦</span> IntelliDesk features
                    </button>
                </div>

                <div class="side-card">
                    <h3>Helpdesk Information</h3>
                    <div class="notice">
                        <strong>About this assistant</strong>
                        Ask about employee management, attendance, dashboard navigation, and attendance reports. General questions are answered by your local AI model.
                    </div>
                </div>
            </aside>
        </div>

        <div class="footer">
            IntelliDesk · Office Management System
        </div>
    </main>
</div>


<script>
    const form = document.getElementById('chat-form');
    const input = document.getElementById('question');
    const messages = document.getElementById('messages');
    const clearButton = document.getElementById('clear-chat');
    const assistantStatus = document.getElementById('assistant-status');
    const submitButton = form.querySelector('button[type="submit"]');

    const welcomeMessage = `Hello, {{ auth()->user()->name ?? 'there' }}! 👋

I'm the IntelliDesk Helpdesk Assistant. You can ask me about attendance, employees, reports, or how to use the system.

Choose a suggested question or type your own below.`;

    function addMessage(text, type) {
        const message = document.createElement('div');
        message.className = 'message ' + type;
        message.textContent = text;
        messages.appendChild(message);
        messages.scrollTop = messages.scrollHeight;
        return message;
    }

    function setBusy(isBusy) {
        input.disabled = isBusy;
        submitButton.disabled = isBusy;
        clearButton.disabled = isBusy;
        assistantStatus.textContent = isBusy ? 'Thinking…' : 'AI assistant ready';
        if (!isBusy) {
            input.focus();
        }
    }

    form.addEventListener('submit', async function (event) {
        event.preventDefault();

        const question = input.value.trim();
        if (!question || submitButton.disabled) {
            return;
        }

        addMessage(question, 'user-message');
        input.value = '';
        setBusy(true);

        const loadingMessage = addMessage('Thinking…', 'bot-message');

        try {
            const response = await fetch("{{ route('helpdesk.ask') }}", {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector(
                        'meta[name="csrf-token"]'
                    ).content
                },
                body: JSON.stringify({ question: question })
            });

            const data = await response.json();
            loadingMessage.remove();

            if (!response.ok) {
                throw new Error(data.message || 'Unable to process your question.');
            }

            addMessage(
                data.answer || 'Sorry, no answer was received. Please try again.',
                'bot-message'
            );
        } catch (error) {
            loadingMessage.remove();
            addMessage(
                'Sorry, I could not process that request. Please check that the local AI service is running and try again.',
                'bot-message'
            );
            console.error('Helpdesk error:', error);
        } finally {
            setBusy(false);
        }
    });

    clearButton.addEventListener('click', function () {
        if (submitButton.disabled) {
            return;
        }

        messages.replaceChildren();
        addMessage(welcomeMessage, 'bot-message');
        input.value = '';
        input.focus();
    });

    document.querySelectorAll('.topic').forEach(function (button) {
        button.addEventListener('click', function () {
            input.value = button.dataset.question || '';
            input.focus();
        });
    });
</script>

</body>
</html>