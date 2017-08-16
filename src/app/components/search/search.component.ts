import { Component, OnInit } from '@angular/core';
import { SpotifyService } from '../../services/spotify.service';

@Component({
  selector: 'app-search',
  templateUrl: './search.component.html',
  styleUrls: ['./search.component.css']
})
export class SearchComponent implements OnInit {

	//para manejar este termino desde el lado del html voy a usar un engineModel
	termino:string = "";

	   constructor(private _miservicioSpotify:SpotifyService ) {
	     		
	  }

	  ngOnInit() {
	  		
	  		//este simplemente llama al observable, pero no estamos escuchando la respuesta del observable
	  		//this._miservicioSpotify.getArtistas("silvio");  
	  		//.subscribe();

	  		//este simplemente llama al observable, pero no estamos escuchando la respuesta del observable
	  		//necesitamos suscribirnos para escuchar la respuesta del observable
	  		this._miservicioSpotify.getArtistas("metallica")
	  		.subscribe(data=>{
	  		 	console.log('esto es del SEARCH.component');
	  		 	console.log(data);
	  		 });



	  		 /*.subscribe(data=>{
	  		 	console.log('esto es del SEARCH.component');
	  		 	console.log(data);
	  		 });*/
	  		
	  }

}