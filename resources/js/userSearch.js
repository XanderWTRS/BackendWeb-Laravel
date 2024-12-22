document.getElementById('user-search').addEventListener('input', async function (e) {
    const query = e.target.value;

    if (query.length > 0) {
        try {
            const response = await fetch(`/search-users?query=${query}`);
            if (!response.ok) {
                throw new Error('Failed to fetch users');
            }

            const users = await response.json();
            const results = document.getElementById('search-results');
            document.getElementById('user-search').addEventListener('input', async function (e) {
                const query = e.target.value;

                if (query.length > 0) {
                    try {
                        const response = await fetch(`/search-users?query=${query}`);
                        if (!response.ok) {
                            throw new Error('Failed to fetch users');
                        }

                        const users = await response.json();
                        const results = document.getElementById('search-results');

                        results.innerHTML = '';

                        if (users.length === 0) {
                            results.innerHTML = '<li class="p-2">No users found</li>';
                            return;
                        }

                        users.forEach(user => {
                            const li = document.createElement('li');
                            li.classList.add('p-2', 'hover:bg-gray-100');
                            li.innerHTML = `<a href="/profile/${user.username}" class="text-blue-500">${user.username}</a>`;
                            results.appendChild(li);
                        });
                    } catch (error) {
                        console.error('Error fetching users:', error);
                    }
                } else {
                    document.getElementById('search-results').innerHTML = '';
                }
            });

            results.innerHTML = '';

            if (users.length === 0) {
                results.innerHTML = '<li class="p-2">No users found</li>';
                return;
            }

            users.forEach(user => {
                const li = document.createElement('li');
                li.classList.add('p-2', 'hover:bg-gray-100');
                li.innerHTML = `<a href="/profile/${user.username}" class="text-blue-500">${user.username}</a>`;
                results.appendChild(li);
            });
        } catch (error) {
            console.error('Error fetching users:', error);
        }
    } else {
        document.getElementById('search-results').innerHTML = '';
    }
});
