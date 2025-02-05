class Article {
    #id: number;
    #titol: string;
    #cos: string;
    #user_id?: number;
    #data?: string;

    constructor(id: number, titol: string, cos: string, user_id?: number, data?: string){
        this.#id = id;    
        this.#titol = titol;
        this.#cos = cos;
        this.#user_id = user_id;
        this.#data = data;
    }

    public getId(){
        return this.#id;
    }

    public getTitol(){
        return this.#titol;
    }

    public getCos(){
        return this.#cos;
    }

    public getUserID(){
        return this.#user_id;
    }

    public getData(){
        return this.#data;
    }
}

setTimeout(loadArticles, 5000);

function loadArticles() {
    console.log("Iniciando carga de artículos...");

    const fetchSpinnerId = "#spinner"; 
    $(fetchSpinnerId).show(); 

    $.ajax({
        type: 'GET',
        url: 'http://localhost/Practica06-main/model/model_ajax_article.php?action=mostrarTotsArticles', 
        dataType: "json",
        success: function(response) {
            console.log("Peticio correcte:", response);

            if (response.error) {
                console.error("Error en la peticio:", response.error);
                return;
            }

            
            let articles: Article[] = response.map((data: any) => {
                return new Article(data.id, data.titol, data.cos, data.user_id, data.data);
            });

            
            mostrarArticles(articles);
        },
        error: function(xhr, status, error) {
            console.error("Error AJAX:", status, error);
            console.error("Respuesta del servidor:", xhr.responseText);
        }
    });
}

function mostrarArticles(articles: Article[]) {
    const articlesContainer = $(".articles-blocks");
    articlesContainer.empty(); 

    if (articles.length === 0) {
        articlesContainer.append("<p>No hi ha articles disponibles.</p>");
        return;
    }

    
    articles.forEach(article => {
        const articleHtml = `
            <div class="article-block">
                <div class="article-header">
                    <h3>${article.getTitol()}</h3>
                    <small>Usuari: ${article.getUserID() ? article.getUserID() : 'Sense Usuari'}</small><br>
                    <small>Data: ${article.getData() ? article.getData() : 'Sense Data'}</small>
                </div>
                <div class="article-content">
                    <p>${article.getCos()}</p>
                </div>
                <div class="article-actions">
                    <form method="POST" action="editar_article.php" style="display: inline;">
                        <input type="hidden" name="id" value="${article.getId()}">
                        <button class="boto_editar" type="submit" aria-label="Editar article"></button>
                    </form>

                    <form method="POST" action="eliminar_article.php" style="display: inline;" class="form-delete">
                        <input type="hidden" name="id" value="${article.getId()}">
                        <button type="submit" class="boto_borrar" aria-label="Eliminar article"></button>
                    </form>

                    <form method="GET" action="./controller/controlador_generador_qr.php" style="display: inline;">
                        <input type="hidden" name="id" value="${article.getId()}">
                        <button type="button" class="boto_qr" onclick="abrirPopup(${article.getId()})">Generar QR</button>
                    </form>
                </div>
            </div>
        `;
        articlesContainer.append(articleHtml);
    });
}


$(document).ready(function() {
    loadArticles();
});
