import { NgModule } from '@angular/core';
import { WebComponentsModule } from '@spryker/web-components';
import { ButtonLinkModule, ButtonLinkComponent } from '@spryker/button';
import { CardModule, CardComponent } from '@spryker/card';

import { SupplierListComponent } from './supplier-list/supplier-list.component';
import { SupplierListModule } from './supplier-list/supplier-list.module';
import { EditSupplierComponent } from './edit-supplier/edit-supplier.component';
import { EditSupplierModule } from './edit-supplier/edit-supplier.module';

@NgModule({
    imports: [
        WebComponentsModule.withComponents([
            SupplierListComponent,
            ButtonLinkComponent,
            EditSupplierComponent,
            CardComponent,
        ]),
        SupplierListModule,
        ButtonLinkModule,
        EditSupplierModule,
        CardModule,
    ],
})
export class ComponentsModule {}
