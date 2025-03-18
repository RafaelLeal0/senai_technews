const API_KEY = "cece4da7fc8c4bb99a87b2c65cafe37e";
const API_URL = `https://newsapi.org/v2/top-headlines?sources=google-news-br&apiKey=${API_KEY}`;

// Função para buscar notícias
async function fetchNews() {
    try {
        const response = await fetch(API_URL);
        const data = await response.json();

        if (data.articles) {
            displayNews(data.articles);
        }
    } catch (error) {
        console.error("Erro ao buscar notícias:", error);
    }
}

function displayNews(articles) {
    const newsContainer = document.getElementById("news-container");
    newsContainer.innerHTML = ""; // Limpa antes de adicionar novas notícias

    articles.forEach((article, index) => {
        if (index < 4) { // Limita a 6 notícias
            const newsItem = document.createElement("div");
            newsItem.classList.add("news-item");

            let imageUrl = article.urlToImage ? article.urlToImage : "./img/default-news.jpg"; // Imagem padrão caso não haja uma

            newsItem.innerHTML = `
                <img src="${imageUrl}" alt="Imagem da Notícia">
                <div class="news-content">
                    <h3>${article.title}</h3>
                    <p>${article.description ? article.description : "Descrição não disponível."}</p>
                    <a href="${article.url}" target="_blank">Leia mais</a>
                </div>
            `;

            newsContainer.appendChild(newsItem);
        }
    });
}

// Chama a função ao carregar a página
fetchNews();

// // Botão de voltar ao topo
// let topBtn = document.getElementById("topBtn");

// window.onscroll = function() {
//     if (document.documentElement.scrollTop > 200) {
//         topBtn.style.display = "block";
//     } else {
//         topBtn.style.display = "none";
//     }
// };

// topBtn.onclick = function() {
//     window.scrollTo({ top: 0, behavior: "smooth" });
// };
