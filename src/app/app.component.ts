import { Component } from '@angular/core';
import { FormBuilder, FormGroup, Validators } from '@angular/forms';//FORMBUILDER CREA FORMS, FORMGROUP DEFINE UN FORMULARIO Y VALIDATORS CONTIENE VALIDACIONES PREDISEÑADAS
//import { PromptComponent } from './prompt.component';
import { PizzaService } from './pizza.service';
import { DialogComponent, DialogService } from 'ng2-bootstrap-modal';
//import { AlertComponent } from './alert.component';

@Component({
  selector: 'app-root',
  templateUrl: './app.component.html',
  styleUrls: ['./app.component.css'],
 
})
export class AppComponent {
  title = 'app';  
  formVisible = false;
  datosTraidos;
  promptMessage:string = '';

  
  constructor(private PizzaService : PizzaService, public formBuilder: FormBuilder,private dialogService:DialogService)
   {    
    this.TraerPizza();
   
  }


  TraerPizza(){
      this.PizzaService.TraerPizza()
      .then(data => {
        this.datosTraidos = data;
      }) 
      .catch(error => {
        console.log(error);
      });
  }

/*showAltaPrompt() {
    this.dialogService.addDialog( {
      title:'Alta Usuario',
      estado:true,
      nombre:'',
      apellido:'',
      sexo:'',
      dni:0,
      pass:'',
       id:0,
      foto:"http://localhost:80/API/fotos/999999.png" 
      })   
      .subscribe((message)=>{
        this.TraerPizza();
        //this.promptMessage = message;
      });

}*/
}
