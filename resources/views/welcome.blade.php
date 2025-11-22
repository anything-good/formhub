<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Lab</title>
    <script src="/_sdk/element_sdk.js"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Alexandria:wght@100..900&family=Baloo+Da+2:wght@400..800&display=swap"
        rel="stylesheet">
    <style>
        body {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
            height: 100%;
            overflow-x: hidden;
        }

        html {
            height: 100%;
        }

        * {
            box-sizing: border-box;
            font-family: 'Baloo Da 2'

        }

        .container {
            min-height: 100%;
            background: linear-gradient(135deg, #f0fff4 0%, #c6f6d5 50%, #9ae6b4 100%);
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding: 40px 20px;
            position: relative;
            overflow: hidden;
        }

        /* Animated background shapes */
        .bg-shape {
            position: absolute;
            border-radius: 50%;
            opacity: 0.15;
            animation: float 20s infinite ease-in-out;
        }

        .shape-1 {
            width: 300px;
            height: 300px;
            background: #48bb78;
            top: -150px;
            right: -150px;
            animation-delay: 0s;
        }

        .shape-2 {
            width: 200px;
            height: 200px;
            background: #38a169;
            bottom: -100px;
            left: -100px;
            animation-delay: 5s;
        }

        .shape-3 {
            width: 150px;
            height: 150px;
            background: #68d391;
            top: 50%;
            left: 10%;
            animation-delay: 10s;
        }

        @keyframes float {

            0%,
            100% {
                transform: translate(0, 0) scale(1);
            }

            33% {
                transform: translate(30px, -30px) scale(1.1);
            }

            66% {
                transform: translate(-20px, 20px) scale(0.9);
            }
        }

        .content {
            position: relative;
            z-index: 1;
            text-align: center;
            max-width: 800px;
            width: 100%;
        }

        .logo {
            font-size: 48px;
            font-weight: 700;
            color: #22543d;
            margin-bottom: 20px;
            animation: fadeInDown 0.8s ease-out;
            letter-spacing: -1px;
        }

        .logo-icon {
            display: inline-block;
            background: linear-gradient(135deg, #48bb78, #38a169);
            width: 50px;
            height: 50px;
            border-radius: 12px;
            margin-right: 10px;
            vertical-align: middle;
            position: relative;
            animation: pulse 2s infinite;
        }

        .logo-icon::before {
            content: '📋';
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            font-size: 28px;
        }

        @keyframes pulse {

            0%,
            100% {
                transform: scale(1);
            }

            50% {
                transform: scale(1.05);
            }
        }

        h1 {
            font-size: 56px;
            color: #22543d;
            margin: 0 0 20px 0;
            font-weight: 700;
            animation: fadeInUp 0.8s ease-out 0.2s backwards;
            line-height: 1.2;
        }

        .subtitle {
            font-size: 22px;
            color: #2f855a;
            margin: 0 0 50px 0;
            animation: fadeInUp 0.8s ease-out 0.4s backwards;
            font-weight: 400;
        }

        @keyframes fadeInDown {
            from {
                opacity: 0;
                transform: translateY(-30px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .search-container {
            margin-bottom: 40px;
            animation: fadeInUp 0.8s ease-out 0.6s backwards;
            width: 100%;
            max-width: 600px;
            margin-left: auto;
            margin-right: auto;
        }

        .search-box {
            display: flex;
            align-items: center;
            background: white;
            border-radius: 50px;
            padding: 18px 30px;
            box-shadow: 0 10px 40px rgba(56, 161, 105, 0.2);
            transition: all 0.3s ease;
            border: 2px solid transparent;
        }

        .search-box:focus-within {
            box-shadow: 0 15px 50px rgba(56, 161, 105, 0.3);
            border-color: #48bb78;
            transform: translateY(-2px);
        }

        .search-icon {
            font-size: 24px;
            margin-right: 15px;
            color: #48bb78;
        }

        .search-input {
            flex: 1;
            border: none;
            outline: none;
            font-size: 18px;
            color: #2d3748;
            background: transparent;
        }

        .search-input::placeholder {
            color: #a0aec0;
        }

        .cta-button {
            background: linear-gradient(135deg, #48bb78, #38a169);
            color: white;
            border: none;
            padding: 20px 50px;
            font-size: 20px;
            font-weight: 600;
            border-radius: 50px;
            cursor: pointer;
            box-shadow: 0 10px 30px rgba(56, 161, 105, 0.3);
            transition: all 0.3s ease;
            animation: fadeInUp 0.8s ease-out 0.8s backwards;
            letter-spacing: 0.5px;
        }

        .cta-button:hover {
            transform: translateY(-3px);
            box-shadow: 0 15px 40px rgba(56, 161, 105, 0.4);
            background: linear-gradient(135deg, #38a169, #2f855a);
        }

        .cta-button:active {
            transform: translateY(-1px);
        }

        .features {
            display: flex;
            gap: 30px;
            margin-top: 80px;
            animation: fadeInUp 0.8s ease-out 1s backwards;
            flex-wrap: wrap;
            justify-content: center;
        }

        .feature-card {
            background: rgba(255, 255, 255, 0.9);
            padding: 30px;
            border-radius: 20px;
            box-shadow: 0 5px 20px rgba(56, 161, 105, 0.15);
            transition: all 0.3s ease;
            flex: 1;
            min-width: 200px;
            max-width: 250px;
        }

        .feature-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 30px rgba(56, 161, 105, 0.25);
        }

        .feature-icon {
            font-size: 48px;
            margin-bottom: 15px;
        }

        .feature-title {
            font-size: 20px;
            font-weight: 600;
            color: #22543d;
            margin: 0 0 10px 0;
        }

        .feature-description {
            font-size: 15px;
            color: #2f855a;
            margin: 0;
            line-height: 1.6;
        }

        @media (max-width: 768px) {
            h1 {
                font-size: 40px;
            }

            .subtitle {
                font-size: 18px;
            }

            .logo {
                font-size: 36px;
            }

            .cta-button {
                padding: 16px 40px;
                font-size: 18px;
            }

            .features {
                margin-top: 60px;
            }
        }
    </style>
    <style>

    </style>
    <script src="/_sdk/data_sdk.js" type="text/javascript"></script>
    <script src="https://cdn.tailwindcss.com" type="text/javascript"></script>
</head>

<body>
    <div class="container">
        <div class="bg-shape shape-1"></div>
        <div class="bg-shape shape-2"></div>
        <div class="bg-shape shape-3"></div>
        <div class="content">
            <div class="logo"><span class="logo-icon"></span> <span>Form Lab</span>
            </div>
            <h1 id="main-title">Create Reliable Forms That Work</h1>
            <p class="subtitle" id="subtitle">Build beautiful forms, collect responses, and analyze data effortlessly
            </p>
            <div class="search-container">
                <div class="search-box"><span class="search-icon">🔍</span> <input type="text" class="search-input"
                        id="search-input" placeholder="Search for templates...">
                </div>
            </div>
            <a>
                <a href="/admin">
                    <button class="cta-button" id="cta-button">Get Started</button>
                </a>
                <div class="features">
                    <div class="feature-card">
                        <div class="feature-icon">
                            ⚡
                        </div>
                        <h3 class="feature-title">Fast &amp; Easy</h3>
                        <p class="feature-description">Create professional forms in minutes with our intuitive builder
                        </p>
                    </div>
                    <div class="feature-card">
                        <div class="feature-icon">
                            🎨
                        </div>
                        <h3 class="feature-title">Customizable</h3>
                        <p class="feature-description">Personalize every detail to match your brand perfectly</p>
                    </div>
                    <div class="feature-card">
                        <div class="feature-icon">
                            📊
                        </div>
                        <h3 class="feature-title">Analytics</h3>
                        <p class="feature-description">Get insights from your data with powerful analytics tools</p>
                    </div>
                </div>
        </div>
    </div>
    <script>
        const defaultConfig = {
            main_title: "Create Forms That Work",
            subtitle: "Build beautiful forms, collect responses, and analyze data effortlessly",
            cta_button_text: "Get Started",
            search_placeholder: "Search for templates...",
            background_color: "#f0fff4",
            primary_color: "#48bb78",
            secondary_color: "#38a169",
            text_color: "#22543d",
            accent_color: "#2f855a",
            font_family: "Segoe UI, Tahoma, Geneva, Verdana, sans-serif",
            font_size: 16
        };

        async function onConfigChange(config) {
            const baseFont = config.font_family || defaultConfig.font_family;
            const baseFontSize = config.font_size || defaultConfig.font_size;
            const baseFontStack = 'Arial, sans-serif';

            // Update text content
            document.getElementById('main-title').textContent = config.main_title || defaultConfig.main_title;
            document.getElementById('subtitle').textContent = config.subtitle || defaultConfig.subtitle;
            document.getElementById('cta-button').textContent = config.cta_button_text || defaultConfig.cta_button_text;
            document.getElementById('search-input').placeholder = config.search_placeholder || defaultConfig
                .search_placeholder;

            // Update colors
            const bgColor = config.background_color || defaultConfig.background_color;
            const primaryColor = config.primary_color || defaultConfig.primary_color;
            const secondaryColor = config.secondary_color || defaultConfig.secondary_color;
            const textColor = config.text_color || defaultConfig.text_color;
            const accentColor = config.accent_color || defaultConfig.accent_color;

            document.querySelector('.container').style.background =
                `linear-gradient(135deg, ${bgColor} 0%, #c6f6d5 50%, #9ae6b4 100%)`;
            document.querySelector('.logo').style.color = textColor;
            document.querySelector('h1').style.color = textColor;
            document.querySelector('.subtitle').style.color = accentColor;
            document.querySelector('.logo-icon').style.background =
                `linear-gradient(135deg, ${primaryColor}, ${secondaryColor})`;
            document.querySelector('.search-icon').style.color = primaryColor;
            document.querySelector('.search-box').style.borderColor = 'transparent';
            document.querySelector('.cta-button').style.background =
                `linear-gradient(135deg, ${primaryColor}, ${secondaryColor})`;

            document.querySelectorAll('.feature-title').forEach(el => {
                el.style.color = textColor;
            });

            document.querySelectorAll('.feature-description').forEach(el => {
                el.style.color = accentColor;
            });

            // Update fonts
            document.querySelector('.logo').style.fontFamily = `${baseFont}, ${baseFontStack}`;
            document.querySelector('h1').style.fontFamily = `${baseFont}, ${baseFontStack}`;
            document.querySelector('h1').style.fontSize = `${baseFontSize * 3.5}px`;
            document.querySelector('.subtitle').style.fontFamily = `${baseFont}, ${baseFontStack}`;
            document.querySelector('.subtitle').style.fontSize = `${baseFontSize * 1.375}px`;
            document.querySelector('.search-input').style.fontFamily = `${baseFont}, ${baseFontStack}`;
            document.querySelector('.search-input').style.fontSize = `${baseFontSize * 1.125}px`;
            document.querySelector('.cta-button').style.fontFamily = `${baseFont}, ${baseFontStack}`;
            document.querySelector('.cta-button').style.fontSize = `${baseFontSize * 1.25}px`;

            document.querySelectorAll('.feature-title').forEach(el => {
                el.style.fontFamily = `${baseFont}, ${baseFontStack}`;
                el.style.fontSize = `${baseFontSize * 1.25}px`;
            });

            document.querySelectorAll('.feature-description').forEach(el => {
                el.style.fontFamily = `${baseFont}, ${baseFontStack}`;
                el.style.fontSize = `${baseFontSize * 0.9375}px`;
            });
        }

        function mapToCapabilities(config) {
            return {
                recolorables: [{
                        get: () => config.background_color || defaultConfig.background_color,
                        set: (value) => {
                            config.background_color = value;
                            window.elementSdk.setConfig({
                                background_color: value
                            });
                        }
                    },
                    {
                        get: () => config.primary_color || defaultConfig.primary_color,
                        set: (value) => {
                            config.primary_color = value;
                            window.elementSdk.setConfig({
                                primary_color: value
                            });
                        }
                    },
                    {
                        get: () => config.text_color || defaultConfig.text_color,
                        set: (value) => {
                            config.text_color = value;
                            window.elementSdk.setConfig({
                                text_color: value
                            });
                        }
                    },
                    {
                        get: () => config.secondary_color || defaultConfig.secondary_color,
                        set: (value) => {
                            config.secondary_color = value;
                            window.elementSdk.setConfig({
                                secondary_color: value
                            });
                        }
                    },
                    {
                        get: () => config.accent_color || defaultConfig.accent_color,
                        set: (value) => {
                            config.accent_color = value;
                            window.elementSdk.setConfig({
                                accent_color: value
                            });
                        }
                    }
                ],
                borderables: [],
                fontEditable: {
                    get: () => config.font_family || defaultConfig.font_family,
                    set: (value) => {
                        config.font_family = value;
                        window.elementSdk.setConfig({
                            font_family: value
                        });
                    }
                },
                fontSizeable: {
                    get: () => config.font_size || defaultConfig.font_size,
                    set: (value) => {
                        config.font_size = value;
                        window.elementSdk.setConfig({
                            font_size: value
                        });
                    }
                }
            };
        }

        function mapToEditPanelValues(config) {
            return new Map([
                ["main_title", config.main_title || defaultConfig.main_title],
                ["subtitle", config.subtitle || defaultConfig.subtitle],
                ["cta_button_text", config.cta_button_text || defaultConfig.cta_button_text],
                ["search_placeholder", config.search_placeholder || defaultConfig.search_placeholder]
            ]);
        }

        if (window.elementSdk) {
            window.elementSdk.init({
                defaultConfig,
                onConfigChange,
                mapToCapabilities,
                mapToEditPanelValues
            });
        }

        // Add interactive search functionality
        document.getElementById('search-input').addEventListener('input', function(e) {
            if (e.target.value.length > 0) {
                e.target.parentElement.style.borderColor = '#48bb78';
            } else {
                e.target.parentElement.style.borderColor = 'transparent';
            }
        });

        // Add button click animation
        document.getElementById('cta-button').addEventListener('click', function() {
            this.style.transform = 'scale(0.95)';
            setTimeout(() => {
                this.style.transform = 'translateY(-3px)';
            }, 100);
        });
    </script>
    <script>
        (function() {
            function c() {
                var b = a.contentDocument || a.contentWindow.document;
                if (b) {
                    var d = b.createElement('script');
                    d.innerHTML =
                        "window.__CF$cv$params={r:'9a2b0897d187d0f4',t:'MTc2Mzg0MTg0Mi4wMDAwMDA='};var a=document.createElement('script');a.nonce='';a.src='/cdn-cgi/challenge-platform/scripts/jsd/main.js';document.getElementsByTagName('head')[0].appendChild(a);";
                    b.getElementsByTagName('head')[0].appendChild(d)
                }
            }
            if (document.body) {
                var a = document.createElement('iframe');
                a.height = 1;
                a.width = 1;
                a.style.position = 'absolute';
                a.style.top = 0;
                a.style.left = 0;
                a.style.border = 'none';
                a.style.visibility = 'hidden';
                document.body.appendChild(a);
                if ('loading' !== document.readyState) c();
                else if (window.addEventListener) document.addEventListener('DOMContentLoaded', c);
                else {
                    var e = document.onreadystatechange || function() {};
                    document.onreadystatechange = function(b) {
                        e(b);
                        'loading' !== document.readyState && (document.onreadystatechange = e, c())
                    }
                }
            }
        })();
    </script>
</body>

</html>
