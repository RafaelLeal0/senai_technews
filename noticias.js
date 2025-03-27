document.addEventListener('DOMContentLoaded', function() {
    // Elementos
    const searchInput = document.getElementById("search-input");
    const searchButton = document.getElementById("search-button");
    const sourceSelect = document.getElementById("source-select");
    const newsContainer = document.getElementById("news-container");

    const apiKey = "25204e69210b41c4971125e26b0db56d";
    const baseUrl = "https://newsapi.org/v2/";

    const fetchNews = async (query, source) => {
        newsContainer.innerHTML = '<div class="loading">Carregando notícias...</div>';
        
        let url = `${baseUrl}top-headlines?apiKey=${apiKey}&country=br`;

        if (source && source !== "all") {
            url = `${baseUrl}top-headlines?apiKey=${apiKey}&sources=${source}`;
        }
        
        if (query) {
            url += `&q=${encodeURIComponent(query)}`;
        }

        try {
            const response = await fetch(url);
            if (!response.ok) throw new Error(`Erro: ${response.status}`);
            const data = await response.json();

            newsContainer.innerHTML = '';
            
            if (data.articles?.length > 0) {
                data.articles.forEach(article => createNewsCard(article));
                initMasonry();
            } else {
                newsContainer.innerHTML = "<p class='no-results'>Nenhuma notícia encontrada.</p>";
            }
        } catch (error) {
            console.error("Erro ao buscar notícias:", error);
            newsContainer.innerHTML = `<p class="error">Erro ao carregar notícias: ${error.message}</p>`;
        }
    };

    const createNewsCard = (article) => {
        const card = document.createElement("div");
        card.className = "news-card";

        card.innerHTML = `
            <img src="${article.urlToImage || 'https://via.placeholder.com/400x250?text=Sem+Imagem'}" 
                 alt="${article.title}"
                 onerror="this.src='https://via.placeholder.com/400x250?text=Imagem+Não+Disponível'">
            <div class="news-content">
                <h3>${article.title}</h3>
                <span class="source">${article.source?.name || 'Fonte desconhecida'}</span>
                <p>${article.description || 'Sem descrição disponível.'}</p>
                <a href="${article.url}" target="_blank" class="read-more">Leia mais →</a>
            </div>
        `;

        newsContainer.appendChild(card);
    };

    const initMasonry = () => {
        newsContainer.style.columns = "3 300px";
        newsContainer.style.columnGap = "20px";
        
        Array.from(newsContainer.children).forEach(item => {
            item.style.breakInside = "avoid";
            item.style.marginBottom = "20px";
        });
    };

    const populateSources = async () => {
        try {
            const response = await fetch(`${baseUrl}top-headlines/sources?country=br&apiKey=${apiKey}`);
            const data = await response.json();
            
            if (data.sources?.length > 0) {
                data.sources.forEach(source => {
                    const option = new Option(source.name, source.id);
                    sourceSelect.add(option);
                });
            }
        } catch (error) {
            console.error("Erro ao carregar fontes:", error);
        }
    };

    searchButton.addEventListener("click", () => fetchNews(searchInput.value.trim(), sourceSelect.value));
    searchInput.addEventListener("keypress", (e) => e.key === "Enter" && fetchNews(searchInput.value.trim(), sourceSelect.value));
    sourceSelect.addEventListener("change", () => fetchNews(searchInput.value.trim(), sourceSelect.value));

    (async () => {
        await populateSources();
        fetchNews("", "globo");
    })();
});