document.addEventListener('DOMContentLoaded', () => {
    const bookListContainer = document.getElementById('book-list');
    const addBookForm = document.getElementById('add-book-form');

    const fetchAndDisplayBooks = () => {
        fetch('/api/books')
            .then(response => response.json())
            .then(data => {
                bookListContainer.innerHTML = '';
                data.forEach(book => {
                    const bookItem = document.createElement('div');
                    bookItem.classList.add('book-item');
                    bookItem.innerHTML = `
                        <h2>${book.title}</h2>
                        <p><strong>ISBN:</strong> ${book.isbn}</p>
                        <p><strong>Release Date:</strong> ${new Date(book.releaseDate).toDateString()}</p>
                        <p><strong>ID:</strong> ${book.id}</p>
                    `;
                    bookListContainer.appendChild(bookItem);
                });
            })
            .catch(error => {
                console.error('Error fetching book data:', error);
                bookListContainer.innerHTML = '<p>Failed to load book data.</p>';
            });
    };
    fetchAndDisplayBooks();

    addBookForm.addEventListener('submit', (event) => {
        event.preventDefault();

        const formData = new FormData(addBookForm);
        const bookData = {
            book: {
                title: formData.get('title'),
                isbn: formData.get('isbn'),
                releaseDate: new Date(formData.get('releaseDate')).toISOString(),
            }
        };

        fetch('/api/books', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify(bookData),
        })
            .then(response => response.json())
            .then(data => {
                console.log('Book added:', data);
                addBookForm.reset();
                fetchAndDisplayBooks();
            })
            .catch(error => {
                console.error('Error adding book:', error);
            });
    });
});
