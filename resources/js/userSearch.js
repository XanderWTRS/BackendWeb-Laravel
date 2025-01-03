document.addEventListener('DOMContentLoaded', () => {
    const userSearchInput = document.getElementById('user-search');
    const searchResults = document.getElementById('search-results');

    userSearchInput.addEventListener('input', async function (e) {
        const query = e.target.value.trim();

        if (query.length === 0) {
            searchResults.innerHTML = '';
            return;
        }

        try {
            const response = await fetch(`/search-users?query=${query}`);

            if (!response.ok) {
                throw new Error('Failed to fetch users');
            }
            const users = await response.json();

            searchResults.innerHTML = '';

            if (users.length === 0) {
                searchResults.innerHTML = '<li class="p-2 text-gray-500">No users found</li>';
                return;
            }

            users.forEach(user => {
                const li = document.createElement('li');
                li.classList.add('p-2', 'hover:bg-gray-100', 'cursor-pointer');
                li.innerHTML = `<a href="/profile/${user.username}" class="text-blue-500">${user.username}</a>`;
                searchResults.appendChild(li);
            });
        } catch (error) {
            console.error('Error fetching users:', error);

            searchResults.innerHTML = '<li class="p-2 text-red-500">Error fetching users</li>';
        }
    });

    document.addEventListener('click', (event) => {
        if (!userSearchInput.contains(event.target) && !searchResults.contains(event.target)) {
            searchResults.innerHTML = '';
        }
    });
});
