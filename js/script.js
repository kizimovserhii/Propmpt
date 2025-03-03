$(document).ready(function() {
    let prompts = [];

    $("#addBlockBtn").click(function () {
        $('#addBlockModal').fadeIn();
    });

    $("#closeModal").click(function () {
        $("#addBlockModal").fadeOut();
    });

    $('#categoryId').on('change', function () {
        const categoryId = $(this).val();

        $.ajax({
            "url": '/api/get-prompt-by-category',
            "method": 'POST',
            "data": {"category_id": categoryId},

            "success": function (data) {
                $('#PromptsContainer').html(data);
            },
            "error": function (xhr, status, error) {
                console.error('Error:', error);
            }
        });
    });

    $(document).on('click', '.prompts', function () {
        let promptId = $(this).data('id');

        if (!prompts.includes(promptId)) {
            prompts.push(promptId);
        }

        $("#addBlockModal").fadeOut();
        updatePrompts(prompts);
    });

    function updatePrompts(prompts) {
        if (prompts && prompts.length > 0) {
            $.ajax({
                url: '/api/update-prompts',
                method: 'POST',
                data: {prompts: prompts},
                success: function (response) {
                    $('#PromptsList').html(response);
                    startDragAndDrop();
                    previewPrompts();
                },
                error: function (xhr, status, error) {
                    console.error('Error:', error);
                }
            });
        } else {
            $('#PromptsList').html('No prompts added yet.');
            previewPrompts();
        }
    }

    function previewPrompts() {
        const prompts = $('.prompt-body');
        let text = '';

        prompts.each(function (index, value) {
            text = text + value.textContent;
        })

        $('#promptsPreview').html('<input type="text" placeholder="' + text + '" disabled class="p-4 bg-white border border-gray-200 rounded-lg mb-4 w-full" />');
    }

    function startDragAndDrop() {
        const $selectedPrompts = $('#selectedPrompts')[0];

        if ($selectedPrompts) {
            new Sortable($selectedPrompts, {
                group: 'prompts',
                animation: 150,
                onEnd: evt => {
                    console.log('success', $(evt.item).data('id'), '→', evt.newIndex);
                    previewPrompts();
                }
            });
        }
    }
});

