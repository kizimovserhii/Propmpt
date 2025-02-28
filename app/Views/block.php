<!DOCTYPE html>
    <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>AI Prompt</title>
            <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css">
        </head>
        <body class="bg-gray-100 p-6">
            <div class="max-w-4xl mx-auto bg-white p-6 rounded-lg shadow-lg">
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
                    <h1 class="text-2xl font-bold mb-6 text-center">AI Prompts Builder</h1>
                <div id="allPromptsContainer" class="mt-6">
                    <?php if (!empty($prompts)): ?>
                        <?php foreach ($prompts as $prompt): ?>
                            <div class="p-4 bg-gray-50 border border-gray-200 rounded-lg mb-4">
                                <h2 class="text-lg font-semibold">
                                    <a href="#" class="add-prompt text-gray-800 hover:underline"
                                       data-id="<?= $prompt['id'] ?>"
                                       data-title="<?= htmlspecialchars($prompt['title']) ?>"
                                       data-body="<?= htmlspecialchars($prompt['body']) ?>">
                                        <?= htmlspecialchars($prompt['title']) ?>
                                    </a>
                                </h2>
                                <p class='text-gray-700 mt-2'><?= nl2br(htmlspecialchars($prompt['body'])) ?></p>
                            </div>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <p class="text-red-500">No prompts found.</p>
                    <?php endif; ?>
                    </div>
                </div>
            <script>
                document.querySelectorAll('.add-prompt').forEach(link => {
                    link.addEventListener('click', function(event) {
                        event.preventDefault();
                        const promptId = this.getAttribute('data-id');

                        fetch('/api/add-prompt', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                            },
                            body: JSON.stringify({ id: promptId }),
                        })
                            .then(response => response.json())
                            .then(data => {
                                if (data.success) {
                                    window.location.href = '/';
                                } else {
                                    alert(data.message || 'Error adding prompt!');
                                }
                            })
                            .catch(error => console.error('Error:', error));
                    });
                });
            </script>
        </body>
    </html>