// Get the elements from the HTML document
const searchInput = document.getElementById("search-input");
const searchButton = document.getElementById("search-button");
const sourceSelect = document.getElementById("source-select"); // Changed from category-select
const newsContainer = document.getElementById("news-container");

// Define the API key and the base URL
const apiKey = "25204e69210b41c4971125e26b0db56d"; // Replace with your NewsAPI key
const baseUrl = "https://newsapi.org/v2/";

// Fetch news articles based on query and source
const fetchNews = async (query, source) => {
    newsContainer.innerHTML = "";
    let url = `${baseUrl}top-headlines?apiKey=${apiKey}&sources=globo`; // Replace 'globo' with your desired Brazilian source ID

    if (query) {
        url += `&q=${encodeURIComponent(query)}`;
    }

    try {
        const response = await fetch(url);
        if (!response.ok) throw new Error(`Error: ${response.status}`);
        const data = await response.json();

        if (data.articles?.length > 0) {
            data.articles.forEach(article => createArticleElement(article));
        } else {
            newsContainer.innerHTML = "<p>No articles found.</p>";
        }
    } catch (error) {
        console.error("Fetch error:", error);
        newsContainer.innerHTML = "<p>Error fetching news.</p>";
    }
};

// Helper function to create article elements
const createArticleElement = (article) => {
    const articleDiv = document.createElement("div");
    articleDiv.className = "news-article";

    const elements = {
        img: { src: article.urlToImage, alt: article.title },
        h3: { text: article.title },
        p: { text: article.description },
        a: { href: article.url, text: "Read more" }
    };

    Object.entries(elements).forEach(([tag, attrs]) => {
        const el = document.createElement(tag);
        if (tag === 'img') {
            el.src = attrs.src;
            el.alt = attrs.alt;
        } else if (tag === 'a') {
            el.href = attrs.href;
            el.target = "_blank";
            el.textContent = attrs.text;
        } else {
            el.textContent = attrs.text;
        }
        articleDiv.appendChild(el);
    });

    newsContainer.appendChild(articleDiv);
};

// Event listeners
searchButton.addEventListener("click", () => {
    fetchNews(searchInput.value.trim(), sourceSelect.value);
});

sourceSelect.addEventListener("change", () => {
    fetchNews(searchInput.value.trim(), sourceSelect.value);
});

// Initial load
fetchNews("", "globo"); // Default to 'globo' source