<!DOCTYPE html>
    <html lang="en">
        <head>
            <meta charset="UTF-8">
            <title>Create Prompt</title>
            <link href="/src/output.css" rel="stylesheet">
            <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.16/dist/tailwind.min.css" rel="stylesheet">
        </head>
        <body>
            <div class="bg-white p-8 rounded-lg shadow-lg w-full max-w-md mx-auto">
                <h1 class="text-2xl font-semibold text-gray-800 mb-6">Create a New Prompt</h1>

                <form action="/api/prompts" method="POST">
                    <div class="mb-4">
                        <label for="title" class="block text-gray-700 text-sm font-medium mb-2">Title</label>
                        <input
                            type="text"
                            name="title"
                            id="title"
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
                            class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                            required>
                        </textarea>
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
                                <option value="<?= $category['id'] ?>"><?= htmlspecialchars($category['title']) ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div>
                        <form action="/prompts/create" method="GET">
                            <button type="submit" class="inline-block bg-blue-500 text-white px-6 py-2 rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50">
                                Add Prompt
                            </button>
                        </form>
                    </div>
                </form>
            </div>
        </body>
    </html>
