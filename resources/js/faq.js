document.addEventListener('DOMContentLoaded', () => {
    const editCategoryModal = document.getElementById('edit-category-modal');
    const editFaqModal = document.getElementById('edit-faq-modal');

    document.querySelectorAll('.edit-category-button').forEach(button => {
        button.addEventListener('click', () => {
            const categoryId = button.dataset.id;
            const categoryName = button.dataset.name;
            document.getElementById('edit-category-name').value = categoryName;
            document.getElementById('edit-category-form').action = `/admin/faq/category/${categoryId}`;
            editCategoryModal.classList.remove('hidden');
        });
    });

    document.querySelectorAll('.edit-faq-button').forEach(button => {
        button.addEventListener('click', () => {
            const faqId = button.dataset.id;
            const question = button.dataset.question;
            const answer = button.dataset.answer;
            document.getElementById('edit-faq-question').value = question;
            document.getElementById('edit-faq-answer').value = answer;
            document.getElementById('edit-faq-form').action = `/admin/faq/item/${faqId}`;
            editFaqModal.classList.remove('hidden');
        });
    });

    document.getElementById('close-category-modal').addEventListener('click', () => {
        editCategoryModal.classList.add('hidden');
    });

    document.getElementById('close-faq-modal').addEventListener('click', () => {
        editFaqModal.classList.add('hidden');
    });
});
