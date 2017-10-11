import { TestBed, inject } from '@angular/core/testing';

import { MiHttpServiceService } from './mi-http-service.service';

describe('MiHttpServiceService', () => {
  beforeEach(() => {
    TestBed.configureTestingModule({
      providers: [MiHttpServiceService]
    });
  });

  it('should be created', inject([MiHttpServiceService], (service: MiHttpServiceService) => {
    expect(service).toBeTruthy();
  }));
});
