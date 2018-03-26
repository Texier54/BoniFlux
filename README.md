# BoniFlux

BoniFlux est un site permettant le streaming de sa Webcam à plusieurs personnes. Vous pouvez vous connecter, chater, streamer, vous abonner à des streamer et venir regarder des streams sans compte utilisateurs.

### Installation

```
* Clone le depot git — git clone https://github.com/Texier54/BoniFlux
* Configuration de la connexion à la BDD ./src/conf/boniflux.db.conf.ini
* Importation des tables de la BDD /sql/boniflux.sql
* Dans ./src composer install
* Dans ./public npm install
* Dans ./public npm run dev
```
* Pour acceder au site il faudra aller au lien **localhost:XXXX**, dependant de ce que votre npm run dev vous dis, normalement c'est le port **8080**

## Fait avec

* [vuejs](https://github.com/vuejs) javascript framework
  * [vue](https://github.com/vuejs/vue)
  * [vue-router](https://github.com/vuejs/vue-router)
  * [vuex](https://github.com/vuejs/vuex)
* [Axios](https://github.com/axios/axios)
* [Leaflet](https://github.com/Leaflet/Leaflet) javascript library 
* [Bulma CSS](https://github.com/jgthms/bulma) framwork

## Autheurs

* **Baptiste Texier** - *Lancement* - [Github](https://github.com/texier54)
* [Charles Montrouge](https://github.com/Charles974)
* [Jordan Sautron](https://github.com/Voytsu)
* [Daniel Ricklin](https://github.com/DanielRicklin)

## License

This project is licensed under the MIT License - see the [LICENSE.md](LICENSE.md) file for details

