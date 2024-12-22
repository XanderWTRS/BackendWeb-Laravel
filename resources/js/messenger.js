document.getElementById('sendMessageForm').addEventListener('submit', async (e) => {
    e.preventDefault();

    const formData = new FormData(e.target);

    const response = await fetch('/messages/send', {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
        },
        body: formData,
    });

    if (response.ok) {
        alert('Message sent successfully!');
        e.target.reset();
    } else {
        alert('Failed to send the message.');
    }
});
