import { Injectable } from '@angular/core';
import { Http, RequestOptions} from '@angular/http';
import 'rxjs/add/operator/toPromise';

@Injectable()
export class PizzaService {

  route : string = "http://localhost:80/API2/index.php/";
  constructor(private http : Http) { }
  
  TraerPizza(){
    return this.http.get(this.route + "pizza/obtenerTodas").toPromise().then(data => data.json());
  }
/*
  BorrarPizza(id, dni){
    //REQUESTOPTIONS SIRVE PARA PASAR PARAMETROS CON HTTP
    let requestOptions = new RequestOptions({
      body : {"id" : id}
    });
    return this.http.delete(this.route + "pizza/borrar", requestOptions).toPromise();
  }

  AgregarPizza(formData){
    return this.http.post(this.route + "pizza/agregar", formData).toPromise();
  }

 ModificarPizza(formData){
   console.log("esto se ejecuta");
    return this.http.post(this.route + "pizza/modificar", formData).toPromise();
  }

}*/
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
}