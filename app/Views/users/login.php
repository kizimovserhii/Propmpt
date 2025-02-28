<!DOCTYPE html>
    <html lang="en">
        <head>
            <meta charset="UTF-8">
            <title>AI Prompts Builder</title>
            <link href="/src/output.css" rel="stylesheet">
            <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.16/dist/tailwind.min.css" rel="stylesheet">
        </head>
        <body>
            <div class="flex items-center justify-center min-h-screen bg-gray-100">
                <form action="/api/login" method="POST" class="max-w-md mx-auto p-4 space-y-4 bg-white rounded-lg shadow-lg">
                    <h2 class="text-2xl font-semibold text-center text-gray-800">Login</h2>
                    <input type="email" name="email" placeholder="email" class="w-full p-2 border border-gray-300 rounded" required>
                    <input type="password" name="password" placeholder="Password" class="w-full p-2 border border-gray-300 rounded" required>
                    <button type="submit" class="w-full py-2 bg-blue-500 text-white rounded">Login</button>
                </form>
            </div>
        </body>
    </html>
