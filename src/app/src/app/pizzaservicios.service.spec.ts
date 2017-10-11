import { TestBed, inject } from '@angular/core/testing';

import { PizzaserviciosService } from './pizzaservicios.service';

describe('PizzaserviciosService', () => {
  beforeEach(() => {
    TestBed.configureTestingModule({
      providers: [PizzaserviciosService]
    });
  });

  it('should be created', inject([PizzaserviciosService], (service: PizzaserviciosService) => {
    expect(service).toBeTruthy();
  }));
});
