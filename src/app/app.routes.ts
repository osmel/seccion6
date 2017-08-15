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
