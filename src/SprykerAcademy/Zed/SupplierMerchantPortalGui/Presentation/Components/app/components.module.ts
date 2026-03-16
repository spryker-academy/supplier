import { NgModule } from '@angular/core';
import { WebComponentsModule } from '@spryker/web-components';
import { ButtonLinkModule, ButtonLinkComponent } from '@spryker/button';

import { SupplierListComponent } from './supplier-list/supplier-list.component';
import { SupplierListModule } from './supplier-list/supplier-list.module';

@NgModule({
    imports: [
        WebComponentsModule.withComponents([
            SupplierListComponent,
            ButtonLinkComponent,
        ]),
        SupplierListModule,
        ButtonLinkModule,
    ],
})
export class ComponentsModule {}
