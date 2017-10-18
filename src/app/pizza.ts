export class Pizza {
    id: number = null;
    sabor?: String = '';
    tipo?: String = '';
    cantidad?: String = '';

    constructor( sectionData ) {
        Object.assign( this, sectionData );
    }
}
