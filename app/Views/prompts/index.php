<!DOCTYPE html>
    <html lang="en">
        <head>
            <meta charset="UTF-8">
            <title>All Prompts</title>
            <link href="/src/output.css" rel="stylesheet">
            <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.16/dist/tailwind.min.css" rel="stylesheet">
        </head>
        <body>
            <div class="bg-white p-8 rounded-lg shadow-lg w-full max-w-7xl mx-auto">
                <h1 class="text-3xl font-semibold text-gray-800 mb-6 text-center">AI Prompt Builder</h1>

                <div class="">
                    <?php if (!empty($prompts)): ?>
                        <?php foreach ($prompts as $prompt): ?>
                            <div class="bg-gray-50 p-4 rounded-lg shadow-md mb-6">
                                <h2 class="text-xl font-semibold text-gray-800 mb-4">
                                    <a href='/prompts/<?= htmlspecialchars($prompt['id']) ?>'
                                        class='text-gray-800 hover:underline' style='text-decoration: none;'>
                                        <?= htmlspecialchars($prompt['title']) ?>
                                    </a>
                                </h2>
                                <p class="text-gray-600 mb-4"><?= htmlspecialchars($prompt['body']) ?></p>
                            </div>
                        <?php endforeach; ?>
                    <?php else: ?>
                    <p class="text-center text-gray-600">No prompts available.</p>
                    <?php endif; ?>
                </div>
                <div>
                    <a href="/prompts/create" class="inline-block bg-blue-500 text-white px-6 py-2 rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50">
                        Add Prompt
                    </a>
                </div>
            </div>
        </body>
    </html>
