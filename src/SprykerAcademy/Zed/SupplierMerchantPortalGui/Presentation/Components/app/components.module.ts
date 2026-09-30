import { NgModule } from '@angular/core';
import { WebComponentsModule } from '@spryker/web-components';
import { ButtonActionComponent, ButtonActionModule } from '@spryker/button.action';
import { CardComponent, CardModule } from '@spryker/card';

import { SupplierListComponent } from './supplier-list/supplier-list.component';
import { SupplierListModule } from './supplier-list/supplier-list.module';
import { EditSupplierComponent } from './edit-supplier/edit-supplier.component';
import { EditSupplierModule } from './edit-supplier/edit-supplier.module';
import { SupplierLocationsTableComponent } from './supplier-locations-table/supplier-locations-table.component';
import { SupplierLocationsTableModule } from './supplier-locations-table/supplier-locations-table.module';

@NgModule({
    imports: [
        WebComponentsModule.withComponents([
            SupplierListComponent,
            ButtonActionComponent,
            EditSupplierComponent,
            CardComponent,
            // TODO: Register SupplierLocationsTableComponent (<web-mp-supplier-locations-table>)
        ]),
        SupplierListModule,
        ButtonActionModule,
        EditSupplierModule,
        CardModule,
        SupplierLocationsTableModule,
    ],
})
export class ComponentsModule {}
