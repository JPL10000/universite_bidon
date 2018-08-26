import $ from 'jquery';

class Search {
    // 1 - description et création de l'objet 
    constructor() {
        this.addSearchHTML();
        this.resultsDiv = $("#search_overlay__results");
        this.openButton = $(".js-search-trigger");
        this.closeButton = $(".search-overlay__close");
        this.searchOverlay = $(".search-overlay");
        this.searchField = $("#search-term");
        this.events();
        this.isOverlayOpen = false;
        this.isSpinnerVisible = false;
        this.previousValue;
        this.typingTimer;
    }

    // 2 - évènements
    events() {
        this.openButton.on("click", this.openOverlay.bind(this));
        this.closeButton.on("click", this.closeOverlay.bind(this));
        $(document).on("keydown", this.keyPressDispatcher.bind(this));
        this.searchField.on("keyup", this.typingLogic.bind(this));
    }

    // 3 methods
    typingLogic() {

        if (this.searchField.val() != this.previousValue) {
            clearTimeout(this.typingTimer);

            if (this.searchField.val()) {
                if (!this.isSpinnerVisible) {
                    this.resultsDiv.html('<div class="spinner-loader"></div>');
                    this.isSpinnerVisible = true;
                }
                this.typingTimer = setTimeout(this.getResults.bind(this), 500);
            } else {
                this.resultsDiv.html('');
                this.isSpinnerVisible = false;
            }

        }
        this.previousValue = this.searchField.val();        
    }

    getResults() {

        $.getJSON(monThemeData.root_url + '/wp-json/monTheme/v1/search?recherche=' + this.searchField.val(), (results) => {
            this.resultsDiv.html(`
                <div class="row">
                    <div class="one-third">
                        <h2 class="search-overlay__section-title">Informations générales</h2>
                        ${results.informationsGenerales.length ? '<ul class="link-list min-list">' : '<p>Il n\'y a rien sur le site qui corresponde à cette requête.</p>'}
                        ${results.informationsGenerales.map(item => `<li><a href="${item.permalink}">${item.title}</a> ${item.postType == 'post' ? `par ${item.auteur}` : ''}</li>`).join('')}
                        ${results.informationsGenerales.length ? '</ul>' : ''}
                    </div>
                    <div class="one-third">
                        <h2 class="search-overlay__section-title">Programmes</h2>
                        
                        ${results.programmes.length ? '<ul class="link-list min-list">' : `<p>Il n\'y a pas de programme sur le site qui corresponde à cette requête. <a href="${monThemeData.root_url}/programmes">Voir tous les programmes</a></p>`}
                        ${results.programmes.map(item => `<li><a href="${item.permalink}">${item.title}</a></li>`).join('')}
                        ${results.programmes.length ? '</ul>' : ''}

                        <h2 class="search-overlay__section-title">Coaches</h2>
                        
                        ${results.coaches.length ? '<ul class="coach-cards">' : `<p>Il n\'y a pas de coach qui corresponde à cette requête. <a href="${monThemeData.root_url}/coaches">Voir tous les coaches</a></p>`}
                        ${results.coaches.map(item => `
                            <li class="coach-card__list-item">
                                <a class="coach-card" href="${item.permalink}">
                                <img class="coach-card__image" src="${item.image}">
                                <<span class="coach-card__name">${item.title}</span>
                                </a>
                            </li>
                        `).join('')}
                        ${results.coaches.length ? '</ul>' : ''}
                    </div>
                    <div class="one-third">
                        <h2 class="search-overlay__section-title">Incubateurs</h2>
                        
                        ${results.incubateurs.length ? '<ul class="link-list min-list">' : `<p>Il n\'y a pas d'incubateur qui corresponde à cette requête. <a href="${monThemeData.root_url}/incubateurs">Voir tous les incubateurs</a></p>`}
                        ${results.incubateurs.map(item => `<li><a href="${item.permalink}">${item.title}</a></li>`).join('')}
                        ${results.incubateurs.length ? '</ul>' : ''}
                        
                        <h2 class="search-overlay__section-title">Evènements</h2>

                        ${results.evenements.length ? '' : `<p>Il n\'y a pas d'évènements prévus prochainement qui corresponde à cette requête. <a href="${monThemeData.root_url}/evenements">Voir tous les évènements</a></p>`}
                        ${results.evenements.map(item => `
                            <div class="event-summary">
                            <a class="event-summary__date t-center" href="${item.permalink}">
                            <span class="event-summary__month">${item.mois}
                            </span>
                            <span class="event-summary__day">${item.jour}</span>  
                            </a>
                            <div class="event-summary__content">
                            <h5 class="event-summary__title headline headline--tiny"><a href="${item.permalink}">${item.title}</a></h5>
                            <p>${item.excerpt}<a href="${item.permalink}" class="nu gray">En savoir plus</a></p>
                            </div>
                            </div>
                        `).join('')}
                    
                    </div>
                </div>
            `);
            this.isSpinnerVisible = false;
        });

    }  

    keyPressDispatcher(e) {
        if(e.keyCode == 83 && !this.isOverlayOpen && !$("input, textarea").is(':focus')) {
            this.openOverlay();
        }

        if(e.keyCode == 27 && this.isOverlayOpen) {
            this.closeOverlay();
        }
    }

    openOverlay() {
        this.searchOverlay.addClass("search-overlay--active");
        $("body").addClass("body-no-scroll");
        this.searchField.val('');
        setTimeout(() => this.searchField.focus(), 301);
        console.log("notre méthode openOverlay a été exécutée")
        this.isOverlayOpen = true;
    }

    closeOverlay() {
        this.searchOverlay.removeClass("search-overlay--active");
        $("body").removeClass("body-no-scroll");
        console.log("notre méthode closeOverlay a été exécutée")
        this.isOverlayOpen = false;
    }

    addSearchHTML() {
        $("body").append(`
            <div class="search-overlay">
                <div class="search-overlay__top">
                    <div class="container">
                        <i class="fa fa-search search-overlay__icon" aria-hidden="true"></i>
                        <input type="text" class="search-term" placeholder="Que cherchez-vous ?" id="search-term">
                        <i class="fa fa-window-close search-overlay__close" aria-hidden="true"></i> 
                    </div>
                </div>

                <div class="container">
                    <div id="search_overlay__results">
                    </div>
                </div>
            </div>
        `);
    }


}

export default Search