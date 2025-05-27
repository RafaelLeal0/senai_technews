document.addEventListener('DOMContentLoaded', function () {
  const searchInput = document.getElementById("search-input");
  const searchButton = document.getElementById("search-button");
  const newsContainer = document.getElementById("news-container");

  const apiKey = "25204e69210b41c4971125e26b0db56d";
  const baseUrl = "https://newsapi.org/v2/";

  // Função que monta e faz a requisição
  const fetchNews = async (extraQuery) => {
    newsContainer.innerHTML = '<div class="loading">Carregando notícias...</div>';

    let termos = 'SENAI AND (programação OR tecnologia OR inteligencia artificial OR IA)';
    if (extraQuery) {
      termos += ` AND (${extraQuery})`;
    }

    // parâmetros da URL
    const params = new URLSearchParams({
      apiKey: apiKey,
      language: 'pt',
      q: termos,
      sortBy: 'relevancy',
      pageSize: '15'
    });

    try {
      const response = await fetch(`${baseUrl}everything?${params}`);
      if (!response.ok) throw new Error(`Status ${response.status}`);
      const data = await response.json();

      newsContainer.innerHTML = '';

      if (data.articles?.length) {
        data.articles.forEach(createNewsCard);
        initMasonry();
      } else {
        newsContainer.innerHTML = "<p class='no-results'>Nenhuma notícia encontrada.</p>";
      }
    } catch (error) {
      console.error("Erro ao buscar notícias:", error);
      newsContainer.innerHTML = `<p class="error">Erro ao carregar notícias: ${error.message}</p>`;
    }
  };

  // Cria o card de notícia
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
  };

  searchButton.addEventListener("click", () => fetchNews(searchInput.value.trim()));
  searchInput.addEventListener("keypress", (e) => {
    if (e.key === "Enter") fetchNews(searchInput.value.trim());
  });

  fetchNews("");
});
