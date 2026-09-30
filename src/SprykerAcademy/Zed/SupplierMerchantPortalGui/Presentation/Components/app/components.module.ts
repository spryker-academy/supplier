import { NgModule } from '@angular/core';
import { WebComponentsModule } from '@spryker/web-components';

import { SupplierListComponent } from './supplier-list/supplier-list.component';
import { SupplierListModule } from './supplier-list/supplier-list.module';

@NgModule({
    imports: [
        WebComponentsModule.withComponents([
            SupplierListComponent,
        ]),
        SupplierListModule,
    ],
})
export class ComponentsModule {}
