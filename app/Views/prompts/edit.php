<!DOCTYPE html>
    <html lang="en">
        <head>
            <meta charset="UTF-8">
            <title>Edit Prompt</title>
            <link href="/src/output.css" rel="stylesheet">
            <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.16/dist/tailwind.min.css" rel="stylesheet">
        </head>
        <body>
            <div class="bg-white p-8 rounded-lg shadow-lg w-full max-w-md mx-auto mt-10">
                <h1 class="text-2xl font-semibold text-gray-800 mb-6">Edit Prompt</h1>

                <form id="updateForm" action="/api/prompts/<?php echo htmlspecialchars($prompt['id']); ?>" method="POST">
                    <input type="hidden" name="_method" value="PUT">
                    <div class="mb-4">
                        <label for="title" class="block text-gray-700 text-sm font-medium mb-2">Title</label>
                        <input
                            type="text"
                            name="title"
                            id="title"
                            value="<?php echo htmlspecialchars($prompt['title'] ?? ''); ?>"
                            placeholder="Prompt title"
                            class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                            required>
                    </div>

                    <div class="mb-4">
                        <label for="body" class="block text-gray-700 text-sm font-medium mb-2">Body</label>
                        <textarea
                            name="body"
                            id="body"
                            rows="4"
                            placeholder="Enter the body of the prompt"
                            class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                            required><?php echo htmlspecialchars($prompt['body'] ?? ''); ?></textarea>
                    </div>

                    <div class="mb-4">
                        <label for="category_id" class="block text-gray-700 text-sm font-medium mb-2">Category</label>
                        <select
                            name="category_id"
                            id="category_id"
                            class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                            required>
                        <option value="">Select Category</option>
                            <?php foreach ($categories as $category): ?>
                                <option value="<?= $category['id']; ?>"><?= $category['title']; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="flex justify-between">
                        <a href="#" onclick="document.getElementById('updateForm').submit();"
                            class="inline-block bg-blue-500 text-white px-6 py-2 rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50">
                            Update
                        </a>

                        <a href="/prompts" class="bg-gray-500 text-white p-3 rounded-lg hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-gray-500">
                            Cancel
                        </a>
                    </div>
                </form>
            </div>
        </body>
    </html>