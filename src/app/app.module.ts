import { BrowserModule } from '@angular/platform-browser';
import { NgModule } from '@angular/core';
import { CommonModule } from "@angular/common";
import { FormsModule, ReactiveFormsModule } from '@angular/forms';
import { HttpModule } from '@angular/http';
import { BootstrapModalModule } from 'ng2-bootstrap-modal';
//import { PromptComponent } from './prompt.component';
//import { AlertComponent } from './alert.component';
import { AppComponent } from './app.component';
import { PizzaService } from './pizza.service';

@NgModule({
  declarations: [
    AppComponent
  ],
  imports: [
    BrowserModule,
    CommonModule,
    FormsModule,
    HttpModule,
    ReactiveFormsModule,
    BootstrapModalModule
  ],
  providers: [PizzaService,AppComponent],
  bootstrap: [AppComponent]
})
export class AppModule { }
