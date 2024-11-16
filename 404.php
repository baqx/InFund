<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>404 - Page Not Found</title>
    <style>
         @import url("./assets/css/colors.css");
        @import url("https://fonts.googleapis.com/css2?family=Inter:wght@400;600&display=swap");

        body {
            margin: 0;
            padding: 0;
            font-family: "Inter", sans-serif;
            background-color: var(--background-color);
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            overflow: hidden;
        }

        .error-container {
            text-align: center;
            color: var(--text-color);
        }

        .error-title {
            font-size: 5rem;
            color: var(--primary-color);
            animation: float 2s infinite ease-in-out;
        }

        .error-message {
            font-size: 1.5rem;
            margin: 1rem 0;
            color: var(--text-color);
        }

        .error-message span {
            color: var(--accent-color);
        }

        .back-button {
            display: inline-block;
            padding: 0.75rem 1.5rem;
            font-size: 1rem;
            color: white;
            background-color: var(--primary-color);
            text-decoration: none;
            border-radius: var(--border-radius);
            box-shadow: var(--shadow);
            transition: var(--transition);
            margin-top: 1rem;
        }

        .back-button:hover {
            background-color: var(--accent-color);
            box-shadow: var(--shadow-hover);
        }

        .illustration {
            font-size: 8rem;
            color: var(--secondary-color);
            animation: shake 1.5s infinite ease-in-out;
        }

        @keyframes float {
            0%,
            100% {
                transform: translateY(0);
            }
            50% {
                transform: translateY(-10px);
            }
        }

        @keyframes shake {
            0%,
            100% {
                transform: rotate(0deg);
            }
            25% {
                transform: rotate(-10deg);
            }
            75% {
                transform: rotate(10deg);
            }
        }
    </style>
</head>

<body>
    <main class="error-container" role="main">
        <section aria-labelledby="error-title">
            <div class="illustration" aria-hidden="true">
                <img src="./assets/images/static/404.svg" alt="Page not found!" style="width: 70px; height: 70px;">
            </div>
            <h1 id="error-title" class="error-title">404</h1>
            <p class="error-message">
                Oops! Looks like this fundraiser took a wrong turn. <br />
                <span>"Crowds funding, but not this page!"</span>
            </p>
            <a href="./" class="back-button" role="button">Back to Home</a>
        </section>
    </main>
</body>

</html>