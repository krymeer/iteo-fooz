function fetchLatestBooks()
{
    const ulElement = document.querySelector('#latest-books > ul');

    if (ulElement && kroTtfe?.currentId && kroTtfe.apiUrl )
    {
        fetch(`${kroTtfe.apiUrl}/book?per_page=20&exclude=${kroTtfe.currentId}&orderby=date&order=desc&_embed`)
            .then(response => {
                if (!response.ok) throw new Error('Fetching data error');
                return response.json();
            })
            .then(books => {
                if (books.length === 0)
                {
                    ulElement.parentElement.remove();
                    return;
                }

                books.forEach(book => {
                    let liHTML      = '';
                    const genres    = book?._embedded?.['wp:term']?.[0] ?? [];
                    const genreList = genres.map(g => g.name).join(', ') || '';

                    if (book.title?.rendered)
                    {
                        liHTML += `<strong>"${book.title.rendered}"</strong>`;
                    }

                    if (book.excerpt?.rendered)
                    {
                        liHTML += book.excerpt.rendered;
                    }

                    if (genreList)
                    {
                        liHTML += `<p><strong>Genres:</strong> ${genreList}</p>`;
                    }

                    if (book.link)
                    {
                        liHTML += `<a href="${book.link}" target="_blank">Read more...</a>`;
                    }

                    if (liHTML)
                    {
                        ulElement.innerHTML += `<li>${liHTML}</li>`;
                    }
                });
            })
            .catch(err => console.error('REST API Error:', err));
    }
}

window.addEventListener('load', loadEvent => {
    fetchLatestBooks();
});