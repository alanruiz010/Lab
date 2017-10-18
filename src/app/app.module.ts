import { BrowserModule } from '@angular/platform-browser';
import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';
import { FormsModule, ReactiveFormsModule } from '@angular/forms';
import { HttpModule } from '@angular/http';
import { Routes, RouterModule } from '@angular/router';
import { BootstrapModalModule } from 'ng2-bootstrap-modal';

import { AppComponent } from './app.component';
import { MenuComponent } from './menu/menu.component';
import { PizzasListadoComponent } from './pizzas-listado/pizzas-listado.component';
import { PizzaComponent } from './pizza/pizza.component';
import { PizzaService } from './pizza.service';

const routes: Routes = [
    { path: 'pizzas', component: PizzasListadoComponent },
    { path: 'pizza', component: PizzaComponent },
    // { path: 'pizza/:postId', component: PizzaComponent },
    { path: '', pathMatch: 'full', redirectTo: '/pizzas' }
];


@NgModule({
  declarations: [
    AppComponent,
    PizzasListadoComponent,
    PizzaComponent,
    MenuComponent,
  ],
  imports: [
    BrowserModule,
    RouterModule.forRoot(routes),
    CommonModule,
    FormsModule,
    HttpModule,
    ReactiveFormsModule,
    BootstrapModalModule
  ],
  providers: [PizzaService, AppComponent],
  bootstrap: [AppComponent]
})
export class AppModule { }
