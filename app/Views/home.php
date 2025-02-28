<!DOCTYPE html>
    <html lang="en">
        <head>
            <meta charset="UTF-8">
            <title>AI Prompts Builder</title>
            <link href="/src/output.css" rel="stylesheet">
            <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.16/dist/tailwind.min.css" rel="stylesheet">
        </head>
        <body>
            <div class="min-h-screen p-8 bg-gray-100">
                <div class="flex justify-end items-center mb-6">
                    <?php if (!isset($_SESSION['user_id'])): ?>
                        <div class="flex space-x-4">
                            <a href="/login" class="inline-block bg-blue-500 text-white px-6 py-2 rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50">
                                Login
                            </a>
                            <a href="/register" class="inline-block bg-green-500 text-white px-6 py-2 rounded-lg hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-opacity-50">
                                Register
                            </a>
                         </div>
                    <?php else: ?>
                <div class="flex space-x-4">
                    <span class="text-lg text-gray-700">Welcome, User!</span>

                    <form method="POST" action="/api/logout">
                        <button type="submit" class="inline-block bg-red-500 text-white px-6 py-2 rounded-lg hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-opacity-50">
                            Logout
                        </button>
                    </form>
                </div>
                    <?php endif; ?>
                </div>
                    <h1 class="text-3xl font-semibold text-gray-800 mb-6 text-center">AI Prompt Builder</h1>
                    <div class="text-center mb-4">
                        <a href="/blocks" class="inline-block bg-blue-500 text-white px-6 py-2 rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50">
                            Add Block
                        </a>
                    </div>

                <div id="allPromptsContainer" class="mt-6">
                    <?php
                    $previewText = "";

                    if (!empty($prompts)): ?>
                        <?php foreach ($prompts as $prompt): ?>
                            <div class="p-4 bg-gray-50 border border-gray-200 rounded-lg mb-4">
                                <h2 class="text-lg font-semibold"><?= htmlspecialchars($prompt['title']) ?></h2>
                                <p class="text-gray-700 mt-2"><?= nl2br(htmlspecialchars($prompt['body'])) ?></p>
                            </div>
                            <?php $previewText .= htmlspecialchars($prompt['body']) . " "; ?>
                        <?php endforeach; ?>
                        <div class="mt-6">
                            <label class="block text-lg font-semibold mb-2">Preview:</label>
                            <div class="flex bg-gray-50 p-4 border rounded-lg">
                                <p class="text-gray-700"><?= trim($previewText) ?></p>
                            </div>
                        </div>
                    <?php else: ?>
                        <p class="text-red-500">No prompts added yet.</p>
                    <?php endif; ?>
                </div>
        </body>
    </html>