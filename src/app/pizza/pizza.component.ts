import { Component, OnInit } from '@angular/core';
import { Router, ActivatedRoute } from '@angular/router';
import { PizzaService } from '../pizza.service';
import { Pizza } from '../pizza';

@Component({
  selector: 'app-pizza',
  templateUrl: './pizza.component.html',
  styleUrls: ['./pizza.component.css']
})
export class PizzaComponent implements OnInit {
  public pizza = new Pizza( {} );

  constructor(
      private pizzaService: PizzaService,
      private router: Router,
      private activatedRoute: ActivatedRoute,
  ) { }

  ngOnInit() {
  }
    // Refreshes if you change some data in the component.
    ngOnChanges() {

    }

    onSubmit( data ) {
      console.log(data);
       // Edit Country.
        if ( this.activatedRoute.snapshot.params[ 'id' ] ) {
          console.log( 'Edit' );
            // const oldCode = this.pizza.code;
            data.name = document.querySelector( 'option[value=' + data.code + ']' ).innerHTML;
            Object.assign( this.pizza, data );
            // this.pizzaService.patch( this.pizzas, oldCode ).subscribe( () => {
            //     this.router.navigate( [ '/pizzas' ] );
            // } );
        } else {
          console.log( 'Post' );
            // Create Country
            this.pizzaService.AgregarPizza( data ).subscribe( () => {
                this.router.navigate( [ '/pizzas' ] );
            } );
        }
    }
}
