¿Qué aprenderemos en esta sección?
Sección 6, clase 78
	Vamos a crear una aplicación que nos ayudará a comprender sobre los siguientes temas:

		- Reforzamiento de rutas y parámetros de rutas.
		- Uso de carruseles del Bootstrap 4
		- Uso del HTTP para obtener información
		- Uso de la API de Spotify para obtener información de:
			- Artistas
			- Albumes
			- Audio
			- Trabajo sobre el manejo de data asíncrona.
			- ngModel para enlazar campos de texto a variables del componente.
			- Widgets de Spotify
			- HTML5 audio
		- Observables
		- Maps
		Durante la sección tendremos tareas y al final un examen teórico para reforzar los conocimientos adquiridos.



////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

	para hacer que el angular corra más rapido

	tsconfig.json

	"exclude":[
	    "../node_modules"
	], 
	"compilerOnSave": false

////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
https://developer.spotify.com/
 https://developer.spotify.com/web-api/console/

get-search-item
 https://developer.spotify.com/web-api/console/get-search-item/



80////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
Poner la maqueta en navbar


84////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

   Servicio que ofrece spotify para hacer busqueda en su plataforma, para buscar artista, albunes, etc
   		https://developer.spotify.com/web-api/console/get-search-item/

   			poner artista 
   			pulsar try IT

   			Devuelve request(peticion) y response(respuesta)


   			curl -X GET "https://api.spotify.com/v1/search?q=silvio+rodriguez&type=artist" -H "Accept: application/json"
   			https://api.spotify.com/v1/search?q=silvio+rodriguez&type=artist



**- Crear un servicio para "spotify.service.ts"
          1-  Crear el servicio "spotify"
		          	ng g s services/spotify
					  ///////
		             	import { Injectable } from '@angular/core';
						@Injectable()
						export class SpotifyService {
						  constructor() { }
						}
					  ///////	

          2- Declarar el servicio para q se pueda usar "app.module.ts"
	               ///////
					import { SpotifyService } from './services/spotify.service';
					providers: [ //providers=services=servicios
					    SpotifyService
					],	
					///////

		  3- Usandolo en un componente "home.component.ts"
			  	 ///////
			      import { SpotifyService } from '../../services/spotify.service';
			      constructor(private _miservicioSpotify:SpotifyService ) {
				     _miservicioSpotify.getArtistas();
				  }
				  ///////





		Ejemplo para paso 1		  

		/* este es para el caso especifico de implementacion de un servicio GET*/
			import { Injectable } from '@angular/core';
			import { Http} from '@angular/http';  //para poder hacer get de http
			import 'rxjs/add/operator/map';  //para solo importar el .map

			@Injectable()
			export class SpotifyService {
				  constructor(private objHttp:Http) { }
				  
				  getArtistas(termino:String){ //metodo
			  				let url = "https://api.spotify.com/v1/search?q=silvio+rodriguez&type=artist";
							return this.objHttp.get( url ).map(res=>{
								console.log(res);				
							})
				  }

			}





**- Crear router "app.routes.ts"
          1-  Crear routes "app.routes.ts"
		  			  ///////
							import { RouterModule, Routes } from '@angular/router';

							import { HomeComponent } from './components/home/home.component';
							import { SearchComponent } from './components/search/search.component';

							const APP_ROUTES: Routes = [
							  { path: 'home', component: HomeComponent },
							  { path: 'buscar', component: SearchComponent },
							  
							 // {path:'heroe/:id',component:HeroeComponent },

							  //esta es la ruta por defecto, que tomara sino coincide ninguna
							  { path: '**', pathMatch: 'full', redirectTo: 'home' }
							];

							//si usas este sin hash, asegurarse de que en index.html aparezca esto   <base href="/">
							export const APP_ROUTING = RouterModule.forRoot(APP_ROUTES,{useHash:true} );
							//useHash:true ->para el uso de parametros
							//export const APP_ROUTING = RouterModule.forRoot(APP_ROUTES,{useHash:true});
		  			  ///////	

          2- Declarar el router para q se pueda usar "app.module.ts"
		               ///////
								import { APP_ROUTING } from './app.routes';
								imports: [
								    	...
								    APP_ROUTING
								  ],
						///////
		  3- Usandolo en un componente "navbar.component.html"
			  	 ///////
			            <li class="nav-item" routerLinkActive="active">
						        <a class="nav-link" [routerLink]="['home']">Home</a>
					    </li>
				  ///////


			4- Visualizando el navbar "app.component.html"	  
			    	<app-navbar></app-navbar>  
					<router-outlet></router-outlet>



///////////////////// video 86 y 87//////////////////////// explican lo de los tockens


Autenticar por Tocken en spotify
https://developer.spotify.com/my-applications/#!/applications/cfd67d67cf8141efb046bc524ac1d5ef

	**MY Applications
			aplication: spotiOsmel
				client_id: cfd67d67cf8141efb046bc524ac1d5ef
				client_secret: 43bebae642444dd3b5221b441647ca1e
				grant_type: client_credentials

				nota: 
				son necesarios para poder generar un tocken, que necesitamos usar para poder enviar peticiones
				para hacer el tocken: descargar plugins para chrome (Postman)
				Postman: Nos permite a nosotros realizar peticiones (GET, POST, PUT, DELETE, COPY, patch, etc). Para realizar "pruebas de servicios rest", como es el caso del "Api rest de spotify"

				Cdo nos sale el error "this request require authentication"

	**Web API
	      Authorization Guide
	         hay 2 tipos de autenticaciones:  (min 3)

	             1- Las que requieren el usuario
	             2- Las que requieren el tocken
	                 para generar el tocken (Your application requests refresh and access tokens)


POST https://accounts.spotify.com/api/token

  	  client_id: cfd67d67cf8141efb046bc524ac1d5ef
  client_secret: 43bebae642444dd3b5221b441647ca1e
     grant_type: client_credentials

				{
				    "access_token": "BQCNgJ1BnA0ePw8fIiVwgiJimWLp3siSmR5LcmISvwp7cSxaaUVIGSOxmfg8wPKnmGFCCyty0jclkJZc8zqbzg",
				    "token_type": "Bearer",
				    "expires_in": 3600
				}

GET https://api.spotify.com/v1/search?q=metallica&type=artist
		   Headers :
			   Content-Type : application/x-www-form-urlencoded
			   Authorization: Bearer BQAKkMmYyKC2I9o_oHrlwXJS36xCnatsXaTdX5qipG0vnv_BOgdbzAzHUyWSUw0WtHnDfnHkrRqmixceMK-L9g

///////////////////// video 88//////////////////////// 



OK servicio y componentes
OK que son los MODULOS