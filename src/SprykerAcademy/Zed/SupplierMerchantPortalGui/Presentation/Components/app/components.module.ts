import { NgModule } from '@angular/core';
import { WebComponentsModule } from '@spryker/web-components';

import { SupplierListComponent } from './supplier-list/supplier-list.component';
import { SupplierListModule } from './supplier-list/supplier-list.module';

@NgModule({
    imports: [
        // TODO: Register SupplierListComponent as a web component, so Twig can render <web-mp-supplier-list>.
        // Hint: WebComponentsModule.withComponents([SupplierListComponent])
        WebComponentsModule.withComponents([]),
        SupplierListModule,
    ],
})
export class ComponentsModule {}
