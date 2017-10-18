import { Component } from '@angular/core';
import { PizzaService } from '../pizza.service';
import { FormBuilder, FormGroup, Validators } from '@angular/forms';
import { DialogComponent, DialogService } from 'ng2-bootstrap-modal';


@Component({
  selector: 'app-pizzas-listado',
  templateUrl: './pizzas-listado.component.html',
  styleUrls: ['./pizzas-listado.component.css']
})
export class PizzasListadoComponent {

  datosTraidos;

  constructor(
    private pizzaService: PizzaService,
    public formBuilder: FormBuilder,
    private dialogService: DialogService ) {
    this.TraerPizza();
  }


  TraerPizza() {
      this.pizzaService.TraerPizza()
      .then(data => {
        this.datosTraidos = data;
      })
      .catch(error => {
        console.log(error);
      });
  }

}
