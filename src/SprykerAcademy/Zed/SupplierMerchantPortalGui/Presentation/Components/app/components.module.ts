import { NgModule } from '@angular/core';
import { WebComponentsModule } from '@spryker/web-components';
import { ButtonActionComponent, ButtonActionModule } from '@spryker/button.action';
import { CardComponent, CardModule } from '@spryker/card';

import { SupplierListComponent } from './supplier-list/supplier-list.component';
import { SupplierListModule } from './supplier-list/supplier-list.module';
import { EditSupplierComponent } from './edit-supplier/edit-supplier.component';
import { EditSupplierModule } from './edit-supplier/edit-supplier.module';

@NgModule({
    imports: [
        WebComponentsModule.withComponents([
            SupplierListComponent,
            ButtonActionComponent,
            EditSupplierComponent,
            CardComponent,
        ]),
        SupplierListModule,
        ButtonActionModule,
        EditSupplierModule,
        CardModule,
    ],
})
export class ComponentsModule {}
