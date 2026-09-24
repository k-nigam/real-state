<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>@yield('title', 'Real Estate')</title>

    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background: #f5f7fa;
            color: #222;
        }

        .container {
            width: 100%;
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
        }

        .auth-container {
            max-width: 450px;
            margin: 60px auto;
            padding: 30px;
            background: #fff;
            border-radius: 8px;
            box-shadow: 0 2px 12px rgba(0, 0, 0, 0.08);
        }

        .form-group {
            margin-bottom: 18px;
        }

        label {
            display: block;
            margin-bottom: 6px;
            font-weight: 600;
        }

        input {
            width: 100%;
            padding: 11px 12px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 15px;
        }

        button {
            /* width: 100%; */
            padding: 12px;
            border: 0;
            border-radius: 5px;
            background: #2563eb;
            color: #fff;
            font-size: 16px;
            cursor: pointer;
        }

        .error {
            margin-bottom: 15px;
            padding: 10px;
            background: #fee2e2;
            color: #991b1b;
            border-radius: 5px;
        }

        .links {
            margin-top: 20px;
            text-align: center;
        }

        .links a {
            color: #2563eb;
            text-decoration: none;
        }

        .property-slider .property-slider__button {
            position: absolute;
            top: 50%;
            transform: translateY(-50%);

            width: 42px !important;
            min-width: 42px !important;
            max-width: 42px !important;

            height: 42px !important;
            min-height: 42px !important;
            max-height: 42px !important;

            padding: 0 !important;
            margin: 0 !important;

            display: flex !important;
            align-items: center !important;
            justify-content: center !important;

            border: none !important;
            border-radius: 50% !important;

            background: rgba(0, 0, 0, 0.55) !important;
            color: #fff !important;

            font-size: 30px !important;
            line-height: 1 !important;

            cursor: pointer;

            box-sizing: border-box;
        }

        .property-slider .property-slider__button:hover {
            background: rgba(0, 0, 0, 0.8) !important;
        }

        .property-slider .property-slider__button--prev {
            left: 12px !important;
            right: auto !important;
        }

        .property-slider .property-slider__button--next {
            right: 12px !important;
            left: auto !important;
        }
        
    </style>
</head>

<body>

    <main class="container">
        @yield('content')
    </main>
    @stack('scripts')
    @stack('styles')
</body>
</html>
