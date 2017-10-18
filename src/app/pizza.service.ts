import { Injectable } from '@angular/core';
import { Http, RequestOptions} from '@angular/http';
import 'rxjs/add/operator/toPromise';
import { Observable } from 'rxjs/Observable';

@Injectable()
export class PizzaService {

  private basePathURL = 'http://localhost:80/AP2/index.php/';

  constructor( private http: Http ) { }

  TraerPizza() {
    const path = `${this.basePathURL}/pizza/obtenerTodas`;
    return this.http.get(path).toPromise().then(data => data.json());
  }

  // BorrarPizza( id, dni ) {
  //   // REQUESTOPTIONS SIRVE PARA PASAR PARAMETROS CON HTTP.
  //   const path = `${this.basePathURL}/pizza/borrar`;
  //   let requestOptions = new RequestOptions({
  //     body : {'is' : id}
  //   });
  //   return this.http.delete(path, requestOptions).toPromise();
  // }

  AgregarPizza( formData ) {
    console.log("Service", formData);
    const path = `${this.basePathURL}/pizza/agregar`;
      return this.http.post( path, formData )
            .map( res => res.json() )
            .catch( res => {
                // ToDo: Implementing modal notifications.
                alert( 'Error reingrese' );
                return Observable.throw( res.json() );
            } );
    // return this.http.post(path, formData).toPromise();
  }



//  ModificarPizza(formData){
//    console.log("esto se ejecuta");
//     return this.http.post(this.route + "pizza/modificar", formData).toPromise();
//   }

}
/*@Injectable()
export class PersonasService{

  route : string = "http://localhost:80/API/index.php/";
  constructor(private http : Http) { }

  TraerPersonas(){
    return this.http.get(this.route + "persona/obtenerTodas").toPromise().then(data => data.json());
  }

  BorrarPersona(id, dni){
    //REQUESTOPTIONS SIRVE PARA PASAR PARAMETROS CON HTTP
    let requestOptions = new RequestOptions({
      body : {"id" : id, "dni" : dni}
    });
    return this.http.delete(this.route + "persona/borrar", requestOptions).toPromise();
  }

  AgregarPersona(formData){
    return this.http.post(this.route + "persona/agregar", formData).toPromise();
  }

 ModificarPersona(formData){
   console.log("esto se ejecuta");
    return this.http.post(this.route + "persona/modificar", formData).toPromise();
  }

}*/
// }
