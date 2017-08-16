import { Injectable } from '@angular/core';

import { Http, Headers} from '@angular/http';

import 'rxjs/add/operator/map';  //para solo importar el .map

@Injectable()
export class SpotifyService {

	  artistas:any[] =[];	
	  urlBusqueda:string ="https://api.spotify.com/v1/search";
	  urlArtista:string ="https://api.spotify.com/v1/artists";

	  constructor(private objHttp:Http) { }

	  getArtistas(termino:String ){
	  		//let query= "q=silvio+rodriguez&type=artist";
	  		
	  		let headers = new Headers();    //headers es una propiedad por eso no le puedo cambiar el nombre
	  		headers.append('Authorization', 'Bearer BQCNgJ1BnA0ePw8fIiVwgiJimWLp3siSmR5LcmISvwp7cSxaaUVIGSOxmfg8wPKnmGFCCyty0jclkJZc8zqbzg');

	  		let query= `?q=${ termino }&type=artists`;
	  		let url = "https://api.spotify.com/v1/search?query=metallica&type=artist"; //this.urlBusqueda + query;

	  		/*hacer una peticion al url 
					
					 asyncronico
				la data no va a regresar de manera inmediata, va a ser la peticion a spotify y quizas demore unas fracciones de segundo
				por tanto debemos regresar algo así como una promesa(pero en este caso vamos a regresar un observable" que es algo similar a la promesa pero con ciertas ventajas" ), 

	  		*/


		  		//return this.objHttp.get( url )  //esto va a regresar un observable, pero nosotros podemos convertir esa respuesta en un objeto,
				 								// usando .map( que viene de rxjs)
				return this.objHttp.get( url, {headers} ) //, {}
				.map(res=>{ //
					//console.log(res);				
					console.log(res.json() );				
					console.log(res.json().artists.items );				
					this.artistas = res.json().artists.items;

					//return res.json().artists.items;
				})
	  }

	  getArtista(id:String){
	  }


}
