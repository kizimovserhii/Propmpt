<!DOCTYPE html>
    <html lang="en">
        <head>
            <meta charset="UTF-8">
            <title>View Prompt</title>
            <link href="/src/output.css" rel="stylesheet">
            <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.16/dist/tailwind.min.css" rel="stylesheet">
        </head>
        <body>
            <div class="bg-white p-8 rounded-lg shadow-lg w-full max-w-md mx-auto mt-10">
                <?php if ($prompt): ?>
                    <div class="bg-gray-50 p-4 rounded-lg shadow-md mb-6">
                        <div class="flex justify-between items-baseline mb-4">
                            <h2 class="text-2xl font-semibold text-gray-800">Title:</h2>
                            <p class="text-lg text-gray-900"><?= htmlspecialchars($prompt['title']) ?></p>
                        </div>

                        <div class="flex justify-between items-baseline mb-4">
                            <h2 class="text-2xl font-semibold text-gray-800">Body:</h2>
                            <p class="text-lg text-gray-900"><?= nl2br(htmlspecialchars($prompt['body'])) ?></p>
                        </div>

                        <div class="flex justify-between items-baseline mb-4">
                            <h2 class="text-2xl font-semibold text-gray-800">Category:</h2>
                            <p class="text-lg text-gray-900"><?= nl2br(htmlspecialchars($prompt['category_title'])) ?></p>
                        </div>
                    </div>
                <?php else: ?>
                    <p class="text-center text-gray-600">Prompt not found.</p>
                <?php endif; ?>
                <div class="mt-6 flex justify-between">
                    <a href="/prompts/<?= htmlspecialchars($prompt['id']); ?>/edit"
                        class="inline-block text-black bg-blue-500 hover:bg-blue-600 py-2 px-4 rounded-md transition-all">
                        Edit
                    </a>

                    <a href="/prompts"
                        class="inline-block text-black bg-gray-200 hover:bg-gray-300 py-2 px-4 rounded-md transition-all">
                        Back to all prompts
                    </a>

                    <form action="/api/prompts/<?= htmlspecialchars($prompt['id']); ?>" method="POST" class="inline-block">
                        <input type="hidden" name="_method" value="DELETE">
                        <button type="submit"
                            class="inline-block text-white bg-red-500 hover:bg-red-600 py-2 px-4 rounded-md transition-all"
                            onclick="return confirm('Are you sure you want to delete this prompt?');">
                            Delete
                        </button>
                    </form>

                </div>
            </div>
        </body>
    </html>