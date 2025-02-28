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
                <form action="/api/register" method="POST" class="max-w-md w-full p-6 space-y-6 bg-white rounded-lg shadow-xl">
                    <h2 class="text-2xl font-semibold text-center text-gray-800">Registration</h2>
                    <input type="text" name="name" placeholder="Your Name" class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                    <input type="email" name="email" placeholder="Email" class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                    <input type="password" name="password" placeholder="Password" class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                    <button type="submit" class="w-full py-3 bg-blue-500 text-white rounded-lg hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500">Sign Up</button>
                </form>
            </div>
        </body>
    </html>